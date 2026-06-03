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

    .avaliacoes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .av-card {
        background: #fff;
        border-radius: 16px;
        border: 1.5px solid #ececec;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.22s, box-shadow 0.22s;
        animation: fadeUp 0.4s ease both;
    }
    .av-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.09);
    }

    /* barra colorida no topo pela nota */
    .av-banner { height: 8px; flex-shrink: 0; }
    .nota-5 { background: linear-gradient(90deg, #f9a825, #fa4101); }
    .nota-4 { background: #ffc107; }
    .nota-3 { background: #adb5bd; }
    .nota-2 { background: #6c757d; }
    .nota-1 { background: #dee2e6; }

    .av-body { padding: 18px 20px; flex: 1; display: flex; flex-direction: column; }

    .av-top {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: 10px;
        margin-bottom: 10px;
    }
    .av-servico { font-size: 0.95rem; font-weight: 800; color: #111; line-height: 1.3; letter-spacing: -0.2px; }

    /* estrelas */
    .stars { display: flex; align-items: center; gap: 2px; flex-shrink: 0; }
    .stars i { font-size: 13px; }
    .star-fill  { color: #f9a825; }
    .star-empty { color: #ddd; }

    .nota-num {
        font-size: 0.72rem; font-weight: 800; color: #f9a825;
        background: #fdf6e3; padding: 2px 7px; border-radius: 20px;
        margin-left: 4px; white-space: nowrap;
    }

    .av-meta { display: flex; flex-direction: column; gap: 5px; margin-bottom: 14px; }
    .av-meta-item { display: flex; align-items: center; gap: 7px; font-size: 0.77rem; color: #999; }
    .av-meta-item i { font-size: 13px; color: #ccc; flex-shrink: 0; }
    .av-meta-item strong { color: #555; font-weight: 600; }

    .av-comentario {
        font-size: 0.82rem; color: #666; line-height: 1.55;
        background: #fafafa; border-radius: 10px;
        padding: 10px 14px; margin-top: auto;
        border-left: 3px solid #fa4101;
        font-style: italic;
    }
    .av-comentario-vazio {
        font-size: 0.78rem; color: #ccc;
        margin-top: auto; font-style: italic;
        padding: 6px 0;
    }

    .av-footer {
        padding: 13px 20px;
        border-top: 1.5px solid #f5f5f5;
        display: flex; align-items: center; gap: 7px;
    }

  
    .autor-badge {
        display: flex; align-items: center; gap: 6px;
        font-size: 0.75rem; font-weight: 700; color: #888;
        margin-left: auto;
    }
    .autor-avatar {
        width: 22px; height: 22px; border-radius: 6px;
        background: #f5f0eb; color: #c47a3a;
        font-size: 9px; font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
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
        .avaliacoes-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="fa-solid fa-star"></i> Avaliações</h4>
        @if(Auth::user()->isCliente())
        <a href="{{ route('avaliacoes.create') }}" class="btn-dash-fill">
            <i class="fa-solid fa-circle-plus"></i> Nova Avaliação
        </a>
        @endif
    </div>

    <div class="avaliacoes-grid">
        @forelse($avaliacoes as $i => $av)
        <div class="av-card d{{ ($i % 6) + 1 }}">

            <div class="av-banner nota-{{ $av->nota }}"></div>

            <div class="av-body">

                <div class="av-top">
                    <div class="av-servico">{{ $av->servico->titulo }}</div>
                    <div style="display:flex;align-items:center;gap:4px;">
                        <div class="stars">
                            @for($s = 1; $s <= 5; $s++)
                                <i class="fa-solid fa-star{{ $s <= $av->nota ? '-fill star-fill' : ' star-empty' }}"></i>
                            @endfor
                        </div>
                        <span class="nota-num">{{ $av->nota }}/5</span>
                    </div>
                </div>

                <div class="av-meta">
                    <div class="av-meta-item">
                        <i class="fa-solid fa-person-gear"></i>
                        <span>Prestador: <strong>{{ $av->servico->usuario->nome }}</strong></span>
                    </div>
                    <div class="av-meta-item">
                        <i class="fa-solid fa-person-check"></i>
                        <span>Avaliado por: <strong>{{ $av->usuario->nome }}</strong></span>
                    </div>
                </div>

                @if($av->comentario)
                    <div class="av-comentario">"{{ $av->comentario }}"</div>
                @else
                    <div class="av-comentario-vazio">Sem comentário.</div>
                @endif

            </div>

            <div class="av-footer">
                @if(Auth::user()->isAdm() || $av->usuario_id === Auth::id())
                <form action="{{ route('avaliacoes.destroy', $av) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Remover avaliação?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="act-btn act-delete" title="Excluir"><i class="fa-solid fa-trash"></i></button>
                </form>
                @endif

                <div class="autor-badge">
                    <div class="autor-avatar">{{ strtoupper(substr($av->usuario->nome, 0, 1)) }}</div>
                    {{ Str::limit($av->usuario->nome, 16) }}
                </div>
            </div>

        </div>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-star"></i>
            <p>Nenhuma avaliação encontrada.</p>
        </div>
        @endforelse
    </div>

    @if($avaliacoes->hasPages())
    <div class="pagination-wrap">
        {{ $avaliacoes->links() }}
    </div>
    @endif

</div>
@endsection