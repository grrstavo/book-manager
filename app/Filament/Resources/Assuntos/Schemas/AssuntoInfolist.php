<?php

namespace App\Filament\Resources\Assuntos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AssuntoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('Descricao'),
            ]);
    }
}
