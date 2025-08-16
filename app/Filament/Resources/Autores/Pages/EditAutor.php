<?php

namespace App\Filament\Resources\Autores\Pages;

use App\Filament\Resources\Autores\AutorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAutor extends EditRecord
{
    protected static string $resource = AutorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
