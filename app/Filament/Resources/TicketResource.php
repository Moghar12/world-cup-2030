<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\matchs;
use App\Models\Ticket;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->unique()
                ->required(),
                TextInput::make('serial_code')
                ->type('number')
                ->unique()
                ->required(),
                TextInput::make('QR_code')
                ->label('QR code')
                ->unique()
                ->required(),
                TextInput::make('door')
                ->required(),
                TextInput::make('rank')
                ->required(),
                TextInput::make('seat')
                ->numeric()
                ->required(),
                Select::make('category')
               ->options([
                '1' => '1',
                '2' => '2',
                '3' => '3',
                'VIP' => 'VIP',
               ])
               ->label('zone') 
               ->required(),

                Select::make('user_id')
                ->relationship('user', 'name')
                ->preload()   
                ->label('user')
                ->required(),
                Select::make('match_id')
                ->relationship('match', 'name')
                ->preload()
                ->searchable()    
                ->label('match')
                ->required(),


                        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('user')->sortable()->searchable()->toggleable(),
                TextColumn::make('match.name')->label('match')->sortable()->searchable()->toggleable(),
                TextColumn::make('name')->label('name')->sortable()->searchable()->toggleable(),
                TextColumn::make('serial_code')->label('serial code')->sortable()->searchable()->toggleable(),
                TextColumn::make('QR_code')->label('QR code')->sortable()->searchable()->toggleable(),
                TextColumn::make('door')->sortable()->searchable()->toggleable(),
                TextColumn::make('rank')->sortable()->searchable()->toggleable(),
                TextColumn::make('seat')->sortable()->searchable()->toggleable(),
                TextColumn::make('category')->sortable()->searchable()->toggleable(),


                    ])
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }    
}
