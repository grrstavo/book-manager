<?php

use App\Repositories\AutorRepository;
use App\Services\AutorService;
use Mockery;

it('delegates to repository in getTotalBooksCount', function () {
    $mockRepository = Mockery::mock(AutorRepository::class);
    $service = new AutorService($mockRepository);

    $mockRepository
        ->shouldReceive('getTotalBooksCount')
        ->once()
        ->andReturn(10);

    $result = $service->getTotalBooksCount();

    expect($result)->toBe(10);
    expect($result)->toBeInt();
});

it('delegates to repository in getTotalValue', function () {
    $mockRepository = Mockery::mock(AutorRepository::class);
    $service = new AutorService($mockRepository);

    $mockRepository
        ->shouldReceive('getTotalValue')
        ->once()
        ->andReturn(35000.0);

    $result = $service->getTotalValue();

    expect($result)->toBe(35000.0);
    expect($result)->toBeFloat();
});

it('delegates to repository in getTotalSubjectsCount', function () {
    $mockRepository = Mockery::mock(AutorRepository::class);
    $service = new AutorService($mockRepository);

    $mockRepository
        ->shouldReceive('getTotalSubjectsCount')
        ->once()
        ->andReturn(6);

    $result = $service->getTotalSubjectsCount();

    expect($result)->toBe(6);
    expect($result)->toBeInt();
});

it('delegates to repository in getAverageValuePerAuthor', function () {
    $mockRepository = Mockery::mock(AutorRepository::class);
    $service = new AutorService($mockRepository);

    $mockRepository
        ->shouldReceive('getAverageValuePerAuthor')
        ->once()
        ->andReturn(11666.67);

    $result = $service->getAverageValuePerAuthor();

    expect($result)->toBe(11666.67);
    expect($result)->toBeFloat();
});

it('returns properly formatted chart data from getBooksChartData', function () {
    $mockRepository = Mockery::mock(AutorRepository::class);
    $service = new AutorService($mockRepository);

    $mockStatistics = collect([
        (object) [
            'autor_nome' => 'João Silva',
            'total_livros' => 3,
        ],
        (object) [
            'autor_nome' => 'Maria Santos',
            'total_livros' => 2,
        ],
    ]);

    $mockRepository
        ->shouldReceive('getAuthorStatistics')
        ->once()
        ->andReturn($mockStatistics);

    $result = $service->getBooksChartData();

    expect($result)->toBeArray();
    expect($result)->toHaveKey('datasets');
    expect($result)->toHaveKey('labels');
    expect($result['datasets'])->toHaveCount(1);

    $dataset = $result['datasets'][0];
    expect($dataset['label'])->toBe('Livros por Autor');
    expect($dataset['data'])->toEqual([3, 2]);
    expect($dataset['backgroundColor'])->toBe('rgba(34, 197, 94, 0.8)');
    expect($result['labels'])->toEqual(['João Silva', 'Maria Santos']);
});

it('returns properly formatted chart data with converted values from getValueChartData', function () {
    $mockRepository = Mockery::mock(AutorRepository::class);
    $service = new AutorService($mockRepository);

    $mockStatistics = collect([
        (object) [
            'autor_nome' => 'João Silva',
            'total_valor' => 15000, // 150.00 in reais
        ],
        (object) [
            'autor_nome' => 'Maria Santos',
            'total_valor' => 8000, // 80.00 in reais
        ],
    ]);

    $mockRepository
        ->shouldReceive('getAuthorStatistics')
        ->once()
        ->andReturn($mockStatistics);

    $result = $service->getValueChartData();

    expect($result)->toBeArray();
    expect($result)->toHaveKey('datasets');
    expect($result)->toHaveKey('labels');

    $dataset = $result['datasets'][0];
    expect($dataset['label'])->toBe('Valor total por Autor (R$)');
    expect($dataset['data'])->toEqual([150.0, 80.0]); // Values converted from centavos
    expect($dataset['backgroundColor'])->toBe('rgba(251, 146, 60, 0.8)');
    expect($result['labels'])->toEqual(['João Silva', 'Maria Santos']);
});

it('returns properly formatted chart data from getSubjectsChartData', function () {
    $mockRepository = Mockery::mock(AutorRepository::class);
    $service = new AutorService($mockRepository);

    $mockStatistics = collect([
        (object) [
            'autor_nome' => 'João Silva',
            'total_assuntos' => 2,
        ],
        (object) [
            'autor_nome' => 'Maria Santos',
            'total_assuntos' => 1,
        ],
    ]);

    $mockRepository
        ->shouldReceive('getAuthorStatistics')
        ->once()
        ->andReturn($mockStatistics);

    $result = $service->getSubjectsChartData();

    expect($result)->toBeArray();
    expect($result)->toHaveKey('datasets');
    expect($result)->toHaveKey('labels');

    $dataset = $result['datasets'][0];
    expect($dataset['label'])->toBe('Assuntos por Autor');
    expect($dataset['data'])->toEqual([2, 1]);
    expect($dataset['backgroundColor'])->toBe('rgba(59, 130, 246, 0.8)');
    expect($result['labels'])->toEqual(['João Silva', 'Maria Santos']);
});

it('returns properly formatted chart data from getAverageValuePerAuthorChartData', function () {
    $mockRepository = Mockery::mock(AutorRepository::class);
    $service = new AutorService($mockRepository);

    $mockStatistics = collect([
        (object) [
            'autor_nome' => 'João Silva',
            'media_valor' => 5000, // 50.00 in reais
        ],
        (object) [
            'autor_nome' => 'Maria Santos',
            'media_valor' => 4000, // 40.00 in reais
        ],
    ]);

    $mockRepository
        ->shouldReceive('getAuthorStatistics')
        ->once()
        ->andReturn($mockStatistics);

    $result = $service->getAverageValuePerAuthorChartData();

    expect($result)->toBeArray();
    expect($result)->toHaveKey('datasets');
    expect($result)->toHaveKey('labels');

    $dataset = $result['datasets'][0];
    expect($dataset['label'])->toBe('Valor médio por Autor');
    expect($dataset['data'])->toEqual([50.0, 40.0]); // Values converted from centavos
    expect($dataset['backgroundColor'])->toBe('rgba(99, 102, 241, 0.8)');
    expect($result['labels'])->toEqual(['João Silva', 'Maria Santos']);
});

it('handles empty collections gracefully', function () {
    $mockRepository = Mockery::mock(AutorRepository::class);
    $service = new AutorService($mockRepository);

    $emptyCollection = collect([]);

    $mockRepository
        ->shouldReceive('getAuthorStatistics')
        ->andReturn($emptyCollection);

    $result = $service->getBooksChartData();

    expect($result)->toBeArray();
    expect($result['datasets'][0]['data'])->toEqual([]);
    expect($result['labels'])->toEqual([]);
});

it('has consistent chart data structure', function () {
    $mockRepository = Mockery::mock(AutorRepository::class);
    $service = new AutorService($mockRepository);

    $mockStatistics = collect([
        (object) [
            'autor_nome' => 'Test Author',
            'total_livros' => 1,
            'total_valor' => 1000,
            'total_assuntos' => 1,
            'media_valor' => 1000,
        ],
    ]);

    $mockRepository
        ->shouldReceive('getAuthorStatistics')
        ->times(4)
        ->andReturn($mockStatistics);

    $chartMethods = [
        'getBooksChartData',
        'getValueChartData',
        'getSubjectsChartData',
        'getAverageValuePerAuthorChartData',
    ];

    foreach ($chartMethods as $method) {
        $result = $service->$method();
        
        expect($result)->toHaveKey('datasets');
        expect($result)->toHaveKey('labels');
        expect($result['datasets'])->toBeArray();
        expect($result['labels'])->toBeArray();
        expect($result['datasets'])->toHaveCount(1);
        
        $dataset = $result['datasets'][0];
        expect($dataset)->toHaveKey('label');
        expect($dataset)->toHaveKey('data');
        expect($dataset)->toHaveKey('backgroundColor');
        expect($dataset)->toHaveKey('borderColor');
        expect($dataset)->toHaveKey('borderWidth');
    }
});

afterEach(function () {
    Mockery::close();
});
