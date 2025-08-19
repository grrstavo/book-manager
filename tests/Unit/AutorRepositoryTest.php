<?php

use App\Repositories\AutorRepository;
use Illuminate\Support\Facades\DB;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('uses caching in getAuthorStatistics', function () {
    $mockData = collect([
        (object) [
            'autor_id' => 1,
            'autor_nome' => 'João Silva',
            'total_livros' => 3,
            'total_valor' => 15000,
            'total_assuntos' => 2,
            'media_valor' => 5000,
        ],
    ]);

    // Create repository with cached data
    $repository = new AutorRepository($mockData);

    // DB should not be called since we have cached data
    DB::shouldReceive('table')->never();

    $result = $repository->getAuthorStatistics();

    expect($result)->toEqual($mockData);
});

it('returns array of author names from getAuthorNames', function () {
    $mockData = collect([
        (object) ['autor_nome' => 'João Silva'],
        (object) ['autor_nome' => 'Maria Santos'],
    ]);

    $repository = new AutorRepository($mockData);
    $result = $repository->getAuthorNames();

    expect($result)->toEqual(['João Silva', 'Maria Santos']);
    expect($result)->toBeArray();
});

it('returns array of book counts from getTotalBooksPerAuthor', function () {
    $mockData = collect([
        (object) ['total_livros' => 3],
        (object) ['total_livros' => 2],
        (object) ['total_livros' => 5],
    ]);

    $repository = new AutorRepository($mockData);
    $result = $repository->getTotalBooksPerAuthor();

    expect($result)->toEqual([3, 2, 5]);
    expect($result)->toBeArray();
});

it('returns array of values from getTotalValuePerAuthor', function () {
    $mockData = collect([
        (object) ['total_valor' => 15000],
        (object) ['total_valor' => 8000],
        (object) ['total_valor' => 12000],
    ]);

    $repository = new AutorRepository($mockData);
    $result = $repository->getTotalValuePerAuthor();

    expect($result)->toEqual([15000, 8000, 12000]);
    expect($result)->toBeArray();
});

it('returns array of subject counts from getTotalSubjectsPerAuthor', function () {
    $mockData = collect([
        (object) ['total_assuntos' => 2],
        (object) ['total_assuntos' => 1],
        (object) ['total_assuntos' => 3],
    ]);

    $repository = new AutorRepository($mockData);
    $result = $repository->getTotalSubjectsPerAuthor();

    expect($result)->toEqual([2, 1, 3]);
    expect($result)->toBeArray();
});

it('returns sum of all books from getTotalBooksCount', function () {
    $mockData = collect([
        (object) ['total_livros' => 3],
        (object) ['total_livros' => 2],
        (object) ['total_livros' => 5],
    ]);

    $repository = new AutorRepository($mockData);
    $result = $repository->getTotalBooksCount();

    expect($result)->toBe(10);
    expect($result)->toBeInt();
});

it('returns sum of all values as float from getTotalValue', function () {
    $mockData = collect([
        (object) ['total_valor' => 15000],
        (object) ['total_valor' => 8000],
        (object) ['total_valor' => 12000],
    ]);

    $repository = new AutorRepository($mockData);
    $result = $repository->getTotalValue();

    expect($result)->toBe(35000.0);
    expect($result)->toBeFloat();
});

it('returns sum of all subjects from getTotalSubjectsCount', function () {
    $mockData = collect([
        (object) ['total_assuntos' => 2],
        (object) ['total_assuntos' => 1],
        (object) ['total_assuntos' => 3],
    ]);

    $repository = new AutorRepository($mockData);
    $result = $repository->getTotalSubjectsCount();

    expect($result)->toBe(6);
    expect($result)->toBeInt();
});

it('calculates correct average from getAverageValuePerAuthor', function () {
    $mockData = collect([
        (object) ['total_valor' => 15000],
        (object) ['total_valor' => 9000],
        (object) ['total_valor' => 6000],
    ]);

    $repository = new AutorRepository($mockData);
    $result = $repository->getAverageValuePerAuthor();

    expect($result)->toBe(10000.0);
    expect($result)->toBeFloat();
});

it('returns zero when no authors in getAverageValuePerAuthor', function () {
    $mockData = collect([]);
    $repository = new AutorRepository($mockData);
    $result = $repository->getAverageValuePerAuthor();

    expect($result)->toBe(0.0);
    expect($result)->toBeFloat();
});

it('handles empty collections gracefully', function () {
    $mockData = collect([]);
    $repository = new AutorRepository($mockData);

    expect($repository->getAuthorNames())->toEqual([]);
    expect($repository->getTotalBooksPerAuthor())->toEqual([]);
    expect($repository->getTotalValuePerAuthor())->toEqual([]);
    expect($repository->getTotalSubjectsPerAuthor())->toEqual([]);
    expect($repository->getTotalBooksCount())->toBe(0);
    expect($repository->getTotalValue())->toBe(0.0);
    expect($repository->getTotalSubjectsCount())->toBe(0);
    expect($repository->getAverageValuePerAuthor())->toBe(0.0);
});
