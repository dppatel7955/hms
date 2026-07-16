<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('patient_id')
                    ->relationship('patient', 'id', modifyQueryUsing: fn ($query) => $query->with('user'))
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user?->name ?? "Patient #{$record->id}")
                    ->searchable()
                    ->required()
                    ->label('Patient'),
                Select::make('doctor_id')
                    ->relationship('doctor', 'id', modifyQueryUsing: fn ($query) => $query->with('user'))
                    ->getOptionLabelFromRecordUsing(fn ($record) => ($record->user?->name ?? "Doctor #{$record->id}") . " - {$record->specialization}")
                    ->searchable()
                    ->required()
                    ->label('Doctor'),
                DateTimePicker::make('appointment_date')
                    ->required()
                    ->native(false)
                    ->minDate(now()->subDays(30))
                    ->label('Appointment Date & Time'),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required()
                    ->default('pending'),
                Textarea::make('reason')
                    ->placeholder('Enter primary symptoms or reason for visit...')
                    ->rows(3)
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->placeholder('Internal staff notes (optional)...')
                    ->rows(3)
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
