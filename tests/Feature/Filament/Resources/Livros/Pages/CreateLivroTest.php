<?php

use App\Filament\Resources\Livros\Pages\CreateLivro;
use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

it('can create a new livro', function () {
    $livro = Livro::factory()->make();

    livewire(CreateLivro::class)
        ->fillForm([
            'Titulo' => $livro->Titulo,
            'Editora' => $livro->Editora,
            'Edicao' => $livro->Edicao,
            'AnoPublicacao' => $livro->AnoPublicacao,
            'Valor' => $livro->Valor
        ])
        ->call('create')
        ->assertNotified()
        ->assertRedirect();

    assertDatabaseHas(Livro::class, [
        'Titulo' => $livro->Titulo,
        'Editora' => $livro->Editora,
        'Edicao' => $livro->Edicao,
        'AnoPublicacao' => $livro->AnoPublicacao,
        'Valor' => $livro->Valor
    ]);
});

it('validates the form data', function (array $data, array $errors) {
    $newLivroData = Livro::factory()->make();

    livewire(CreateLivro::class)
        ->fillForm([
            'Titulo' => $newLivroData->Titulo,
            'Editora' => $newLivroData->Editora,
            'Edicao' => $newLivroData->Edicao,
            'AnoPublicacao' => $newLivroData->AnoPublicacao,
            'Valor' => $newLivroData->Valor,
            ...$data,
        ])
        ->call('create')
        ->assertHasFormErrors($errors)
        ->assertNotNotified()
        ->assertNoRedirect();
})->with([
    '`Titulo` is required' => [['Titulo' => null], ['Titulo' => 'required']],
    '`Titulo` is max 40 characters' => [['Titulo' => Str::random(41)], ['Titulo' => 'max']],
    '`Editora` is required' => [['Editora' => null], ['Editora' => 'required']],
    '`Editora` is max 40 characters' => [['Editora' => Str::random(41)], ['Editora' => 'max']],
    '`Edicao` is required' => [['Edicao' => null], ['Edicao' => 'required']],
    '`Edicao` is not a valid number' => [['Edicao' => 'invalid'], ['Edicao' => 'numeric']],
    '`AnoPublicacao` is required' => [['AnoPublicacao' => null], ['AnoPublicacao' => 'required']],
    '`Valor` is required' => [['Valor' => null], ['Valor' => 'required']],
    '`Valor` is not a valid number' => [['Valor' => 'invalid'], ['Valor' => 'numeric']],
]);