@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-star me-2"></i>Avaliações</h4>
    @if(Auth::user()->isCliente())
    <a href="{{ route('avaliacoes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Nova Avaliação
    </a>
    @endif
</div>

<div class="row g-4">
    @forelse($avaliacoes as $av)
    <div class="col-md-6">
        <div class="card p-3 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="fw-bold mb-0">{{ $av->servico->titulo }}</h6>
                    <small class="text-muted">Prestador: {{ $av->servico->usuario->nome }}</small>
                </div>
                <div>
                    @for($i=1;$i<=5;$i++)
                        <i class="bi bi-star{{ $i <= $av->nota ? '-fill text-warning' : ' text-muted' }}"></i>
                    @endfor
                </div>
            </div>
            <hr class="my-2">
            <p class="small text-muted mb-1">Por: <strong>{{ $av->usuario->nome }}</strong></p>
            @if($av->comentario)<p class="mb-0 text-muted">{{ $av->comentario }}</p>@endif
            <div class="mt-2">
                @if(Auth::user()->isAdm() || $av->usuario_id === Auth::id())
                <form action="{{ route('avaliacoes.destroy', $av) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Remover avaliação?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-muted py-5">Nenhuma avaliação encontrada.</div>
    @endforelse
</div>
<div class="mt-3">{{ $avaliacoes->links() }}</div>
@endsection
