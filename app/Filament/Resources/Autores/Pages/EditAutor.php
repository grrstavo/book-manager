<?php

namespace App\Filament\Resources\Autores\Pages;

use App\Filament\Resources\Autores\AutorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

/**
 * Class EditAutor
 *
 * Filament page for editing Autor (Author) records.
 * This page provides the edit form and related actions for authors.
 *
 * @package App\Filament\Resources\Autores\Pages
 */
class EditAutor extends EditRecord
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
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
