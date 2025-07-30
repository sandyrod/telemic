<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleexpenseResource\Pages;
use App\Models\vehicleexpense;
use App\Models\VehicleSystem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VehicleexpenseResource extends Resource
{
    protected static ?string $model = vehicleexpense::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $modelLabel = 'Gasto de Vehículo';
    protected static ?string $pluralModelLabel = 'Gastos de Vehículos';
    protected static ?string $navigationGroup = 'Vehículos';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('gasto')
                    ->label('Gasto')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('descripcion')
                    ->label('Descripción')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('vehicle_system_id')
                    ->label('Sistema del Vehículo')
                    ->options(VehicleSystem::pluck('sistema', 'id'))
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('gasto')->label('Gasto')->searchable(),
                Tables\Columns\TextColumn::make('descripcion')->label('Descripción')->searchable(),
                Tables\Columns\TextColumn::make('vehicleSystem.sistema')->label('Sistema')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Creado')->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->label('Actualizado')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicleexpenses::route('/'),
            'create' => Pages\CreateVehicleexpense::route('/create'),
            'edit' => Pages\EditVehicleexpense::route('/{record}/edit'),
        ];
    }
}
