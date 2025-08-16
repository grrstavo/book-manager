<?php

namespace App\Filament\Resources\Autores\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AutorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('Nome'),
            ]);
    }
}
