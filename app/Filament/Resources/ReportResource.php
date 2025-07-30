<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Inspection;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ReportResource extends Resource
{
    protected static ?string $model = Inspection::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationLabel = 'Reportes';
    protected static ?string $modelLabel = 'Reporte';
    protected static ?string $navigationGroup = 'Reportes';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Form fields for filters
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle.placa')
                    ->label('Placa'),
                Tables\Columns\TextColumn::make('vehicle.brand.description')
                    ->label('Marca'),
                Tables\Columns\TextColumn::make('vehicle.model.modelo')
                    ->label('Modelo'),
                Tables\Columns\TextColumn::make('km_departure')
                    ->label('Km Salida'),
                Tables\Columns\TextColumn::make('km_traveled')
                    ->label('Km Recorrido'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('vehicle_id')
                    ->label('Vehículo')
                    ->options(
                        Vehicle::with(['brand', 'model'])
                            ->get()
                            ->mapWithKeys(fn ($vehicle) => [
                                $vehicle->id => \sprintf(
                                    '%s %s - %s',
                                    $vehicle->brand?->description,
                                    $vehicle->model?->modelo,
                                    $vehicle->placa
                                )
                            ])
                    ),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Desde'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\Action::make('pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->url(fn (Inspection $record): string => route('inspections.pdf', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('export_pdf')
                    ->label('Exportar selección a PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(fn ($records) => redirect()->route('inspections.bulk-pdf', [
                        'ids' => $records->pluck('id')->toArray()
                    ])),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
        ];
    }
}
