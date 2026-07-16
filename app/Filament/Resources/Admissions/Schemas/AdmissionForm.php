<?php

namespace App\Filament\Resources\Admissions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Schemas\Schema;

class AdmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Admission & Room Assignment')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('patient_id')
                                    ->relationship('patient', 'id', modifyQueryUsing: fn ($query) => $query->with('user'))
                                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user?->name ?? "Patient #{$record->id}")
                                    ->searchable()
                                    ->required()
                                    ->label('Patient'),
                                Select::make('room_id')
                                    ->relationship('room', 'id')
                                    ->getOptionLabelFromRecordUsing(fn ($record) => "Room {$record->room_number} - " . ucfirst($record->type) . " (\${$record->price_per_day}/day)")
                                    ->searchable()
                                    ->required()
                                    ->label('Room'),
                            ]),
                    ]),

                Section::make('Stay Timeline & Clinical Reason')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                DateTimePicker::make('admission_date')
                                    ->required()
                                    ->native(false)
                                    ->label('Admission Date & Time'),
                                DateTimePicker::make('discharge_date')
                                    ->native(false)
                                    ->label('Discharge Date & Time'),
                                Select::make('status')
                                    ->options([
                                        'admitted' => 'Admitted',
                                        'discharged' => 'Discharged',
                                    ])
                                    ->required()
                                    ->default('admitted'),
                            ]),
                        Textarea::make('reason')
                            ->placeholder('Enter main clinical reason for inpatient stay...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
