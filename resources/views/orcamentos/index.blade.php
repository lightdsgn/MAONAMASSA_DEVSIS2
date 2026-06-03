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
    .page-title i { color: #fa4101; font-size: 1.2rem; }

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

    .orcamentos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .orc-card {
        background: #fff;
        border-radius: 16px;
        border: 1.5px solid #ececec;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.22s, box-shadow 0.22s;
        animation: fadeUp 0.4s ease both;
    }
    .orc-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.09);
    }

    /* topo colorido por status */
    .orc-banner { height: 8px; flex-shrink: 0; }
    .banner-pendente { background: #ffc107; }
    .banner-aceito   { background: #28a745; }
    .banner-recusado { background: #fa4101; }
    .banner-default  { background: #ced4da; }

    .orc-body { padding: 18px 20px; flex: 1; display: flex; flex-direction: column; }

    .orc-top {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: 10px;
        margin-bottom: 12px;
    }
    .orc-titulo { font-size: 0.95rem; font-weight: 800; color: #111; line-height: 1.3; letter-spacing: -0.2px; }
    .orc-id { font-size: 0.68rem; font-weight: 700; color: #bbb; margin-top: 2px; font-family: monospace; }

    .tag {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.65rem; font-weight: 700;
        padding: 3px 9px; border-radius: 20px;
        white-space: nowrap; flex-shrink: 0;
    }
    .tag::before { content:''; width:5px; height:5px; border-radius:50%; background:currentColor; opacity:.6; }
    .tag-pendente { background: #fdf6e3; color: #8a6000; }
    .tag-aceito   { background: #e8f6ef; color: #145c37; }
    .tag-recusado { background: #fff1ec; color: #c73200; }
    .tag-gray     { background: #f0f0f0; color: #666; }

    .orc-meta { display: flex; flex-direction: column; gap: 6px; margin-bottom: 14px; }
    .orc-meta-item { display: flex; align-items: center; gap: 7px; font-size: 0.77rem; color: #999; }
    .orc-meta-item i { font-size: 13px; color: #ccc; flex-shrink: 0; }
    .orc-meta-item strong { color: #555; font-weight: 600; }

    /* prestador com avatar */
    .prestador-row { display: flex; align-items: center; gap: 8px; }
    .p-avatar {
        width: 24px; height: 24px; border-radius: 6px;
        background: #ebf2ff; color: #0d6efd;
        font-size: 10px; font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .orc-bottom {
        display: flex; align-items: flex-end;
        justify-content: space-between; gap: 8px;
        margin-top: auto;
    }
    .orc-valor {
        font-size: 1.2rem; font-weight: 900; color: #fa4101;
        letter-spacing: -0.5px; line-height: 1;
    }
    .orc-valor small { font-size: 0.7rem; font-weight: 600; color: #bbb; display: block; margin-bottom: 2px; }

    .orc-prazo {
        display: flex; align-items: center; gap: 5px;
        font-size: 0.75rem; font-weight: 700;
        padding: 5px 10px; border-radius: 8px;
        background: #f5f5f5; color: #777;
    }
    .orc-prazo i { font-size: 12px; color: #bbb; }

    .orc-mo {
        font-size: 0.72rem; font-weight: 600; color: #aaa; margin-top: 3px;
    }

    .orc-footer {
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
  
    .act-accept { border-color: #b2e8c8; color: #145c37; }
    .act-accept:hover { background: #e8f6ef; color: #145c37; }
    .act-reject { border-color: #ffd5c2; color: #c73200; }
    .act-reject:hover { background: #fff1ec; color: #c73200; }

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
        .orcamentos-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="fa-solid fa-receipt"></i> Orçamentos</h4>
        @if(Auth::user()->isPrestador() || Auth::user()->isAdm())
        <a href="{{ route('orcamentos.create') }}" class="btn-dash-fill">
                <i class="fa-solid fa-circle-plus"></i> Novo Orçamento
            </a>
        @endif
    </div>

    <form method="GET" action="{{ route('orcamentos.index') }}" class="search-bar">
        <input type="text" name="busca" class="search-input"
            placeholder="Buscar por solicitação ou status..."
            value="{{ $busca ?? '' }}">
        <button type="submit" class="search-btn"><i class="bi bi-search"></i></button>
        @if($busca ?? false)
        <a href="{{ route('orcamentos.index') }}" class="clear-btn"><i class="bi bi-x"></i> Limpar</a>
        @endif
    </form>

    <div class="orcamentos-grid">
        @forelse($orcamentos as $i => $orc)
        @php
            $statusSlug = $orc->status ?? 'default';
            $bannerClass = match($statusSlug) {
                'pendente' => 'banner-pendente',
                'aceito'   => 'banner-aceito',
                'recusado' => 'banner-recusado',
                default    => 'banner-default',
            };
            $tagClass = match($statusSlug) {
                'pendente' => 'tag-pendente',
                'aceito'   => 'tag-aceito',
                'recusado' => 'tag-recusado',
                default    => 'tag-gray',
            };
        @endphp
        <div class="orc-card d{{ ($i % 6) + 1 }}">

            <div class="orc-banner {{ $bannerClass }}"></div>

            <div class="orc-body">

                <div class="orc-top">
                    <div>
                        <div class="orc-titulo">{{ Str::limit($orc->solicitacao->titulo, 32) }}</div>
                        <div class="orc-id">#{{ $orc->id }}</div>
                    </div>
                    <span class="tag {{ $tagClass }}">{{ ucfirst($orc->status) }}</span>
                </div>

                <div class="orc-meta">
                    <div class="orc-meta-item">
                        <i class="fa-solid fa-person-gear"></i>
                        <div class="prestador-row">
                            <div class="p-avatar">{{ strtoupper(substr($orc->usuario->nome, 0, 1)) }}</div>
                            <strong>{{ Str::limit($orc->usuario->nome, 20) }}</strong>
                        </div>
                    </div>
                    <div class="orc-meta-item">
                        <i class="fa-solid fa-tools"></i>
                        <span>M.O.: <strong>R$ {{ number_format($orc->mao_de_obra, 2, ',', '.') }}</strong></span>
                    </div>
                </div>

                <div class="orc-bottom">
                    <div class="orc-valor">
                        <small>total</small>
                        R$ {{ number_format($orc->valor_total, 2, ',', '.') }}
                    </div>
                    <div class="orc-prazo">
                        <i class="fa-solid fa-clock"></i>
                        {{ $orc->prazo }} dias
                    </div>
                </div>

            </div>

            <div class="orc-footer">
                <a href="{{ route('orcamentos.show', $orc) }}" class="act-btn act-view" title="Ver"><i class="fa-solid fa-eye"></i></a>

                @if(Auth::user()->isAdm() || $orc->usuario_id === Auth::id())
                    <a href="{{ route('orcamentos.edit', $orc) }}" class="act-btn act-edit" title="Editar"><i class="fa-solid fa-pencil"></i></a>
                    <form action="{{ route('orcamentos.destroy', $orc) }}" method="POST" class="d-inline" onsubmit="return confirm('Excluir este orçamento?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="act-btn act-delete" title="Excluir"><i class="fa-solid fa-trash"></i></button>
                    </form>
                @endif

                {{-- Cliente pode aceitar/recusar orçamentos pendentes --}}
                @if(Auth::user()->isCliente() && $orc->status === 'pendente' && $orc->solicitacao->usuario_id === Auth::id())
                    <form action="{{ route('orcamentos.aceitar', $orc) }}" method="POST" class="d-inline ms-auto">
                        @csrf
                        <button type="submit" class="act-btn act-accept" title="Aceitar orçamento"><i class="fa-solid fa-check"></i></button>
                    </form>
                    <form action="{{ route('orcamentos.recusar', $orc) }}" method="POST" class="d-inline" onsubmit="return confirm('Recusar este orçamento?')">
                        @csrf
                        <button type="submit" class="act-btn act-reject" title="Recusar orçamento"><i class="fa-solid fa-times"></i></button>
                    </form>
                @endif
            </div>

        </div>
        @empty
        <div class="empty-state">
            <i class="bi bi-receipt"></i>
            <p>Nenhum orçamento encontrado{{ ($busca ?? false) ? ' para "'.$busca.'"' : '' }}.</p>
        </div>
        @endforelse
    </div>

    @if($orcamentos->hasPages())
    <div class="pagination-wrap">
        {{ $orcamentos->appends(['busca' => $busca])->links() }}
    </div>
    @endif

</div>
@endsection