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

class AssuntoResource extends Resource
{
    protected static ?string $model = Assunto::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Descricao';

    public static function form(Schema $schema): Schema
    {
        return AssuntoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AssuntoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssuntosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            LivrosRelationManager::class
        ];
    }

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
