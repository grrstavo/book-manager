<?php

namespace App\Filament\Resources\Assuntos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

/**
 * Class AssuntoForm
 *
 * Form schema configuration for Assunto (Subject) resources.
 * This class defines the form fields and validation rules for creating and editing subjects.
 *
 * @package App\Filament\Resources\Assuntos\Schemas
 */
class AssuntoForm
{
    /**
     * Configure the form schema for Assunto resources.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema with form components
     */
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
