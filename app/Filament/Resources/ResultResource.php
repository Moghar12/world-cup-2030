<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResultResource\Pages;
use App\Filament\Resources\ResultResource\RelationManagers;
use App\Models\matchs;
use App\Models\player;
use App\Models\Result;
use App\Models\team;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;



class ResultResource extends Resource
{
    protected static ?string $model = Result::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('match_id')
                ->relationship('match', 'name')
                ->preload()
                ->searchable()    
                ->label('matchs')
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('winner_id', null))
                ->required(),
               Select::make('winner_id')
                    ->options(function (callable $get){
                        $match = matchs::find($get('match_id'));
                        if(!$match){
                        return team::all()->pluck('name', 'id');
                        }
                        return $match->teams->pluck('name','id');
                    })
                    ->preload()
                     ->searchable()    
                    ->label('winner')
                    ->required(),
               TextInput::make('team1_goals')
               ->numeric()
               ->required(),
               TextInput::make('team2_goals')
                    ->numeric()
                    ->required(),
               TextInput::make('team1_possession')
               ->numeric()
               ->minValue(0)
               ->maxValue(100)
               ->reactive()
               ->afterStateUpdated(fn (callable $set) => $set('team2_possession', null))
               ->required(),
               Select::make('team2_possession')
                    // ->numeric()
                    ->options(function(callable $get){
                        $team1 = $get('team1_possession');
                         $team2[0]= 100-$team1;
                        return $team2 ;
                    })
                    // ->disabled()
                    ->required(),
                TextInput::make('fullTime')
                    ->numeric()
                    ->minValue(90)
                    ->maxValue(120)
                    ->required(),
                Repeater::make('goal')
                    ->relationship('goals')
                    ->schema([
                        Select::make('player_id')
                            ->relationship('player', 'name')
                            ->preload()
                            ->searchable() 
                            ->label('player')
                            ->required(),
                        Select::make('type')
                            ->options([
                                'normal goal' => 'normal goal',
                                'penalty' => 'penalty',
                                'self goal' => 'self goal',
                            ])
                            ->searchable() 
                            ->label('type')
                            ->required(),
                        TextInput::make('time')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(120)
                            ->required(),
                            ]),
                    Repeater::make('card')
                    ->relationship('cards')
                    ->schema([
                        select::make('player_id')
                        ->relationship('player', 'name')
                        ->preload()
                        ->searchable() 
                        ->label('player')
                        ->required(),
                        select::make('color')
                        ->options([
                            'red',
                            'yellow',
                        ])->placeholder('card color')
                            ->required()
                            ,
                        TextInput::make('time')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(120)
                        ->required()
                    
                    ])
            ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('winner.name')->label('winner')->sortable()->searchable()->toggleable(),
                TextColumn::make('match.name')->label('match')->sortable()->searchable()->toggleable(),
                TextColumn::make('team1_goals')->toggleable(),
                TextColumn::make('team2_goals')->toggleable(),
                TextColumn::make('team1_possession')->toggleable(),
                TextColumn::make('team2_possession')->toggleable(),
                TextColumn::make('fullTime')->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()->toggleable(),
                TextColumn::make('updated_at')
                    ->dateTime()->toggleable(),
            ])->defaultSort('match_id')
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
            'index' => Pages\ListResults::route('/'),
            'create' => Pages\CreateResult::route('/create'),
            'view' => Pages\ViewResult::route('/{record}'),
            'edit' => Pages\EditResult::route('/{record}/edit'),
        ];
    }    
}
