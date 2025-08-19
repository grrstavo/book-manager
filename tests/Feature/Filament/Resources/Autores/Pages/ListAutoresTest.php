<?php

use App\Filament\Resources\Autores\Pages\ListAutores;
use App\Models\Autor;

use function Pest\Livewire\livewire;

it('can load the page', function () {
    $autores = Autor::factory()->count(5)->create();

    livewire(ListAutores::class)
        ->assertOk()
        ->assertCanSeeTableRecords($autores);
});