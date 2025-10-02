<?php

namespace App\Filament\Resources\Employees\Schemas;

use App\Models\Employee;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use App\Enums\EmploymentStatus;
use App\Enums\CivilStatus;
use App\Enums\Sex;
use App\Enums\Status;

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
                TextInput::make('suffix'),
                Select::make('sex')
                    ->options(Sex::class)
                    ->required(),
                Select::make('civil_status')
                    ->options(CivilStatus::class)
                    ->required(),
                Select::make('office_id')
                    ->label('Office')
                    ->relationship('office', 'name')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state) {
                        if (blank($state)) {
                            $set('scanner_id', null);
                            return;
                        }

                        $max = Employee::where('office_id', $state)->max('scanner_id');
                        $set('scanner_id', is_null($max) ? 1 : ($max + 1));
                    }),
                TextInput::make('designation'),
                Select::make('employment_status')
                    ->options(EmploymentStatus::class)
                    ->required(),
                TextInput::make('group')
                    ->required(),
                DateTimePicker::make('registration_date')
                    ->required(),
                TextInput::make('scanner_id')
                    ->label('Convo ID')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                Select::make('status')
                    ->options(Status::class)
                    ->required(),
            ]);
    }
}
