@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-clipboard-check me-2"></i>{{ $solicitacao->titulo }}</h4>
    <a href="{{ route('solicitacoes.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card p-4">
            <div class="d-flex justify-content-between mb-3">
                <span class="badge
                    {{ $solicitacao->status === 'aberta' ? 'bg-info' : '' }}
                    {{ $solicitacao->status === 'em_andamento' ? 'bg-warning text-dark' : '' }}
                    {{ $solicitacao->status === 'concluida' ? 'bg-success' : '' }}
                    {{ $solicitacao->status === 'cancelada' ? 'bg-secondary' : '' }}">
                    {{ ucfirst(str_replace('_', ' ', $solicitacao->status)) }}
                </span>
                <small class="text-muted">{{ $solicitacao->created_at->format('d/m/Y') }}</small>
            </div>
            <p><strong>Categoria:</strong> {{ $solicitacao->categoria }}</p>
            <p><strong>Cliente:</strong> {{ $solicitacao->usuario->nome }}</p>
            @if($solicitacao->disponibilidade)
                <p><strong>Disponível a partir de:</strong> {{ \Carbon\Carbon::parse($solicitacao->disponibilidade)->format('d/m/Y') }}</p>
            @endif
            <hr>
            <p>{{ $solicitacao->descricao }}</p>
            @if($solicitacao->foto)
                <img src="{{ asset('storage/'.$solicitacao->foto) }}" class="img-fluid rounded mt-2" style="max-height:250px;object-fit:cover;">
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4">
            <h6 class="fw-bold mb-3">Orçamento</h6>
            @if($solicitacao->orcamento)
                @php $orc = $solicitacao->orcamento; @endphp
                <p class="mb-1"><strong>Mão de obra:</strong> R$ {{ number_format($orc->mao_de_obra,2,',','.') }}</p>
                <p class="mb-1"><strong>Valor total:</strong> R$ {{ number_format($orc->valor_total,2,',','.') }}</p>
                <p class="mb-1"><strong>Prazo:</strong> {{ $orc->prazo }} dias</p>
                <span class="badge {{ $orc->status === 'aceito' ? 'bg-success' : ($orc->status === 'recusado' ? 'bg-danger' : 'bg-warning text-dark') }}">
                    {{ ucfirst($orc->status) }}
                </span>
                @if($orc->observacoes)<p class="mt-2 text-muted small">{{ $orc->observacoes }}</p>@endif

                @if(Auth::id() === $solicitacao->usuario_id && $orc->status === 'pendente')
                    <div class="d-flex gap-2 mt-3">
                        <form action="{{ route('orcamentos.aceitar', $orc) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Aceitar Orçamento</button>
                        </form>
                        <form action="{{ route('orcamentos.recusar', $orc) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Recusar Orçamento</button>
                        </form>
                    </div>
                @endif

                @if(Auth::id() === $solicitacao->usuario_id && $orc->status === 'aceito')
                    <a href="{{ route('agendamentos.create') }}" class="btn btn-sm btn-primary mt-3">
                        <i class="bi bi-calendar-plus me-1"></i>Agendar Serviço
                    </a>
                @endif
            @else
                <p class="text-muted">Sem orçamento ainda.</p>
                @if(Auth::user()->isPrestador() || Auth::user()->isAdm())
                <a href="{{ route('orcamentos.create', ['solicitacao_id'=>$solicitacao->id]) }}" class="btn btn-sm btn-primary mt-2">
                    <i class="bi bi-receipt me-1"></i>Enviar Orçamento
                </a>
                @endif
            @endif
        </div>

        <div class="card p-4 mt-3">
            @if(Auth::user()->isAdm() || $solicitacao->usuario_id === Auth::id())
                <a href="{{ route('solicitacoes.edit', $solicitacao) }}" class="btn btn-outline-warning w-100 mb-2">
                    <i class="bi bi-pencil me-1"></i>Editar
                </a>
                <form action="{{ route('solicitacoes.destroy', $solicitacao) }}" method="POST"
                    onsubmit="return confirm('Excluir?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger w-100"><i class="bi bi-trash me-1"></i>Excluir</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
