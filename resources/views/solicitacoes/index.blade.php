@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-clipboard-check me-2"></i>Solicitações</h4>
    @if(Auth::user()->isCliente() || Auth::user()->isAdm())
    <a href="{{ route('solicitacoes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Nova Solicitação
    </a>
    @endif
</div>

<form method="GET" action="{{ route('solicitacoes.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="busca" class="form-control" placeholder="Buscar por título, categoria ou status..."
            value="{{ $busca ?? '' }}">
        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
        @if($busca ?? false) <a href="{{ route('solicitacoes.index') }}" class="btn btn-outline-secondary">Limpar</a> @endif
    </div>
</form>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th><th>Título</th><th>Categoria</th><th>Status</th>
                    <th>Disponível</th><th>Cliente</th><th>Orçamento</th><th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($solicitacoes as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->titulo }}</td>
                    <td>{{ $s->categoria }}</td>
                    <td>
                        <span class="badge
                            {{ $s->status === 'aberta' ? 'bg-info' : '' }}
                            {{ $s->status === 'em_andamento' ? 'bg-warning text-dark' : '' }}
                            {{ $s->status === 'concluida' ? 'bg-success' : '' }}
                            {{ $s->status === 'cancelada' ? 'bg-secondary' : '' }}">
                            {{ ucfirst(str_replace('_', ' ', $s->status)) }}
                        </span>
                    </td>
                    <td>{{ $s->disponibilidade ? \Carbon\Carbon::parse($s->disponibilidade)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $s->usuario->nome }}</td>
                    <td>
                        @if($s->orcamento)
                            <span class="badge bg-success">Sim</span>
                        @else
                            <span class="badge bg-light text-muted">Não</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('solicitacoes.show', $s) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                        @if(Auth::user()->isAdm() || $s->usuario_id === Auth::id())
                            <a href="{{ route('solicitacoes.edit', $s) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('solicitacoes.destroy', $s) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Excluir esta solicitação?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">Nenhuma solicitação encontrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $solicitacoes->appends(['busca'=>$busca])->links() }}</div>
@endsection
