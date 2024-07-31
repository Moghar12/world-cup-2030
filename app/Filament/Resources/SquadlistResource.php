<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SquadlistResource\Pages;
use App\Filament\Resources\SquadlistResource\RelationManagers;
use App\Models\matchs;
use App\Models\Squadlist;
use App\Models\team;
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



class SquadlistResource extends Resource
{
    protected static ?string $model = Squadlist::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('match_id')
                    ->relationship('match', 'name')
                    ->preload() 
                    ->searchable()    
                    ->label('match')
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('team_id', null))
                    ->required(),
                Select::make('team_id')
                ->options(function (callable $get){
                    $match = matchs::find($get('match_id'));
                    if(!$match){
                    return team::all()->pluck('name', 'id');
                    }
                    return $match->teams->pluck('name','id');
                })
                    ->preload()
                    ->searchable()    
                    ->label('team')
                    ->required(),
                TextInput::make('formation')
                    ->datalist([
                        
                            '4-4-2',
                            '4-3-3',
                            '3-5-2',
                            '5-3-2',
                            '4-2-3-1',
                            '3-4-3',
                            '4-5-1',
                            '4-1-4-1',
                            '4-3-2-1',
                            '4-2-2-2',
                          
                    ])
                    ->required(),
                    Select::make('player')
                    ->multiple()
                    ->options(function (callable $get){
                        $team = team::find($get('team_id'));
                        if(!$team){
                        return team::all()->pluck('name', 'id');
                        }
                        return $team->players->pluck('name','id');
                    })
                    ->maxItems(11)
                    ->preload(),
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('match_id')->label('match')->sortable()->searchable()->toggleable(),
                TextColumn::make('team.name')->label('team')->sortable()->searchable()->toggleable(),
                TextColumn::make('formation')->sortable()->searchable()->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()->toggleable(),
                TextColumn::make('updated_at')
                    ->dateTime()->toggleable(),
            ])->defaultSort('formation')
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
            'index' => Pages\ListSquadlists::route('/'),
            'create' => Pages\CreateSquadlist::route('/create'),
            'view' => Pages\ViewSquadlist::route('/{record}'),
            'edit' => Pages\EditSquadlist::route('/{record}/edit'),
        ];
    }    
}
