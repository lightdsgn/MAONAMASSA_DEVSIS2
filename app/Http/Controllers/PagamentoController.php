<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pagamento;
use App\Models\Agendamento;

class PagamentoController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->busca;

        $pagamentos = Pagamento::with(['agendamento.servico', 'agendamento.cliente'])
            ->when($busca, function ($q) use ($busca) {
                $q->where('metodo', 'like', "%$busca%")
                  ->orWhere('status', 'like', "%$busca%");
            })
            ->when(!Auth::user()->isAdm(), function ($q) {
                // Clientes veem apenas pagamentos dos seus agendamentos
                $q->whereHas('agendamento', function ($a) {
                    $a->where('cliente_id', Auth::id());
                });
            })
            ->latest()
            ->paginate(10);

        return view('pagamentos.index', compact('pagamentos', 'busca'));
    }

    public function create(Request $request)
    {
        // Pré-seleciona agendamento se passado via query string
        $agendamento_id = $request->agendamento_id;

        // Agendamentos disponíveis: sem pagamento ainda
        $agendamentos = Agendamento::with(['servico', 'cliente'])
            ->whereDoesntHave('pagamento')
            ->when(!Auth::user()->isAdm(), function ($q) {
                $q->whereHas('servico', fn($s) => $s->where('usuario_id', Auth::id()))
                  ->orWhere('cliente_id', Auth::id());
            })
            ->where('status', 'concluido')
            ->get();

        return view('pagamentos.create', compact('agendamentos', 'agendamento_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'agendamento_id' => 'required|exists:agendamentos,id|unique:pagamentos,agendamento_id',
            'valor'          => 'required|numeric|min:0.01',
            'metodo'         => 'required|in:pix,cartao_credito,cartao_debito,boleto,dinheiro',
            'status'         => 'required|in:pendente,pago,cancelado,estornado',
            'data_pagamento' => 'nullable|date',
        ]);

        Pagamento::create($request->all());

        return redirect()->route('pagamentos.index')->with('sucesso', 'Pagamento registrado com sucesso!');
    }

    public function show(Pagamento $pagamento)
    {
        $this->authorizeAcesso($pagamento);
        $pagamento->load(['agendamento.servico.usuario', 'agendamento.cliente']);
        return view('pagamentos.show', compact('pagamento'));
    }

    public function edit(Pagamento $pagamento)
    {
        $this->authorizeAcesso($pagamento);
        $pagamento->load(['agendamento.servico', 'agendamento.cliente']);

        $agendamentos = Agendamento::with(['servico', 'cliente'])
            ->where(function ($q) use ($pagamento) {
                $q->whereDoesntHave('pagamento')
                  ->orWhere('id', $pagamento->agendamento_id);
            })
            ->where('status', 'concluido')
            ->get();

        return view('pagamentos.edit', compact('pagamento', 'agendamentos'));
    }

    public function update(Request $request, Pagamento $pagamento)
    {
        $this->authorizeAcesso($pagamento);

        $request->validate([
            'valor'          => 'required|numeric|min:0.01',
            'metodo'         => 'required|in:pix,cartao_credito,cartao_debito,boleto,dinheiro',
            'status'         => 'required|in:pendente,pago,cancelado,estornado',
            'data_pagamento' => 'nullable|date',
        ]);

        $pagamento->update($request->only(['valor', 'metodo', 'status', 'data_pagamento']));

        return redirect()->route('pagamentos.index')->with('sucesso', 'Pagamento atualizado!');
    }

    public function destroy(Pagamento $pagamento)
    {
        if (!Auth::user()->isAdm()) {
            abort(403, 'Acesso negado.');
        }
        $pagamento->delete();
        return redirect()->route('pagamentos.index')->with('sucesso', 'Pagamento removido!');
    }

    // Verifica se o usuário tem acesso ao pagamento
    private function authorizeAcesso(Pagamento $pagamento): void
    {
        if (Auth::user()->isAdm()) return;

        $ag = $pagamento->agendamento ?? $pagamento->load('agendamento')->agendamento;

        $ehCliente    = $ag->cliente_id === Auth::id();
        $ehPrestador  = $ag->servico?->usuario_id === Auth::id();

        if (!$ehCliente && !$ehPrestador) {
            abort(403, 'Acesso negado.');
        }
    }
}
