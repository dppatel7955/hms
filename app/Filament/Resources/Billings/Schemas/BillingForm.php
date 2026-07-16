<?php

namespace App\Filament\Resources\Billings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BillingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Invoice Information')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('patient_id')
                                    ->relationship('patient', 'id', modifyQueryUsing: fn ($query) => $query->with('user'))
                                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user?->name ?? "Patient #{$record->id}")
                                    ->searchable()
                                    ->required()
                                    ->label('Patient'),
                                TextInput::make('invoice_number')
                                    ->required()
                                    ->default(fn () => 'INV-' . date('Y') . '-' . strtoupper(Str::random(6)))
                                    ->readOnly()
                                    ->label('Invoice Number'),
                                DatePicker::make('billing_date')
                                    ->required()
                                    ->native(false)
                                    ->default(now())
                                    ->label('Billing Date'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Select::make('status')
                                    ->options([
                                        'unpaid' => 'Unpaid',
                                        'paid' => 'Paid',
                                        'partially_paid' => 'Partially Paid',
                                    ])
                                    ->required()
                                    ->default('unpaid'),
                                Select::make('payment_method')
                                    ->options([
                                        'cash' => 'Cash',
                                        'card' => 'Credit/Debit Card',
                                        'insurance' => 'Health Insurance',
                                        'bank_transfer' => 'Bank Transfer',
                                    ])
                                    ->placeholder('Select payment method...')
                                    ->default(null),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Select::make('appointment_id')
                                    ->relationship('appointment', 'id', modifyQueryUsing: fn ($query) => $query->with('patient.user'))
                                    ->getOptionLabelFromRecordUsing(fn ($record) => "Appt #{$record->id} - " . ($record->patient?->user?->name ?? "Patient") . " (" . $record->appointment_date->format('M j, Y') . ")")
                                    ->placeholder('None')
                                    ->default(null)
                                    ->label('Link Appointment'),
                                Select::make('admission_id')
                                    ->relationship('admission', 'id', modifyQueryUsing: fn ($query) => $query->with('patient.user'))
                                    ->getOptionLabelFromRecordUsing(fn ($record) => "Admission #{$record->id} - " . ($record->patient?->user?->name ?? "Patient") . " (" . $record->admission_date->format('M j, Y') . ")")
                                    ->placeholder('None')
                                    ->default(null)
                                    ->label('Link Room Admission'),
                            ]),
                    ]),

                Section::make('Invoice Line Items')
                    ->schema([
                        Repeater::make('items')
                            ->relationship('items')
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->placeholder('e.g. Consultation Fee, Lab Test, Medicine')
                                    ->columnSpan(2),
                                TextInput::make('amount')
                                    ->numeric()
                                    ->required()
                                    ->prefix('$')
                                    ->placeholder('0.00')
                                    ->live(onBlured: true)
                                    ->afterStateUpdated(fn (Get $get, Set $set) => self::calculateTotals($get, $set)),
                                TextInput::make('quantity')
                                    ->integer()
                                    ->required()
                                    ->default(1)
                                    ->live()
                                    ->afterStateUpdated(fn (Get $get, Set $set) => self::calculateTotals($get, $set)),
                            ])
                            ->columns(4)
                            ->columnSpanFull()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'New Line Item')
                            ->defaultItems(1)
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::calculateTotals($get, $set)),
                    ]),

                Section::make('Totals Summary')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextInput::make('total_amount')
                                    ->numeric()
                                    ->readOnly()
                                    ->prefix('$')
                                    ->default(0.00)
                                    ->label('Subtotal'),
                                TextInput::make('discount')
                                    ->numeric()
                                    ->prefix('$')
                                    ->default(0.00)
                                    ->live(onBlured: true)
                                    ->afterStateUpdated(fn (Get $get, Set $set) => self::calculateTotals($get, $set))
                                    ->label('Discount'),
                                TextInput::make('tax')
                                    ->numeric()
                                    ->readOnly()
                                    ->prefix('$')
                                    ->default(0.00)
                                    ->label('Tax (8%)'),
                                TextInput::make('grand_total')
                                    ->numeric()
                                    ->readOnly()
                                    ->prefix('$')
                                    ->default(0.00)
                                    ->label('Grand Total'),
                            ]),
                    ]),
            ]);
    }

    /**
     * Helper function to calculate subtotal, tax, and grand total dynamically.
     */
    public static function calculateTotals(Get $get, Set $set): void
    {
        $items = $get('items') ?? [];
        $subtotal = 0;

        foreach ($items as $item) {
            $amount = floatval($item['amount'] ?? 0);
            $qty = intval($item['quantity'] ?? 1);
            $subtotal += $amount * $qty;
        }

        $discount = floatval($get('discount') ?? 0);
        $taxableAmount = max(0, $subtotal - $discount);
        
        // Let's charge a flat 8% tax rate
        $tax = round($taxableAmount * 0.08, 2);
        $grandTotal = round($taxableAmount + $tax, 2);

        $set('total_amount', round($subtotal, 2));
        $set('tax', $tax);
        $set('grand_total', $grandTotal);
    }
}
