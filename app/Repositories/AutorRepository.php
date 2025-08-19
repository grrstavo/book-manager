<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class AutorRepository
 *
 * Repository class for handling Autor (Author) data access operations.
 * This class encapsulates database queries related to authors and their statistics.
 *
 * @package App\Repositories
 */
class AutorRepository
{
    /**
     * Create a new AutorRepository instance.
     *
     * @param Collection<int, object> $cachedStatistics Cached author statistics collection
     */
    public function __construct(
        protected ?Collection $cachedStatistics = null
    ) {}

    /**
     * Get author statistics from the view for chart display.
     *
     * This method retrieves aggregated data about authors including
     * total books, total value, and distinct subjects per author.
     *
     * @return Collection<int, object> Collection of author statistics
     */
    public function getAuthorStatistics(): Collection
    {
        $this->cachedStatistics = $this->cachedStatistics ?: DB::table('vw_relatorio_autor')->get();
        return $this->cachedStatistics;
    }

    /**
     * Get author names for chart labels.
     *
     * @return array<int, string> Array of author names
     */
    public function getAuthorNames(): array
    {
        return $this->getAuthorStatistics()
            ->pluck('autor_nome')
            ->toArray();
    }

    /**
     * Get total books count per author.
     *
     * @return array<int, int> Array of book counts per author
     */
    public function getTotalBooksPerAuthor(): array
    {
        return $this->getAuthorStatistics()
            ->pluck('total_livros')
            ->toArray();
    }

    /**
     * Get total value per author.
     *
     * @return array<int, float> Array of total values per author
     */
    public function getTotalValuePerAuthor(): array
    {
        return $this->getAuthorStatistics()
            ->pluck('total_valor')
            ->toArray();
    }

    /**
     * Get total distinct subjects per author.
     *
     * @return array<int, int> Array of distinct subject counts per author
     */
    public function getTotalSubjectsPerAuthor(): array
    {
        return $this->getAuthorStatistics()
            ->pluck('total_assuntos')
            ->toArray();
    }

    /**
     * Get the total count of all books across all authors.
     *
     * @return int Total number of books
     */
    public function getTotalBooksCount(): int
    {
        return $this->getAuthorStatistics()->sum('total_livros');
    }

    /**
     * Get the total value across all authors.
     *
     * @return float Total value
     */
    public function getTotalValue(): float
    {
        return (float) $this->getAuthorStatistics()->sum('total_valor');
    }

    /**
     * Get the total count of distinct subjects across all authors.
     *
     * @return int Total number of distinct subjects
     */
    public function getTotalSubjectsCount(): int
    {
        return $this->getAuthorStatistics()->sum('total_assuntos');
    }

    /**
     * Get the average value per author.
     *
     * @return float Average value per author
     */
    public function getAverageValuePerAuthor(): float
    {
        $statistics = $this->getAuthorStatistics();
        $totalValue = $statistics->sum('total_valor');
        $authorCount = $statistics->count();
        
        return $authorCount > 0 ? (float) ($totalValue / $authorCount) : 0.0;
    }
}
