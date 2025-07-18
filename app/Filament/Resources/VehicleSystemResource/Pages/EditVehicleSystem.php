<?php

namespace App\Filament\Resources\VehicleSystemResource\Pages;

use App\Filament\Resources\VehicleSystemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleSystem extends EditRecord
{
    protected static string $resource = VehicleSystemResource::class;

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
