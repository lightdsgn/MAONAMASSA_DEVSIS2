@extends('layouts.app')
@section('content')

<style>
    /* ─── Tokens ─────────────────────────────────────────── */
    :root {
        --brand:        #fa4101;
        --brand-dark:   #c73200;
        --brand-light:  rgba(250,65,1,.08);
        --surface:      #ffffff;
        --surface-2:    #f7f7f8;
        --border:       #ebebeb;
        --text:         #111111;
        --text-2:       #555555;
        --text-3:       #999999;
        --radius-lg:    18px;
        --radius-md:    12px;
        --radius-sm:    8px;
        --shadow-sm:    0 2px 8px rgba(0,0,0,.05);
        --shadow-md:    0 6px 24px rgba(0,0,0,.07);
        --shadow-lg:    0 12px 40px rgba(0,0,0,.10);
        --font:         'Sora', system-ui, sans-serif;
    }

    /* ─── Layout base ────────────────────────────────────── */
    .dash { padding: 36px 32px; font-family: var(--font); background: #f4f4f6; min-height: 100vh; }

    /* ─── Hero ───────────────────────────────────────────── */
    .dash-hero {
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);
        border-radius: var(--radius-lg);
        padding: 32px 36px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }
    .dash-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 90% -10%, rgba(255,255,255,.14) 0%, transparent 55%),
            radial-gradient(circle at 110% 80%, rgba(255,255,255,.07) 0%, transparent 45%);
        pointer-events: none;
    }
    .hero-left { position: relative; z-index: 1; }
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(255,255,255,.18);
        border: 1px solid rgba(255,255,255,.28);
        color: #fff;
        font-size: .68rem;
        font-weight: 700;
        padding: 4px 13px;
        border-radius: 20px;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
    }
    .hero-dot {
        width: 7px; height: 7px;
        background: #fff; border-radius: 50%;
        animation: blink 1.6s ease infinite;
    }
    @keyframes blink { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.4;transform:scale(1.3)} }
    .dash-hero h4 { color: #fff; font-size: 1.6rem; font-weight: 800; margin: 0 0 5px; letter-spacing: -.5px; }
    .dash-hero p  { color: rgba(255,255,255,.75); font-size: .87rem; margin: 0; }
    .hero-right {
        position: relative; z-index: 1;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.2);
        border-radius: var(--radius-md);
        padding: 14px 20px;
        text-align: right;
        flex-shrink: 0;
    }
    .hero-date { color: rgba(255,255,255,.65); font-size: .68rem; font-weight: 600; text-transform: uppercase; letter-spacing: .8px; margin-bottom: 3px; }
    .hero-time { color: #fff; font-size: 1.3rem; font-weight: 800; letter-spacing: -1px; }

    /* ─── Section title ──────────────────────────────────── */
    .section-label {
        font-size: .68rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: 1px;
        color: var(--text-3);
        margin: 0 0 14px;
        display: flex; align-items: center; gap: 8px;
    }
    .section-label::after { content:''; flex: 1; height: 1px; background: var(--border); }

    /* ─── Stat grid ──────────────────────────────────────── */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 14px;
        margin-bottom: 28px;
    }

    /* FIX 1 & 2: layout em coluna, padding generoso, sem corte de texto */
    .stat-card {
        background: var(--surface);
        border-radius: var(--radius-md);
        padding: 20px 20px 18px;          /* padding lateral aumentado */
        border: 1.5px solid var(--border);
        display: flex;
        flex-direction: column;           /* ícone acima, texto abaixo */
        align-items: flex-start;
        gap: 12px;
        min-height: 110px;                /* altura mínima para respirar */
        transition: transform .2s, box-shadow .2s;
        animation: fadeUp .4s ease both;
        position: relative;
        overflow: hidden;
    }
    .stat-card::after {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 3px;
        background: var(--accent-color, var(--brand));
        border-radius: 4px 0 0 4px;
        opacity: 0;
        transition: opacity .2s;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
    .stat-card:hover::after { opacity: 1; }

    .stat-icon {
        width: 42px; height: 42px;
        border-radius: var(--radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 17px; flex-shrink: 0;
    }
    .stat-icon.orange { background: rgba(250,65,1,.1);    color: #fa4101; }
    .stat-icon.blue   { background: rgba(13,110,253,.1);  color: #0d6efd; }
    .stat-icon.green  { background: rgba(25,135,84,.1);   color: #198754; }
    .stat-icon.yellow { background: rgba(255,193,7,.14);  color: #e6a800; }

    .stat-card.orange { --accent-color:#fa4101; }
    .stat-card.blue   { --accent-color:#0d6efd; }
    .stat-card.green  { --accent-color:#198754; }
    .stat-card.yellow { --accent-color:#e6a800; }

    /* FIX 1: valor e label no mesmo bloco, sem quebra forçada */
    .stat-body { display: flex; flex-direction: column; gap: 3px; }
    .stat-num   { font-size: 1.5rem; font-weight: 900; color: var(--text); line-height: 1; letter-spacing: -1px; white-space: nowrap; }
    .stat-label { font-size: .7rem; font-weight: 600; color: var(--text-3); text-transform: uppercase; letter-spacing: .5px; white-space: nowrap; }

    /* ─── Chart grid ─────────────────────────────────────── */
    .chart-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 18px; margin-bottom: 28px; }

    /* FIX 3: 70% gráfico / 30% texto */
    .chart-grid-bottom { display: grid; grid-template-columns: 7fr 3fr; gap: 18px; margin-bottom: 28px; }

    @media(max-width:991px) { .chart-grid,.chart-grid-bottom { grid-template-columns:1fr; } }

    .chart-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1.5px solid var(--border);
        padding: 22px;
        min-height: 360px;
    }

    /* ─── Cards grid ─────────────────────────────────────── */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 18px;
        margin-bottom: 28px;
    }
    .dash-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1.5px solid var(--border);
        overflow: hidden;
        animation: fadeUp .4s ease both;
        transition: box-shadow .2s;
    }
    .dash-card:hover { box-shadow: var(--shadow-md); }

    .dash-card-head {
        padding: 15px 20px;
        border-bottom: 1.5px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
        background: var(--surface-2);
    }
    .dash-card-head h6 {
        font-size: .78rem; font-weight: 800; color: var(--text);
        margin: 0; display: flex; align-items: center; gap: 8px;
        text-transform: uppercase; letter-spacing: .4px;
    }
    .dash-card-head h6 i { color: var(--brand); }
    .dash-card-footer { padding: 13px 20px; border-top: 1.5px solid var(--border); background: var(--surface-2); }

    /* ─── Rows ───────────────────────────────────────────── */
    .dash-row {
        display: flex; align-items: center; justify-content: space-between;
        padding: 11px 20px; gap: 12px;
        transition: background .15s;
    }
    .dash-row:hover { background: var(--surface-2); }
    .dash-row + .dash-row { border-top: 1px solid var(--border); }
    .row-title {
        font-size: .83rem; font-weight: 600; color: var(--text-2);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 170px;
    }
    .dash-empty { padding: 28px; font-size: .82rem; color: var(--text-3); text-align: center; }
    .dash-empty::before { content:'—'; display:block; font-size:1.2rem; margin-bottom:4px; }

    /* ─── Tags ───────────────────────────────────────────── */
    .tag {
        display: inline-block; font-size: .67rem; font-weight: 700;
        padding: 3px 10px; border-radius: 20px; white-space: nowrap; flex-shrink: 0;
    }
    .tag-orange { background: rgba(250,65,1,.1);   color: #c73200; }
    .tag-blue   { background: rgba(13,110,253,.1); color: #0947b3; }
    .tag-green  { background: rgba(25,135,84,.1);  color: #145c37; }
    .tag-yellow { background: rgba(255,193,7,.14); color: #8a6000; }
    .tag-gray   { background: #efefef; color: #666; }

    /* ─── Buttons ────────────────────────────────────────── */
    .btn-dash {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: .75rem; font-weight: 700;
        padding: 5px 12px; border-radius: var(--radius-sm);
        text-decoration: none; transition: all .2s;
        border: 1.5px solid var(--border); color: var(--text-3);
        background: none; cursor: pointer; font-family: var(--font);
    }
    .btn-dash:hover { border-color: var(--brand); color: var(--brand); background: var(--brand-light); }

    .btn-dash-fill {
        background: var(--brand); color: #fff; border: none;
        border-radius: var(--radius-sm); padding: 9px 18px;
        font-size: .8rem; font-weight: 700;
        text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
        transition: background .2s; font-family: var(--font);
    }
    .btn-dash-fill:hover { background: var(--brand-dark); color: #fff; }

    /* ─── Activity items ─────────────────────────────────── */
    .activity-item {
        display: flex; gap: 13px; padding: 13px 20px;
        border-bottom: 1px solid var(--border); align-items: flex-start;
    }
    .activity-item:last-child { border-bottom: none; }
    .activity-icon {
        width: 34px; height: 34px; border-radius: var(--radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; flex-shrink: 0;
    }
    .activity-icon.blue   { background: rgba(13,110,253,.1); color: #0d6efd; }
    .activity-icon.orange { background: rgba(250,65,1,.1);   color: #fa4101; }
    .activity-title { font-size: .82rem; font-weight: 600; color: var(--text-2); margin-bottom: 2px; }
    .activity-sub   { font-size: .72rem; color: var(--text-3); }

    /* ─── Quick actions ──────────────────────────────────── */
    .quick-grid {
        display: grid; grid-template-columns: repeat(2,1fr); gap: 10px;
        padding: 18px;
    }
    .quick-btn {
        background: var(--surface); border: 1.5px solid var(--border); border-radius: var(--radius-md);
        padding: 16px 12px; display: flex; flex-direction: column;
        align-items: center; gap: 8px;
        text-decoration: none; color: var(--text-2);
        transition: all .2s; font-weight: 700; font-size: .75rem;
        text-align: center; line-height: 1.3;
    }
    .quick-btn:hover { border-color: var(--brand); background: var(--brand-light); color: var(--brand); }
    .quick-btn i { font-size: 22px; }

    /* ─── Metric boxes ───────────────────────────────────── */
    .metric-box {
        background: var(--surface-2); border-radius: var(--radius-md);
        padding: 14px 16px; border: 1px solid var(--border); margin-bottom: 10px;
    }
    .metric-label { font-size: .67rem; font-weight: 700; color: var(--text-3); text-transform: uppercase; letter-spacing: .5px; margin-bottom: 5px; }
    .metric-val   { font-size: 1.5rem; font-weight: 900; color: var(--text); line-height: 1; }

    /* ─── Dividers / Spacing cards ───────────────────────── */
    .two-col-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 28px;
    }
    @media(max-width:700px) { .two-col-grid { grid-template-columns: 1fr; } }

    /* ─── Animations ─────────────────────────────────────── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .d1{animation-delay:.05s} .d2{animation-delay:.1s}
    .d3{animation-delay:.15s} .d4{animation-delay:.2s}

    /* ─── Responsive ─────────────────────────────────────── */
    @media(max-width:576px) {
        .dash { padding: 14px; }
        .dash-hero { padding: 22px 20px; flex-direction: column; align-items: flex-start; }
        .hero-right { width: 100%; text-align: left; }
        .dash-hero h4 { font-size: 1.2rem; }
    }
</style>

<div class="dash">

    {{-- ── Hero ── --}}
    <div class="dash-hero">
        <div class="hero-left">
            <span class="hero-badge">
                <span class="hero-dot"></span>
                @if(Auth::user()->isAdm()) Administrador
                @elseif(Auth::user()->isPrestador()) Prestador
                @else Cliente @endif
            </span>
            <h4>Olá, {{ Auth::user()->nome }}!</h4>
            <p>Bem-vindo ao seu painel. Aqui está um resumo da sua conta.</p>
        </div>
        <div class="hero-right">
            <div class="hero-date">Hoje</div>
            <div class="hero-time" id="dash-clock">--:--</div>
        </div>
    </div>

    {{-- ════════════════════════════════════
         ADMINISTRADOR
    ════════════════════════════════════ --}}
    @if(Auth::user()->isAdm())

        <p class="section-label">Visão geral</p>

        <div class="stat-grid">
            <div class="stat-card orange d1">
                <div class="stat-icon orange"><i class="bi bi-people-fill"></i></div>
                <div class="stat-body"><div class="stat-num">{{ $usuarios }}</div><div class="stat-label">Usuários</div></div>
            </div>
            <div class="stat-card blue d1">
                <div class="stat-icon blue"><i class="bi bi-tools"></i></div>
                <div class="stat-body"><div class="stat-num">{{ $servicos }}</div><div class="stat-label">Serviços</div></div>
            </div>
            <div class="stat-card green d2">
                <div class="stat-icon green"><i class="bi bi-cash-stack"></i></div>
                <div class="stat-body"><div class="stat-num">R$ {{ number_format($faturamentoTotal,0,',','.') }}</div><div class="stat-label">Faturamento</div></div>
            </div>
            <div class="stat-card yellow d2">
                <div class="stat-icon yellow"><i class="bi bi-receipt"></i></div>
                <div class="stat-body"><div class="stat-num">R$ {{ number_format($ticketMedio,0,',','.') }}</div><div class="stat-label">Ticket Médio</div></div>
            </div>
            <div class="stat-card orange d3">
                <div class="stat-icon orange"><i class="bi bi-calendar-check"></i></div>
                <div class="stat-body"><div class="stat-num">{{ $agendamentos }}</div><div class="stat-label">Agendamentos</div></div>
            </div>
            <div class="stat-card blue d3">
                <div class="stat-icon blue"><i class="bi bi-clipboard-check"></i></div>
                <div class="stat-body"><div class="stat-num">{{ $solicitacoes }}</div><div class="stat-label">Solicitações</div></div>
            </div>
            <div class="stat-card green d4">
                <div class="stat-icon green"><i class="bi bi-graph-up-arrow"></i></div>
                <div class="stat-body"><div class="stat-num">{{ $taxaConversao }}%</div><div class="stat-label">Conversão</div></div>
            </div>
            <div class="stat-card yellow d4">
                <div class="stat-icon yellow"><i class="bi bi-wallet2"></i></div>
                <div class="stat-body"><div class="stat-num">R$ {{ number_format($faturamentoMes,0,',','.') }}</div><div class="stat-label">Mês Atual</div></div>
            </div>
        </div>

        <p class="section-label">Gráficos</p>

        <div class="chart-grid">
            <div class="chart-card">{!! $faturamentoChart->container() !!}</div>
            <div class="chart-card">{!! $statusChart->container() !!}</div>
        </div>

        <div class="chart-grid-bottom">
            <div class="chart-card">{!! $usuariosChart->container() !!}</div>
            <div class="chart-card">
                <h5 style="font-weight:800;margin-bottom:18px;font-size:.95rem;text-transform:uppercase;letter-spacing:.4px;">
                    Distribuição de Usuários
                </h5>
                <div class="metric-box">
                    <div class="metric-label">Clientes</div>
                    <div class="metric-val">{{ $clientes }}</div>
                </div>
                <div class="metric-box">
                    <div class="metric-label">Prestadores</div>
                    <div class="metric-val">{{ $prestadores }}</div>
                </div>
                <div class="metric-box">
                    <div class="metric-label">Administradores</div>
                    <div class="metric-val">{{ $administradores }}</div>
                </div>
            </div>
        </div>

        <p class="section-label">Atividade recente</p>

        <div class="cards-grid">
            <div class="dash-card d1">
                <div class="dash-card-head">
                    <h6><i class="bi bi-people"></i> Últimos Usuários</h6>
                    <a href="{{ route('usuarios.index') }}" class="btn-dash">Ver todos</a>
                </div>
                @forelse(\App\Models\Usuario::latest()->take(4)->get() as $u)
                    <div class="dash-row">
                        <span class="row-title">{{ $u->nome }}</span>
                        <span class="tag {{ $u->tipo==='adm' ? 'tag-orange' : ($u->tipo==='prestador' ? 'tag-blue' : 'tag-gray') }}">
                            {{ strtoupper($u->tipo) }}
                        </span>
                    </div>
                @empty
                    <div class="dash-empty">Nenhum usuário.</div>
                @endforelse
            </div>

            <div class="dash-card d2">
                <div class="dash-card-head">
                    <h6><i class="bi bi-clipboard-check"></i> Solicitações Recentes</h6>
                    <a href="{{ route('solicitacoes.index') }}" class="btn-dash">Ver todas</a>
                </div>
                @forelse(\App\Models\Solicitacao::latest()->take(4)->get() as $s)
                    <div class="dash-row">
                        <span class="row-title">{{ Str::limit($s->titulo,28) }}</span>
                        <span class="tag tag-blue">{{ str_replace('_',' ',$s->status) }}</span>
                    </div>
                @empty
                    <div class="dash-empty">Nenhuma solicitação.</div>
                @endforelse
            </div>

            <div class="dash-card d3">
                <div class="dash-card-head">
                    <h6><i class="bi bi-calendar-check"></i> Agendamentos Recentes</h6>
                    <a href="{{ route('agendamentos.index') }}" class="btn-dash">Ver todos</a>
                </div>
                @forelse(\App\Models\Agendamento::with('cliente')->latest()->take(4)->get() as $ag)
                    <div class="dash-row">
                        <span class="row-title">{{ $ag->cliente->nome ?? '—' }}</span>
                        <span class="tag tag-yellow">{{ \Carbon\Carbon::parse($ag->data)->format('d/m/y') }}</span>
                    </div>
                @empty
                    <div class="dash-empty">Nenhum agendamento.</div>
                @endforelse
            </div>
        </div>

        <p class="section-label">Financeiro &amp; Avaliações</p>

        <div class="two-col-grid">
            <div class="dash-card d2">
                <div class="dash-card-head">
                    <h6><i class="bi bi-credit-card"></i> Pagamentos</h6>
                    <a href="{{ route('pagamentos.index') }}" class="btn-dash">Ver mais</a>
                </div>
                <div style="padding:18px;">
                    <div class="metric-box"><div class="metric-label">Realizados</div><div class="metric-val">{{ $pagos }}</div></div>
                    <div class="metric-box"><div class="metric-label">Pendentes</div><div class="metric-val" style="color:var(--brand);">{{ $pendentes }}</div></div>
                </div>
            </div>

            <div class="dash-card d3">
                <div class="dash-card-head">
                    <h6><i class="bi bi-star-fill"></i> Top Avaliados</h6>
                    <a href="{{ route('avaliacoes.index') }}" class="btn-dash">Ver todas</a>
                </div>
                @forelse($avaliacoes as $av)
                    <div class="activity-item">
                        <div class="activity-icon blue"><i class="bi bi-star-fill"></i></div>
                        <div>
                            <div class="activity-title">{{ $av->servico->usuario->nome ?? 'Prestador' }}</div>
                            <div class="activity-sub" style="color:#ffc107;">
                                {{ str_repeat('★',$av->nota) }}
                                <span style="color:var(--text-3);">{{ $av->nota }}.0</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="dash-empty">Nenhuma avaliação.</div>
                @endforelse
            </div>
        </div>

    {{-- ════════════════════════════════════
         PRESTADOR
    ════════════════════════════════════ --}}
    @elseif(Auth::user()->isPrestador())
        @php
            $totalServs  = Auth::user()->servicos()->count();
            $solsAbertas = \App\Models\Solicitacao::where('status','aberta')->count();
            $mediaAval   = \App\Models\Avaliacao::whereHas('servico', fn($q) => $q->where('usuario_id', Auth::id()))->avg('nota');
        @endphp

        <p class="section-label">Meu painel</p>

        <div class="stat-grid">
            <div class="stat-card blue d1">
                <div class="stat-icon blue"><i class="bi bi-tools"></i></div>
                <div class="stat-body"><div class="stat-num">{{ $totalServs }}</div><div class="stat-label">Meus Serviços</div></div>
            </div>
            <div class="stat-card orange d2">
                <div class="stat-icon orange"><i class="bi bi-clipboard"></i></div>
                <div class="stat-body"><div class="stat-num">{{ $solsAbertas }}</div><div class="stat-label">Solicitações Abertas</div></div>
            </div>
            <div class="stat-card yellow d3">
                <div class="stat-icon yellow"><i class="bi bi-star-fill"></i></div>
                <div class="stat-body"><div class="stat-num">{{ $mediaAval ? round($mediaAval,1) : '—' }}</div><div class="stat-label">Minha Avaliação</div></div>
            </div>
        </div>

        <p class="section-label">Atividade</p>

        <div class="cards-grid">
            <div class="dash-card d1">
                <div class="dash-card-head">
                    <h6><i class="bi bi-tools"></i> Meus Serviços</h6>
                    <a href="{{ route('servicos.index') }}" class="btn-dash">Ver todos</a>
                </div>
                @forelse(Auth::user()->servicos()->latest()->take(4)->get() as $sv)
                    <div class="dash-row">
                        <span class="row-title">{{ Str::limit($sv->titulo,28) }}</span>
                        <span class="tag tag-blue">R$ {{ number_format($sv->preco_estimado ?? 0, 2, ',', '.') }}</span>
                    </div>
                @empty
                    <div class="dash-empty">Nenhum serviço cadastrado.</div>
                @endforelse
                <div class="dash-card-footer">
                    <a href="{{ route('servicos.create') }}" class="btn-dash-fill"><i class="bi bi-plus-lg"></i> Novo Serviço</a>
                </div>
            </div>

            <div class="dash-card d2">
                <div class="dash-card-head">
                    <h6><i class="bi bi-clipboard-check"></i> Solicitações Abertas</h6>
                    <a href="{{ route('solicitacoes.index') }}" class="btn-dash">Ver todas</a>
                </div>
                @forelse(\App\Models\Solicitacao::where('status','aberta')->latest()->take(4)->get() as $s)
                    <div class="dash-row">
                        <span class="row-title">{{ Str::limit($s->titulo,28) }}</span>
                        <span class="tag tag-orange">Aberta</span>
                    </div>
                @empty
                    <div class="dash-empty">Nenhuma solicitação aberta.</div>
                @endforelse
            </div>

            <div class="dash-card d3">
                <div class="dash-card-head">
                    <h6><i class="bi bi-calendar-check"></i> Agendamentos</h6>
                    <a href="{{ route('agendamentos.index') }}" class="btn-dash">Ver todos</a>
                </div>
                @forelse(Auth::user()->agendamentosComoPrestador()->with('cliente')->latest()->take(4)->get() as $ag)
                    <div class="dash-row">
                        <span class="row-title">{{ $ag->cliente->nome ?? '—' }}</span>
                        <span class="tag tag-yellow">{{ \Carbon\Carbon::parse($ag->data)->format('d/m') }}</span>
                    </div>
                @empty
                    <div class="dash-empty">Nenhum agendamento.</div>
                @endforelse
            </div>
        </div>

    {{-- ════════════════════════════════════
         CLIENTE
    ════════════════════════════════════ --}}
    @else
        @php
            $totalSols = Auth::user()->solicitacoes()->count();
            $totalAgs  = Auth::user()->agendamentosComoCliente()->count();
        @endphp

        <p class="section-label">Meu painel</p>

        <div class="stat-grid">
            <div class="stat-card orange d1">
                <div class="stat-icon orange"><i class="bi bi-clipboard-check"></i></div>
                <div class="stat-body"><div class="stat-num">{{ $totalSols }}</div><div class="stat-label">Minhas Solicitações</div></div>
            </div>
            <div class="stat-card green d2">
                <div class="stat-icon green"><i class="bi bi-calendar-check"></i></div>
                <div class="stat-body"><div class="stat-num">{{ $totalAgs }}</div><div class="stat-label">Meus Agendamentos</div></div>
            </div>
        </div>

        <p class="section-label">Atividade</p>

        <div class="cards-grid">
            <div class="dash-card d1">
                <div class="dash-card-head">
                    <h6><i class="bi bi-clipboard-check"></i> Minhas Solicitações</h6>
                    <a href="{{ route('solicitacoes.index') }}" class="btn-dash">Ver todas</a>
                </div>
                @forelse(Auth::user()->solicitacoes()->latest()->take(4)->get() as $s)
                    <div class="dash-row">
                        <span class="row-title">{{ Str::limit($s->titulo,28) }}</span>
                        <span class="tag tag-blue">{{ str_replace('_',' ',$s->status) }}</span>
                    </div>
                @empty
                    <div class="dash-empty">Nenhuma solicitação ainda.</div>
                @endforelse
                <div class="dash-card-footer">
                    <a href="{{ route('solicitacoes.create') }}" class="btn-dash-fill"><i class="bi bi-plus-lg"></i> Nova Solicitação</a>
                </div>
            </div>

            <div class="dash-card d2">
                <div class="dash-card-head">
                    <h6><i class="bi bi-calendar-check"></i> Meus Agendamentos</h6>
                    <a href="{{ route('agendamentos.index') }}" class="btn-dash">Ver todos</a>
                </div>
                @forelse(Auth::user()->agendamentosComoCliente()->with('servico')->latest()->take(4)->get() as $ag)
                    <div class="dash-row">
                        <span class="row-title">{{ Str::limit($ag->servico->titulo,25) }}</span>
                        <span class="tag tag-yellow">{{ \Carbon\Carbon::parse($ag->data)->format('d/m') }}</span>
                    </div>
                @empty
                    <div class="dash-empty">Nenhum agendamento ainda.</div>
                @endforelse
            </div>

            <div class="dash-card d3">
                <div class="dash-card-head"><h6><i class="bi bi-lightning"></i> Ações Rápidas</h6></div>
                <div class="quick-grid">
                    <a href="{{ route('solicitacoes.create') }}" class="quick-btn"><i class="bi bi-plus-circle"></i> Nova Solicitação</a>
                    <a href="{{ route('servicos.index') }}" class="quick-btn"><i class="bi bi-search"></i> Buscar Serviços</a>
                    <a href="{{ route('agendamentos.index') }}" class="quick-btn"><i class="bi bi-calendar"></i> Agendamentos</a>
                    <a href="{{ route('avaliacoes.index') }}" class="quick-btn"><i class="bi bi-star"></i> Avaliações</a>
                </div>
            </div>
        </div>

        <p class="section-label">Descobrir</p>

        <div class="two-col-grid">
            <div class="dash-card d1">
                <div class="dash-card-head">
                    <h6><i class="bi bi-heart"></i> Serviços Disponíveis</h6>
                    <a href="{{ route('servicos.index') }}" class="btn-dash">Ver todos</a>
                </div>
                @forelse(\App\Models\Servico::where('status','ativo')->latest()->take(4)->get() as $sv)
                    <div class="activity-item">
                        <div class="activity-icon blue"><i class="bi bi-tools"></i></div>
                        <div>
                            <div class="activity-title">{{ Str::limit($sv->titulo,30) }}</div>
                            <div class="activity-sub" style="color:var(--brand);font-weight:600;">
                                R$ {{ number_format($sv->preco_estimado ?? 0, 2, ',', '.') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="dash-empty">Nenhum serviço disponível.</div>
                @endforelse
            </div>

            <div class="dash-card d2">
                <div class="dash-card-head">
                    <h6><i class="bi bi-wallet2"></i> Últimos Pagamentos</h6>
                    <a href="{{ route('pagamentos.index') }}" class="btn-dash">Ver tudo</a>
                </div>
                @forelse(Auth::user()->pagamentos()->latest()->take(4)->get() as $pag)
                    <div class="dash-row">
                        <span class="row-title">{{ Str::limit($pag->descricao ?? 'Pagamento',25) }}</span>
                        <span class="tag {{ $pag->status==='pago' ? 'tag-green' : 'tag-yellow' }}">
                            R$ {{ number_format($pag->valor,2,',','.') }}
                        </span>
                    </div>
                @empty
                    <div class="dash-empty">Nenhum pagamento realizado.</div>
                @endforelse
            </div>
        </div>
    @endif

</div>

{{-- Charts scripts (adm only) --}}
@if(Auth::user()->isAdm())
<script src="{{ $faturamentoChart->cdn() }}"></script>
{{ $faturamentoChart->script() }}
{{ $statusChart->script() }}
{{ $usuariosChart->script() }}
@endif

{{-- Relógio no hero --}}
<script>
(function(){
    var el = document.getElementById('dash-clock');
    if(!el) return;
    function tick(){
        var d = new Date();
        el.textContent = d.toLocaleTimeString('pt-BR',{hour:'2-digit',minute:'2-digit'});
    }
    tick(); setInterval(tick,1000);
})();
</script>

@endsection