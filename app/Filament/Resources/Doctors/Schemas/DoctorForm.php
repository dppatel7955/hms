<?php

namespace App\Filament\Resources\Doctors\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DoctorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name', modifyQueryUsing: fn ($query) => $query->where('role', 'doctor'))
                    ->required()
                    ->label('Doctor User Account'),
                Select::make('department_id')
                    ->relationship('department', 'name')
                    ->required()
                    ->label('Department'),
                TextInput::make('specialization')
                    ->required()
                    ->placeholder('e.g. Cardiologist, Neurologist')
                    ->maxLength(255),
                TextInput::make('license_number')
                    ->required()
                    ->placeholder('e.g. DOC12345')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                TextInput::make('consultation_fee')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->default(0.00),
                Textarea::make('biography')
                    ->default(null)
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }
}
