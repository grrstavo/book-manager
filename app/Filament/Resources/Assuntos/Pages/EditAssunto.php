<?php

namespace App\Filament\Resources\Assuntos\Pages;

use App\Filament\Resources\Assuntos\AssuntoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAssunto extends EditRecord
{
    protected static string $resource = AssuntoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
