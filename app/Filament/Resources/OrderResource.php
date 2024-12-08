<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Restaurant Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_id')
                    ->label('Order ID')
                    ->disabled(),

                Forms\Components\Select::make('staff_member_id')
                    ->relationship('staffMember.user', 'name') // Correct relationship to reference the User's name
                    ->label('Staff Member')
                    ->required(),

                Forms\Components\TextInput::make('customer_name')
                    ->required(),

                Forms\Components\TextInput::make('customer_phone')
                    ->label('Customer Phone')
                    ->nullable(),

                Forms\Components\TextInput::make('customer_email')
                    ->label('Customer Email')
                    ->nullable(),

                Forms\Components\Select::make('table_number')
                    ->label('Table Number')
                    ->options([
                        'TB01' => 'TB01',
                        'TB02' => 'TB02',
                        'TB03' => 'TB03',
                        'TB04' => 'TB04',
                        'TB05' => 'TB05',
                        'TB06' => 'TB06',
                        'TB07' => 'TB07',
                        'TB08' => 'TB08',
                        'TB09' => 'TB09',
                        'TB10' => 'TB10',
                    ])
                    ->required()
                    ->placeholder('Select Table'),

                Forms\Components\DateTimePicker::make('send_to_kitchen_time')
                    ->required()
                    ->default(now()),

                Forms\Components\Select::make('status')->options([
                    'Pending' => 'Pending',
                    'In Progress' => 'In Progress',
                    'Completed' => 'Completed',
                ])->default('Pending')->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_id')->sortable(),
                Tables\Columns\TextColumn::make('customer_name')->sortable(),
                Tables\Columns\TextColumn::make('customer_phone')->sortable(),
                Tables\Columns\TextColumn::make('customer_email')->sortable(),
                Tables\Columns\TextColumn::make('table_number')->sortable(),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('total_amount')->sortable()->money(),
                Tables\Columns\TextColumn::make('send_to_kitchen_time')->sortable()->dateTime(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'Pending' => 'Pending',
                    'In Progress' => 'In Progress',
                    'Completed' => 'Completed',
                ]),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
