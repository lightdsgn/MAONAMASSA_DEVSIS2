@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-bag me-2"></i>{{ $produto->nome }}</h4>
    <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="row g-4">
    <div class="col-md-5">
        @if($produto->foto)
            <img src="{{ asset('storage/'.$produto->foto) }}" class="img-fluid rounded shadow" style="max-height:300px;width:100%;object-fit:cover;">
        @else
            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height:200px;font-size:4rem;">📦</div>
        @endif
    </div>
    <div class="col-md-7">
        <span class="badge {{ $produto->status === 'ativo' ? 'bg-success' : 'bg-secondary' }} mb-2">{{ ucfirst($produto->status) }}</span>
        <h3 class="fw-bold">{{ $produto->nome }}</h3>
        <p class="text-muted"><i class="bi bi-tag me-1"></i>{{ $produto->categoria ?? 'Sem categoria' }}</p>
        <p><i class="bi bi-person me-1"></i>{{ $produto->usuario->nome }}</p>
        <p class="h4 text-success fw-bold">R$ {{ number_format($produto->preco,2,',','.') }}</p>
        <p>Estoque: <strong>{{ $produto->quantidade }}</strong> unid.</p>
        @if($produto->descricao)<p class="text-muted mt-2">{{ $produto->descricao }}</p>@endif
        @if(Auth::user()->isAdm() || $produto->usuario_id === Auth::id())
        <div class="mt-3 d-flex gap-2">
            <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-outline-warning"><i class="bi bi-pencil me-1"></i>Editar</a>
        </div>
        @endif
    </div>
</div>
@endsection
