<?php

namespace App\Filament\Resources\Autores\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

/**
 * Class AutorForm
 *
 * Form schema configuration for Autor (Author) resources.
 * This class defines the form fields and validation rules for creating and editing authors.
 *
 * @package App\Filament\Resources\Autores\Schemas
 */
class AutorForm
{
    /**
     * Configure the form schema for Autor resources.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema with form components
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('Nome')
                    ->maxLength(40)
                    ->required(),
            ]);
    }
}
