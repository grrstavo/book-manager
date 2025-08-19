<?php

namespace App\Filament\Resources\Autores\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

/**
 * Class AutoresTable
 *
 * Table configuration for Autor (Author) resources.
 * This class defines the table columns, actions, and sorting for the authors listing.
 *
 * @package App\Filament\Resources\Autores\Tables
 */
class AutoresTable
{
    /**
     * Configure the table for Autor resources.
     *
     * @param Table $table The table instance to configure
     * @return Table The configured table with columns and actions
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Nome')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->defaultSort('CodAu', 'desc')
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
