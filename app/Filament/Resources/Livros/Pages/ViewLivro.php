<?php

namespace App\Filament\Resources\Livros\Pages;

use App\Filament\Resources\Livros\LivroResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

/**
 * Class ViewLivro
 *
 * Filament page for viewing Livro (Book) records.
 * This page displays detailed information about a book record.
 *
 * @package App\Filament\Resources\Livros\Pages
 */
class ViewLivro extends ViewRecord
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
            EditAction::make(),
        ];
    }
}
