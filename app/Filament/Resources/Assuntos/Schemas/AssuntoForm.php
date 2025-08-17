<?php

namespace App\Filament\Resources\Assuntos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AssuntoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('Descricao')
                    ->maxLength(40)
                    ->required(),
            ]);
    }
}
