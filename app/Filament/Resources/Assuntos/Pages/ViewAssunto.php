<?php

namespace App\Filament\Resources\Assuntos\Pages;

use App\Filament\Resources\Assuntos\AssuntoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

/**
 * Class ViewAssunto
 *
 * Filament page for viewing Assunto (Subject) records.
 * This page displays detailed information about a subject record.
 *
 * @package App\Filament\Resources\Assuntos\Pages
 */
class ViewAssunto extends ViewRecord
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
            EditAction::make(),
        ];
    }
}
