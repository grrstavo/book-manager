<?php

namespace App\Filament\Resources\Autores\Widgets;

use App\Services\AutorService;
use Filament\Widgets\ChartWidget;

/**
 * Class TotalValueWidget
 *
 * Bar chart widget for displaying the value per author.
 * This widget shows a bar chart with monetary value for each author.
 *
 * @package App\Filament\Resources\Autores\Widgets
 */
class TotalValueWidget extends ChartWidget
{
    /**
     * The heading for the chart widget.
     *
     * @var string|null
     */
    protected ?string $heading = 'Valor por Autor';

    /**
     * The author service instance.
     *
     * @var AutorService
     */
    protected AutorService $autorService;

    /**
     * Create a new TotalValueWidget instance.
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
        return $this->autorService->getValueChartData();
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
