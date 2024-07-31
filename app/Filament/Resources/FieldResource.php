<?php

namespace App\Filament\Resources;

use App\Filament\Resources\fieldResource\Pages;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\fieldResource\RelationManagers;
use App\Models\field;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class fieldResource extends Resource
{
    protected static ?string $model = field::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(255),
                RichEditor::make('details')
                ->required()
                ->maxLength(1000),
                TextInput::make('capacity')
                ->numeric()
                ->minValue(1000)
                ->required()
                ->maxLength(255),
                TextInput::make('location')
                ->required()
                ->maxLength(255),
                TextInput::make('image')
                // ->url()
                ->required()
                ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->toggleable()->circular(),
                TextColumn::make('name')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('details')
                ->tooltip(fn (field $record): string => "{$record->details}")
                ->limit(30)
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('capacity')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('location')
                ->sortable()
                ->searchable()
                ->toggleable(),

            ])->defaultSort('name')
            ->filters([
                //
            ])
            ->actions([
                
                
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
            'index' => Pages\Listfield::route('/'),
            'create' => Pages\Createfield::route('/create'),
            'view' => Pages\Viewfield::route('/{record}'),
            'edit' => Pages\Editfield::route('/{record}/edit'),
        ];
    }    
}
