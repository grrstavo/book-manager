<?php

namespace App\Filament\Resources\Livros\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LivroInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('Titulo'),
                TextEntry::make('Editora'),
                TextEntry::make('Edicao')
                    ->numeric(),
                TextEntry::make('AnoPublicacao')
                    ->numeric(),
                TextEntry::make('Valor')
                    ->numeric(),
            ]);
    }
}
