<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleMaintenanceReportResource\Pages;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VehicleMaintenanceReportResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationGroup = 'Reportes';
    protected static ?string $navigationLabel = 'Mantenimiento de Vehículos';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Reporte de Mantenimiento';
    protected static ?string $model = \App\Models\Inspection::class;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vehicle.plate')
                    ->label('Placa')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Inspección')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('km_departure')
                    ->label('Kilometraje')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tire_front_right')
                    ->label('Llanta Del. Der.')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'bueno' => 'success',
                        'regular' => 'warning',
                        'malo' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('tire_front_left')
                    ->label('Llanta Del. Izq.')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'bueno' => 'success',
                        'regular' => 'warning',
                        'malo' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('km_traveled')
                    ->label('Km Recorridos')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('created_from')
                            ->label('Desde'),
                        \Filament\Forms\Components\DatePicker::make('created_until')
                            ->label('Hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->label('Rango de Fechas'),
                Tables\Filters\SelectFilter::make('tire_condition')
                    ->options([
                        'bueno' => 'Bueno',
                        'regular' => 'Regular',
                        'malo' => 'Malo',
                    ])
                    ->query(function (Builder $query, $data) {
                        $value = $data['value'];
                        if ($value) {
                            $query->where(function($q) use ($value) {
                                $q->where('tire_front_right', $value)
                                  ->orWhere('tire_front_left', $value)
                                  ->orWhere('tire_rear_right', $value)
                                  ->orWhere('tire_rear_left', $value);
                            });
                        }
                        return $query;
                    })
                    ->label('Estado de Llantas'),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicleMaintenanceReports::route('/'),
        ];
    }    
}
