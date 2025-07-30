<?php

namespace App\Filament\Resources\ClaimAttentionReportResource\Pages;

use App\Filament\Resources\ClaimAttentionReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClaimAttentionReports extends ListRecords
{
    protected static string $resource = ClaimAttentionReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Add any header actions here
        ];
    }
}
