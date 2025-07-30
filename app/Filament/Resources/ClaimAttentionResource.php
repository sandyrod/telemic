<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClaimAttentionResource\Pages;
use App\Models\ClaimAttention;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClaimAttentionResource extends Resource
{
    protected static ?string $model = ClaimAttention::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $modelLabel = 'Atención a Reclamo';
    protected static ?string $pluralModelLabel = 'Atenciones a Reclamos';
    protected static ?string $navigationGroup = 'Gestión de Reclamos';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Información del Reclamo')
                ->schema([
                    Forms\Components\Select::make('tipo_reclamo')
                        ->label('Tipo de Reclamo')
                        ->options([
                            'Fibrahogar' => 'Fibrahogar',
                            'Instalaciones/Reconexiones' => 'Instalaciones/Reconexiones',
                            'Morosidad/Bajas Voluntarias' => 'Morosidad/Bajas Voluntarias',
                        ])
                        ->required()
                        ->columnSpanFull(),
                    
                    Forms\Components\TextInput::make('abonado')
                        ->label('Abonado')
                        ->maxLength(255),
                        
                    Forms\Components\TextInput::make('servicio')
                        ->label('Servicio')
                        ->maxLength(255),
                        
                    Forms\Components\TextInput::make('ciudad')
                        ->label('Ciudad')
                        ->maxLength(255),
                        
                    Forms\Components\TextInput::make('subnodo')
                        ->label('Subnodo')
                        ->maxLength(255),
                        
                    // Campos que solo se muestran cuando el tipo de reclamo NO es Fibrahogar
                    Forms\Components\Group::make()
                        ->id('network-fields-group')
                        ->extraAttributes(['class' => 'network-fields'])
                        ->schema([
                            Forms\Components\Select::make('descarga_materiales')
                                ->label('Descarga Materiales')
                                ->options([
                                    'si' => 'Sí',
                                    'no' => 'No',
                                ])
                                ->nullable()
                                ->visible(fn (callable $get) => $get('tipo_reclamo') !== 'Fibrahogar')
                                ->dehydrated(true),
                                
                            Forms\Components\TextInput::make('nap')
                                ->label('NAP')
                                ->maxLength(255)
                                ->visible(fn (callable $get) => $get('tipo_reclamo') !== 'Fibrahogar')
                                ->dehydrated(true),
                                
                            Forms\Components\TextInput::make('puerto')
                                ->label('Puerto')
                                ->maxLength(255)
                                ->visible(fn (callable $get) => $get('tipo_reclamo') !== 'Fibrahogar')
                                ->dehydrated(true),
                                
                            Forms\Components\TextInput::make('feeder')
                                ->label('Feeder')
                                ->maxLength(255)
                                ->visible(fn (callable $get) => $get('tipo_reclamo') !== 'Fibrahogar')
                                ->dehydrated(true),
                        ])
                        ->live()
                        ->afterStateUpdated(function (callable $get, callable $set) {
                            // Limpiar los campos cuando se ocultan
                            if ($get('tipo_reclamo') === 'Fibrahogar') {
                                $set('descarga_materiales', null);
                                $set('nap', null);
                                $set('puerto', null);
                                $set('feeder', null);
                            }
                        }),
                ])->columns(2),
                
            Forms\Components\Section::make('Detalles de la Atención')
                ->schema([
                    Forms\Components\DatePicker::make('fecha_ingreso')
                        ->label('Fecha de Ingreso'),
                        
                    Forms\Components\TimePicker::make('hora_inicio')
                        ->label('Hora Inicio')
                        ->seconds(false),
                        
                    Forms\Components\DatePicker::make('fecha_finalizacion')
                        ->label('Fecha Finalización'),
                        
                    Forms\Components\TimePicker::make('hora_final')
                        ->label('Hora Final')
                        ->seconds(false),
                        
                    Forms\Components\TextInput::make('tiempo_atencion')
                        ->label('Tiempo de Atención'),
                        
                    Forms\Components\Textarea::make('causa_falla')
                        ->label('Causa de la Falla')
                        ->columnSpanFull(),
                        
                    Forms\Components\TextInput::make('tecnicos')
                        ->label('Técnicos')
                        ->columnSpanFull(),
                        
                    Forms\Components\Textarea::make('observacion')
                        ->label('Observación')
                        ->columnSpanFull(),
                        
                    Forms\Components\TextInput::make('tipo_orden')
                        ->label('Tipo de Orden')
                        ->maxLength(255),
                ])->columns(2),
        ]);
    }

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
                    
                Tables\Columns\TextColumn::make('hora_inicio')
                    ->label('Hora Inicio')
                    ->time(),
                    
                Tables\Columns\TextColumn::make('fecha_finalizacion')
                    ->label('Fecha Fin')
                    ->date(),
                    
                Tables\Columns\TextColumn::make('hora_final')
                    ->label('Hora Fin')
                    ->time(),
                    
                Tables\Columns\TextColumn::make('tiempo_atencion')
                    ->label('Tiempo Atención'),
                    
                Tables\Columns\TextColumn::make('tecnicos')
                    ->label('Técnicos')
                    ->searchable(),
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
                        Forms\Components\DatePicker::make('fecha_desde')
                            ->label('Desde'),
                        Forms\Components\DatePicker::make('fecha_hasta')
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
                    }),
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
        return [];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClaimAttentions::route('/'),
            'create' => Pages\CreateClaimAttention::route('/create'),
            'edit' => Pages\EditClaimAttention::route('/{record}/edit'),
        ];
    }    
}
