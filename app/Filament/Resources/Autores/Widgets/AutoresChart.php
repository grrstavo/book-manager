<?php

namespace App\Filament\Resources\Autores\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class AutoresChart extends ChartWidget
{
    protected ?string $heading = 'Widgets';

    protected function getData(): array
    {
        $rows = DB::table('vw_relatorio_autor')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Quantidade de Livros',
                    'data' => $rows->pluck('total_livros')->toArray(),
                ],
                [
                    'label' => 'Valor Total (R$)',
                    'data' => $rows->pluck('total_valor')->toArray(),
                ],
                [
                    'label' => 'Assuntos Distintos',
                    'data' => $rows->pluck('total_assuntos')->toArray(),
                ],
            ],
            'labels' => $rows->pluck('autor_nome')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
