<?php

namespace App\Filament\Resources\Employees\Tables;

use App\Enums\Sex;
use App\Models\Office;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\EmploymentStatus;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Name')
                    ->getStateUsing(function ($record): string {
                        $suffix = $record->suffix ?? null;
                        if (is_string($suffix) && trim($suffix) === 'N/A') {
                            $suffix = null;
                        }

                        $nameParts = array_filter([
                            $record->first_name ?? null,
                            $record->middle_name ?? null,
                            $suffix,
                        ], fn ($value) => filled($value));

                        $lastName = $record->last_name ?? '';
                        $rightSide = trim(implode(' ', $nameParts));

                        if (filled($lastName) && filled($rightSide)) {
                            return $lastName . ', ' . $rightSide;
                        }

                        return trim($lastName ?: $rightSide);
                    })
                    ->searchable(query: function (Builder $query, string $search) {
                        $query->where(function (Builder $q) use ($search) {
                            $q->where('first_name', 'like', "%{$search}%")
                                ->orWhere('middle_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%")
                                ->orWhere('suffix', 'like', "%{$search}%");
                        });
                    }),
				TextColumn::make('office.acronym')
                    ->label('Office')
                    ->searchable(),
				TextColumn::make('designation')
                    ->searchable()
					->toggleable(isToggledHiddenByDefault: true)
					->visibleFrom('lg'),
				TextColumn::make('employment_status')
                    ->searchable()
					->toggleable(isToggledHiddenByDefault: false)
					->visibleFrom('md'),
				TextColumn::make('group')
                    ->searchable()
					->toggleable(isToggledHiddenByDefault: true)
					->visibleFrom('lg'),
				TextColumn::make('registration_date')
                    ->dateTime()
                    ->sortable()
					->toggleable(isToggledHiddenByDefault: false)
					->visibleFrom('md'),
                TextColumn::make('scanner_id')
                    ->label('Convo ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
				TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
					->toggleable(isToggledHiddenByDefault: true)
					->visibleFrom('lg'),
				TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
					->toggleable(isToggledHiddenByDefault: true)
					->visibleFrom('lg'),
                    
            ])
            ->filters([
                SelectFilter::make('office_id')
                    ->label('Office')
                    ->options(Office::all()->pluck('acronym', 'id')),
                SelectFilter::make('employment_status')
                    ->label('Employment Status')
                    ->options(function () {
                        return collect(EmploymentStatus::cases())
                            ->mapWithKeys(fn (EmploymentStatus $e) => [$e->value => $e->value])
                            ->all();
                    }),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
