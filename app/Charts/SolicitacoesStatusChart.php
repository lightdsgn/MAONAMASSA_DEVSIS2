<?php

namespace App\Charts;

use App\Models\Solicitacao;
use ArielMejiaDev\LarapexCharts\LarapexChart;
class SolicitacoesStatusChart
{
    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        return (new LarapexChart)
            ->donutChart()
            ->setTitle('Solicitações por Status')
            ->addData([
                Solicitacao::where('status', 'aberta')->count(),
                Solicitacao::where('status', 'em_andamento')->count(),
                Solicitacao::where('status', 'concluida')->count(),
                Solicitacao::where('status', 'cancelada')->count(),
            ])
            ->setLabels([
                'Abertas',
                'Em andamento',
                'Concluídas',
                'Canceladas'
            ]);
    }
}
