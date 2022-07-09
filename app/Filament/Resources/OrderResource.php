<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $recordTitleAttribute = 'user.name';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('shipping_address_id')
                    ->relationship('shippingAddress', 'address')
                    ->required(),
                Select::make('shipping_type_id')
                    ->relationship('shippingType', 'title')
                    ->required(),
                Select::make('payment_method_id')
                    ->relationship('paymentMethod', 'name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subtotal')
                    ->required(),
                Forms\Components\DateTimePicker::make('placed_at')
                    ->required(),
                Forms\Components\DateTimePicker::make('packaged_at'),
                Forms\Components\DateTimePicker::make('shipped_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('shippingAddress.address'),
                Tables\Columns\TextColumn::make('shippingType.title'),
                Tables\Columns\TextColumn::make('paymentMethod.name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('subtotal'),
                Tables\Columns\TextColumn::make('placed_at')
                    ->date(),
                Tables\Columns\TextColumn::make('packaged_at')
                    ->date(),
                Tables\Columns\TextColumn::make('shipped_at')
                    ->date(),

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
            RelationManagers\VariationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
