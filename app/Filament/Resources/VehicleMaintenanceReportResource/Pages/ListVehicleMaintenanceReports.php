<?php

namespace App\Filament\Resources\VehicleMaintenanceReportResource\Pages;

use App\Filament\Resources\VehicleMaintenanceReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleMaintenanceReports extends ListRecords
{
    protected static string $resource = VehicleMaintenanceReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Add any header actions here
        ];
    }
}
