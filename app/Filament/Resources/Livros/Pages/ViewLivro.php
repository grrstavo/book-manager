<?php

namespace App\Filament\Resources\Livros\Pages;

use App\Filament\Resources\Livros\LivroResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLivro extends ViewRecord
{
    protected static string $resource = LivroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
