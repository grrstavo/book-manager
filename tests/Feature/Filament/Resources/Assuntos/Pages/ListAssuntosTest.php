<?php

use App\Filament\Resources\Assuntos\Pages\ListAssuntos;
use App\Models\Assunto;

use function Pest\Livewire\livewire;

it('can load the page', function () {
    $assuntos = Assunto::factory()->count(5)->create();

    livewire(ListAssuntos::class)
        ->assertOk()
        ->assertCanSeeTableRecords($assuntos);
});