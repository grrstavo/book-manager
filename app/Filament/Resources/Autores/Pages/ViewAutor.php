<?php

namespace App\Filament\Resources\Autores\Pages;

use App\Filament\Resources\Autores\AutorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

/**
 * Class ViewAutor
 *
 * Filament page for viewing Autor (Author) records.
 * This page displays detailed information about an author record.
 *
 * @package App\Filament\Resources\Autores\Pages
 */
class ViewAutor extends ViewRecord
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
            EditAction::make(),
        ];
    }
}
