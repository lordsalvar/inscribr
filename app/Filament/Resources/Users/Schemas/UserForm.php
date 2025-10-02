<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Office;
use App\Enums\UserRoles;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
                Select::make('role')
                    ->options([
                        UserRoles::ADMIN->value => 'Admin',
                        UserRoles::OFFICER->value => 'Officer',
                    ])
                    ->required(),
                Select::make('offices')
                    ->label('Offices')
                    ->options(Office::all()->pluck('name', 'id'))
                    ->searchable()
                    ->multiple()
                    ->preload()
                    ->visible(fn ($get) => $get('role') === UserRoles::OFFICER->value),
            ]);
    }
}
