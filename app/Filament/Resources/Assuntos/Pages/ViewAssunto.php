<?php

namespace App\Filament\Resources\Assuntos\Pages;

use App\Filament\Resources\Assuntos\AssuntoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAssunto extends ViewRecord
{
    protected static string $resource = AssuntoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
