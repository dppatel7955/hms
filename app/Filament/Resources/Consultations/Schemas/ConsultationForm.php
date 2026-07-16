<?php

namespace App\Filament\Resources\Consultations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Schemas\Schema;

class ConsultationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->description('Select the appointment and verify patient/doctor details.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('appointment_id')
                                    ->relationship('appointment', 'id', modifyQueryUsing: fn ($query) => $query->with(['patient.user']))
                                    ->getOptionLabelFromRecordUsing(fn ($record) => "Appt #{$record->id} - " . ($record->patient?->user?->name ?? "Patient") . " (" . $record->appointment_date->format('M j, Y H:i') . ")")
                                    ->searchable()
                                    ->required()
                                    ->label('Appointment'),
                                Select::make('patient_id')
                                    ->relationship('patient', 'id', modifyQueryUsing: fn ($query) => $query->with('user'))
                                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user?->name ?? "Patient #{$record->id}")
                                    ->searchable()
                                    ->required()
                                    ->label('Patient'),
                                Select::make('doctor_id')
                                    ->relationship('doctor', 'id', modifyQueryUsing: fn ($query) => $query->with('user'))
                                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user?->name ?? "Doctor #{$record->id}")
                                    ->searchable()
                                    ->required()
                                    ->label('Doctor'),
                            ]),
                    ]),
                
                Section::make('Clinical Vitals')
                    ->description('Record patient vital signs.')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextInput::make('weight_kg')
                                    ->numeric()
                                    ->label('Weight')
                                    ->suffix('kg')
                                    ->placeholder('e.g. 70.5')
                                    ->default(null),
                                TextInput::make('blood_pressure')
                                    ->label('Blood Pressure')
                                    ->placeholder('e.g. 120/80')
                                    ->maxLength(10)
                                    ->default(null),
                                TextInput::make('temperature_c')
                                    ->numeric()
                                    ->label('Temperature')
                                    ->suffix('°C')
                                    ->placeholder('e.g. 36.8')
                                    ->default(null),
                                TextInput::make('pulse_rate')
                                    ->numeric()
                                    ->label('Pulse Rate')
                                    ->suffix('bpm')
                                    ->placeholder('e.g. 72')
                                    ->default(null),
                            ]),
                    ]),
                
                Section::make('Clinical Notes')
                    ->description('Record symptoms, diagnosis, and treatment plan.')
                    ->schema([
                        Textarea::make('symptoms')
                            ->required()
                            ->rows(3)
                            ->placeholder('Describe the symptoms reported by the patient...')
                            ->columnSpanFull(),
                        Textarea::make('diagnosis')
                            ->required()
                            ->rows(3)
                            ->placeholder('Enter the clinical diagnosis...')
                            ->columnSpanFull(),
                        Textarea::make('treatment_plan')
                            ->rows(4)
                            ->placeholder('Outline the treatment, lifestyle changes, and follow-up plan...')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
