<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Servico;
use App\Models\Solicitacao;
use App\Models\Agendamento;
use App\Models\Pagamento;

use App\Charts\FaturamentoChart;
use App\Charts\SolicitacoesStatusChart;
use App\Charts\UsuariosTipoChart;

class DashboardController extends Controller
{
    public function index(
        FaturamentoChart $faturamentoChart,
        SolicitacoesStatusChart $statusChart,
        UsuariosTipoChart $usuariosChart
    ) {

        $usuarios = Usuario::count();

        $clientes = Usuario::where('tipo', 'cliente')->count();

        $prestadores = Usuario::where('tipo', 'prestador')->count();

        $administradores = Usuario::where('tipo', 'adm')->count();

        $servicos = Servico::count();

        $solicitacoes = Solicitacao::count();

        $agendamentos = Agendamento::count();

        $faturamentoTotal = Pagamento::where('status', 'pago')
            ->sum('valor');

        $faturamentoMes = Pagamento::where('status', 'pago')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('valor');

        $ticketMedio = Pagamento::where('status', 'pago')
            ->avg('valor');

        $solicitacoesConcluidas = Solicitacao::where(
            'status',
            'concluida'
        )->count();

        $taxaConversao = $solicitacoes > 0
            ? round(($solicitacoesConcluidas / $solicitacoes) * 100)
            : 0;
        $pagos = \App\Models\Pagamento::where('status', 'pago')->count();

        $pendentes = \App\Models\Pagamento::where('status', 'pendente')->count();

        $avaliacoes = \App\Models\Avaliacao::with('servico.usuario')
            ->orderByDesc('nota')
            ->latest()
            ->take(4)
            ->get();
        $faturamentoChart = $faturamentoChart->build();

        $statusChart = $statusChart->build();

        $usuariosChart = $usuariosChart->build();
        

        return view('dashboard', compact(
    'usuarios',
    'clientes',
    'prestadores',
    'administradores',
    'servicos',
    'solicitacoes',
    'agendamentos',
    'faturamentoTotal',
    'faturamentoMes',
    'ticketMedio',
    'taxaConversao',
    'pagos',
    'pendentes',
    'avaliacoes',
    'faturamentoChart',
    'statusChart',
    'usuariosChart'
));
    }
}