<?php

namespace App\Filament\Resources\Autores\Pages;

use App\Filament\Resources\Autores\AutorResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Class CreateAutor
 *
 * Filament page for creating new Autor (Author) records.
 * This page handles the creation form and related functionality.
 *
 * @package App\Filament\Resources\Autores\Pages
 */
class CreateAutor extends CreateRecord
{
    /**
     * The resource associated with this page.
     *
     * @var string
     */
    protected static string $resource = AutorResource::class;

    /**
     * Whether the user can create another record after creating one.
     *
     * @var bool
     */
    protected static bool $canCreateAnother = false;
}
