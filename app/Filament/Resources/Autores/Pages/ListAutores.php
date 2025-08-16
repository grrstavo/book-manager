<?php

namespace App\Filament\Resources\Autores\Pages;

use App\Filament\Resources\Autores\AutorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAutores extends ListRecords
{
    protected static string $resource = AutorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return AutorResource::getWidgets();
    }
}
