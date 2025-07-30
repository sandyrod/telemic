<?php

namespace App\Filament\Resources\ClaimAttentionResource\Pages;

use App\Filament\Resources\ClaimAttentionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClaimAttention extends EditRecord
{
    protected static string $resource = ClaimAttentionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Atención a Reclamo actualizada exitosamente';
    }
}
