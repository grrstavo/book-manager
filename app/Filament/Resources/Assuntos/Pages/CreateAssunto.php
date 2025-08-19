<?php

namespace App\Filament\Resources\Assuntos\Pages;

use App\Filament\Resources\Assuntos\AssuntoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAssunto extends CreateRecord
{
    protected static string $resource = AssuntoResource::class;

    protected static bool $canCreateAnother = false;
}
