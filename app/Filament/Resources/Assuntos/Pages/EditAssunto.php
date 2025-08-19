<?php

namespace App\Filament\Resources\Assuntos\Pages;

use App\Filament\Resources\Assuntos\AssuntoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

/**
 * Class EditAssunto
 *
 * Filament page for editing Assunto (Subject) records.
 * This page provides the edit form and related actions for subjects.
 *
 * @package App\Filament\Resources\Assuntos\Pages
 */
class EditAssunto extends EditRecord
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
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
