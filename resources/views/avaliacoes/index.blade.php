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

    /* ── Seção ───────────────────────────── */
    .section-title {
        font-size: 1rem; font-weight: 800; color: #111;
        letter-spacing: -0.3px; margin: 0 0 16px 0;
        display: flex; align-items: center; gap: 8px;
    }
    .section-title i { color: #fa4101; font-size: 0.95rem; }
    .section-divider { border: none; border-top: 1.5px solid #ececec; margin: 32px 0; }

    /* ── Cards pendentes ─────────────────── */
    .pendentes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
        gap: 18px;
        margin-bottom: 8px;
    }

    .pend-card {
        background: #fff;
        border-radius: 14px;
        border: 1.5px solid #ececec;
        padding: 18px 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        transition: transform 0.2s, box-shadow 0.2s;
        animation: fadeUp 0.35s ease both;
    }
    .pend-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(0,0,0,0.08); }

    .pend-servico { font-size: 0.95rem; font-weight: 800; color: #111; letter-spacing: -0.2px; }
    .pend-meta { display: flex; flex-direction: column; gap: 4px; }
    .pend-meta-item { display: flex; align-items: center; gap: 6px; font-size: 0.77rem; color: #999; }
    .pend-meta-item i { font-size: 12px; color: #ccc; }
    .pend-meta-item strong { color: #555; font-weight: 600; }

    .btn-avaliar {
        background: #fa4101; color: #fff; border: none;
        border-radius: 9px; padding: 8px 16px;
        font-size: 0.8rem; font-weight: 700;
        text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
        transition: background 0.2s; font-family: 'Sora', sans-serif; cursor: pointer;
        align-self: flex-start; margin-top: 2px;
    }
    .btn-avaliar:hover { background: #c73200; color: #fff; }

    /* ── Cards de avaliações já feitas ──── */
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
    .act-delete { border:none; color: #ffffff;background: #da0101; }
    .act-delete:hover { background: #b80000; }

    .empty-state {
        grid-column: 1 / -1; padding: 60px 20px; text-align: center;
        background: #fff; border-radius: 16px; border: 1.5px solid #ececec;
    }
    .empty-state i { font-size: 44px; color: #e0e0e0; display: block; margin-bottom: 12px; }
    .empty-state p { font-size: 0.9rem; color: #bbb; margin: 0; font-weight: 500; }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(16px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .d1{animation-delay:.04s}.d2{animation-delay:.08s}.d3{animation-delay:.12s}
    .d4{animation-delay:.16s}.d5{animation-delay:.20s}.d6{animation-delay:.24s}

    @media(max-width:576px) {
        .dash { padding: 16px; }
        .avaliacoes-grid, .pendentes-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="fa-solid fa-star"></i> Avaliações</h4>
    </div>

    @if(session('sucesso'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('sucesso') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(Auth::user()->isCliente() && isset($agendamentosPendentes))
    <h5 class="section-title">
        <i class="fa-solid fa-clock-rotate-left"></i>
        Serviços pendentes de avaliação
        @if($agendamentosPendentes->count())
            <span style="background:#fa4101;color:#fff;border-radius:20px;padding:1px 9px;font-size:0.72rem;">
                {{ $agendamentosPendentes->count() }}
            </span>
        @endif
    </h5>

    <div class="pendentes-grid">
        @forelse($agendamentosPendentes as $i => $ag)
        <div class="pend-card d{{ ($i % 6) + 1 }}">
            <div class="pend-servico">{{ $ag->servico->titulo }}</div>

            <div class="pend-meta">
                <div class="pend-meta-item">
                    <i class="fa-solid fa-person-gear"></i>
                    <span>Prestador: <strong>{{ $ag->servico->usuario->nome }}</strong></span>
                </div>
                <div class="pend-meta-item">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Concluído em: <strong>{{ $ag->updated_at?->format('d/m/Y') ?? '—' }}</strong></span>
                </div>
            </div>

            <a href="{{ route('avaliacoes.create', ['agendamento_id' => $ag->id]) }}" class="btn-avaliar">
                <i class="fa-solid fa-star-half-stroke"></i> Avaliar
            </a>
        </div>
        @empty
        <div class="empty-state">
            <i class="fa-regular fa-circle-check"></i>
            <p>Nenhum serviço aguardando avaliação.</p>
        </div>
        @endforelse
    </div>

    <hr class="section-divider">
    @endif

    
    <h5 class="section-title">
        <i class="fa-solid fa-star"></i>
        @if(Auth::user()->isPrestador())
            Avaliações dos meus serviços
        @else
            Minhas avaliações
        @endif
    </h5>

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
                                <i class="{{ $s <= $av->nota ? 'fa-solid' : 'fa-regular' }} fa-star"
                                   style="color: {{ $s <= $av->nota ? '#f9a825' : '#ddd' }}"></i>
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
                    @if(Auth::user()->isPrestador() || Auth::user()->isAdm())
                    <div class="av-meta-item">
                        <i class="fa-solid fa-person-check"></i>
                        <span>Cliente: <strong>{{ $av->usuario->nome }}</strong></span>
                    </div>
                    @endif
                    <div class="av-meta-item">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Data: <strong>{{ $av->created_at->format('d/m/Y') }}</strong></span>
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
                    <button type="submit" class="act-btn act-delete" title="Excluir">
                        <i class="fa-solid fa-trash"></i>
                    </button>
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

</div>
@endsection