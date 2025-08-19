<?php

namespace App\Services;

use App\Repositories\AutorRepository;

/**
 * Class AutorService
 *
 * Service class for handling Autor (Author) business logic.
 * This class acts as an intermediary between the repository and presentation layers,
 * providing formatted data for charts and other UI components.
 *
 * @package App\Services
 */
class AutorService
{
    /**
     * The author repository instance.
     *
     * @var AutorRepository
     */
    protected AutorRepository $autorRepository;

    /**
     * Create a new AutorService instance.
     *
     * @param AutorRepository $autorRepository The author repository
     */
    public function __construct(AutorRepository $autorRepository)
    {
        $this->autorRepository = $autorRepository;
    }

    /**
     * Get formatted chart data for author statistics.
     *
     * This method prepares the data structure required for chart widgets,
     * including datasets for books, values, and subjects with appropriate styling.
     *
     * @return array<string, mixed> Formatted chart data with datasets and labels
     */
    public function getChartData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Quantidade de Livros',
                    'data' => $this->autorRepository->getTotalBooksPerAuthor(),
                    'backgroundColor' => '#FF6384',
                    'borderColor' => '#9b0606ff'
                ],
                [
                    'label' => 'Valor Total (R$)',
                    'data' => $this->autorRepository->getTotalValuePerAuthor(),
                    'backgroundColor' => '#5878ecff',
                    'borderColor' => '#0d2b96ff',
                ],
                [
                    'label' => 'Assuntos Distintos',
                    'data' => $this->autorRepository->getTotalSubjectsPerAuthor(),
                    'backgroundColor' => '#55dd40ff',
                    'borderColor' => '#148603ff',
                ],
            ],
            'labels' => $this->autorRepository->getAuthorNames(),
        ];
    }

    /**
     * Get author statistics summary.
     *
     * @return array<string, mixed> Summary statistics about authors
     */
    public function getStatisticsSummary(): array
    {
        $statistics = $this->autorRepository->getAuthorStatistics();

        return [
            'total_authors' => $statistics->count(),
            'total_books' => $statistics->sum('total_livros'),
            'total_value' => $statistics->sum('total_valor'),
            'total_subjects' => $statistics->sum('total_assuntos'),
        ];
    }

    /**
     * Get the total books count across all authors.
     *
     * @return int Total books count
     */
    public function getTotalBooksCount(): int
    {
        return $this->autorRepository->getTotalBooksCount();
    }

    /**
     * Get the total value across all authors.
     *
     * @return float Total value
     */
    public function getTotalValue(): float
    {
        return $this->autorRepository->getTotalValue();
    }

    /**
     * Get the total subjects count across all authors.
     *
     * @return int Total subjects count
     */
    public function getTotalSubjectsCount(): int
    {
        return $this->autorRepository->getTotalSubjectsCount();
    }

    /**
     * Get the average value per author.
     *
     * @return float Average value per author
     */
    public function getAverageValuePerAuthor(): float
    {
        return $this->autorRepository->getAverageValuePerAuthor();
    }

    /**
     * Get chart data for books per author.
     *
     * @return array<string, mixed> Chart data for books per author
     */
    public function getBooksChartData(): array
    {
        $statistics = $this->autorRepository->getAuthorStatistics();
        
        return [
            'datasets' => [
                [
                    'label' => 'Livros por Autor',
                    'data' => $statistics->pluck('total_livros')->toArray(),
                    'backgroundColor' => 'rgba(34, 197, 94, 0.8)',
                    'borderColor' => 'rgba(34, 197, 94, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $statistics->pluck('autor_nome')->toArray(),
        ];
    }

    /**
     * Get chart data for value per author.
     *
     * @return array<string, mixed> Chart data for value per author
     */
    public function getValueChartData(): array
    {
        $statistics = $this->autorRepository->getAuthorStatistics();
        
        return [
            'datasets' => [
                [
                    'label' => 'Valor total por Autor (R$)',
                    'data' => $statistics->pluck('total_valor')->map(fn($value) => (float) $value / 100)->toArray(),
                    'backgroundColor' => 'rgba(251, 146, 60, 0.8)',
                    'borderColor' => 'rgba(251, 146, 60, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $statistics->pluck('autor_nome')->toArray(),
        ];
    }

    /**
     * Get chart data for subjects per author.
     *
     * @return array<string, mixed> Chart data for subjects per author
     */
    public function getSubjectsChartData(): array
    {
        $statistics = $this->autorRepository->getAuthorStatistics();
        
        return [
            'datasets' => [
                [
                    'label' => 'Assuntos por Autor',
                    'data' => $statistics->pluck('total_assuntos')->toArray(),
                    'backgroundColor' => 'rgba(59, 130, 246, 0.8)',
                    'borderColor' => 'rgba(59, 130, 246, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $statistics->pluck('autor_nome')->toArray(),
        ];
    }

    /**
     * Get chart data for books count per author (alternative view).
     *
     * @return array<string, mixed> Chart data for books count distribution
     */
    public function getAverageValuePerAuthorChartData(): array
    {
        $statistics = $this->autorRepository->getAuthorStatistics();
        
        return [
            'datasets' => [
                [
                    'label' => 'Valor médio por Autor',
                    'data' => $statistics->pluck('media_valor')->map(fn($value) => (float) $value / 100)->toArray(),
                    'backgroundColor' => 'rgba(99, 102, 241, 0.8)',
                    'borderColor' => 'rgba(99, 102, 241, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $statistics->pluck('autor_nome')->toArray(),
        ];
    }
}
