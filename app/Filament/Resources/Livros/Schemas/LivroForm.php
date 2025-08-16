<?php

namespace App\Filament\Resources\Livros\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LivroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('Titulo')
                    ->required(),
                TextInput::make('Editora')
                    ->required(),
                TextInput::make('Edicao')
                    ->required()
                    ->numeric(),
                Select::make('AnoPublicacao')
                    ->options(range(now()->year, 0))
                    ->required(),
                TextInput::make('Valor')
                    ->required()
                    ->numeric(),
            ]);
    }
}
