<?php

use App\Filament\Resources\Autores\Pages\EditAutor;
use App\Filament\Resources\Autores\RelationManagers\LivrosRelationManager;
use App\Models\Autor;
use App\Models\Livro;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Str;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Livewire\livewire;

it('can update a autor', function () {
    $autor = Autor::factory()->create();

    livewire(EditAutor::class, [
        'record' => $autor->CodAu,
    ])
    ->fillForm([
        'Nome' => 'Novo Nome',
    ])
    ->call('save')
    ->assertNotified();

    assertDatabaseHas(Autor::class, [
        'CodAu' => $autor->CodAu,
        'Nome' => 'Novo Nome',
    ]);
});

it('cant update a new autor without a description', function () {
    $autor = Autor::factory()->create();

    livewire(EditAutor::class,[
        'record' => $autor->CodAu,
    ])
    ->fillForm([
        'Nome' => '',
    ])
    ->call('save')
    ->assertHasFormErrors(['Nome' => 'required']);
});

it('cant update a new autor with a long description', function () {
    $autor = Autor::factory()->create();

    livewire(EditAutor::class,[
        'record' => $autor->CodAu,
    ])
    ->fillForm([
        'Nome' => Str::random(41),
    ])
    ->call('save')
    ->assertHasFormErrors(['Nome' => 'max']);
});

it('can delete an autor', function () {
    $autor = Autor::factory()->create();

    livewire(EditAutor::class, [
        'record' => $autor->CodAu,
    ])
    ->callAction(DeleteAction::class)
    ->assertNotified()
    ->assertRedirect();

    assertDatabaseMissing($autor);
});

it('can load the relation manager', function () {
    $autor = Autor::factory()->create();

    livewire(EditAutor::class, [
        'record' => $autor->CodAu,
    ])
    ->assertSeeLivewire(LivrosRelationManager::class);
});

it ('can attach a livro to an autor', function () {
    $livro = Livro::factory()->create();
    $autor = Autor::factory()->create();

    livewire(LivrosRelationManager::class, [
        'ownerRecord' => $autor,
        'pageClass' => EditAutor::class,
    ])
    ->mountTableAction('attach')
    ->fillForm([
        'recordId' => $livro->Codl,
    ])
    ->callMountedTableAction()
    ->assertHasNoTableActionErrors()
    ->assertNotified();

    assertDatabaseHas('Livro_Autor', [
        'Autor_CodAu' => $autor->CodAu,
        'Livro_Codl' => $livro->Codl,
    ]);
});

it ('can detach a livro to an autor', function () {
    $livro = Livro::factory()->create();
    $autor = Autor::factory()->create();

    $autor->livros()->attach($livro->Codl);

    livewire(LivrosRelationManager::class, [
        'ownerRecord' => $autor,
        'pageClass' => EditAutor::class,
    ])
    ->callTableAction('detach', $livro->getKey())
    ->assertHasNoTableActionErrors()
    ->assertNotified();
    
    assertDatabaseMissing('Livro_Autor', [
        'Autor_CodAu' => $autor->CodAu,
        'Livro_Codl' => $livro->Codl,
    ]);
});