<?php

namespace App\Filament\Resources\Autores\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AutorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('Nome')
                    ->required(),
            ]);
    }
}
