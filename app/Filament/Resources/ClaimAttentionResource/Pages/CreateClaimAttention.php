<?php

namespace App\Filament\Resources\ClaimAttentionResource\Pages;

use App\Filament\Resources\ClaimAttentionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClaimAttention extends CreateRecord
{
    protected static string $resource = ClaimAttentionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Atención a Reclamo creada exitosamente';
    }
}
