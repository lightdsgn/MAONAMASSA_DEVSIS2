@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-tools me-2"></i>Serviços</h4>
    @if(Auth::user()->isPrestador() || Auth::user()->isAdm())
    <a href="{{ route('servicos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Novo Serviço
    </a>
    @endif
</div>

<form method="GET" action="{{ route('servicos.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="busca" class="form-control" placeholder="Buscar por título ou categoria..."
            value="{{ $busca ?? '' }}">
        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
        @if($busca ?? false)
            <a href="{{ route('servicos.index') }}" class="btn btn-outline-secondary">Limpar</a>
        @endif
    </div>
</form>

<div class="row g-4">
    @forelse($servicos as $servico)
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            @if($servico->foto)
                <img src="{{ asset('storage/'.$servico->foto) }}" class="card-img-top" style="height:180px;object-fit:cover;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height:180px;font-size:3rem;">🔧</div>
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <h5 class="card-title fw-bold">{{ $servico->titulo }}</h5>
                    <span class="badge {{ $servico->status === 'ativo' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($servico->status) }}
                    </span>
                </div>
                <p class="text-muted small mb-1"><i class="bi bi-tag me-1"></i>{{ $servico->categoria ?? 'Sem categoria' }}</p>
                <p class="text-muted small mb-2"><i class="bi bi-person me-1"></i>{{ $servico->usuario->nome }}</p>
                @if($servico->preco_estimado)
                    <p class="fw-bold text-success mb-2">R$ {{ number_format($servico->preco_estimado,2,',','.') }}</p>
                @endif
                <p class="card-text text-muted small">{{ Str::limit($servico->descricao, 80) }}</p>

                {{-- Avaliação média --}}
                @php $nota = $servico->notaMedia(); @endphp
                @if($nota > 0)
                <div class="mb-2">
                    @for($i=1;$i<=5;$i++)
                        <i class="bi bi-star{{ $i <= $nota ? '-fill text-warning' : ' text-muted' }}"></i>
                    @endfor
                    <small class="text-muted">({{ $servico->avaliacoes->count() }})</small>
                </div>
                @endif
            </div>
            <div class="card-footer bg-transparent d-flex gap-2">
                <a href="{{ route('servicos.show', $servico) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                @if(Auth::user()->isAdm() || $servico->usuario_id === Auth::id())
                    <a href="{{ route('servicos.edit', $servico) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('servicos.destroy', $servico) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Excluir este serviço?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                @endif
                @if(Auth::user()->isCliente())
                    <a href="{{ route('agendamentos.create', ['servico_id'=>$servico->id]) }}" class="btn btn-sm btn-primary ms-auto">
                        <i class="bi bi-calendar-check me-1"></i>Agendar
                    </a>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-muted py-5">Nenhum serviço encontrado.</div>
    @endforelse
</div>

<div class="mt-4">{{ $servicos->appends(['busca' => $busca])->links() }}</div>
@endsection
