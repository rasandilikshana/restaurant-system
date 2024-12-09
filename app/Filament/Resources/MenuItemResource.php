<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Filament\Resources\MenuItemResource\RelationManagers;
use App\Models\Category;
use App\Models\MenuItem;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Restaurant Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->nullable(),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric(),

                Forms\Components\Toggle::make('available')
                    ->required(),

                Select::make('category')
                    ->label('Category')
                    ->options(function () {
                        return Category::pluck('name', 'name')->toArray();
                    })
                    ->searchable()
                    ->placeholder('Select or create category')
                    ->afterStateUpdated(function ($state, $set) {
                        if (!Category::where('name', $state)->exists()) {
                            // If the category doesn't exist, create it
                            Category::create(['name' => $state]);
                        }
                    })
                    ->required(),

                FileUpload::make('image')
                    ->label('Image')
                    ->image() // Ensure the uploaded file is an image
                    ->disk('public') // Specify the disk (ensure 'public' disk is defined in config/filesystems.php)
                    ->directory('menu-items') // Define the directory where images will be stored
                    ->required() // Make image upload required
                    ->maxSize(10240) // Max size in KB (10MB)
                    ->visibility('public') // Set visibility to public so the image is accessible
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image') // Display image in the table
                    ->disk('public') // Use the public disk to fetch the image
                    ->size(50), // Resize image to 50px
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50), // Limit description to 50 characters
                Tables\Columns\TextColumn::make('price')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category') // Show category name
                    ->sortable(),
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
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}
