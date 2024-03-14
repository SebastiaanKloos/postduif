<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\SubscriptionResource\Pages;
use App\Filament\App\Resources\SubscriptionResource\RelationManagers;
use App\Models\Subscription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Inschrijvingen';

    protected static ?string $label = 'Inschrijving';

    protected static ?string $pluralLabel = 'Inschrijvingen';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Gebruiker')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('E-mailadres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Datum')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListSubscriptions::route('/'),
            'create' => Pages\CreateSubscription::route('/create'),
        ];
    }
}
