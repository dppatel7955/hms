<?php

namespace App\Filament\Resources\Patients\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PatientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Patient Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date_of_birth')
                    ->label('DOB')
                    ->date()
                    ->sortable(),
                TextColumn::make('gender')
                    ->sortable(),
                TextColumn::make('blood_group')
                    ->label('Blood Group')
                    ->badge()
                    ->color('info')
                    ->sortable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('emergency_contact_name')
                    ->label('Emergency Contact')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('emergency_contact_phone')
                    ->label('Emergency Phone')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
