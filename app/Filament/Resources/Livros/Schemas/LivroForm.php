<?php

namespace App\Filament\Resources\Livros\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

/**
 * Class LivroForm
 *
 * Form schema configuration for Livro (Book) resources.
 * This class defines the form fields and validation rules for creating and editing books.
 *
 * @package App\Filament\Resources\Livros\Schemas
 */
class LivroForm
{
    /**
     * Configure the form schema for Livro resources.
     *
     * @param Schema $schema The schema instance to configure
     * @return Schema The configured schema with form components
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('Titulo')
                    ->maxLength(40)
                    ->required(),
                TextInput::make('Editora')
                    ->maxLength(40)
                    ->required(),
                TextInput::make('Edicao')
                    ->required()
                    ->numeric(),
                Select::make('AnoPublicacao')
                    ->options(range(now()->year, 0))
                    ->required(),
                TextInput::make('Valor')
                    ->prefix('R$')
                    ->mask(RawJs::make(<<<'JS'
                        (function($input) {
                            // Strip all non-digit characters
                            const digits = $input.replace(/\D/g, '');

                            if (!digits) {
                                return '';
                            }

                            // Always ensure at least two digits for cents
                            const padded = digits.padStart(2, '0');
                            const len = padded.length;

                            const intPart = padded.slice(0, len - 2);
                            const centPart = padded.slice(len - 2);

                            // Remove leading zeros from integer part, but if empty, default to '0'
                            const trimmedInt = intPart.replace(/^0+/, '') || '0';

                            // Combine with dot as cents separator
                            return trimmedInt + '.' + centPart;
                        })($input);
                    JS))
                    ->placeholder('10.00')
                    ->stripCharacters([',', '.', '-'])
                    ->numeric()
                    ->required(),
            ]);
    }
}
