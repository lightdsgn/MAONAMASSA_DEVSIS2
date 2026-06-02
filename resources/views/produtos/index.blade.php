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

    .produtos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .prod-card {
        background: #fff;
        border-radius: 16px;
        border: 1.5px solid #ececec;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.22s, box-shadow 0.22s;
        animation: fadeUp 0.4s ease both;
    }
    .prod-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.09);
    }

    .prod-img { width: 100%; height: 180px; object-fit: cover; display: block; flex-shrink: 0; }
    .prod-img-placeholder {
        height: 180px; flex-shrink: 0;
        background: linear-gradient(135deg, #f5f0eb 0%, #ede8e2 100%);
        display: flex; flex-direction: column;
        align-items: center; justify-content: center; gap: 8px;
    }
    .prod-img-placeholder i { font-size: 38px; color: #d0c8be; }
    .prod-img-placeholder span { font-size: 0.68rem; font-weight: 700; color: #c4bdb5; text-transform: uppercase; letter-spacing: 1px; }

    .prod-body { padding: 18px 20px; flex: 1; display: flex; flex-direction: column; }

    .prod-top {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: 10px;
        margin-bottom: 10px;
    }
    .prod-nome { font-size: 0.95rem; font-weight: 800; color: #111; line-height: 1.3; letter-spacing: -0.2px; }

    .tag {
        display: inline-flex; align-items: center;
        font-size: 0.65rem; font-weight: 700;
        padding: 3px 9px; border-radius: 20px;
        white-space: nowrap; flex-shrink: 0;
    }
    .tag-ativo   { background: #e8f6ef; color: #145c37; }
    .tag-inativo { background: #f0f0f0; color: #888; }

    .prod-meta { display: flex; flex-direction: column; gap: 5px; margin-bottom: 14px; }
    .prod-meta-item { display: flex; align-items: center; gap: 7px; font-size: 0.77rem; color: #999; }
    .prod-meta-item i { font-size: 13px; color: #ccc; flex-shrink: 0; }
    .prod-meta-item strong { color: #555; font-weight: 600; }

    .prod-bottom {
        display: flex; align-items: flex-end;
        justify-content: space-between; gap: 8px;
        margin-top: auto;
    }
    .prod-preco { font-size: 1.2rem; font-weight: 900; color: #fa4101; letter-spacing: -0.5px; line-height: 1; }
    .prod-preco small { font-size: 0.7rem; font-weight: 600; color: #bbb; display: block; margin-bottom: 2px; }

    .prod-estoque {
        display: flex; align-items: center; gap: 5px;
        font-size: 0.75rem; font-weight: 700;
        padding: 5px 10px; border-radius: 8px;
    }
    .estoque-ok    { background: #e8f6ef; color: #145c37; }
    .estoque-baixo { background: #fdf6e3; color: #8a6000; }
    .estoque-zero  { background: #fff1ec; color: #c73200; }

    .prod-footer {
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
    .act-view   { border-color: #bde0ff; color: #0d6efd; }
    .act-view:hover   { background: #ebf2ff; color: #0d6efd; }
    .act-edit   { border-color: #fde9a2; color: #b07d00; }
    .act-edit:hover   { background: #fdf6e3; color: #b07d00; }
    .act-delete { border-color: #ffc9b8; color: #c73200; }
    .act-delete:hover { background: #fff1ec; color: #c73200; }

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
        .produtos-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="bi bi-bag"></i> Produtos</h4>
        @if(Auth::user()->isPrestador() || Auth::user()->isAdm())
        <a href="{{ route('produtos.create') }}" class="btn-dash-fill">
            <i class="fa-solid fa-circle-plus"></i> Novo Produto
        </a>
        @endif
    </div>

    <form method="GET" action="{{ route('produtos.index') }}" class="search-bar">
        <input type="text" name="busca" class="search-input"
            placeholder="Buscar por nome ou categoria..."
            value="{{ $busca ?? '' }}">
        <button type="submit" class="search-btn"><i class="bi bi-search"></i></button>
        @if($busca ?? false)
        <a href="{{ route('produtos.index') }}" class="clear-btn"><i class="bi bi-x"></i> Limpar</a>
        @endif
    </form>

    <div class="produtos-grid">
        @forelse($produtos as $i => $p)
        @php
            $estoqueClass = $p->quantidade <= 0 ? 'estoque-zero' : ($p->quantidade <= 5 ? 'estoque-baixo' : 'estoque-ok');
            $estoqueIcon  = $p->quantidade <= 0 ? 'bi-x-circle' : ($p->quantidade <= 5 ? 'bi-exclamation-circle' : 'bi-box-seam');
        @endphp
        <div class="prod-card d{{ ($i % 6) + 1 }}">

            @if($p->foto)
                <img src="{{ asset('storage/'.$p->foto) }}" class="prod-img" alt="{{ $p->nome }}">
            @else
                <div class="prod-img-placeholder">
                    <i class="bi bi-bag"></i>
                    <span>Sem imagem</span>
                </div>
            @endif

            <div class="prod-body">
                <div class="prod-top">
                    <div class="prod-nome">{{ $p->nome }}</div>
                    <span class="tag {{ $p->status === 'ativo' ? 'tag-ativo' : 'tag-inativo' }}">{{ ucfirst($p->status) }}</span>
                </div>

                <div class="prod-meta">
                    @if($p->categoria)
                    <div class="prod-meta-item"><i class="bi bi-tag"></i><span>{{ $p->categoria }}</span></div>
                    @endif
                    <div class="prod-meta-item"><i class="bi bi-person"></i><strong>{{ $p->usuario->nome }}</strong></div>
                </div>

                <div class="prod-bottom">
                    <div class="prod-preco">
                        <small>preço</small>
                        R$ {{ number_format($p->preco, 2, ',', '.') }}
                    </div>
                    <div class="prod-estoque {{ $estoqueClass }}">
                        <i class="bi {{ $estoqueIcon }}" style="font-size:12px;"></i>
                        {{ $p->quantidade }} un.
                    </div>
                </div>
            </div>

            <div class="prod-footer">
                <a href="{{ route('produtos.show', $p) }}" class="act-btn act-view" title="Ver"><i class="bi bi-eye"></i></a>
                @if(Auth::user()->isAdm() || $p->usuario_id === Auth::id())
                <a href="{{ route('produtos.edit', $p) }}" class="act-btn act-edit" title="Editar"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('produtos.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Excluir produto?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="act-btn act-delete" title="Excluir"><i class="bi bi-trash"></i></button>
                </form>
                @endif
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="bi bi-bag"></i>
            <p>Nenhum produto encontrado{{ ($busca ?? false) ? ' para "'.$busca.'"' : '' }}.</p>
        </div>
        @endforelse
    </div>

    @if($produtos->hasPages())
    <div class="pagination-wrap">
        {{ $produtos->appends(['busca' => $busca])->links() }}
    </div>
    @endif

</div>
@endsection