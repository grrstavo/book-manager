<?php

namespace App\Filament\Resources\Assuntos\Pages;

use App\Filament\Resources\Assuntos\AssuntoResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Class CreateAssunto
 *
 * Filament page for creating new Assunto (Subject) records.
 * This page handles the creation form and related functionality.
 *
 * @package App\Filament\Resources\Assuntos\Pages
 */
class CreateAssunto extends CreateRecord
{
    /**
     * The resource associated with this page.
     *
     * @var string
     */
    protected static string $resource = AssuntoResource::class;

    /**
     * Whether the user can create another record after creating one.
     *
     * @var bool
     */
    protected static bool $canCreateAnother = false;
}
