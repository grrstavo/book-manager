<?php

namespace App\Filament\Resources\Assuntos\Pages;

use App\Filament\Resources\Assuntos\AssuntoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

/**
 * Class ListAssuntos
 *
 * Filament page for listing Assunto (Subject) records.
 * This page displays a table of subjects with actions for managing them.
 *
 * @package App\Filament\Resources\Assuntos\Pages
 */
class ListAssuntos extends ListRecords
{
    /**
     * The resource associated with this page.
     *
     * @var string
     */
    protected static string $resource = AssuntoResource::class;

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
}
