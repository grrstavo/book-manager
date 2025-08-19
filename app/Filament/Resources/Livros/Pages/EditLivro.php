<?php

namespace App\Filament\Resources\Livros\Pages;

use App\Filament\Resources\Livros\LivroResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

/**
 * Class EditLivro
 *
 * Filament page for editing Livro (Book) records.
 * This page provides the edit form and related actions for books.
 *
 * @package App\Filament\Resources\Livros\Pages
 */
class EditLivro extends EditRecord
{
    /**
     * The resource associated with this page.
     *
     * @var string
     */
    protected static string $resource = LivroResource::class;

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
