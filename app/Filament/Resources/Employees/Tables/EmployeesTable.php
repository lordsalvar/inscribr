<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Name')
                    ->getStateUsing(function ($record): string {
                        $parts = array_filter([
                            $record->last_name ?? null,
                            $record->first_name ?? null,
                            $record->middle_name ?? null,
                            $record->suffix ?? null,
                        ], fn ($value) => filled($value));

                        return trim(implode(' ', $parts));
                    })
                    ->searchable(query: function (Builder $query, string $search) {
                        $query->where(function (Builder $q) use ($search) {
                            $q->where('first_name', 'like', "%{$search}%")
                                ->orWhere('middle_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%")
                                ->orWhere('suffix', 'like', "%{$search}%");
                        });
                    }),
                SelectColumn::make('gender')
                    ->options(Gender::class),
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
