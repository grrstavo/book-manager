<?php

namespace App\Filament\Resources\Autores\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

/**
 * Class AutorInfolist
 *
 * Infolist schema configuration for Autor (Author) resources.
 * This class defines the information display layout for viewing author details.
 *
 * @package App\Filament\Resources\Autores\Schemas
 */
class AutorInfolist
{
    /**
     * Configure the infolist schema for Autor resources.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema with infolist components
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('Nome'),
            ]);
    }
}
