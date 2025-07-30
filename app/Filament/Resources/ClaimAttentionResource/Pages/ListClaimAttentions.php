<?php

namespace App\Filament\Resources\ClaimAttentionResource\Pages;

use App\Filament\Resources\ClaimAttentionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClaimAttentions extends ListRecords
{
    protected static string $resource = ClaimAttentionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nueva Atención a Reclamo'),
        ];
    }
}
