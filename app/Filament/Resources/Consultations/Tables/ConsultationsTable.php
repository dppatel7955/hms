<?php

namespace App\Filament\Resources\Consultations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConsultationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('appointment.id')
                    ->label('Appt ID')
                    ->sortable(),
                TextColumn::make('patient.user.name')
                    ->label('Patient')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('doctor.user.name')
                    ->label('Doctor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('diagnosis')
                    ->limit(30)
                    ->searchable(),
                TextColumn::make('weight_kg')
                    ->label('Weight')
                    ->suffix(' kg')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('blood_pressure')
                    ->label('BP')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('temperature_c')
                    ->label('Temp')
                    ->suffix(' °C')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('pulse_rate')
                    ->label('Pulse')
                    ->suffix(' bpm')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('M j, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
