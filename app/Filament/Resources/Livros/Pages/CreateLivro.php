<?php

namespace App\Filament\Resources\Livros\Pages;

use App\Filament\Resources\Livros\LivroResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLivro extends CreateRecord
{
    protected static string $resource = LivroResource::class;

    protected static bool $canCreateAnother = false;
}
