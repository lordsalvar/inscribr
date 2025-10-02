<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Remove offices from the main data as it will be handled separately
        $offices = $data['offices'] ?? [];
        unset($data['offices']);
        
        return $data;
    }

    protected function afterCreate(): void
    {
        // Sync the offices after the user is created
        $offices = $this->form->getState()['offices'] ?? [];
        if (!empty($offices)) {
            $this->record->offices()->sync($offices);
        }
    }
}
