<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Enums\EmploymentStatus;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('middle_name'),
                TextInput::make('suffix')
                    ->required(),
                Select::make('office_id')
                    ->label('Office')
                    ->relationship('office', 'name')
                    ->required(),
                TextInput::make('designation'),
                Select::make('employment_status')
                    ->options(EmploymentStatus::class)
                    ->required(),
                TextInput::make('group')
                    ->required(),
                DateTimePicker::make('registration_date')
                    ->required(),
                TextInput::make('scanner_id')
                    ->required(),
                TextInput::make('office_scanner_id')
                    ->required(),
            ]);
    }
}
