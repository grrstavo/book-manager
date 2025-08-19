<?php

namespace App\Filament\Resources\Assuntos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

/**
 * Class AssuntoInfolist
 *
 * Infolist schema configuration for Assunto (Subject) resources.
 * This class defines the information display layout for viewing subject details.
 *
 * @package App\Filament\Resources\Assuntos\Schemas
 */
class AssuntoInfolist
{
    /**
     * Configure the infolist schema for Assunto resources.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema with infolist components
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('Descricao'),
            ]);
    }
}
