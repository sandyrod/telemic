<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClaimAttentionReportResource\Pages;
use App\Models\ClaimAttention;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClaimAttentionReportResource extends Resource
{
    protected static ?string $model = ClaimAttention::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Atenciones y Reclamos';
    protected static ?string $navigationGroup = 'Reportes';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'Reporte de Atenciones';
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipo_reclamo')
                    ->label('Tipo de Reclamo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('abonado')
                    ->label('Abonado')
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
            ])
            ->filters([
                // Add your filters here
            ])
            ->actions([
                Tables\Actions\Action::make('pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->url(fn (ClaimAttention $record): string => route('claim-attentions.pdf', $record))
                    ->openUrlInNewTab(),
            ])
            ->headerActions([
                \Filament\Tables\Actions\Action::make('export_pdf')
                    ->label('Exportar a PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->url(fn () => route('claim-attentions.export-pdf', array_merge(
                        request()->query(),
                        ['_token' => csrf_token()]
                    )))
                    ->openUrlInNewTab(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClaimAttentionReports::route('/'),
        ];
    }    
}
