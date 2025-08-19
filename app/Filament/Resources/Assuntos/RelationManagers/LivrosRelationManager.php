<?php

namespace App\Filament\Resources\Assuntos\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DissociateAction;
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
 * Class LivrosRelationManager
 *
 * Relation manager for handling the many-to-many relationship between
 * Assunto (Subject) and Livro (Book) entities.
 *
 * @package App\Filament\Resources\Assuntos\RelationManagers
 */
class LivrosRelationManager extends RelationManager
{
    /**
     * The relationship name to manage.
     *
     * @var string
     */
    protected static string $relationship = 'livros';

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
                TextInput::make('Titulo')
                    ->required(),
                TextInput::make('Editora')
                    ->required(),
                TextInput::make('Edicao')
                    ->required()
                    ->numeric(),
                TextInput::make('AnoPublicacao')
                    ->required(),
                TextInput::make('Valor')
                    ->required()
                    ->numeric(),
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
                TextEntry::make('Titulo'),
                TextEntry::make('Editora'),
                TextEntry::make('Edicao')
                    ->numeric(),
                TextEntry::make('AnoPublicacao'),
                TextEntry::make('Valor')
                    ->numeric(),
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
            ->recordTitleAttribute('Titulo')
            ->columns([
                TextColumn::make('Titulo')
                    ->searchable(),
                TextColumn::make('Editora')
                    ->searchable(),
                TextColumn::make('Edicao')
                    ->numeric(),
                TextColumn::make('AnoPublicacao')
                    ->searchable(),
                TextColumn::make('Valor')
                    ->numeric()
            ])
            ->headerActions([
                AttachAction::make()->preloadRecordSelect()->attachAnother(condition: false),
            ])
            ->recordActions([
                DetachAction::make(),
            ]);
    }
}
