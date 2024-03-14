<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\PostResource\Pages;
use App\Filament\App\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->columns(4)
                    ->schema([
                        Forms\Components\Section::make()
                            ->columnSpan(4)
                            ->inlineLabel()
                            ->schema([
                                Forms\Components\TextInput::make('subject')
                                    ->label('Onderwerp'),
                                Forms\Components\RichEditor::make('content')
                                    ->label('Content'),
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Publiceren op')
                                    ->default('now'),
                                Forms\Components\Select::make('event_id')
                                    ->label('Hoort bij agenda punt')
                                    ->relationship('event', 'title', fn ($query) => $query->whereBelongsTo(Filament::getTenant())),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject')
                    ->label('Onderwerp')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Publiceren op')
                    ->sortable()
                    ->searchable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Geplaatst door'),
                Tables\Columns\TextColumn::make('event.title')
                    ->label('Agenda punt'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('author')
                    ->label('Geplaatst door')
                    ->relationship('author', 'email', fn ($query) => $query->whereHas('teams', fn ($query) => $query->whereKey(Filament::getTenant()->id))),

                Tables\Filters\SelectFilter::make('event')
                    ->label('Hoort bij agenda punt')
                    ->relationship('event', 'title', fn ($query) => $query->whereBelongsTo(Filament::getTenant())),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
