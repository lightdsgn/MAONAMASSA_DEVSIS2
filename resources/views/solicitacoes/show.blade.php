@extends('layouts.app')
@section('content')

<style>
    .dash { padding: 36px 32px; font-family: 'Sora', sans-serif; }

    .page-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 28px; gap: 16px;
    }
    .page-title {
        font-size: 1.3rem; font-weight: 900; color: #111;
        letter-spacing: -0.5px; margin: 0;
        display: flex; align-items: center; gap: 10px;
    }
    .page-title i { color: #fa4101; font-size: 1.2rem; }

    .btn-outline-back {
        border: 1.5px solid #ddd; background: transparent; color: #555;
        border-radius: 9px; padding: 8px 16px;
        font-size: 0.82rem; font-weight: 700; text-decoration: none;
        display: inline-flex; align-items: center; gap: 6px;
        transition: border-color 0.2s, color 0.2s; font-family: 'Sora', sans-serif;
    }
    .btn-outline-back:hover { border-color: #fa4101; color: #fa4101; }

    /* ── Layout ───────────────────────────────── */
    .show-grid {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 24px;
        align-items: start;
    }

    /* ── Card base ────────────────────────────── */
    .info-card {
        background: #fff;
        border: 1.5px solid #ececec;
        border-radius: 16px;
        overflow: hidden;
    }

    .card-header-bar {
        height: 6px; width: 100%;
    }
    .bar-aberta       { background: #17a2b8; }
    .bar-em_andamento { background: #ffc107; }
    .bar-concluida    { background: #28a745; }
    .bar-cancelada    { background: #6c757d; }

    .card-body-pad { padding: 24px 28px; }

    /* ── Título + badge ───────────────────────── */
    .solic-titulo-big {
        font-size: 1.15rem; font-weight: 900; color: #111;
        letter-spacing: -0.3px; margin-bottom: 6px; line-height: 1.3;
    }
    .solic-id-small { font-size: 0.7rem; color: #bbb; font-weight: 700; margin-bottom: 16px; }

    .tag {
        display: inline-flex; align-items: center;
        font-size: 0.68rem; font-weight: 700;
        padding: 4px 11px; border-radius: 20px; white-space: nowrap;
    }
    .tag-aberta       { background: #e0f5f8; color: #0c6674; }
    .tag-em_andamento { background: #fdf6e3; color: #8a6000; }
    .tag-concluida    { background: #e8f6ef; color: #145c37; }
    .tag-cancelada    { background: #f0f0f0; color: #888; }

    /* ── Meta grid ────────────────────────────── */
    .meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin: 20px 0;
    }
    .meta-item {
        display: flex; flex-direction: column; gap: 3px;
    }
    .meta-label {
        font-size: 0.68rem; font-weight: 700; color: #bbb;
        text-transform: uppercase; letter-spacing: 0.5px;
    }
    .meta-value {
        font-size: 0.88rem; font-weight: 700; color: #333;
        display: flex; align-items: center; gap: 6px;
    }
    .meta-value i { color: #fa4101; font-size: 13px; }

    /* ── Descrição ────────────────────────────── */
    .desc-block {
        background: #fafafa;
        border-radius: 12px;
        border: 1.5px solid #ececec;
        padding: 16px 20px;
        font-size: 0.88rem; color: #555; line-height: 1.6;
        margin-top: 4px;
    }

    /* ── Foto ─────────────────────────────────── */
    .foto-block {
        margin-top: 20px;
        border-radius: 12px; overflow: hidden;
        border: 1.5px solid #ececec; max-height: 280px;
    }
    .foto-block img { width: 100%; height: 280px; object-fit: cover; display: block; }

    /* ── Seção lateral ────────────────────────── */
    .side-card {
        background: #fff;
        border: 1.5px solid #ececec;
        border-radius: 16px;
        padding: 22px 24px;
        margin-bottom: 16px;
    }
    .side-title {
        font-size: 0.9rem; font-weight: 900; color: #111;
        margin-bottom: 16px; display: flex; align-items: center; gap: 8px;
    }
    .side-title i { color: #fa4101; }

    /* orçamento valores */
    .orc-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 8px 0; border-bottom: 1px solid #f5f5f5;
        font-size: 0.83rem;
    }
    .orc-row:last-of-type { border-bottom: none; }
    .orc-label { color: #999; font-weight: 600; }
    .orc-value { color: #222; font-weight: 800; }
    .orc-value.total { color: #fa4101; font-size: 1rem; }

    .orc-status-badge {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.72rem; font-weight: 700;
        padding: 4px 10px; border-radius: 20px; margin: 12px 0 4px;
    }
    .orc-pendente  { background: #fdf6e3; color: #8a6000; }
    .orc-aceito    { background: #e8f6ef; color: #145c37; }
    .orc-recusado  { background: #fdecea; color: #7b1a1a; }

    .orc-obs {
        font-size: 0.78rem; color: #888; line-height: 1.5;
        background: #fafafa; border-radius: 8px;
        padding: 10px 12px; margin-top: 10px;
        border-left: 3px solid #fa4101;
    }

    /* ── Botões de ação ───────────────────────── */
    .btn-action {
        display: flex; align-items: center; justify-content: center; gap: 7px;
        width: 100%; padding: 10px 16px; border-radius: 9px;
        font-size: 0.82rem; font-weight: 700; cursor: pointer;
        text-decoration: none; border: none; margin-bottom: 8px;
        transition: all 0.2s; font-family: 'Sora', sans-serif;
    }
    .btn-action:last-child { margin-bottom: 0; }
    .btn-primary-fill   { background: #fa4101; color: #fff; }
    .btn-primary-fill:hover { background: #c73200; color: #fff; }
    .btn-success-fill   { background: #28a745; color: #fff; }
    .btn-success-fill:hover { background: #1e7e34; color: #fff; }
    .btn-danger-fill    { background: #dc3545; color: #fff; }
    .btn-danger-fill:hover  { background: #b02a37; color: #fff; }
    .btn-outline-edit {
        background: transparent; color: #fa4101;
        border: 1.5px solid #fa4101;
    }
    .btn-outline-edit:hover { background: #fa4101; color: #fff; }
    .btn-outline-del {
        background: transparent; color: #dc3545;
        border: 1.5px solid #dc3545;
    }
    .btn-outline-del:hover { background: #dc3545; color: #fff; }

    .empty-orc {
        text-align: center; padding: 20px 0;
        font-size: 0.83rem; color: #bbb;
    }
    .empty-orc i { font-size: 32px; display: block; margin-bottom: 8px; color: #e0e0e0; }

    @media(max-width: 900px) {
        .show-grid { grid-template-columns: 1fr; }
    }
    @media(max-width: 576px) {
        .dash { padding: 16px; }
        .card-body-pad { padding: 18px 16px; }
        .meta-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title">
            <i class="fa-solid fa-clipboard-check"></i>
            Detalhes da Solicitação
        </h4>
        <a href="{{ route('solicitacoes.index') }}" class="btn-outline-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="show-grid">

        {{-- ══════════════════════════════════════
             COLUNA PRINCIPAL
        ══════════════════════════════════════ --}}
        <div class="info-card">
            <div class="card-header-bar bar-{{ $solicitacao->status ?? 'cancelada' }}"></div>

            <div class="card-body-pad">

                {{-- Título + status --}}
                <div class="d-flex align-items-flex-start justify-content-between gap-3 flex-wrap">
                    <div>
                        <div class="solic-titulo-big">{{ $solicitacao->titulo }}</div>
                        <div class="solic-id-small">#{{ $solicitacao->id }}</div>
                    </div>
                    <span class="tag tag-{{ $solicitacao->status ?? 'cancelada' }}">
                        {{ ucfirst(str_replace('_', ' ', $solicitacao->status)) }}
                    </span>
                </div>

                {{-- Meta dados --}}
                <div class="meta-grid">
                    <div class="meta-item">
                        <span class="meta-label">Categoria</span>
                        <span class="meta-value">
                            <i class="fa-solid fa-tag"></i>
                            {{ $solicitacao->categoria ?? '—' }}
                        </span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Cliente</span>
                        <span class="meta-value">
                            <i class="fa-solid fa-person"></i>
                            {{ $solicitacao->usuario?->nome ?? '—' }}
                        </span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Criado em</span>
                        <span class="meta-value">
                            <i class="fa-solid fa-calendar-plus"></i>
                            {{ $solicitacao->created_at?->format('d/m/Y') ?? '—' }}
                        </span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Disponibilidade</span>
                        <span class="meta-value">
                            <i class="fa-solid fa-calendar-check"></i>
                            {{ $solicitacao->disponibilidade
                                ? \Carbon\Carbon::parse($solicitacao->disponibilidade)->format('d/m/Y')
                                : 'Não informada' }}
                        </span>
                    </div>
                    @if($solicitacao->prestador)
                    <div class="meta-item">
                        <span class="meta-label">Prestador</span>
                        <span class="meta-value">
                            <i class="fa-solid fa-person-gear"></i>
                            {{ $solicitacao->prestador->nome }}
                        </span>
                    </div>
                    @endif
                </div>

                {{-- Descrição --}}
                <div class="meta-label mb-2">Descrição</div>
                <div class="desc-block">{{ $solicitacao->descricao ?? 'Nenhuma descrição informada.' }}</div>

                {{-- Foto --}}
                @if($solicitacao->foto)
                <div class="foto-block">
                    <img src="{{ asset('storage/'.$solicitacao->foto) }}" alt="Foto da solicitação">
                </div>
                @endif

            </div>
        </div>

        {{-- ══════════════════════════════════════
             COLUNA LATERAL
        ══════════════════════════════════════ --}}
        <div>

            {{-- Card de orçamento --}}
            <div class="side-card">
                <div class="side-title">
                    <i class="fa-solid fa-receipt"></i> Orçamento
                </div>

                @if($solicitacao->orcamento)
                    @php $orc = $solicitacao->orcamento; @endphp

                    <div class="orc-row">
                        <span class="orc-label">Mão de obra</span>
                        <span class="orc-value">R$ {{ number_format($orc->mao_de_obra, 2, ',', '.') }}</span>
                    </div>
                    <div class="orc-row">
                        <span class="orc-label">Valor total</span>
                        <span class="orc-value total">R$ {{ number_format($orc->valor_total, 2, ',', '.') }}</span>
                    </div>
                    <div class="orc-row">
                        <span class="orc-label">Prazo estimado</span>
                        <span class="orc-value">{{ $orc->prazo }} dia{{ $orc->prazo > 1 ? 's' : '' }}</span>
                    </div>

                    <span class="orc-status-badge orc-{{ $orc->status }}">
                        @if($orc->status === 'aceito') <i class="fa-solid fa-check"></i>
                        @elseif($orc->status === 'recusado') <i class="fa-solid fa-xmark"></i>
                        @else <i class="fa-solid fa-clock"></i>
                        @endif
                        {{ ucfirst($orc->status) }}
                    </span>

                    @if($orc->observacoes)
                        <div class="orc-obs">{{ $orc->observacoes }}</div>
                    @endif

                    {{-- Aceitar / Recusar (cliente, orçamento pendente) --}}
                    @if(Auth::id() === $solicitacao->usuario_id && $orc->status === 'pendente')
                        <div class="d-flex gap-2 mt-3">
                            <form action="{{ route('orcamentos.aceitar', $orc) }}" method="POST" style="flex:1">
                                @csrf
                                <button type="submit" class="btn-action btn-success-fill">
                                    <i class="fa-solid fa-check"></i> Aceitar
                                </button>
                            </form>
                            <form action="{{ route('orcamentos.recusar', $orc) }}" method="POST" style="flex:1">
                                @csrf
                                <button type="submit" class="btn-action btn-danger-fill">
                                    <i class="fa-solid fa-xmark"></i> Recusar
                                </button>
                            </form>
                        </div>
                    @endif

                    {{-- Agendar (cliente, orçamento aceito) --}}
                    @if(Auth::id() === $solicitacao->usuario_id && $orc->status === 'aceito')
                        @php $servDefault = $orc->usuario?->servicos()->where('status', 'ativo')->first(); @endphp
                        <a href="{{ route('agendamentos.create', [
                                'orcamento_id' => $orc->id,
                                'servico_id'   => $servDefault?->id,
                            ]) }}" class="btn-action btn-primary-fill mt-3">
                            <i class="fa-solid fa-calendar-plus"></i> Agendar Serviço
                        </a>
                    @endif

                @else
                    <div class="empty-orc">
                        <i class="fa-regular fa-file-lines"></i>
                        Sem orçamento ainda.
                    </div>
                    @if(Auth::user()->isPrestador() || Auth::user()->isAdm())
                        <a href="{{ route('orcamentos.create', ['solicitacao_id' => $solicitacao->id]) }}"
                           class="btn-action btn-primary-fill mt-2">
                            <i class="fa-solid fa-receipt"></i> Enviar Orçamento
                        </a>
                    @endif
                @endif
            </div>

            {{-- Card de ações (editar/excluir) --}}
            @if(Auth::user()->isAdm() || $solicitacao->usuario_id === Auth::id())
            <div class="side-card">
                <div class="side-title">
                    <i class="fa-solid fa-sliders"></i> Ações
                </div>
                <a href="{{ route('solicitacoes.edit', $solicitacao) }}" class="btn-action btn-outline-edit">
                    <i class="fa-solid fa-pencil"></i> Editar Solicitação
                </a>
                <form action="{{ route('solicitacoes.destroy', $solicitacao) }}" method="POST"
                    onsubmit="return confirm('Excluir esta solicitação?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-action btn-outline-del">
                        <i class="fa-solid fa-trash"></i> Excluir Solicitação
                    </button>
                </form>
            </div>
            @endif

        </div>
    </div>

</div>
@endsection