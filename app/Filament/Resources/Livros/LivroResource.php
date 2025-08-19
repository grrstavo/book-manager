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

/**
 * Class LivroResource
 *
 * Filament resource for managing Livro (Book) entities.
 * This resource provides CRUD operations and defines the admin interface
 * for books in the book management system, including relationships with authors and subjects.
 *
 * @package App\Filament\Resources\Livros
 */
class LivroResource extends Resource
{
    /**
     * The model associated with this resource.
     *
     * @var string
     */
    protected static ?string $model = Livro::class;

    /**
     * The navigation icon for this resource in the admin panel.
     *
     * @var string|BackedEnum|null
     */
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    /**
     * The attribute to use as the record title.
     *
     * @var string|null
     */
    protected static ?string $recordTitleAttribute = 'Titulo';

    /**
     * Configure the form schema for this resource.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema
     */
    public static function form(Schema $schema): Schema
    {
        return LivroForm::configure($schema);
    }

    /**
     * Configure the infolist schema for this resource.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema
     */
    public static function infolist(Schema $schema): Schema
    {
        return LivroInfolist::configure($schema);
    }

    /**
     * Configure the table for this resource.
     *
     * @param Table $table The table instance to configure
     * @return Table The configured table
     */
    public static function table(Table $table): Table
    {
        return LivrosTable::configure($table);
    }

    /**
     * Get the relation managers for this resource.
     *
     * @return array<string> Array of relation manager class names
     */
    public static function getRelations(): array
    {
        return [
            AssuntosRelationManager::class,
            AutoresRelationManager::class
        ];
    }

    /**
     * Get the pages available for this resource.
     *
     * @return array<string, \Filament\Resources\Pages\Page> Array of page routes
     */
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
