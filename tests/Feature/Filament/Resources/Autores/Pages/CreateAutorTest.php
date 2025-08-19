<?php

use App\Filament\Resources\Autores\Pages\CreateAutor;
use App\Models\Autor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

it('can create a new autor', function () {
    $autor = Autor::factory()->make();

    livewire(CreateAutor::class)
        ->fillForm([
            'Nome' => $autor->Nome,
        ])
        ->call('create')
        ->assertNotified()
        ->assertRedirect();

    assertDatabaseHas(Autor::class, [
        'Nome' => $autor->Nome,
    ]);
});

it('cant create a new autor without a name', function () {
    livewire(CreateAutor::class)
        ->fillForm([
            'Nome' => '',
        ])
        ->call('create')
        ->assertHasFormErrors(['Nome' => 'required']);
});

it('cant create a new autor with a long name', function () {
    livewire(CreateAutor::class)
        ->fillForm([
            'Nome' => Str::random(41),
        ])
        ->call('create')
        ->assertHasFormErrors(['Nome' => 'max']);
});