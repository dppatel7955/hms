<?php

namespace App\Filament\Resources\Prescriptions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Schemas\Schema;

class PrescriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Prescription Details')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('consultation_id')
                                    ->relationship('consultation', 'id', modifyQueryUsing: fn ($query) => $query->with('patient.user'))
                                    ->getOptionLabelFromRecordUsing(fn ($record) => "Consultation #{$record->id} - " . ($record->patient?->user?->name ?? "Patient") . " (" . $record->created_at->format('M j, Y') . ")")
                                    ->required()
                                    ->label('Consultation Record'),
                                Select::make('patient_id')
                                    ->relationship('patient', 'id', modifyQueryUsing: fn ($query) => $query->with('user'))
                                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user?->name ?? "Patient #{$record->id}")
                                    ->required()
                                    ->label('Patient'),
                                Select::make('doctor_id')
                                    ->relationship('doctor', 'id', modifyQueryUsing: fn ($query) => $query->with('user'))
                                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user?->name ?? "Doctor #{$record->id}")
                                    ->required()
                                    ->label('Doctor'),
                            ]),
                        Textarea::make('notes')
                            ->placeholder('General notes or pharmacological advice...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Medicines & Dosage')
                    ->schema([
                        Repeater::make('items')
                            ->relationship('items')
                            ->schema([
                                Grid::make(4)
                                    ->schema([
                                        TextInput::make('medicine_name')
                                            ->required()
                                            ->placeholder('e.g. Paracetamol 500mg')
                                            ->maxLength(255),
                                        TextInput::make('dosage')
                                            ->required()
                                            ->placeholder('e.g. 1 tablet / 5ml')
                                            ->maxLength(255),
                                        TextInput::make('frequency')
                                            ->required()
                                            ->placeholder('e.g. 3 times daily')
                                            ->maxLength(255),
                                        TextInput::make('duration')
                                            ->required()
                                            ->placeholder('e.g. 5 days')
                                            ->maxLength(255),
                                    ]),
                                Textarea::make('instructions')
                                    ->placeholder('Specific instructions (e.g. Take after meals, avoid alcohol)')
                                    ->rows(2)
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull()
                            ->itemLabel(fn (array $state): ?string => $state['medicine_name'] ?? 'New Medicine')
                            ->defaultItems(1)
                            ->reorderable(true),
                    ]),
            ]);
    }
}
