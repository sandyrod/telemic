<?php

namespace App\Filament\Resources\VehicleSystemResource\Pages;

use App\Filament\Resources\VehicleSystemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVehicleSystem extends CreateRecord
{
    protected static string $resource = VehicleSystemResource::class;

    protected function getCreatedNotificationRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('index');
    }
}
