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

class LivrosRelationManager extends RelationManager
{
    protected static string $relationship = 'livros';

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
                AttachAction::make(),
            ])
            ->recordActions([
                DetachAction::make(),
            ]);
    }
}
