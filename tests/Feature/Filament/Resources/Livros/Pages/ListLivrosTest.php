<?php

use App\Filament\Resources\Livros\Pages\ListLivros;
use App\Models\Livro;

use function Pest\Livewire\livewire;

it('can load the page', function () {
    $livros = Livro::factory()->count(5)->create();

    livewire(ListLivros::class)
        ->assertOk()
        ->assertCanSeeTableRecords($livros);
});