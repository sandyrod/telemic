<?php

namespace App\Filament\Resources\VehicleexpenseResource\Pages;

use App\Filament\Resources\VehicleexpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleexpense extends EditRecord
{
    protected static string $resource = VehicleexpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getSavedNotificationRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('index');
    }
}
