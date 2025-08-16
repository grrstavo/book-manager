<?php

namespace App\Filament\Resources\Livros;

use App\Filament\Resources\Livros\Pages\CreateLivro;
use App\Filament\Resources\Livros\Pages\EditLivro;
use App\Filament\Resources\Livros\Pages\ListLivros;
use App\Filament\Resources\Livros\Pages\ViewLivro;
use App\Filament\Resources\Livros\RelationManagers\AssuntosRelationManager;
use App\Filament\Resources\Livros\RelationManagers\AutoresRelationManager;
use App\Filament\Resources\Livros\Schemas\LivroForm;
use App\Filament\Resources\Livros\Schemas\LivroInfolist;
use App\Filament\Resources\Livros\Tables\LivrosTable;
use App\Models\Assunto;
use App\Models\Livro;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LivroResource extends Resource
{
    protected static ?string $model = Livro::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Titulo';

    public static function form(Schema $schema): Schema
    {
        return LivroForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LivroInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LivrosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            AssuntosRelationManager::class,
            AutoresRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLivros::route('/'),
            'create' => CreateLivro::route('/create'),
            'view' => ViewLivro::route('/{record}'),
            'edit' => EditLivro::route('/{record}/edit'),
        ];
    }
}
