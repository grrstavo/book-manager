<?php

namespace App\Filament\Resources\Assuntos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

/**
 * Class AssuntosTable
 *
 * Table configuration for Assunto (Subject) resources.
 * This class defines the table columns, actions, and sorting for the subjects listing.
 *
 * @package App\Filament\Resources\Assuntos\Tables
 */
class AssuntosTable
{
    /**
     * Configure the table for Assunto resources.
     *
     * @param Table $table The table instance to configure
     * @return Table The configured table with columns and actions
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Descricao')
                    ->searchable(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->defaultSort('codAs', 'desc')
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
