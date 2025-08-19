<?php

use App\Filament\Resources\Livros\Pages\EditLivro;
use App\Filament\Resources\Livros\RelationManagers\AutoresRelationManager;
use App\Models\Autor;
use App\Models\Livro;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Str;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Livewire\livewire;

it('can update a livro', function () {
    $livro = Livro::factory()->create();

    livewire(EditLivro::class, [
        'record' => $livro->Codl,
    ])
    ->fillForm([
        'Titulo' => 'Novo Titulo',
        'Editora' => 'Nova Editora',
        'Edicao' => 10,
        'AnoPublicacao' => 2023,
        'Valor' => 10,
    ])
    ->call('save')
    ->assertNotified();

    assertDatabaseHas(Livro::class, [
        'Codl' => $livro->Codl,
        'Titulo' => 'Novo Titulo',
        'Editora' => 'Nova Editora',
        'Edicao' => 10,
        'AnoPublicacao' => 2023,
        'Valor' => 10,
    ]);
});

it('validates the form data', function (array $data, array $errors) {
    $livro = Livro::factory()->create();

    $newLivroData = Livro::factory()->make();

    livewire(EditLivro::class, [
        'record' => $livro->Codl,
    ])
    ->fillForm([
        'Titulo' => $newLivroData->Titulo,
        'Editora' => $newLivroData->Editora,
        'Edicao' => $newLivroData->Edicao,
        'AnoPublicacao' => $newLivroData->AnoPublicacao,
        'Valor' => $newLivroData->Valor,
        ...$data,
    ])
    ->call('save')
    ->assertHasFormErrors($errors)
    ->assertNotNotified();
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

it('can delete a livro', function () {
    $livro = Livro::factory()->create();

    livewire(EditLivro::class, [
        'record' => $livro->Codl,
    ])
    ->callAction(DeleteAction::class)
    ->assertNotified()
    ->assertRedirect();

    assertDatabaseMissing($livro);
});

it ('can attach an autor to an livro', function () {
    $livro = Livro::factory()->create();
    $autor = Autor::factory()->create();

    livewire(AutoresRelationManager::class, [
        'ownerRecord' => $livro,
        'pageClass' => EditLivro::class,
    ])
    ->mountTableAction('attach')
    ->fillForm([
        'recordId' => $autor->CodAu,
    ])
    ->callMountedTableAction()
    ->assertHasNoTableActionErrors()
    ->assertNotified();

    assertDatabaseHas('Livro_Autor', [
        'Autor_CodAu' => $autor->CodAu,
        'Livro_Codl' => $livro->Codl,
    ]);
});

it ('can detach an autor to an livro', function () {
    $livro = Livro::factory()->create();
    $autor = Autor::factory()->create();

    $livro->autores()->attach($autor->CodAu);

    livewire(AutoresRelationManager::class, [
        'ownerRecord' => $livro,
        'pageClass' => EditLivro::class,
    ])
    ->callTableAction('detach', $autor->getKey())
    ->assertHasNoTableActionErrors()
    ->assertNotified();
    
    assertDatabaseMissing('Livro_Autor', [
        'Autor_CodAu' => $autor->CodAu,
        'Livro_Codl' => $livro->Codl,
    ]);
});