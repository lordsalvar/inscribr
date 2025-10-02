<?php

namespace App\Filament\Resources\Offices\RelationManagers;

use App\Filament\Resources\Users\UserResource;
use App\Enums\UserRoles;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OfficersRelationManager extends RelationManager
{
    protected static string $relationship = 'officers';

    protected static ?string $relatedResource = UserResource::class;

    protected static ?string $title = 'Officers';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email Address')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('role'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Assign')
                    ->modalHeading('Assign Officer')
                    ->modalSubmitActionLabel('Assign')
                    ->attachAnother(false)
                    ->preloadRecordSelect()
                    ->recordSelectOptionsQuery(function (Builder $query) {
                        return $query->where('role', UserRoles::OFFICER->value);
                    }),
            ])
            ->recordActions([
                DetachAction::make()
                    ->label('Remove')
                    ->modalHeading('Remove Officer')
                    ->modalSubmitActionLabel('Remove'),
            ])
            ->bulkActions([
                DetachBulkAction::make()
                    ->label('Remove')
                    ->modalHeading('Remove Officers')
                    ->modalSubmitActionLabel('Remove'),
            ]);
    }
}
