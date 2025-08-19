<?php

namespace App\Filament\Resources\Autores\Widgets;

use App\Services\AutorService;
use Filament\Widgets\ChartWidget;

/**
 * Class TotalSubjectsWidget
 *
 * Bar chart widget for displaying the number of subjects per author.
 * This widget shows a bar chart with subjects count for each author.
 *
 * @package App\Filament\Resources\Autores\Widgets
 */
class TotalSubjectsWidget extends ChartWidget
{
    /**
     * The heading for the chart widget.
     *
     * @var string|null
     */
    protected ?string $heading = 'Assuntos por Autor';

    /**
     * The author service instance.
     *
     * @var AutorService
     */
    protected AutorService $autorService;

    /**
     * Create a new TotalSubjectsWidget instance.
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
        return $this->autorService->getSubjectsChartData();
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
