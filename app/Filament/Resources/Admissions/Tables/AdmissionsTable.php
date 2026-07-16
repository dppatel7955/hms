<?php

namespace App\Filament\Resources\Admissions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class AdmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.user.name')
                    ->label('Patient Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('room.room_number')
                    ->label('Room')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('admission_date')
                    ->label('Admitted')
                    ->dateTime('M j, Y h:i A')
                    ->sortable(),
                TextColumn::make('discharge_date')
                    ->label('Discharged')
                    ->dateTime('M j, Y h:i A')
                    ->placeholder('Still Admitted')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admitted' => 'warning',
                        'discharged' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'admitted' => 'Admitted',
                        'discharged' => 'Discharged',
                    ]),
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
