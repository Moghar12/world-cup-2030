<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatchsResource\Pages;
use App\Filament\Resources\MatchsResource\RelationManagers;
use App\Models\field;
use App\Models\Matchs;
use App\Models\referee;
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
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ToggleColumn;

class MatchsResource extends Resource
{
    protected static ?string $model = Matchs::class;

    protected static ?string $navigationIcon = 'heroicon-o-play';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->maxLength(50)
                ->required(),
                Select::make('field_id')
                ->relationship('field', 'name')
                ->preload()
                ->searchable()    
                ->label('stadium')
                ->required(),
                Select::make('referee_id')
                ->relationship('referee', 'name')
                ->preload()
                ->searchable()    
                ->label('referee')
                    ->required(),
                select::make('type')
                    ->options([
                        'Group stage' =>'Group stage',
                        'Round of 16' =>'Round of 16',
                        'Quarterfinal' =>'Quarterfinal',
                        'Semifinal' => 'Semifinal',
                        'Third-place' =>'Third-place',
                        'Final' =>'Final',
                    ])
                    ->placeholder('match type')
                    ->required(),
                Forms\Components\DateTimePicker::make('date')
                        ->withoutSeconds()    
                        ->required(),
                    Toggle::make( 'isTicket')
                    ->label('tickets')
                    ->inline(false)
                    ->onColor('success')
                    ->offColor('danger'),
                    TextInput::make('ticketsNumber')
                    ->numeric()
                    ->minValue(100)
                    ->maxValue(200000),
                    TextInput::make('price')
                    ->numeric(),
                    Select::make('teams')
                    ->multiple()
                    ->preload()
                    ->relationship('teams', 'name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable()->toggleable(),
                TextColumn::make('field.name')->label('stadium')->sortable()->searchable()->toggleable(),
                TextColumn::make('referee.name')->label('referee')->sortable()->searchable()->toggleable(),
                TextColumn::make('type')->sortable()->searchable()->toggleable(),
                TextColumn::make('date')
                ->date()->toggleable(),
                IconColumn::make('isTicket')
                ->label('tickets')
                ->boolean(),
                TextColumn::make('ticketsNumber')->label('tickets Number')->sortable()->searchable()->toggleable(),
                TextColumn::make('price')->sortable()->searchable()->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()->toggleable(),
                TextColumn::make('updated_at')
                    ->dateTime()->toggleable(),
            ])->defaultSort('type')
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
            'index' => Pages\ListMatchs::route('/'),
            'create' => Pages\CreateMatchs::route('/create'),
            'view' => Pages\ViewMatchs::route('/{record}'),
            'edit' => Pages\EditMatchs::route('/{record}/edit'),
        ];
    }    
}