<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Models\ClaimAttention;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClaimAttentionsReport extends ListRecords
{
    protected static string $resource = \App\Filament\Resources\ReportResource::class;
    protected static string $view = 'filament.resources.report-resource.pages.claim-attentions-report';
    
    protected static ?string $title = 'Reporte de Atenciones y Reclamos';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Atenciones y Reclamos';
    protected static ?string $navigationGroup = 'Reportes';
    protected static ?int $navigationSort = 2;
    
    public static function getNavigationItems(array $urlParameters = []): array
    {
        return [
            \Filament\Navigation\NavigationItem::make()
                ->group('Reportes')
                ->icon(static::getNavigationIcon())
                ->label(static::getNavigationLabel())
                ->url(static::getUrl($urlParameters))
                ->isActiveWhen(fn (): bool => request()->is('*/claim-attentions*'))
        ];
    }
    
    protected function getTableQuery(): Builder
    {
        return ClaimAttention::query();
    }
    
    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('exportPdf')
                ->label('Exportar a PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action('exportPdf')
        ];
    }
    
    protected function getTableHeaderActions(): array
    {
        return [
            \Filament\Tables\Actions\BulkAction::make('exportBulkPdf')
                ->label('Exportar selección a PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->action('exportBulkPdf')
        ];
    }
    
    public function table(Table $table): Table
    {
        return $table
            ->query(ClaimAttention::query())
            ->columns([
                Tables\Columns\TextColumn::make('tipo_reclamo')
                    ->label('Tipo de Reclamo')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('abonado')
                    ->label('Abonado')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('servicio')
                    ->label('Servicio')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('subnodo')
                    ->label('Nodo')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('fecha_ingreso')
                    ->label('Fecha Ingreso')
                    ->date()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('fecha_finalizacion')
                    ->label('Fecha Finalización')
                    ->date(),
                    
                Tables\Columns\TextColumn::make('tecnicos')
                    ->label('Técnicos')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('tipo_orden')
                    ->label('Tipo de Orden')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tipo_reclamo')
                    ->options([
                        'Fibrahogar' => 'Fibrahogar',
                        'Instalaciones/Reconexiones' => 'Instalaciones/Reconexiones',
                        'Morosidad/Bajas Voluntarias' => 'Morosidad/Bajas Voluntarias',
                    ])
                    ->label('Tipo de Reclamo'),
                    
                Tables\Filters\Filter::make('fecha_ingreso')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('fecha_desde')
                            ->label('Desde'),
                        \Filament\Forms\Components\DatePicker::make('fecha_hasta')
                            ->label('Hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['fecha_desde'],
                                fn (Builder $query, $date): Builder => $query->whereDate('fecha_ingreso', '>=', $date),
                            )
                            ->when(
                                $data['fecha_hasta'],
                                fn (Builder $query, $date): Builder => $query->whereDate('fecha_ingreso', '<=', $date),
                            );
                    })
                    ->label('Rango de Fechas de Ingreso'),
                    
                Tables\Filters\Filter::make('fecha_finalizacion')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('fin_desde')
                            ->label('Desde'),
                        \Filament\Forms\Components\DatePicker::make('fin_hasta')
                            ->label('Hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['fin_desde'],
                                fn (Builder $query, $date): Builder => $query->whereDate('fecha_finalizacion', '>=', $date),
                            )
                            ->when(
                                $data['fin_hasta'],
                                fn (Builder $query, $date): Builder => $query->whereDate('fecha_finalizacion', '<=', $date),
                            );
                    })
                    ->label('Rango de Fechas de Finalización'),
                    
                Tables\Filters\SelectFilter::make('tipo_orden')
                    ->options(function (): array {
                        return ClaimAttention::query()
                            ->whereNotNull('tipo_orden')
                            ->distinct()
                            ->pluck('tipo_orden', 'tipo_orden')
                            ->filter()
                            ->toArray();
                    })
                    ->searchable()
                    ->label('Tipo de Orden'),
                    
                Tables\Filters\SelectFilter::make('tecnicos')
                    ->options(function (): array {
                        return ClaimAttention::query()
                            ->whereNotNull('tecnicos')
                            ->distinct()
                            ->pluck('tecnicos', 'tecnicos')
                            ->filter()
                            ->toArray();
                    })
                    ->searchable()
                    ->label('Técnicos'),
            ])
            ->actions([
                Tables\Actions\Action::make('pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->url(fn (ClaimAttention $record): string => route('claim-attentions.pdf', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('export_pdf')
                    ->label('Exportar selección a PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(fn ($records) => redirect()->route('claim-attentions.bulk-pdf', [
                        'ids' => $records->pluck('id')->toArray()
                    ])),
            ]);
    }
    
    // Navigation configuration is now handled by the static properties
    
    public function exportPdf(): void
    {
        $filters = $this->getTableFilters() ?? [];
        $this->dispatch('exportPdf', filters: $filters);
    }
    
    public function exportBulkPdf(array $records): void
    {
        $this->dispatch('exportBulkPdf', ids: $records);
    }
    
    protected function getTableFilters(): array
    {
        $filters = [];
        
        // Get all filter values from the request
        $request = request();
        
        // Add filter values if they exist in the request
        $filterKeys = [
            'tipo_reclamo', 'abonado', 'servicio', 'subnodo', 
            'fecha_desde', 'fecha_hasta', 'fin_desde', 'fin_hasta',
            'tecnicos', 'tipo_orden'
        ];
        
        foreach ($filterKeys as $key) {
            if ($request->has($key)) {
                $filters[$key] = $request->get($key);
            }
        }
        
        return $filters;
    }
}
