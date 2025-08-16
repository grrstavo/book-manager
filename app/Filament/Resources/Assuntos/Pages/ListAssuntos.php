<?php

namespace App\Filament\Resources\Assuntos\Pages;

use App\Filament\Resources\Assuntos\AssuntoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAssuntos extends ListRecords
{
    protected static string $resource = AssuntoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
