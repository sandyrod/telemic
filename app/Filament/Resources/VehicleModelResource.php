<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleModelResource\Pages;
use App\Models\VehicleModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VehicleModelResource extends Resource
{
    protected static ?string $model = VehicleModel::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Modelo de Vehículo';
    protected static ?string $pluralModelLabel = 'Modelos de Vehículos';
    protected static ?string $navigationGroup = 'Vehículos';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('modelo')
                ->label('Modelo')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('description')
                ->label('Descripción')
                ->maxLength(65535)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('modelo')
                    ->label('Modelo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicles_count')
                    ->label('Vehículos')
                    ->counts('vehicles')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Add filters here if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (VehicleModel $record) {
                        // Prevent deletion if there are associated vehicles
                        if ($record->vehicles()->count() > 0) {
                            throw new \Exception('No se puede eliminar el modelo porque tiene vehículos asociados.');
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            // Check if any model has associated vehicles
                            foreach ($records as $record) {
                                if ($record->vehicles()->count() > 0) {
                                    throw new \Exception('Uno o más modelos tienen vehículos asociados y no pueden ser eliminados.');
                                }
                            }
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add relations here if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicleModels::route('/'),
            'create' => Pages\CreateVehicleModel::route('/create'),
            'edit' => Pages\EditVehicleModel::route('/{record}/edit'),
        ];
    }
}
