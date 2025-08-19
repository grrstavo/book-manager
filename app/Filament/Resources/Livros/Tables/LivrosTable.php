<?php

namespace App\Filament\Resources\Livros\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

/**
 * Class LivrosTable
 *
 * Table configuration for Livro (Book) resources.
 * This class defines the table columns, actions, and sorting for the books listing.
 *
 * @package App\Filament\Resources\Livros\Tables
 */
class LivrosTable
{
    /**
     * Configure the table for Livro resources.
     *
     * @param Table $table The table instance to configure
     * @return Table The configured table with columns and actions
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Titulo')
                    ->searchable(),
                TextColumn::make('Editora')
                    ->searchable(),
                TextColumn::make('Edicao')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('AnoPublicacao')
                    ->searchable(),
                TextColumn::make('Valor')
                    ->money('BRL', divideBy: 100)
                    ->searchable(),
            ])
            ->defaultSort('Codl', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }
}
