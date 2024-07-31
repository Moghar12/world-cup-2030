<?php

namespace App\Filament\Resources;

use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Models\confederation;
use App\Models\matchs;
use App\Models\Team;
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



class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    public static function form(Form $form): Form
    {
        
        return $form
            ->schema([
                Select::make('confederation_id')
                    ->relationship('confederation', 'acronym')
                    ->preload()
                    ->label('confederation')
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nickname')
                    ->required()
                    ->maxLength(255),
                TextInput::make('rank')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(211)
                    ->required(),
                TextInput::make('image')
                    ->url()
                    ->required()
                    ->label('logo'),
                    TextInput::make('flag')
                    ->url()
                    ->required(),
                    select::make('stage')
                    ->options([
                        'Group stage' =>'Group stage',
                        'Round of 16' =>'Round of 16',
                        'Quarterfinal' =>'Quarterfinal',
                        'Semifinal' => 'Semifinal',
                        'Third-place' =>'Third-place',
                        'Final' =>'Final',
                        'eleminated'=> 'eleminated'
                    ])
                    ->required(),
                    select::make('group')
                    ->options([
                        'A' =>'A',
                        'B' =>'B',
                        'C' =>'C',
                        'D' => 'D',
                        'E' =>'E',
                        'F' =>'F',
                        'G'=> 'G'
                    ])
                    ->required(),
                    TextInput::make('points')
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->maxValue(9)
                    ->required(),
                   
                
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('flag')->circular()->toggleable(),
                ImageColumn::make('image')->label('logo')->toggleable(),
                TextColumn::make('name')->sortable()->searchable()->toggleable(),
               TextColumn::make('confederation.acronym')->label('confederation')->sortable()->searchable()->toggleable(),
               TextColumn::make('nickname')->sortable()->searchable()->toggleable(),
               TextColumn::make('coach.name')->sortable()->searchable()->toggleable(),
               TextColumn::make('rank')->sortable()->searchable()->toggleable(),
               TextColumn::make('created_at')
                    ->dateTime()->toggleable(),
                TextColumn::make('updated_at')
                    ->dateTime()->toggleable(),
            ])->defaultSort('rank')
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'view' => Pages\ViewTeam::route('/{record}'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }    
}
