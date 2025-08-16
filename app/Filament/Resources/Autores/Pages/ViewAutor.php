<?php

namespace App\Filament\Resources\Autores\Pages;

use App\Filament\Resources\Autores\AutorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAutor extends ViewRecord
{
    protected static string $resource = AutorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
