<?php

use App\Filament\Resources\Livros\Pages\ViewLivro;
use App\Models\Livro;

use function Pest\Livewire\livewire;

it('livro view page loads correctly', function () {
    $livro = Livro::factory()->create();

    livewire(ViewLivro::class, ['record' => $livro->getRouteKey()])
    ->assertSuccessful();
});

it('livro view page shows correct data', function () {
    $livro = Livro::factory()->create();

    livewire(ViewLivro::class, ['record' => $livro->getRouteKey()])
    ->assertSee($livro->Titulo)
    ->assertSee($livro->Editora)
    ->assertSee($livro->Edicao)
    ->assertSee($livro->AnoPublicacao);
});