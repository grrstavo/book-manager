<?php

use App\Filament\Resources\Assuntos\Pages\EditAssunto;
use App\Filament\Resources\Assuntos\RelationManagers\LivrosRelationManager;
use App\Models\Assunto;
use App\Models\Livro;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Str;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Livewire\livewire;

it('can update a assunto', function () {
    $assunto = Assunto::factory()->create();

    livewire(EditAssunto::class, [
        'record' => $assunto->codAs,
    ])
    ->fillForm([
        'Descricao' => 'Nova Descricao',
    ])
    ->call('save')
    ->assertNotified();

    assertDatabaseHas(Assunto::class, [
        'codAs' => $assunto->codAs,
        'Descricao' => 'Nova Descricao',
    ]);
});

it('cant update a new assunto without a description', function () {
    $assunto = Assunto::factory()->create();

    livewire(EditAssunto::class,[
        'record' => $assunto->codAs,
    ])
    ->fillForm([
        'Descricao' => '',
    ])
    ->call('save')
    ->assertHasFormErrors(['Descricao' => 'required']);
});

it('cant update a new assunto with a long description', function () {
    $assunto = Assunto::factory()->create();

    livewire(EditAssunto::class,[
        'record' => $assunto->codAs,
    ])
    ->fillForm([
        'Descricao' => Str::random(41),
    ])
    ->call('save')
    ->assertHasFormErrors(['Descricao' => 'max']);
});

it('can delete an assunto', function () {
    $assunto = Assunto::factory()->create();

    livewire(EditAssunto::class, [
        'record' => $assunto->codAs,
    ])
    ->callAction(DeleteAction::class)
    ->assertNotified()
    ->assertRedirect();

    assertDatabaseMissing($assunto);
});

it('can load the relation manager', function () {
    $assunto = Assunto::factory()->create();

    livewire(EditAssunto::class, [
        'record' => $assunto->codAs,
    ])
    ->assertSeeLivewire(LivrosRelationManager::class);
});

it ('can attach a livro to an assunto', function () {
    $livro = Livro::factory()->create();
    $assunto = Assunto::factory()->create();

    livewire(LivrosRelationManager::class, [
        'ownerRecord' => $assunto,
        'pageClass' => EditAssunto::class,
    ])
    ->mountTableAction('attach')
    ->fillForm([
        'recordId' => $livro->Codl,
    ])
    ->callMountedTableAction()
    ->assertHasNoTableActionErrors()
    ->assertNotified();

    assertDatabaseHas('Livro_Assunto', [
        'Assunto_codAs' => $assunto->codAs,
        'Livro_Codl' => $livro->Codl,
    ]);
});

it ('can detach a livro to an assunto', function () {
    $livro = Livro::factory()->create();
    $assunto = Assunto::factory()->create();

    $assunto->livros()->attach($livro->Codl);

    livewire(LivrosRelationManager::class, [
        'ownerRecord' => $assunto,
        'pageClass' => EditAssunto::class,
    ])
    ->callTableAction('detach', $livro->getKey())
    ->assertHasNoTableActionErrors()
    ->assertNotified();
    
    assertDatabaseMissing('Livro_Assunto', [
        'Assunto_codAs' => $assunto->codAs,
        'Livro_Codl' => $livro->Codl,
    ]);
});