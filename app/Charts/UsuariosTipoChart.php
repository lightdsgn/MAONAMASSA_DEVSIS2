<?php

namespace App\Charts;

use App\Models\Usuario;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UsuariosTipoChart
{
    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return (new LarapexChart)
            ->pieChart()
            ->setTitle('Distribuição de Usuários')
            ->addData([
                Usuario::where('tipo', 'cliente')->count(),
                Usuario::where('tipo', 'prestador')->count(),
                Usuario::where('tipo', 'adm')->count(),
            ])
            ->setLabels([
                'Clientes',
                'Prestadores',
                'Administradores'
            ]);
    }
}