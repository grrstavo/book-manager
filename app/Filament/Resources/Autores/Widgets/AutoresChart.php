<?php

namespace App\Filament\Resources\Autores\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

/**
 * Class AutoresChart
 *
 * Chart widget for displaying author statistics.
 * This widget shows data about books, total value, and subjects per author.
 *
 * @package App\Filament\Resources\Autores\Widgets
 */
class AutoresChart extends ChartWidget
{
    /**
     * The heading for the chart widget.
     *
     * @var string|null
     */
    protected ?string $heading = 'Autores';

    /**
     * Get the data for the chart.
     *
     * @return array<string, mixed> Chart data including datasets and labels
     */
    protected function getData(): array
    {
        $rows = DB::table('vw_relatorio_autor')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Quantidade de Livros',
                    'data' => $rows->pluck('total_livros')->toArray(),
                    'backgroundColor' => '#FF6384',
                    'borderColor' => '#9b0606ff'
                ],
                [
                    'label' => 'Valor Total (R$)',
                    'data' => $rows->pluck('total_valor')->toArray(),
                    'backgroundColor' => '#5878ecff',
                    'borderColor' => '#0d2b96ff',
                ],
                [
                    'label' => 'Assuntos Distintos',
                    'data' => $rows->pluck('total_assuntos')->toArray(),
                    'backgroundColor' => '#55dd40ff',
                    'borderColor' => '#148603ff',
                ],
            ],
            'labels' => $rows->pluck('autor_nome')->toArray(),
        ];
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
