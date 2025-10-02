<?php

namespace App\Filament\Resources\Offices\RelationManagers;

use App\Filament\Actions\EnrollEmployeeAction;
use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EnrolledEmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'enrolledEmployees';

    protected static ?string $relatedResource = EmployeeResource::class;

    protected static ?string $title = 'Enrolled Employees';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')->searchable()->sortable(),
                TextColumn::make('last_name')->searchable()->sortable(),
                TextColumn::make('office_scanner_id')
                    ->label('Office Scanner ID')
                    ->getStateUsing(fn ($record) => $record->pivot?->office_scanner_id)
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('employee_office.office_scanner_id', $direction)
                            ->orderBy('employees.id');
                    }),
            ])
            ->headerActions([
                EnrollEmployeeAction::make(),
            ]);
    }
}


