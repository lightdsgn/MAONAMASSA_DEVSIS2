@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-receipt me-2"></i>Orçamentos</h4>
    @if(Auth::user()->isPrestador() || Auth::user()->isAdm())
    <a href="{{ route('orcamentos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Novo Orçamento
    </a>
    @endif
</div>

<form method="GET" action="{{ route('orcamentos.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="busca" class="form-control" placeholder="Buscar por título da solicitação ou status..."
            value="{{ $busca ?? '' }}">
        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
        @if($busca ?? false) <a href="{{ route('orcamentos.index') }}" class="btn btn-outline-secondary">Limpar</a> @endif
    </div>
</form>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Solicitação</th><th>Prestador</th><th>M.O.</th><th>Total</th><th>Prazo</th><th>Status</th><th>Ações</th></tr>
            </thead>
            <tbody>
                @forelse($orcamentos as $orc)
                <tr>
                    <td>{{ $orc->id }}</td>
                    <td>{{ $orc->solicitacao->titulo }}</td>
                    <td>{{ $orc->usuario->nome }}</td>
                    <td>R$ {{ number_format($orc->mao_de_obra,2,',','.') }}</td>
                    <td>R$ {{ number_format($orc->valor_total,2,',','.') }}</td>
                    <td>{{ $orc->prazo }} dias</td>
                    <td>
                        <span class="badge
                            {{ $orc->status === 'pendente'  ? 'bg-warning text-dark' : '' }}
                            {{ $orc->status === 'aceito'    ? 'bg-success' : '' }}
                            {{ $orc->status === 'recusado'  ? 'bg-danger' : '' }}">
                            {{ ucfirst($orc->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('orcamentos.show', $orc) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                        @if(Auth::user()->isAdm() || $orc->usuario_id === Auth::id())
                            <a href="{{ route('orcamentos.edit', $orc) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('orcamentos.destroy', $orc) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Excluir?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">Nenhum orçamento encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $orcamentos->appends(['busca'=>$busca])->links() }}</div>
@endsection
