<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\Pages;
use App\Filament\Resources\OrderItemResource\RelationManagers;
use App\Models\OrderItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Orders Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('order_id')
                    ->relationship('order', 'customer_name')
                    ->required()
                    ->label('Order')
                    ->searchable(),

                Forms\Components\Select::make('menu_item_id')
                    ->relationship('menuItem', 'name')
                    ->required()
                    ->label('Menu Item')
                    ->searchable(),

                Forms\Components\Select::make('concession_id')
                    ->relationship('concession', 'name')
                    ->nullable()
                    ->label('Concession'),

                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->label('Quantity')
                    ->afterStateUpdated(function ($state, $set, $get) {
                        // Update total_price when quantity or price changes
                        $quantity = $state;
                        $price = $get('price');
                        $set('total_price', $quantity * $price);  // Correctly update the total_price
                    }),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->label('Price')
                    ->afterStateUpdated(function ($state, $set, $get) {
                        // Update total_price when price or quantity changes
                        $price = $state;
                        $quantity = $get('quantity');
                        $set('total_price', $quantity * $price);  // Correctly update the total_price
                    }),

                Forms\Components\TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->disabled() // Disable total_price field so it's not editable
                    ->label('Total Price'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order.customer_name')
                    ->sortable()
                    ->searchable()
                    ->label('Customer Name'),

                Tables\Columns\TextColumn::make('menuItem.name')
                    ->sortable()
                    ->searchable()
                    ->label('Menu Item'),

                Tables\Columns\TextColumn::make('concession.name')
                    ->sortable()
                    ->label('Concession'),

                Tables\Columns\TextColumn::make('quantity')
                    ->sortable()
                    ->label('Quantity'),

                Tables\Columns\TextColumn::make('price')
                    ->sortable()
                    ->label('Price'),

                Tables\Columns\TextColumn::make('total_price')
                    ->sortable()
                    ->label('Total Price'),
            ])
            ->filters([
                //
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderItems::route('/'),
            'create' => Pages\CreateOrderItem::route('/create'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}
