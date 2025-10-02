<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load the offices for the form
        $data['offices'] = $this->record->offices()->pluck('id')->toArray();
        
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Remove offices from the main data as it will be handled separately
        $offices = $data['offices'] ?? [];
        unset($data['offices']);
        
        return $data;
    }

    protected function afterSave(): void
    {
        // Sync the offices after the user is updated
        $offices = $this->form->getState()['offices'] ?? [];
        $this->record->offices()->sync($offices);
    }
}
