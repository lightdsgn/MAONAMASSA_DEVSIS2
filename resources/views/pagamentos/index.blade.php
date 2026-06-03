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

    .pagamentos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .pag-card {
        background: #fff;
        border-radius: 16px;
        border: 1.5px solid #ececec;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.22s, box-shadow 0.22s;
        animation: fadeUp 0.4s ease both;
    }
    .pag-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.09);
    }

    .pag-banner { height: 8px; flex-shrink: 0; }
    .banner-pendente  { background: #ffc107; }
    .banner-pago      { background: #28a745; }
    .banner-cancelado { background: #adb5bd; }
    .banner-estornado { background: #dc3545; }

    .pag-body { padding: 18px 20px; flex: 1; display: flex; flex-direction: column; }

    .pag-top {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: 10px;
        margin-bottom: 12px;
    }
    .pag-servico { font-size: 0.95rem; font-weight: 800; color: #111; line-height: 1.3; letter-spacing: -0.2px; }
    .pag-id { font-size: 0.68rem; font-weight: 700; color: #bbb; margin-top: 2px; font-family: monospace; }

    .tag {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.65rem; font-weight: 700;
        padding: 3px 9px; border-radius: 20px;
        white-space: nowrap; flex-shrink: 0;
    }
    .tag::before { content:''; width:5px; height:5px; border-radius:50%; background:currentColor; opacity:.6; }
    .tag-pendente  { background: #fdf6e3; color: #8a6000; }
    .tag-pago      { background: #e8f6ef; color: #145c37; }
    .tag-cancelado { background: #f0f0f0; color: #888; }
    .tag-estornado { background: #fff1ec; color: #c73200; }

    .pag-meta { display: flex; flex-direction: column; gap: 5px; margin-bottom: 14px; }
    .pag-meta-item { display: flex; align-items: center; gap: 7px; font-size: 0.77rem; color: #999; }
    .pag-meta-item i { font-size: 13px; color: #ccc; flex-shrink: 0; }
    .pag-meta-item strong { color: #555; font-weight: 600; }

    .pag-bottom {
        display: flex; align-items: flex-end;
        justify-content: space-between; gap: 8px;
        margin-top: auto;
    }
    .pag-valor {
        font-size: 1.2rem; font-weight: 900; color: #fa4101;
        letter-spacing: -0.5px; line-height: 1;
    }
    .pag-valor small { font-size: 0.7rem; font-weight: 600; color: #bbb; display: block; margin-bottom: 2px; }

    .metodo-badge {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 5px 10px; border-radius: 8px;
        background: #f0f0f0; color: #666;
    }
    .metodo-badge i { font-size: 11px; }

    .data-pgto {
        display: flex; align-items: center; gap: 5px;
        font-size: 0.72rem; font-weight: 600; color: #aaa;
        margin-top: 6px;
    }
    .data-pgto i { font-size: 11px; color: #ccc; }

    .pag-footer {
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

    /* ícone de método de pagamento */
    .metodo-pix        { background: #e8f6ef; color: #145c37; }
    .metodo-cartao     { background: #ebf2ff; color: #0d6efd; }
    .metodo-dinheiro   { background: #fdf6e3; color: #8a6000; }
    .metodo-transferencia { background: #f5f0ff; color: #6f42c1; }

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
        .pagamentos-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="fa-solid fa-credit-card"></i> Pagamentos</h4>
        @if(Auth::user()->isAdm() || Auth::user()->isPrestador())
        <a href="{{ route('pagamentos.create') }}" class="btn-dash-fill">
            <i class="fa-solid fa-circle-plus"></i> Registrar Pagamento
        </a>
        @endif
    </div>

    <form method="GET" action="{{ route('pagamentos.index') }}" class="search-bar">
        <input type="text" name="busca" class="search-input"
            placeholder="Buscar por método ou status..."
            value="{{ $busca ?? '' }}">
        <button type="submit" class="search-btn"><i class="bi bi-search"></i></button>
        @if($busca ?? false)
        <a href="{{ route('pagamentos.index') }}" class="clear-btn"><i class="bi bi-x"></i> Limpar</a>
        @endif
    </form>

    <div class="pagamentos-grid">
        @forelse($pagamentos as $i => $pag)
        @php
            $statusSlug  = $pag->status ?? 'pendente';
            $bannerClass = 'banner-' . $statusSlug;
            $tagClass    = 'tag-'    . $statusSlug;

            $metodoSlug = match(true) {
                str_contains($pag->metodo, 'pix')          => 'pix',
                str_contains($pag->metodo, 'cartao'),
                str_contains($pag->metodo, 'cartão'),
                str_contains($pag->metodo, 'credito'),
                str_contains($pag->metodo, 'debito')       => 'cartao',
                str_contains($pag->metodo, 'dinheiro')     => 'dinheiro',
                default                                    => 'transferencia',
            };
            $metodoIcon = match($metodoSlug) {
                'pix'          => 'bi-lightning-charge-fill',
                'cartao'       => 'bi-credit-card-2-front',
                'dinheiro'     => 'bi-cash-coin',
                default        => 'bi-arrow-left-right',
            };
        @endphp
        <div class="pag-card d{{ ($i % 6) + 1 }}">

            <div class="pag-banner {{ $bannerClass }}"></div>

            <div class="pag-body">

                <div class="pag-top">
                    <div>
                        <div class="pag-servico">{{ $pag->agendamento->servico->titulo }}</div>
                        <div class="pag-id">Agend. #{{ $pag->agendamento_id }} &middot; Pgto. #{{ $pag->id }}</div>
                    </div>
                    <span class="tag {{ $tagClass }}">{{ ucfirst($pag->status) }}</span>
                </div>

                <div class="pag-meta">
                    <div class="pag-meta-item">
                        <i class="fa-solid fa-person"></i>
                        <span>Cliente: <strong>{{ $pag->agendamento->cliente->nome }}</strong></span>
                    </div>
                    <div class="pag-meta-item">
                        <i class="fa-solid fa-person-gear"></i>
                        <span>Prestador: <strong>{{ $pag->agendamento->servico->usuario->nome }}</strong></span>
                    </div>
                </div>

                <div class="pag-bottom">
                    <div>
                        <div class="pag-valor">
                            <small>valor</small>
                            R$ {{ number_format($pag->valor, 2, ',', '.') }}
                        </div>
                        @if($pag->data_pagamento)
                        <div class="data-pgto">
                            <i class="fa-solid fa-calendar-check"></i>
                            {{ \Carbon\Carbon::parse($pag->data_pagamento)->format('d/m/Y') }}
                        </div>
                        @else
                        <div class="data-pgto"><i class="fa-solid fa-calendar-x"></i> Sem data</div>
                        @endif
                    </div>
                    <div class="metodo-badge metodo-{{ $metodoSlug }}">
                        <i class="fa-solid {{ $metodoIcon }}"></i>
                        {{ str_replace('_', ' ', $pag->metodo) }}
                    </div>
                </div>

            </div>

            <div class="pag-footer">
                <a href="{{ route('pagamentos.show', $pag) }}" class="act-btn act-view" title="Ver"><i class="fa-solid fa-eye"></i></a>

                @if(Auth::user()->isAdm() || Auth::user()->isPrestador())
                <a href="{{ route('pagamentos.edit', $pag) }}" class="act-btn act-edit" title="Editar"><i class="fa-solid fa-pencil"></i></a>
                @endif

                @if(Auth::user()->isAdm())
                <form action="{{ route('pagamentos.destroy', $pag) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Remover este pagamento?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="act-btn act-delete" title="Excluir"><i class="fa-solid fa-trash"></i></button>
                </form>
                @endif
            </div>

        </div>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-credit-card"></i>
            <p>Nenhum pagamento encontrado{{ ($busca ?? false) ? ' para "'.$busca.'"' : '' }}.</p>
        </div>
        @endforelse
    </div>

    @if($pagamentos->hasPages())
    <div class="pagination-wrap">
        {{ $pagamentos->appends(['busca' => $busca])->links() }}
    </div>
    @endif

</div>
@endsection