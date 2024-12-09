<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TableResource\Pages;
use App\Models\Table;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table as FilamentTable;

class TableResource extends Resource
{
    protected static ?string $model = Table::class;

    // Set the navigation icon for your resource
    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    // Set the navigation group to "Restaurant Management"
    protected static ?string $navigationGroup = 'Restaurant Management';

    // Set the label for the resource in the navigation
    protected static ?string $navigationLabel = 'Tables';

    // Set the name of the resource to display in the Filament sidebar
    protected static ?string $label = 'Table';
    protected static ?string $pluralLabel = 'Tables';

    // Define the form to manage table data
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Table Name')
                    ->required(),

                Forms\Components\TextInput::make('capacity')
                    ->label('Capacity')
                    ->nullable()
                    ->type('number'),

                Forms\Components\Toggle::make('is_available')
                    ->label('Is Available')
                    ->default(true),
            ]);
    }

    // Define the table (CRUD interface) to manage tables in Filament
    public static function table(FilamentTable $table): FilamentTable
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Table Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('capacity')
                    ->label('Capacity')
                    ->sortable(),

                Tables\Columns\BooleanColumn::make('is_available')
                    ->label('Available')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_available')
                    ->label('Availability')
                    ->options([
                        true => 'Available',
                        false => 'Not Available',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // Define pages for this resource (CRUD operations)
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTables::route('/'),
            'create' => Pages\CreateTable::route('/create'),
            'edit' => Pages\EditTable::route('/{record}/edit'),
        ];
    }
}
