<?php

namespace App\Filament\Resources\Livros\Pages;

use App\Filament\Resources\Livros\LivroResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Class CreateLivro
 *
 * Filament page for creating new Livro (Book) records.
 * This page handles the creation form and related functionality.
 *
 * @package App\Filament\Resources\Livros\Pages
 */
class CreateLivro extends CreateRecord
{
    /**
     * The resource associated with this page.
     *
     * @var string
     */
    protected static string $resource = LivroResource::class;

    /**
     * Whether the user can create another record after creating one.
     *
     * @var bool
     */
    protected static bool $canCreateAnother = false;
}
