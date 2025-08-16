<?php

namespace App\Filament\Resources\Livros\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LivrosTable
{
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
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
