<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Select;
use App\Filament\Resources\VariationResource\Pages;
use App\Filament\Resources\VariationResource\RelationManagers;
use App\Models\Variation;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VariationResource extends Resource
{
    protected static ?string $model = Variation::class;

    protected static ?string $recordTitleAttribute = 'product.name';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')
                    ->relationship('product', 'name')->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    SpatieMediaLibraryFileUpload::make('image'),
                Forms\Components\TextInput::make('price')
                    ->required(),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('parent_id')
                    ->integer(),
                Forms\Components\TextInput::make('sku')
                    ->maxLength(255),
                Forms\Components\TextInput::make('order')
                ->integer(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('sku'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListVariations::route('/'),
            'create' => Pages\CreateVariation::route('/create'),
            'edit' => Pages\EditVariation::route('/{record}/edit'),
        ];
    }
}
