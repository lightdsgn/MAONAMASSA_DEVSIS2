@extends('layouts.app')
@section('content')

<style>
    .dash { padding: 36px 32px; font-family: 'Sora', sans-serif; }

    .page-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 24px; gap: 16px;
    }
    .page-title {
        font-size: 1.3rem; font-weight: 900; color: #111;
        letter-spacing: -0.5px; margin: 0;
        display: flex; align-items: center; gap: 10px;
    }
    .page-title i { color: #fa4101; }

    .btn-dash-fill {
        background: #fa4101; color: #fff; border: none;
        border-radius: 9px; padding: 9px 18px;
        font-size: 0.82rem; font-weight: 700;
        text-decoration: none; display: inline-flex; align-items: center; gap: 7px;
        transition: background 0.2s; font-family: 'Sora', sans-serif; cursor: pointer;
    }
    .btn-dash-fill:hover { background: #c73200; color: #fff; }

    .search-bar { display: flex; gap: 8px; margin-bottom: 24px; }
    .search-input {
        flex: 1; padding: 10px 16px;
        border: 1.5px solid #e8e8e8; border-radius: 10px;
        font-size: 0.85rem; font-family: 'Sora', sans-serif;
        background: #fff; color: #333; outline: none;
        transition: border-color 0.2s;
    }
    .search-input:focus { border-color: #fa4101; }
    .search-input::placeholder { color: #bbb; }
    .search-btn {
        padding: 10px 16px; border-radius: 10px;
        background: #fa4101; border: none; color: #fff;
        font-size: 15px; cursor: pointer; transition: background 0.2s;
        display: flex; align-items: center;
    }
    .search-btn:hover { background: #c73200; }
    .clear-btn {
        padding: 10px 14px; border-radius: 10px;
        background: #fff; border: 1.5px solid #e8e8e8;
        color: #888; font-size: 0.8rem; font-weight: 600;
        cursor: pointer; transition: all 0.2s;
        text-decoration: none; display: flex; align-items: center; gap: 5px;
        font-family: 'Sora', sans-serif;
    }
    .clear-btn:hover { border-color: #ccc; color: #555; }

    .solicitacoes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .solic-card {
        background: #fff;
        border-radius: 16px;
        border: 1.5px solid #ececec;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.22s, box-shadow 0.22s;
        animation: fadeUp 0.4s ease both;
    }
    .solic-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.09);
    }

    .solic-banner {
        height: 8px;
        flex-shrink: 0;
    }
    .banner-aberta      { background: #17a2b8; }
    .banner-em_andamento { background: #ffc107; }
    .banner-concluida   { background: #28a745; }
    .banner-cancelada   { background: #6c757d; }

    .solic-body { padding: 18px 20px; flex: 1; display: flex; flex-direction: column; }

    .solic-top {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: 10px;
        margin-bottom: 10px;
    }
    .solic-titulo { font-size: 0.95rem; font-weight: 800; color: #111; line-height: 1.3; letter-spacing: -0.2px; }
    .solic-id { font-size: 0.68rem; font-weight: 700; color: #bbb; margin-top: 2px; }

    .tag {
        display: inline-flex; align-items: center;
        font-size: 0.65rem; font-weight: 700;
        padding: 3px 9px; border-radius: 20px;
        white-space: nowrap; flex-shrink: 0;
    }
    .tag-aberta       { background: #e0f5f8; color: #0c6674; }
    .tag-em_andamento { background: #fdf6e3; color: #8a6000; }
    .tag-concluida    { background: #e8f6ef; color: #145c37; }
    .tag-cancelada    { background: #f0f0f0; color: #888; }

    .solic-meta { display: flex; flex-direction: column; gap: 5px; margin-bottom: 14px; }
    .solic-meta-item { display: flex; align-items: center; gap: 7px; font-size: 0.77rem; color: #999; }
    .solic-meta-item i { font-size: 13px; color: #ccc; flex-shrink: 0; }
    .solic-meta-item strong { color: #555; font-weight: 600; }

    .solic-bottom {
        display: flex; align-items: flex-end;
        justify-content: space-between; gap: 8px;
        margin-top: auto;
    }

    .orcamento-badge {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.75rem; font-weight: 700;
        padding: 5px 10px; border-radius: 8px;
    }
    .orcamento-sim  { background: #e8f6ef; color: #145c37; }
    .orcamento-nao  { background: #f0f0f0; color: #aaa; }

    .data-badge {
        display: flex; align-items: center; gap: 5px;
        font-size: 0.75rem; font-weight: 700; color: #888;
    }
    .data-badge i { font-size: 12px; color: #ccc; }

    .solic-footer {
        padding: 13px 20px;
        border-top: 1.5px solid #f5f5f5;
        display: flex; align-items: center; gap: 7px;
    }

    .act-btn {
        width: 34px; height: 34px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 14px; cursor: pointer; transition: all 0.2s;
        border: 1.5px solid; text-decoration: none; background: transparent;
        flex-shrink: 0;
    }
    .act-view   { border:none; color: #ffffff;background: #fa4101; }
    .act-view:hover   { background: #c93200;  }
    .act-edit   { border:none; color: #ffffff;background: #fa4101; }
    .act-edit:hover   { background: #c93200;  }
    .act-delete { border:none; color: #ffffff;background: #da0101; }
    .act-delete:hover { background: #b80000;  }

    .empty-state {
        grid-column: 1 / -1; padding: 60px 20px; text-align: center;
        background: #fff; border-radius: 16px; border: 1.5px solid #ececec;
    }
    .empty-state i { font-size: 44px; color: #e0e0e0; display: block; margin-bottom: 12px; }
    .empty-state p { font-size: 0.9rem; color: #bbb; margin: 0; font-weight: 500; }

    .pagination-wrap { margin-top: 4px; }
    .pagination-wrap .pagination { gap: 4px; }
    .pagination-wrap .page-link {
        border-radius: 8px !important; border: 1.5px solid #ececec;
        color: #666; font-size: 0.8rem; font-weight: 600;
        font-family: 'Sora', sans-serif; padding: 6px 12px; transition: all 0.2s;
    }
    .pagination-wrap .page-link:hover { border-color: #fa4101; color: #fa4101; background: #fff8f5; }
    .pagination-wrap .page-item.active .page-link { background: #fa4101; border-color: #fa4101; color: #fff; }
    .pagination-wrap .page-item.disabled .page-link { opacity: 0.4; }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(16px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .d1{animation-delay:.04s}.d2{animation-delay:.08s}.d3{animation-delay:.12s}
    .d4{animation-delay:.16s}.d5{animation-delay:.20s}.d6{animation-delay:.24s}

    @media(max-width:576px) {
        .dash { padding: 16px; }
        .solicitacoes-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="fa-solid fa-clipboard-check"></i> Solicitações</h4>
        @if(Auth::user()->isCliente() || Auth::user()->isAdm())
        <a href="{{ route('solicitacoes.create') }}" class="btn-dash-fill">
            <i class="fa-solid fa-circle-plus"></i> Nova Solicitação
        </a>
        @endif
    </div>

    <form method="GET" action="{{ route('solicitacoes.index') }}" class="search-bar">
        <input type="text" name="busca" class="search-input"
            placeholder="Buscar por título, categoria ou status..."
            value="{{ $busca ?? '' }}">
        <button type="submit" class="search-btn"><i class="fa-solid fa-search"></i></button>
        @if($busca ?? false)
        <a href="{{ route('solicitacoes.index') }}" class="clear-btn"><i class="fa-solid fa-x"></i> Limpar</a>
        @endif
    </form>

    <div class="solicitacoes-grid">
        @forelse($solicitacoes as $i => $s)
        @php
            $statusSlug = $s->status ?? 'cancelada';
        @endphp
        <div class="solic-card d{{ ($i % 6) + 1 }}">

            <div class="solic-banner banner-{{ $statusSlug }}"></div>

            <div class="solic-body">
                <div class="solic-top">
                    <div>
                        <div class="solic-titulo">{{ $s->titulo }}</div>
                        <div class="solic-id">#{{ $s->id }}</div>
                    </div>
                    <span class="tag tag-{{ $statusSlug }}">
                        {{ ucfirst(str_replace('_', ' ', $s->status)) }}
                    </span>
                </div>

                <div class="solic-meta">
                    @if($s->categoria)
                    <div class="solic-meta-item"><i class="fa-solid fa-tag"></i><span>{{ $s->categoria }}</span></div>
                    @endif
                    <div class="solic-meta-item"><i class="fa-solid fa-person"></i><strong>{{ $s->usuario->nome }}</strong></div>
                </div>

                <div class="solic-bottom">
                    <div class="data-badge">
                        <i class="fa-solid fa-calendar-days"></i>
                        {{ $s->disponibilidade ? \Carbon\Carbon::parse($s->disponibilidade)->format('d/m/Y') : 'Sem data' }}
                    </div>
                    @if($s->orcamento)
                        <div class="orcamento-badge orcamento-sim">
                            <i class="fa-solid fa-check-circle" style="font-size:12px;"></i> Com orçamento
                        </div>
                    @else
                        <div class="orcamento-badge orcamento-nao">
                            <i class="fa-solid fa-circle-minus" style="font-size:12px;"></i> Sem orçamento
                        </div>
                    @endif
                </div>
            </div>

            <div class="solic-footer">
                <a href="{{ route('solicitacoes.show', $s) }}" class="act-btn act-view" title="Ver"><i class="fa-solid fa-eye"></i></a>
                @if(Auth::user()->isAdm() || $s->usuario_id === Auth::id())
                <a href="{{ route('solicitacoes.edit', $s) }}" class="act-btn act-edit" title="Editar"><i class="fa-solid fa-pencil"></i></a>
                <form action="{{ route('solicitacoes.destroy', $s) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Excluir esta solicitação?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="act-btn act-delete" title="Excluir"><i class="fa-solid fa-trash"></i></button>
                </form>
                @endif
            </div>

        </div>
        @empty
        <div class="empty-state">
            <i class="bi bi-clipboard-x"></i>
            <p>Nenhuma solicitação encontrada{{ ($busca ?? false) ? ' para "'.$busca.'"' : '' }}.</p>
        </div>
        @endforelse
    </div>

    @if($solicitacoes->hasPages())
    <div class="pagination-wrap">
        {{ $solicitacoes->appends(['busca' => $busca])->links() }}
    </div>
    @endif

</div>
@endsection