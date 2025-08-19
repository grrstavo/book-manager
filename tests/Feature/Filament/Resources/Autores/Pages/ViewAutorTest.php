<?php

use App\Filament\Resources\Autores\Pages\ViewAutor;
use App\Models\Autor;

use function Pest\Livewire\livewire;

it('autor view page loads correctly', function () {
    $autor = Autor::factory()->create();

    livewire(ViewAutor::class, ['record' => $autor->getRouteKey()])
    ->assertSuccessful();
});

it('autor view page shows correct data', function () {
    $autor = Autor::factory()->create();

    livewire(ViewAutor::class, ['record' => $autor->getRouteKey()])
    ->assertSee($autor->Nome);
});