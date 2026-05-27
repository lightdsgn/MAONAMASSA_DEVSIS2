@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-calendar-check me-2"></i>Agendamento #{{ $agendamento->id }}</h4>
    <a href="{{ route('agendamentos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <div class="row g-3">
        <div class="col-md-6"><strong>Serviço:</strong> {{ $agendamento->servico->titulo }}</div>
        <div class="col-md-6"><strong>Prestador:</strong> {{ $agendamento->servico->usuario->nome }}</div>
        <div class="col-md-6"><strong>Cliente:</strong> {{ $agendamento->cliente->nome }}</div>
        <div class="col-md-3"><strong>Data:</strong> {{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</div>
        <div class="col-md-3"><strong>Horário:</strong> {{ $agendamento->horario }}</div>
        <div class="col-md-6">
            <strong>Status:</strong>
            <span class="badge
                {{ $agendamento->status === 'pendente'   ? 'bg-warning text-dark' : '' }}
                {{ $agendamento->status === 'confirmado' ? 'bg-info' : '' }}
                {{ $agendamento->status === 'concluido'  ? 'bg-success' : '' }}
                {{ $agendamento->status === 'cancelado'  ? 'bg-secondary' : '' }}">
                {{ ucfirst($agendamento->status) }}
            </span>
        </div>
        @if($agendamento->observacoes)
        <div class="col-12"><strong>Observações:</strong><p class="text-muted mt-1">{{ $agendamento->observacoes }}</p></div>
        @endif
    </div>
    <div class="mt-4">
        <a href="{{ route('agendamentos.edit', $agendamento) }}" class="btn btn-outline-warning"><i class="bi bi-pencil me-1"></i>Editar</a>
    </div>
</div>
@endsection
