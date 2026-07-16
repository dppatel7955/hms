<?php

namespace App\Filament\Resources\Rooms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class RoomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('room_number')
                    ->required()
                    ->placeholder('e.g. 101A, ICU-1')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Select::make('type')
                    ->options([
                        'general' => 'General Ward',
                        'semi_private' => 'Semi-Private Room',
                        'private' => 'Private Room',
                        'icu' => 'ICU',
                    ])
                    ->required(),
                Select::make('status')
                    ->options([
                        'available' => 'Available',
                        'occupied' => 'Occupied',
                        'maintenance' => 'Under Maintenance',
                    ])
                    ->required()
                    ->default('available'),
                TextInput::make('price_per_day')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->default(0.00),
            ]);
    }
}
