@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-bag me-2"></i>Produtos</h4>
    @if(Auth::user()->isPrestador() || Auth::user()->isAdm())
    <a href="{{ route('produtos.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Novo Produto</a>
    @endif
</div>

<form method="GET" action="{{ route('produtos.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="busca" class="form-control" placeholder="Buscar por nome ou categoria..."
            value="{{ $busca ?? '' }}">
        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
        @if($busca ?? false) <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary">Limpar</a> @endif
    </div>
</form>

<div class="row g-4">
    @forelse($produtos as $p)
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            @if($p->foto)
                <img src="{{ asset('storage/'.$p->foto) }}" class="card-img-top" style="height:180px;object-fit:cover;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height:180px;font-size:3rem;">📦</div>
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <h5 class="card-title fw-bold">{{ $p->nome }}</h5>
                    <span class="badge {{ $p->status === 'ativo' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($p->status) }}</span>
                </div>
                <p class="text-muted small"><i class="bi bi-tag me-1"></i>{{ $p->categoria ?? '-' }}</p>
                <p class="text-muted small"><i class="bi bi-person me-1"></i>{{ $p->usuario->nome }}</p>
                <p class="fw-bold text-success">R$ {{ number_format($p->preco,2,',','.') }}</p>
                <p class="text-muted small">Estoque: {{ $p->quantidade }}</p>
            </div>
            <div class="card-footer bg-transparent d-flex gap-2">
                <a href="{{ route('produtos.show', $p) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                @if(Auth::user()->isAdm() || $p->usuario_id === Auth::id())
                    <a href="{{ route('produtos.edit', $p) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('produtos.destroy', $p) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Excluir produto?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-muted py-5">Nenhum produto encontrado.</div>
    @endforelse
</div>
<div class="mt-4">{{ $produtos->appends(['busca'=>$busca])->links() }}</div>
@endsection
