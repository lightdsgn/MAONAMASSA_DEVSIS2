@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-receipt me-2"></i>Orçamento #{{ $orcamento->id }}</h4>
    <a href="{{ route('orcamentos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <div class="row g-3">
        <div class="col-md-8"><strong>Solicitação:</strong> {{ $orcamento->solicitacao->titulo }}</div>
        <div class="col-md-4"><strong>Prestador:</strong> {{ $orcamento->usuario->nome }}</div>
        <div class="col-md-4"><strong>Mão de Obra:</strong> R$ {{ number_format($orcamento->mao_de_obra,2,',','.') }}</div>
        <div class="col-md-4"><strong>Valor Total:</strong> R$ {{ number_format($orcamento->valor_total,2,',','.') }}</div>
        <div class="col-md-4"><strong>Prazo:</strong> {{ $orcamento->prazo }} dias</div>
        <div class="col-md-4">
            <strong>Status:</strong>
            <span class="badge
                {{ $orcamento->status === 'pendente'  ? 'bg-warning text-dark' : '' }}
                {{ $orcamento->status === 'aceito'    ? 'bg-success' : '' }}
                {{ $orcamento->status === 'recusado'  ? 'bg-danger' : '' }}">
                {{ ucfirst($orcamento->status) }}
            </span>
        </div>
        @if(Auth::id() === $orcamento->solicitacao->usuario_id && $orcamento->status === 'pendente')
        <div class="col-12 mt-3">
            <form action="{{ route('orcamentos.aceitar', $orcamento) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success btn-sm me-2">Aceitar Orçamento</button>
            </form>
            <form action="{{ route('orcamentos.recusar', $orcamento) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Recusar Orçamento</button>
            </form>
        </div>
        @endif
        @if($orcamento->observacoes)
        <div class="col-12"><strong>Observações:</strong><p class="text-muted mt-1">{{ $orcamento->observacoes }}</p></div>
        @endif
    </div>
    <div class="mt-4 d-flex gap-2">
        @if(Auth::user()->isAdm() || $orcamento->usuario_id === Auth::id())
            <a href="{{ route('orcamentos.edit', $orcamento) }}" class="btn btn-outline-warning">
                <i class="bi bi-pencil me-1"></i>Editar
            </a>
        @endif
    </div>
</div>
@endsection
