<?php

namespace App\Filament\Resources\Autores;

use App\Filament\Resources\Autores\Pages\CreateAutor;
use App\Filament\Resources\Autores\Pages\EditAutor;
use App\Filament\Resources\Autores\Pages\ListAutores;
use App\Filament\Resources\Autores\Pages\ViewAutor;
use App\Filament\Resources\Autores\RelationManagers\LivrosRelationManager;
use App\Filament\Resources\Autores\Schemas\AutorForm;
use App\Filament\Resources\Autores\Schemas\AutorInfolist;
use App\Filament\Resources\Autores\Tables\AutoresTable;
use App\Filament\Resources\Autores\Widgets\AutoresChart;
use App\Models\Autor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

/**
 * Class AutorResource
 *
 * Filament resource for managing Autor (Author) entities.
 * This resource provides CRUD operations and defines the admin interface
 * for authors in the book management system, including widgets and charts.
 *
 * @package App\Filament\Resources\Autores
 */
class AutorResource extends Resource
{
    /**
     * The model associated with this resource.
     *
     * @var string
     */
    protected static ?string $model = Autor::class;

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
    protected static ?string $recordTitleAttribute = 'Nome';

    /**
     * The plural label for the model.
     *
     * @var string|null
     */
    protected static ?string $pluralModelLabel = 'autores';

    /**
     * The URL slug for this resource.
     *
     * @var string|null
     */
    protected static ?string $slug = 'autores';

    /**
     * Configure the form schema for this resource.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema
     */
    public static function form(Schema $schema): Schema
    {
        return AutorForm::configure($schema);
    }

    /**
     * Configure the infolist schema for this resource.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema
     */
    public static function infolist(Schema $schema): Schema
    {
        return AutorInfolist::configure($schema);
    }

    /**
     * Configure the table for this resource.
     *
     * @param Table $table The table instance to configure
     * @return Table The configured table
     */
    public static function table(Table $table): Table
    {
        return AutoresTable::configure($table);
    }

    /**
     * Get the relation managers for this resource.
     *
     * @return array<string> Array of relation manager class names
     */
    public static function getRelations(): array
    {
        return [
            LivrosRelationManager::class
        ];
    }

    /**
     * Get the widgets available for this resource.
     *
     * @return array<string> Array of widget class names
     */
    public static function getWidgets(): array
    {
        return [
            AutoresChart::class,
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
            'index' => ListAutores::route('/'),
            'create' => CreateAutor::route('/create'),
            'view' => ViewAutor::route('/{record}'),
            'edit' => EditAutor::route('/{record}/edit'),
        ];
    }
}
