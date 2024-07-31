<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConfederationResource\Pages;
use App\Filament\Resources\ConfederationResource\RelationManagers;
use App\Models\Confederation;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;



class ConfederationResource extends Resource
{
    protected static ?string $model = Confederation::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('acronym')
                    ->required()
                    ->maxLength(255),
                Select::make('region')
                ->options([
                    'Asia' => 'Asia',
                    'Africa' =>'Africa' ,
                    ' North and Central America, and the Caribbean' => ' North and Central America, and the Caribbean',
                    'South America' =>  'South America',
                    'Oceania' => 'Oceania',
                    'Europe' => 'Europe',
                ])
                    ->unique()
                    ->required(),
                TextInput::make('teams')
                ->numeric()
                ->minValue(1)
                ->maxValue(100)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('name')->sortable()->searchable()->toggleable(),
               TextColumn::make('acronym')->sortable()->searchable()->toggleable(),
               TextColumn::make('region')->sortable()->searchable()->toggleable(),
               TextColumn::make('teams')->toggleable(),
               TextColumn::make('created_at')
                    ->dateTime()->toggleable(),
               TextColumn::make('updated_at')
                    ->dateTime()->toggleable(),
            ])->defaultSort('name')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListConfederations::route('/'),
            'create' => Pages\CreateConfederation::route('/create'),
            'view' => Pages\ViewConfederation::route('/{record}'),
            'edit' => Pages\EditConfederation::route('/{record}/edit'),
        ];
    }    
}
