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

    /* GRID DE CARDS */
    .servicos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .serv-card {
        background: #fff;
        border-radius: 16px;
        border: 1.5px solid #ececec;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.22s, box-shadow 0.22s;
        animation: fadeUp 0.4s ease both;
    }
    .serv-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.09);
    }

    /* IMAGEM / PLACEHOLDER */
    .serv-img {
        width: 100%; height: 172px;
        object-fit: cover; display: block;
        flex-shrink: 0;
    }
    .serv-img-placeholder {
        height: 172px; flex-shrink: 0;
        background: linear-gradient(135deg, #f5f0eb 0%, #ede8e2 100%);
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        gap: 8px;
    }
    .serv-img-placeholder i {
        font-size: 36px; color: #d0c8be;
    }
    .serv-img-placeholder span {
        font-size: 0.7rem; font-weight: 700;
        color: #c4bdb5; text-transform: uppercase; letter-spacing: 1px;
    }

    /* BODY */
    .serv-body { padding: 18px 20px; flex: 1; display: flex; flex-direction: column; gap: 0; }

    .serv-top {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: 10px;
        margin-bottom: 10px;
    }
    .serv-titulo {
        font-size: 0.95rem; font-weight: 800;
        color: #111; line-height: 1.3;
        letter-spacing: -0.2px;
    }

    .tag {
        display: inline-flex; align-items: center;
        font-size: 0.65rem; font-weight: 700;
        padding: 3px 9px; border-radius: 20px;
        white-space: nowrap; flex-shrink: 0;
    }
    .tag-ativo    { background: #e8f6ef; color: #145c37; }
    .tag-inativo  { background: #f0f0f0; color: #888; }

    .serv-meta {
        display: flex; flex-direction: column; gap: 5px;
        margin-bottom: 12px;
    }
    .serv-meta-item {
        display: flex; align-items: center; gap: 7px;
        font-size: 0.77rem; color: #999;
    }
    .serv-meta-item i { font-size: 13px; color: #ccc; flex-shrink: 0; }
    .serv-meta-item strong { color: #555; font-weight: 600; }

    .serv-preco {
        font-size: 1.15rem; font-weight: 900;
        color: #fa4101; letter-spacing: -0.5px;
        margin-bottom: 10px;
    }
    .serv-preco small {
        font-size: 0.72rem; font-weight: 600;
        color: #bbb; margin-left: 3px;
    }

    .serv-desc {
        font-size: 0.8rem; color: #aaa; line-height: 1.55;
        flex: 1; margin-bottom: 14px;
    }

    /* ESTRELAS */
    .serv-stars {
        display: flex; align-items: center; gap: 2px;
        margin-bottom: 14px;
    }
    .serv-stars i { font-size: 13px; }
    .serv-stars .count { font-size: 0.72rem; color: #bbb; margin-left: 5px; font-weight: 600; }

    /* FOOTER */
    .serv-footer {
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

    .act-agendar {
        margin-left: auto;
        background: #fa4101; color: #fff; border: none;
        border-radius: 8px; padding: 7px 14px;
        font-size: 0.78rem; font-weight: 700;
        text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
        transition: background 0.2s; font-family: 'Sora', sans-serif; cursor: pointer;
        flex-shrink: 0;
    }
    .act-agendar:hover { background: #c73200; color: #fff; }

    /* EMPTY */
    .empty-state {
        grid-column: 1 / -1;
        padding: 60px 20px; text-align: center;
        background: #fff; border-radius: 16px;
        border: 1.5px solid #ececec;
    }
    .empty-state i { font-size: 44px; color: #e0e0e0; display: block; margin-bottom: 12px; }
    .empty-state p { font-size: 0.9rem; color: #bbb; margin: 0; font-weight: 500; }

    /* PAGINATION */
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
        .servicos-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="bi bi-tools"></i> Serviços</h4>
        @if(Auth::user()->isPrestador() || Auth::user()->isAdm())
        <a href="{{ route('servicos.create') }}" class="btn-dash-fill">
            <i class="fa-solid fa-circle-plus"></i> Novo Serviço
        </a>
        @endif
    </div>

    <form method="GET" action="{{ route('servicos.index') }}" class="search-bar">
        <input type="text" name="busca" class="search-input"
            placeholder="Buscar por título ou categoria..."
            value="{{ $busca ?? '' }}">
        <button type="submit" class="search-btn"><i class="bi bi-search"></i></button>
        @if($busca ?? false)
        <a href="{{ route('servicos.index') }}" class="clear-btn"><i class="bi bi-x"></i> Limpar</a>
        @endif
    </form>

    <div class="servicos-grid">
        @forelse($servicos as $i => $servico)
        @php $nota = $servico->notaMedia(); @endphp
        <div class="serv-card d{{ ($i % 6) + 1 }}">

            {{-- IMAGEM --}}
            @if($servico->foto)
                <img src="{{ asset('storage/'.$servico->foto) }}" class="serv-img" alt="{{ $servico->titulo }}">
            @else
                <div class="serv-img-placeholder">
                    <i class="bi bi-tools"></i>
                    <span>Sem imagem</span>
                </div>
            @endif

            {{-- CORPO --}}
            <div class="serv-body">
                <div class="serv-top">
                    <div class="serv-titulo">{{ $servico->titulo }}</div>
                    <span class="tag {{ $servico->status === 'ativo' ? 'tag-ativo' : 'tag-inativo' }}">
                        {{ ucfirst($servico->status) }}
                    </span>
                </div>

                <div class="serv-meta">
                    @if($servico->categoria)
                    <div class="serv-meta-item">
                        <i class="bi bi-tag"></i>
                        <span>{{ $servico->categoria }}</span>
                    </div>
                    @endif
                    <div class="serv-meta-item">
                        <i class="bi bi-person"></i>
                        <strong>{{ $servico->usuario->nome }}</strong>
                    </div>
                </div>

                @if($servico->preco_estimado)
                <div class="serv-preco">
                    R$ {{ number_format($servico->preco_estimado, 2, ',', '.') }}
                    <small>estimado</small>
                </div>
                @endif

                @if($servico->descricao)
                <p class="serv-desc">{{ Str::limit($servico->descricao, 90) }}</p>
                @endif

                @if($nota > 0)
                <div class="serv-stars">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= $nota ? '-fill' : '' }}" style="color:{{ $i <= $nota ? '#f59e0b' : '#e0e0e0' }};"></i>
                    @endfor
                    <span class="count">({{ $servico->avaliacoes->count() }})</span>
                </div>
                @endif
            </div>

            {{-- FOOTER --}}
            <div class="serv-footer">
                <a href="{{ route('servicos.show', $servico) }}" class="act-btn act-view" title="Ver"><i class="bi bi-eye"></i></a>

                @if(Auth::user()->isAdm() || $servico->usuario_id === Auth::id())
                <a href="{{ route('servicos.edit', $servico) }}" class="act-btn act-edit" title="Editar"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('servicos.destroy', $servico) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Excluir este serviço?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="act-btn act-delete" title="Excluir"><i class="bi bi-trash"></i></button>
                </form>
                @endif

                @if(Auth::user()->isCliente())
                <a href="{{ route('agendamentos.create', ['servico_id' => $servico->id]) }}" class="act-agendar">
                    <i class="bi bi-calendar-check"></i> Agendar
                </a>
                @endif
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="bi bi-tools"></i>
            <p>Nenhum serviço encontrado{{ ($busca ?? false) ? ' para "'.$busca.'"' : '' }}.</p>
        </div>
        @endforelse
    </div>

    @if($servicos->hasPages())
    <div class="pagination-wrap">
        {{ $servicos->appends(['busca' => $busca])->links() }}
    </div>
    @endif

</div>
@endsection