<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('last_name')
                    ->searchable(),
                TextColumn::make('first_name')
                    ->searchable(),
                TextColumn::make('middle_name')
                    ->searchable(),
                TextColumn::make('suffix')
                    ->searchable(),
                TextColumn::make('office_id')
                    ->label('Office')
                    ->searchable(),
                TextColumn::make('designation')
                    ->searchable(),
                TextColumn::make('employment_status')
                    ->searchable(),
                TextColumn::make('group')
                    ->searchable(),
                TextColumn::make('registration_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('scanner_id')
                    ->label('Convo ID')
                    ->searchable(),
                TextColumn::make('office_scanner_id')
                    ->label('Daily ID')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
