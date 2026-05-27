@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-credit-card me-2"></i>Pagamento #{{ $pagamento->id }}</h4>
    <a href="{{ route('pagamentos.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Voltar
    </a>
</div>

<div class="card p-4">
    <div class="row g-4">
        {{-- Resumo do Agendamento --}}
        <div class="col-12">
            <h6 class="fw-bold text-muted mb-3"><i class="bi bi-calendar-check me-2"></i>Agendamento Vinculado</h6>
        </div>
        <div class="col-md-4">
            <strong>Serviço:</strong>
            <p class="text-muted mb-0">{{ $pagamento->agendamento->servico->titulo }}</p>
        </div>
        <div class="col-md-4">
            <strong>Prestador:</strong>
            <p class="text-muted mb-0">{{ $pagamento->agendamento->servico->usuario->nome }}</p>
        </div>
        <div class="col-md-4">
            <strong>Cliente:</strong>
            <p class="text-muted mb-0">{{ $pagamento->agendamento->cliente->nome }}</p>
        </div>
        <div class="col-md-4">
            <strong>Data do Serviço:</strong>
            <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($pagamento->agendamento->data)->format('d/m/Y') }} às {{ $pagamento->agendamento->horario }}</p>
        </div>

        <div class="col-12"><hr></div>

        {{-- Dados do Pagamento --}}
        <div class="col-12">
            <h6 class="fw-bold text-muted mb-3"><i class="bi bi-receipt me-2"></i>Dados do Pagamento</h6>
        </div>
        <div class="col-md-3">
            <strong>Valor:</strong>
            <p class="h4 text-success fw-bold mb-0">R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</p>
        </div>
        <div class="col-md-3">
            <strong>Método:</strong>
            <p class="text-muted mb-0 text-uppercase">{{ str_replace('_', ' ', $pagamento->metodo) }}</p>
        </div>
        <div class="col-md-3">
            <strong>Status:</strong><br>
            <span class="badge fs-6
                {{ $pagamento->status === 'pendente'  ? 'bg-warning text-dark' : '' }}
                {{ $pagamento->status === 'pago'      ? 'bg-success' : '' }}
                {{ $pagamento->status === 'cancelado' ? 'bg-secondary' : '' }}
                {{ $pagamento->status === 'estornado' ? 'bg-danger' : '' }}">
                {{ ucfirst($pagamento->status) }}
            </span>
        </div>
        <div class="col-md-3">
            <strong>Data do Pagamento:</strong>
            <p class="text-muted mb-0">
                {{ $pagamento->data_pagamento ? \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') : '—' }}
            </p>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        @if(Auth::user()->isAdm() || Auth::user()->isPrestador())
        <a href="{{ route('pagamentos.edit', $pagamento) }}" class="btn btn-outline-warning">
            <i class="bi bi-pencil me-1"></i>Editar
        </a>
        @endif
        @if(Auth::user()->isAdm())
        <form action="{{ route('pagamentos.destroy', $pagamento) }}" method="POST"
            onsubmit="return confirm('Remover este pagamento?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger"><i class="bi bi-trash me-1"></i>Excluir</button>
        </form>
        @endif
    </div>
</div>
@endsection
