<?php

namespace App\Filament\Resources\Autores\Widgets;

use App\Services\AutorService;
use Filament\Widgets\ChartWidget;

/**
 * Class TotalBooksWidget
 *
 * Bar chart widget for displaying the number of books per author.
 * This widget shows a bar chart with books count for each author.
 *
 * @package App\Filament\Resources\Autores\Widgets
 */
class TotalBooksWidget extends ChartWidget
{
    /**
     * The heading for the chart widget.
     *
     * @var string|null
     */
    protected ?string $heading = 'Livros por Autor';

    /**
     * The author service instance.
     *
     * @var AutorService
     */
    protected AutorService $autorService;

    /**
     * Create a new TotalBooksWidget instance.
     */
    public function __construct()
    {
        $this->autorService = app(AutorService::class);
    }

    /**
     * Get the data for the chart.
     *
     * @return array<string, mixed> Chart data including datasets and labels
     */
    protected function getData(): array
    {
        return $this->autorService->getBooksChartData();
    }

    /**
     * Get the chart type.
     *
     * @return string The chart type
     */
    protected function getType(): string
    {
        return 'bar';
    }
}
