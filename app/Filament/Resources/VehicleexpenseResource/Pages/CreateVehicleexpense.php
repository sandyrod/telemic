<?php

namespace App\Filament\Resources\VehicleexpenseResource\Pages;

use App\Filament\Resources\VehicleexpenseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVehicleexpense extends CreateRecord
{
    protected static string $resource = VehicleexpenseResource::class;

    protected function getCreatedNotificationRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('index');
    }
}
