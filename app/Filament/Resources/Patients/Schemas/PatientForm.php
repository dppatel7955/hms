<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name', modifyQueryUsing: fn ($query) => $query->where('role', 'patient'))
                    ->required()
                    ->label('Patient User Account'),
                DatePicker::make('date_of_birth')
                    ->required()
                    ->native(false)
                    ->maxDate(now()),
                Select::make('gender')
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                        'Other' => 'Other',
                    ])
                    ->required(),
                Select::make('blood_group')
                    ->options([
                        'A+' => 'A+',
                        'A-' => 'A-',
                        'B+' => 'B+',
                        'B-' => 'B-',
                        'AB+' => 'AB+',
                        'AB-' => 'AB-',
                        'O+' => 'O+',
                        'O-' => 'O-',
                    ])
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(20)
                    ->default(null),
                TextInput::make('emergency_contact_name')
                    ->label('Emergency Contact Name')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('emergency_contact_phone')
                    ->label('Emergency Contact Phone')
                    ->tel()
                    ->maxLength(20)
                    ->default(null),
                Textarea::make('address')
                    ->rows(3)
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('medical_history')
                    ->label('Pre-existing Medical History')
                    ->rows(4)
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
