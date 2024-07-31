<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CardResource\Pages;
use App\Filament\Resources\CardResource\RelationManagers;
use App\Models\Card;
use App\Models\player;
use App\Models\result;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;

class CardResource extends Resource
{
    protected static ?string $model = Card::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-tablet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                select::make('player_id')
                ->relationship('player', 'name')
                ->preload()
                ->searchable() 
                ->label('player')
                ->required(),
                select::make('result_id')
                ->relationship('result', 'id')
                ->preload()
                ->searchable()    
                ->label('result')
                ->required(),
                select::make('color')
                ->options([
                    'red',
                    'yellow',
                ])->placeholder('card color')
                    ->required()
                    ,
                TextInput::make('time')
                ->type('number')
                ->maxLength(3)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('player.name')->label('player')->sortable()->searchable()->toggleable(),
                TextColumn::make('result_id')->label('result')->sortable()->searchable()->toggleable(),
                TextColumn::make('color')->sortable()->searchable()->toggleable(),
                TextColumn::make('time')->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()->toggleable(),
                TextColumn::make('updated_at')
                    ->dateTime()->toggleable(),
            ])->defaultSort('result_id')
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListCards::route('/'),
            'create' => Pages\CreateCard::route('/create'),
            'edit' => Pages\EditCard::route('/{record}/edit'),
        ];
    }    
}
