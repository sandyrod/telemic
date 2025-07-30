<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleSystemResource\Pages;
use App\Models\VehicleSystem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VehicleSystemResource extends Resource
{
    protected static ?string $model = VehicleSystem::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $modelLabel = 'Sistema de Vehículo';
    protected static ?string $pluralModelLabel = 'Sistemas de Vehículo';
    protected static ?string $navigationGroup = 'Vehículos';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sistema')
                    ->label('Sistema')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('descripcion')
                    ->label('Descripción')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sistema')->label('Sistema')->searchable(),
                Tables\Columns\TextColumn::make('descripcion')->label('Descripción')->searchable(),
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
            'index' => Pages\ListVehicleSystems::route('/'),
            'create' => Pages\CreateVehicleSystem::route('/create'),
            'edit' => Pages\EditVehicleSystem::route('/{record}/edit'),
        ];
    }
}
