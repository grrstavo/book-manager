<?php

namespace App\Filament\Resources\Assuntos;

use App\Filament\Resources\Assuntos\Pages\CreateAssunto;
use App\Filament\Resources\Assuntos\Pages\EditAssunto;
use App\Filament\Resources\Assuntos\Pages\ListAssuntos;
use App\Filament\Resources\Assuntos\Pages\ViewAssunto;
use App\Filament\Resources\Assuntos\RelationManagers\LivrosRelationManager;
use App\Filament\Resources\Assuntos\Schemas\AssuntoForm;
use App\Filament\Resources\Assuntos\Schemas\AssuntoInfolist;
use App\Filament\Resources\Assuntos\Tables\AssuntosTable;
use App\Models\Assunto;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

/**
 * Class AssuntoResource
 *
 * Filament resource for managing Assunto (Subject) entities.
 * This resource provides CRUD operations and defines the admin interface
 * for subjects in the book management system.
 *
 * @package App\Filament\Resources\Assuntos
 */
class AssuntoResource extends Resource
{
    /**
     * The model associated with this resource.
     *
     * @var string
     */
    protected static ?string $model = Assunto::class;

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
    protected static ?string $recordTitleAttribute = 'Descricao';

    /**
     * Configure the form schema for this resource.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema
     */
    public static function form(Schema $schema): Schema
    {
        return AssuntoForm::configure($schema);
    }

    /**
     * Configure the infolist schema for this resource.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema
     */
    public static function infolist(Schema $schema): Schema
    {
        return AssuntoInfolist::configure($schema);
    }

    /**
     * Configure the table for this resource.
     *
     * @param Table $table The table instance to configure
     * @return Table The configured table
     */
    public static function table(Table $table): Table
    {
        return AssuntosTable::configure($table);
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
     * Get the pages available for this resource.
     *
     * @return array<string, \Filament\Resources\Pages\Page> Array of page routes
     */
    public static function getPages(): array
    {
        return [
            'index' => ListAssuntos::route('/'),
            'create' => CreateAssunto::route('/create'),
            'view' => ViewAssunto::route('/{record}'),
            'edit' => EditAssunto::route('/{record}/edit'),
        ];
    }
}
