<?php

use App\Filament\Resources\Assuntos\Pages\ViewAssunto;
use App\Models\Assunto;

use function Pest\Livewire\livewire;

it('assunto view page loads correctly', function () {
    $assunto = Assunto::factory()->create();

    livewire(ViewAssunto::class, ['record' => $assunto->getRouteKey()])
    ->assertSuccessful();
});

it('assunto view page shows correct data', function () {
    $assunto = Assunto::factory()->create();

    livewire(ViewAssunto::class, ['record' => $assunto->getRouteKey()])
    ->assertSee($assunto->Descricao);
});