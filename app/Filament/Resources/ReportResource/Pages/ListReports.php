<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReports extends ListRecords
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('export_all_pdf')
                ->label('Exportar todo a PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->url(route('inspections.all-pdf'))
                ->openUrlInNewTab(),
        ];
    }
}
