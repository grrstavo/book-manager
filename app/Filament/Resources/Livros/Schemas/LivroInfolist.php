<?php

namespace App\Filament\Resources\Livros\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

/**
 * Class LivroInfolist
 *
 * Infolist schema configuration for Livro (Book) resources.
 * This class defines the information display layout for viewing book details.
 *
 * @package App\Filament\Resources\Livros\Schemas
 */
class LivroInfolist
{
    /**
     * Configure the infolist schema for Livro resources.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema with infolist components
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('Titulo'),
                TextEntry::make('Editora'),
                TextEntry::make('Edicao')
                    ->numeric(thousandsSeparator: false),
                TextEntry::make('AnoPublicacao')
                    ->numeric(thousandsSeparator: false),
                TextEntry::make('Valor')
                    ->money('BRL', divideBy: 100),
            ]);
    }
}
