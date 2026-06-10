<?php

namespace App\Charts;

use App\Models\Pagamento;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class FaturamentoChart
{
    public function build()
    {
        $meses = [];
        $valores = [];

        for ($i = 5; $i >= 0; $i--) {

            $mes = now()->subMonths($i);

            $meses[] = ucfirst($mes->translatedFormat('M'));

            $valores[] = Pagamento::where('status', 'pago')
                ->whereMonth('created_at', $mes->month)
                ->whereYear('created_at', $mes->year)
                ->sum('valor');
        }

        return (new LarapexChart)
            ->lineChart()
            ->setTitle('Faturamento dos Últimos 6 Meses')
            ->setSubtitle('Receita gerada por pagamentos aprovados')
            ->addData($valores)
            ->setXAxis($meses);
    }
}