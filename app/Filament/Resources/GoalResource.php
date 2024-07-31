<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoalResource\Pages;
use App\Filament\Resources\GoalResource\RelationManagers;
use App\Models\Goal;
use App\Models\player;
use App\Models\result;
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



class GoalResource extends Resource
{
    protected static ?string $model = Goal::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
    {
        return $form
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
               Select::make('result_id')
               ->relationship('result', 'id')
               ->preload()
                ->searchable()    
                ->label('result')
                    ->required(),
               TextInput::make('time')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('player.name')->label('player')->sortable()->searchable()->toggleable(),
               TextColumn::make('type')->label('type')->sortable()->searchable()->toggleable(),
               TextColumn::make('result_id')->label('result')->sortable()->searchable()->toggleable(),
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
            'index' => Pages\ListGoals::route('/'),
            'create' => Pages\CreateGoal::route('/create'),
            'view' => Pages\ViewGoal::route('/{record}'),
            'edit' => Pages\EditGoal::route('/{record}/edit'),
        ];
    }    
}
