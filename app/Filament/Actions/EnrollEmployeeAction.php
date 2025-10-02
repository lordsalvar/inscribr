<?php

namespace App\Filament\Actions;

use App\Models\Employee;
use Filament\Actions\Action;
use Filament\Forms\Components\Select as FormSelect;
use Filament\Resources\RelationManagers\RelationManager;

class EnrollEmployeeAction
{
    public static function make(): Action
    {
        return Action::make('enrollEmployee')
            ->label('Enroll employee')
            ->form([
                FormSelect::make('id')
                    ->label('Employee')
                    ->searchable()
                    ->preload()
                    ->options(fn () => Employee::query()
                        ->orderBy('last_name')
                        ->get()
                        ->mapWithKeys(fn (Employee $e) => [
                            $e->id => trim($e->last_name . ', ' . $e->first_name . ' ' . ($e->middle_name ?? '')),
                        ]))
                    ->required(),
            ])
            ->action(function (array $data, RelationManager $livewire): void {
                $office = $livewire->getOwnerRecord();

                $next = $office->enrolledEmployees()->max('employee_office.office_scanner_id');
                $next = is_null($next) ? 1 : ($next + 1);

                $employee = Employee::findOrFail($data['id']);
                $office->enrolledEmployees()->attach($employee->id, [
                    'office_scanner_id' => $next,
                ]);
            });
    }
}


