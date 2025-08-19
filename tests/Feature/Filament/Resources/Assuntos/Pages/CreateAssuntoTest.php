<?php

use App\Filament\Resources\Assuntos\Pages\CreateAssunto;
use App\Models\Assunto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

it('can create a new assunto', function () {
    $assunto = Assunto::factory()->make();

    livewire(CreateAssunto::class)
        ->fillForm([
            'Descricao' => $assunto->Descricao,
        ])
        ->call('create')
        ->assertNotified()
        ->assertRedirect();

    assertDatabaseHas(Assunto::class, [
        'Descricao' => $assunto->Descricao,
    ]);
});

it('cant create a new assunto without a description', function () {
    livewire(CreateAssunto::class)
        ->fillForm([
            'Descricao' => '',
        ])
        ->call('create')
        ->assertHasFormErrors(['Descricao' => 'required']);
});

it('cant create a new assunto with a long description', function () {
    livewire(CreateAssunto::class)
        ->fillForm([
            'Descricao' => Str::random(41),
        ])
        ->call('create')
        ->assertHasFormErrors(['Descricao' => 'max']);
});