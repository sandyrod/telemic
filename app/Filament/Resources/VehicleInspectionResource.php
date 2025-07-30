<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleInspectionResource\Pages;
use App\Models\Inspection;
use App\Models\Vehicle;
use App\Models\Provider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VehicleInspectionResource extends Resource
{
    protected static ?string $model = Inspection::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $modelLabel = 'Inspección de Vehículo';
    protected static ?string $pluralModelLabel = 'Inspecciones de Vehículo';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('vehicle_id')
                ->label('Vehículo')
                ->options(
                    Vehicle::with(['brand', 'model'])
                        ->get()
                        ->mapWithKeys(fn ($vehicle) => [
                            $vehicle->id => \sprintf(
                                '%s - %s - %s',
                                $vehicle->brand->description ?? 'Sin marca',
                                $vehicle->model->modelo ?? 'Sin modelo',
                                $vehicle->placa
                            )
                        ])
                )
                ->searchable(['placa', 'brand.description', 'model.modelo'])
                ->required()
                ->getSearchResultsUsing(function (string $search): array {
                    return Vehicle::query()
                        ->select('vehicles.*')
                        ->join('brands', 'vehicles.brand_id', '=', 'brands.id')
                        ->join('models', 'vehicles.model_id', '=', 'models.id')
                        ->where('vehicles.placa', 'like', "%{$search}%")
                        ->orWhere('brands.description', 'like', "%{$search}%")
                        ->orWhere('models.modelo', 'like', "%{$search}%")
                        ->limit(50)
                        ->get()
                        ->mapWithKeys(fn ($vehicle) => [
                            $vehicle->id => \sprintf(
                                '%s - %s - %s',
                                $vehicle->brand->description ?? 'Sin marca',
                                $vehicle->model->modelo ?? 'Sin modelo',
                                $vehicle->placa
                            )
                        ])
                        ->toArray();
                })
                ->getOptionLabelUsing(fn ($value): ?string => 
                    Vehicle::with(['brand', 'model'])
                        ->find($value)
                        ?->pluck(\sprintf(
                            '%s - %s - %s',
                            'brand.description',
                            'model.modelo',
                            'placa'
                        ))
                        ->first()
                ),
            Forms\Components\Section::make('Cauchos')->schema([
                Forms\Components\Select::make('tire_front_right')
                    ->label('Delantero Derecho')
                    ->options(['bueno'=>'Bueno','regular'=>'Regular','malo'=>'Malo'])
                    ->required(),
                Forms\Components\Select::make('tire_front_left')
                    ->label('Delantero Izquierdo')
                    ->options(['bueno'=>'Bueno','regular'=>'Regular','malo'=>'Malo'])
                    ->required(),
                Forms\Components\Select::make('tire_rear_right')
                    ->label('Trasero Derecho')
                    ->options(['bueno'=>'Bueno','regular'=>'Regular','malo'=>'Malo'])
                    ->required(),
                Forms\Components\Select::make('tire_rear_left')
                    ->label('Trasero Izquierdo')
                    ->options(['bueno'=>'Bueno','regular'=>'Regular','malo'=>'Malo'])
                    ->required(),
            ]),
            Forms\Components\Section::make('Fluidos')->schema([
                Forms\Components\Select::make('fluid_motor')
                    ->label('Motor')
                    ->options(['bueno'=>'Bueno','regular'=>'Regular','malo'=>'Malo'])
                    ->required(),
                Forms\Components\Select::make('fluid_steering')
                    ->label('Dirección')
                    ->options(['bueno'=>'Bueno','regular'=>'Regular','malo'=>'Malo'])
                    ->required(),
                Forms\Components\Select::make('fluid_coolant')
                    ->label('Refrigerante')
                    ->options(['bueno'=>'Bueno','regular'=>'Regular','malo'=>'Malo'])
                    ->required(),
                Forms\Components\Select::make('fluid_brake')
                    ->label('Liga de Frenos')
                    ->options(['bueno'=>'Bueno','regular'=>'Regular','malo'=>'Malo'])
                    ->required(),
            ]),
            Forms\Components\TextInput::make('km_departure')
                ->label('Kilometraje de salida')
                ->numeric(),
            Forms\Components\TextInput::make('km_traveled')
                ->label('Kilometraje recorrido')
                ->numeric(),
            Forms\Components\Section::make('Suministro de gasolina')->schema([
                Forms\Components\TextInput::make('fuel_current_liters')
                    ->label('Litros de gasolina actual')
                    ->numeric(),
                Forms\Components\TextInput::make('fuel_consumed')
                    ->label('Gasolina consumida')
                    ->numeric(),
                Forms\Components\TextInput::make('fuel_supplied')
                    ->label('Litros surtidos')
                    ->numeric(),
                Forms\Components\TextInput::make('fuel_total')
                    ->label('Litros total')
                    ->numeric(),
                Forms\Components\Select::make('provider_id')
                    ->label('Proveedor')
                    ->options(Provider::all()->pluck('name', 'id'))
                    ->searchable(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('vehicle.placa')->label('Vehículo'),
            Tables\Columns\TextColumn::make('tire_front_right')->label('Del. Der.'),
            Tables\Columns\TextColumn::make('tire_front_left')->label('Del. Izq.'),
            Tables\Columns\TextColumn::make('tire_rear_right')->label('Tras. Der.'),
            Tables\Columns\TextColumn::make('tire_rear_left')->label('Tras. Izq.'),
            Tables\Columns\TextColumn::make('fluid_motor')->label('Motor'),
            Tables\Columns\TextColumn::make('fluid_steering')->label('Dirección'),
            Tables\Columns\TextColumn::make('fluid_coolant')->label('Refrigerante'),
            Tables\Columns\TextColumn::make('fluid_brake')->label('Liga Frenos'),
            Tables\Columns\TextColumn::make('km_departure')->label('Km salida'),
            Tables\Columns\TextColumn::make('km_traveled')->label('Km recorrido'),
            Tables\Columns\TextColumn::make('fuel_current_liters')->label('Gasolina actual'),
            Tables\Columns\TextColumn::make('fuel_consumed')->label('Gas. consumida'),
            Tables\Columns\TextColumn::make('fuel_supplied')->label('Litros surtidos'),
            Tables\Columns\TextColumn::make('fuel_total')->label('Litros total'),
            Tables\Columns\TextColumn::make('provider.name')->label('Proveedor'),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Fecha')->sortable(),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicleInspections::route('/'),
            'create' => Pages\CreateVehicleInspection::route('/create'),
            'edit' => Pages\EditVehicleInspection::route('/{record}/edit'),
        ];
    }
}
