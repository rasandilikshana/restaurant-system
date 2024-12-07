<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConcessionResource\Pages;
use App\Filament\Resources\ConcessionResource\RelationManagers;
use App\Models\Concession;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConcessionResource extends Resource
{
    protected static ?string $model = Concession::class;

    protected static ?string $navigationIcon = 'heroicon-o-percent-badge';
    protected static ?string $navigationLabel = 'Concessions';
    protected static ?string $navigationGroup = 'Restaurant Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->nullable(),

            Forms\Components\TextInput::make('discount_percentage')
                ->required()
                ->numeric(),

            Forms\Components\DatePicker::make('valid_from')
                ->required(),

            Forms\Components\DatePicker::make('valid_until')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('discount_percentage')->sortable(),
                Tables\Columns\TextColumn::make('valid_from')->sortable()->date(),
                Tables\Columns\TextColumn::make('valid_until')->sortable()->date(),
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
            'index' => Pages\ListConcessions::route('/'),
            'create' => Pages\CreateConcession::route('/create'),
            'edit' => Pages\EditConcession::route('/{record}/edit'),
        ];
    }
}
