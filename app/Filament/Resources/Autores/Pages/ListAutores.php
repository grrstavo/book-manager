<?php

namespace App\Filament\Resources\Autores\Pages;

use App\Filament\Resources\Autores\AutorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

/**
 * Class ListAutores
 *
 * Filament page for listing Autor (Author) records.
 * This page displays a table of authors with actions and widgets for managing them.
 *
 * @package App\Filament\Resources\Autores\Pages
 */
class ListAutores extends ListRecords
{
    /**
     * The resource associated with this page.
     *
     * @var string
     */
    protected static string $resource = AutorResource::class;

    /**
     * Get the actions available in the page header.
     *
     * @return array<\Filament\Actions\Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    /**
     * Get the widgets to display in the page header.
     *
     * @return array<string>
     */
    protected function getHeaderWidgets(): array
    {
        return AutorResource::getWidgets();
    }
}
