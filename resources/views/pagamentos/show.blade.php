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
    .page-title i { color: #fa4101; }

    .btn-outline-back {
        border: 1.5px solid #ddd; background: transparent; color: #555;
        border-radius: 9px; padding: 8px 16px;
        font-size: 0.82rem; font-weight: 700; text-decoration: none;
        display: inline-flex; align-items: center; gap: 6px;
        transition: border-color 0.2s, color 0.2s; font-family: 'Sora', sans-serif;
    }
    .btn-outline-back:hover { border-color: #fa4101; color: #fa4101; }

    /* ── CARD PRINCIPAL ── */
    .show-card {
        background: #fff; border: 1.5px solid #ececec;
        border-radius: 16px; overflow: hidden;
        margin-bottom: 20px;
    }

    /* banner colorido no topo */
    .status-banner { height: 5px; width: 100%; }
    .banner-pendente  { background: #ffc107; }
    .banner-pago      { background: #28a745; }
    .banner-cancelado { background: #adb5bd; }
    .banner-estornado { background: #dc3545; }

    .show-card-header {
        padding: 20px 28px; border-bottom: 1.5px solid #f0f0f0;
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
    }
    .show-card-header-left { display: flex; align-items: center; gap: 10px; }
    .show-card-header i { color: #fa4101; }
    .show-card-header .card-title {
        font-size: 0.82rem; font-weight: 800; color: #111;
        text-transform: uppercase; letter-spacing: .4px;
    }
    .show-card-header .card-sub {
        font-size: 0.75rem; color: #aaa; margin-top: 1px; font-weight: 500;
    }

    .tag {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.68rem; font-weight: 700;
        padding: 4px 11px; border-radius: 20px; white-space: nowrap;
    }
    .tag::before { content:''; width:5px; height:5px; border-radius:50%; background:currentColor; opacity:.5; }
    .tag-pendente  { background: #fdf6e3; color: #8a6000; }
    .tag-pago      { background: #e8f6ef; color: #145c37; }
    .tag-cancelado { background: #f0f0f0; color: #888; }
    .tag-estornado { background: #fff1ec; color: #c73200; }

    .show-card-body { padding: 28px; }

    /* ── SECTION DIVIDER ── */
    .section-divider {
        font-size: 0.7rem; font-weight: 800; color: #ccc;
        text-transform: uppercase; letter-spacing: 1px;
        margin-bottom: 16px; margin-top: 6px;
        display: flex; align-items: center; gap: 10px;
    }
    .section-divider::after { content: ''; flex: 1; height: 1px; background: #f0f0f0; }

    /* ── CAMPOS INFO ── */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 8px;
    }
    .info-item {}
    .info-label {
        font-size: 0.7rem; font-weight: 700; color: #bbb;
        text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 4px;
    }
    .info-value {
        font-size: 0.88rem; font-weight: 600; color: #222; line-height: 1.4;
    }
    .info-value.muted { color: #888; font-weight: 500; }

    /* ── VALOR DESTAQUE ── */
    .valor-card {
        background: #fff8f5; border: 1.5px solid #fdd0bc;
        border-radius: 12px; padding: 16px 20px;
        display: inline-flex; flex-direction: column; gap: 2px;
        min-width: 180px;
    }
    .valor-label { font-size: 0.7rem; font-weight: 700; color: #fa4101; text-transform: uppercase; letter-spacing: 0.8px; }
    .valor-num   { font-size: 1.6rem; font-weight: 900; color: #fa4101; letter-spacing: -1px; line-height: 1; }

    /* ── METODO BADGE ── */
    .metodo-badge {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.78rem; font-weight: 700;
        padding: 6px 14px; border-radius: 8px;
        background: #f5f5f5; color: #555;
        text-transform: uppercase; letter-spacing: 0.4px;
    }
    .metodo-badge i { font-size: 13px; }

    /* ── CARD DE AGENDAMENTO ── */
    .agend-box {
        background: #fafafa; border: 1.5px solid #f0f0f0;
        border-radius: 12px; padding: 18px 20px;
        display: flex; gap: 16px; align-items: flex-start;
    }
    .agend-box-icon {
        width: 40px; height: 40px; border-radius: 10px;
        background: #fff0eb; display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .agend-box-icon i { color: #fa4101; font-size: 16px; }
    .agend-box-body { flex: 1; }
    .agend-box-title { font-size: 0.9rem; font-weight: 800; color: #111; margin-bottom: 6px; }
    .agend-box-meta  { display: flex; flex-wrap: wrap; gap: 14px; }
    .agend-meta-item { font-size: 0.76rem; color: #888; display: flex; align-items: center; gap: 5px; }
    .agend-meta-item i { font-size: 11px; color: #ccc; }
    .agend-meta-item strong { color: #555; font-weight: 600; }

    /* ── FOOTER AÇÕES ── */
    .show-card-footer {
        padding: 18px 28px; border-top: 1.5px solid #f0f0f0;
        display: flex; align-items: center; gap: 10px;
    }
    .btn-edit {
        background: #fa4101; color: #fff; border: none;
        border-radius: 9px; padding: 9px 20px;
        font-size: 0.82rem; font-weight: 700;
        display: inline-flex; align-items: center; gap: 7px;
        cursor: pointer; transition: background .2s;
        text-decoration: none; font-family: 'Sora', sans-serif;
    }
    .btn-edit:hover { background: #c73200; color: #fff; }

    .btn-delete {
        background: transparent; color: #dc3545;
        border: 1.5px solid #f5c6cb; border-radius: 9px; padding: 8px 18px;
        font-size: 0.82rem; font-weight: 700;
        display: inline-flex; align-items: center; gap: 7px;
        cursor: pointer; transition: all .2s; font-family: 'Sora', sans-serif;
    }
    .btn-delete:hover { background: #dc3545; color: #fff; border-color: #dc3545; }

    @media(max-width:576px) {
        .dash { padding: 16px; }
        .show-card-body { padding: 18px 16px; }
        .info-grid { grid-template-columns: 1fr 1fr; }
        .agend-box { flex-direction: column; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title">
            <i class="fa-solid fa-credit-card"></i> Pagamento #{{ $pagamento->id }}
        </h4>
        <a href="{{ route('pagamentos.index') }}" class="btn-outline-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="show-card">

        <div class="status-banner banner-{{ $pagamento->status }}"></div>

        <div class="show-card-header">
            <div class="show-card-header-left">
                <i class="fa-solid fa-receipt"></i>
                <div>
                    <div class="card-title">{{ $pagamento->agendamento->servico->titulo }}</div>
                    <div class="card-sub">Agendamento #{{ $pagamento->agendamento_id }}</div>
                </div>
            </div>
            <span class="tag tag-{{ $pagamento->status }}">{{ ucfirst($pagamento->status) }}</span>
        </div>

        <div class="show-card-body">

            {{-- ── AGENDAMENTO VINCULADO ── --}}
            <div class="section-divider">Agendamento Vinculado</div>
            <div class="agend-box" style="margin-bottom: 24px;">
                <div class="agend-box-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div class="agend-box-body">
                    <div class="agend-box-title">{{ $pagamento->agendamento->servico->titulo }}</div>
                    <div class="agend-box-meta">
                        <div class="agend-meta-item">
                            <i class="fa-solid fa-user"></i>
                            <span>Cliente: <strong>{{ $pagamento->agendamento->cliente->nome }}</strong></span>
                        </div>
                        <div class="agend-meta-item">
                            <i class="fa-solid fa-briefcase"></i>
                            <span>Prestador: <strong>{{ $pagamento->agendamento->servico->usuario->nome }}</strong></span>
                        </div>
                        @if($pagamento->agendamento->data)
                        <div class="agend-meta-item">
                            <i class="fa-solid fa-clock"></i>
                            <span>
                                {{ \Carbon\Carbon::parse($pagamento->agendamento->data)->format('d/m/Y') }}
                                @if($pagamento->agendamento->horario)
                                    às {{ $pagamento->agendamento->horario }}
                                @endif
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ── DADOS DO PAGAMENTO ── --}}
            <div class="section-divider">Dados do Pagamento</div>

            <div style="display:flex; gap: 20px; flex-wrap:wrap; align-items:flex-start;">

                <div class="valor-card">
                    <span class="valor-label">Valor pago</span>
                    <span class="valor-num">R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</span>
                </div>

                <div class="info-grid" style="flex:1; min-width:240px;">
                    <div class="info-item">
                        <div class="info-label">Método</div>
                        <div class="info-value">
                            @php
                                $metodoIcon = match(true) {
                                    str_contains($pagamento->metodo, 'pix')     => 'fa-brands fa-pix',
                                    str_contains($pagamento->metodo, 'cartao')  => 'fa-solid fa-credit-card',
                                    str_contains($pagamento->metodo, 'dinheiro')=> 'fa-solid fa-money-bill',
                                    str_contains($pagamento->metodo, 'boleto')  => 'fa-solid fa-barcode',
                                    default                                     => 'fa-solid fa-exchange-alt',
                                };
                            @endphp
                            <span class="metodo-badge">
                                <i class="{{ $metodoIcon }}"></i>
                                {{ ucfirst(str_replace('_', ' ', $pagamento->metodo)) }}
                            </span>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Data do Pagamento</div>
                        <div class="info-value {{ $pagamento->data_pagamento ? '' : 'muted' }}">
                            @if($pagamento->data_pagamento)
                                <i class="fa-solid fa-calendar-check" style="color:#fa4101; margin-right:5px; font-size:12px;"></i>
                                {{ \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') }}
                            @else
                                Não informada
                            @endif
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Registrado em</div>
                        <div class="info-value muted">
                            {{ \Carbon\Carbon::parse($pagamento->created_at)->format('d/m/Y \à\s H:i') }}
                        </div>
                    </div>

                    @if($pagamento->updated_at != $pagamento->created_at)
                    <div class="info-item">
                        <div class="info-label">Última atualização</div>
                        <div class="info-value muted">
                            {{ \Carbon\Carbon::parse($pagamento->updated_at)->format('d/m/Y \à\s H:i') }}
                        </div>
                    </div>
                    @endif
                </div>

            </div>

        </div>

        {{-- ── AÇÕES ── --}}
        @if(Auth::user()->isAdm() || Auth::user()->isPrestador())
        <div class="show-card-footer">
            <a href="{{ route('pagamentos.edit', $pagamento) }}" class="btn-edit">
                <i class="fa-solid fa-pencil"></i> Editar
            </a>
            @if(Auth::user()->isAdm())
            <form action="{{ route('pagamentos.destroy', $pagamento) }}" method="POST"
                onsubmit="return confirm('Remover este pagamento permanentemente?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-delete">
                    <i class="fa-solid fa-trash"></i> Excluir
                </button>
            </form>
            @endif
        </div>
        @endif

    </div>

</div>
@endsection