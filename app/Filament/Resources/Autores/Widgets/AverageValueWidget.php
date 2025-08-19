<?php

namespace App\Filament\Resources\Autores\Widgets;

use App\Services\AutorService;
use Filament\Widgets\ChartWidget;

/**
 * Class AverageValueWidget
 *
 * Bar chart widget for displaying the book count distribution per author.
 * This widget shows a bar chart with book quantities for each author.
 *
 * @package App\Filament\Resources\Autores\Widgets
 */
class AverageValueWidget extends ChartWidget
{
    /**
     * The heading for the chart widget.
     *
     * @var string|null
     */
    protected ?string $heading = 'Média de valor por Autor';

    /**
     * The author service instance.
     *
     * @var AutorService
     */
    protected AutorService $autorService;

    /**
     * Create a new AverageValueWidget instance.
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
        return $this->autorService->getAverageValuePerAuthorChartData();
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
