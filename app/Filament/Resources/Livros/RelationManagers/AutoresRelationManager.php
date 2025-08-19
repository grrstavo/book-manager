<?php

namespace App\Filament\Resources\Livros\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

/**
 * Class AutoresRelationManager
 *
 * Relation manager for handling the many-to-many relationship between
 * Livro (Book) and Autor (Author) entities.
 *
 * @package App\Filament\Resources\Livros\RelationManagers
 */
class AutoresRelationManager extends RelationManager
{
    /**
     * The relationship name to manage.
     *
     * @var string
     */
    protected static string $relationship = 'Autores';

    /**
     * Configure the form schema for this relation manager.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema with form components
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('Nome')
                    ->required(),
            ]);
    }

    /**
     * Configure the infolist schema for this relation manager.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema with infolist components
     */
    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('Nome'),
            ]);
    }

    /**
     * Configure the table for this relation manager.
     *
     * @param Table $table The table instance to configure
     * @return Table The configured table with columns and actions
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Nome')
            ->columns([
                TextColumn::make('Nome')
                    ->searchable(),
            ])
            ->headerActions([
                AttachAction::make()->preloadRecordSelect()->attachAnother(condition: false)
            ])
            ->recordActions([
                DetachAction::make(),
            ]);
    }
}
