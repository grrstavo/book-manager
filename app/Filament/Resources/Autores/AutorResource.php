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

class AutorResource extends Resource
{
    protected static ?string $model = Autor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Nome';

    protected static ?string $pluralModelLabel = 'autores';

    protected static ?string $slug = 'autores';

    public static function form(Schema $schema): Schema
    {
        return AutorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AutorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AutoresTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            LivrosRelationManager::class
        ];
    }

    public static function getWidgets(): array
    {
        return [
            AutoresChart::class,
        ];
    }

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
