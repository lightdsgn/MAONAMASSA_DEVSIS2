@extends('layouts.app')
@section('content')

<style>
    .dash { padding: 40px 32px; font-family: 'Sora', sans-serif; }

    .dash-hero {
        background: linear-gradient(135deg, #fa4101 0%, #c73200 100%);
        border-radius: 16px;
        padding: 28px 32px;
        margin-bottom: 28px;
        overflow: hidden;
        position: relative;
    }
    .dash-hero::before, .dash-hero::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.06);
    }
    .dash-hero::before { width: 200px; height: 200px; top: -40px; right: -40px; }
    .dash-hero::after  { width: 140px; height: 140px; bottom: -60px; right: 80px; }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.18);
        border: 1px solid rgba(255,255,255,0.25);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .hero-dot {
        width: 7px; height: 7px;
        background: #fff; border-radius: 50%;
        animation: blink 1.6s ease infinite;
    }
    @keyframes blink { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.4;transform:scale(1.3)} }
    .dash-hero h4 { color: #fff; font-size: 1.5rem; font-weight: 800; margin: 0 0 4px; letter-spacing: -0.5px; }
    .dash-hero p  { color: rgba(255,255,255,0.8); font-size: 0.88rem; margin: 0; }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }
    .stat-card {
        background: #fff;
        border-radius: 14px;
        padding: 20px;
        border: 1.5px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: transform 0.2s, box-shadow 0.2s;
        animation: fadeUp 0.4s ease both;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.07); }
    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; flex-shrink: 0;
    }
    .stat-icon.orange { background: rgba(250,65,1,0.1);   color: #fa4101; }
    .stat-icon.blue   { background: rgba(13,110,253,0.1);  color: #0d6efd; }
    .stat-icon.green  { background: rgba(25,135,84,0.1);   color: #198754; }
    .stat-icon.yellow { background: rgba(255,193,7,0.12);  color: #e6a800; }
    .stat-num   { font-size: 1.7rem; font-weight: 900; color: #111; line-height: 1; letter-spacing: -1px; }
    .stat-label { font-size: 0.72rem; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 3px; }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }
    .dash-card {
        background: #fff;
        border-radius: 14px;
        border: 1.5px solid #f0f0f0;
        overflow: hidden;
        animation: fadeUp 0.4s ease both;
        transition: box-shadow 0.2s;
    }
    .dash-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.06); }
    .dash-card-head {
        padding: 16px 20px;
        border-bottom: 1.5px solid #f5f5f5;
        display: flex; align-items: center; justify-content: space-between;
    }
    .dash-card-head h6 {
        font-size: 0.82rem; font-weight: 800; color: #111; margin: 0;
        display: flex; align-items: center; gap: 8px;
        text-transform: uppercase; letter-spacing: 0.4px;
    }
    .dash-card-head h6 i { color: #fa4101; }
    .dash-card-footer { padding: 12px 20px; border-top: 1.5px solid #f5f5f5; }

    .dash-row {
        display: flex; align-items: center; justify-content: space-between;
        padding: 10px 20px; gap: 12px;
        transition: background 0.15s;
    }
    .dash-row:hover { background: #fafafa; }
    .dash-row + .dash-row { border-top: 1px solid #f5f5f5; }
    .row-title {
        font-size: 0.84rem; font-weight: 600; color: #333;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 160px;
    }
    .dash-empty { padding: 20px; font-size: 0.82rem; color: #bbb; text-align: center; }

    .tag {
        display: inline-block; font-size: 0.68rem; font-weight: 700;
        padding: 3px 9px; border-radius: 20px; white-space: nowrap; flex-shrink: 0;
    }
    .tag-orange { background: rgba(250,65,1,0.1);   color: #c73200; }
    .tag-blue   { background: rgba(13,110,253,0.1);  color: #0947b3; }
    .tag-green  { background: rgba(25,135,84,0.1);   color: #145c37; }
    .tag-yellow { background: rgba(255,193,7,0.14);  color: #8a6000; }
    .tag-gray   { background: #f0f0f0; color: #666; }

    .btn-dash {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.78rem; font-weight: 700;
        padding: 6px 13px; border-radius: 8px;
        text-decoration: none; transition: all 0.2s;
        border: 1.5px solid #ddd; color: #555;
        background: none; cursor: pointer; font-family: 'Sora', sans-serif;
    }
    .btn-dash:hover { border-color: #fa4101; color: #fa4101; }
    .btn-dash-fill {
        background: #fa4101; color: #fff; border: none;
        border-radius: 8px; padding: 9px 18px;
        font-size: 0.82rem; font-weight: 700;
        text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
        transition: background 0.2s; font-family: 'Sora', sans-serif;
    }
    .btn-dash-fill:hover { background: #c73200; color: #fff; }

    .activity-item {
        display: flex; gap: 12px; padding: 12px 20px;
        border-bottom: 1px solid #f5f5f5; align-items: flex-start;
    }
    .activity-item:last-child { border-bottom: none; }
    .activity-icon {
        width: 32px; height: 32px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; flex-shrink: 0;
    }
    .activity-icon.blue   { background: rgba(13,110,253,0.1); color: #0d6efd; }
    .activity-icon.orange { background: rgba(250,65,1,0.1);   color: #fa4101; }
    .activity-title { font-size: 0.82rem; font-weight: 600; color: #333; margin-bottom: 2px; }
    .activity-sub   { font-size: 0.72rem; color: #999; }

    .quick-grid {
        display: grid; grid-template-columns: repeat(2,1fr); gap: 10px;
        padding: 20px;
    }
    .quick-btn {
        background: #fff; border: 1.5px solid #f0f0f0; border-radius: 10px;
        padding: 14px; display: flex; flex-direction: column;
        align-items: center; gap: 7px;
        text-decoration: none; color: #666;
        transition: all 0.2s; font-weight: 600; font-size: 0.78rem;
    }
    .quick-btn:hover { border-color: #fa4101; background: #fff8f5; color: #fa4101; }
    .quick-btn i { font-size: 20px; }

    .chart-wrap {
        display: flex; align-items: flex-end; gap: 12px;
        height: 90px; padding: 0 20px 0;
    }
    .bar-col { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 5px; }
    .bar { width: 100%; border-radius: 4px 4px 0 0; min-height: 8px; }
    .bar-lbl { font-size: 0.68rem; font-weight: 600; color: #666; }
    .bar-val { font-size: 0.8rem; font-weight: 700; color: #fa4101; }

    .metric-box {
        background: #fafafa; border-radius: 10px;
        padding: 14px 16px; border: 1px solid #f0f0f0; margin-bottom: 10px;
    }
    .metric-label { font-size: 0.68rem; font-weight: 700; color: #999; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
    .metric-val   { font-size: 1.5rem; font-weight: 900; color: #111; line-height: 1; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .d1 { animation-delay: .05s } .d2 { animation-delay: .1s }
    .d3 { animation-delay: .15s } .d4 { animation-delay: .2s }

    @media (max-width: 576px) {
        .dash { padding: 16px; }
        .dash-hero { padding: 22px 20px; }
        .dash-hero h4 { font-size: 1.2rem; }
    }
</style>

<div class="dash">

    <div class="dash-hero">
        <span class="hero-badge"><span class="hero-dot"></span>
            @if(Auth::user()->isAdm()) Administrador
            @elseif(Auth::user()->isPrestador()) Prestador
            @else Cliente @endif
        </span>
        <h4>Olá, {{ Auth::user()->nome }}!</h4>
        <p>Bem-vindo ao seu painel. Aqui está um resumo da sua conta.</p>
    </div>

    @if(Auth::user()->isAdm())
        @php
            $adms       = \App\Models\Usuario::where('tipo','adm')->count();
            $prestadores= \App\Models\Usuario::where('tipo','prestador')->count();
            $clientes   = \App\Models\Usuario::where('tipo','cliente')->count();
            $total      = $adms + $prestadores + $clientes ?: 1;
            $pagos      = \App\Models\Pagamento::where('status','pago')->count();
            $pendentes  = \App\Models\Pagamento::where('status','pendente')->count();
            $avaliacoes = \App\Models\Avaliacao::with('prestador')->orderByDesc('nota')->latest()->take(4)->get();
        @endphp

        <div class="stat-grid">
            <div class="stat-card d1"><div class="stat-icon orange"><i class="bi bi-people-fill"></i></div><div><div class="stat-num">{{ \App\Models\Usuario::count() }}</div><div class="stat-label">Usuários</div></div></div>
            <div class="stat-card d2"><div class="stat-icon blue"><i class="bi bi-tools"></i></div><div><div class="stat-num">{{ \App\Models\Servico::count() }}</div><div class="stat-label">Serviços</div></div></div>
            <div class="stat-card d3"><div class="stat-icon green"><i class="bi bi-clipboard-check"></i></div><div><div class="stat-num">{{ \App\Models\Solicitacao::count() }}</div><div class="stat-label">Solicitações</div></div></div>
            <div class="stat-card d4"><div class="stat-icon yellow"><i class="bi bi-calendar-check"></i></div><div><div class="stat-num">{{ \App\Models\Agendamento::count() }}</div><div class="stat-label">Agendamentos</div></div></div>
        </div>

        <div class="cards-grid">
            <div class="dash-card d1">
                <div class="dash-card-head"><h6><i class="bi bi-people"></i> Últimos Usuários</h6><a href="{{ route('usuarios.index') }}" class="btn-dash">Ver todos</a></div>
                @forelse(\App\Models\Usuario::latest()->take(4)->get() as $u)
                <div class="dash-row">
                    <span class="row-title">{{ $u->nome }}</span>
                    <span class="tag {{ $u->tipo==='adm' ? 'tag-orange' : ($u->tipo==='prestador' ? 'tag-blue' : 'tag-gray') }}">{{ strtoupper($u->tipo) }}</span>
                </div>
                @empty<div class="dash-empty">Nenhum usuário.</div>@endforelse
            </div>

            <div class="dash-card d2">
                <div class="dash-card-head"><h6><i class="bi bi-clipboard-check"></i> Solicitações Recentes</h6><a href="{{ route('solicitacoes.index') }}" class="btn-dash">Ver todas</a></div>
                @forelse(\App\Models\Solicitacao::latest()->take(4)->get() as $s)
                <div class="dash-row">
                    <span class="row-title">{{ Str::limit($s->titulo,28) }}</span>
                    <span class="tag tag-blue">{{ str_replace('_',' ',$s->status) }}</span>
                </div>
                @empty<div class="dash-empty">Nenhuma solicitação.</div>@endforelse
            </div>

            <div class="dash-card d3">
                <div class="dash-card-head"><h6><i class="bi bi-calendar-check"></i> Agendamentos Recentes</h6><a href="{{ route('agendamentos.index') }}" class="btn-dash">Ver todos</a></div>
                @forelse(\App\Models\Agendamento::with('cliente')->latest()->take(4)->get() as $ag)
                <div class="dash-row">
                    <span class="row-title">{{ $ag->cliente->nome ?? '—' }}</span>
                    <span class="tag tag-yellow">{{ \Carbon\Carbon::parse($ag->data)->format('d/m/y') }}</span>
                </div>
                @empty<div class="dash-empty">Nenhum agendamento.</div>@endforelse
            </div>
        </div>

       

            <div class="dash-card d2">
                <div class="dash-card-head"><h6><i class="bi bi-credit-card"></i> Pagamentos</h6><a href="{{ route('pagamentos.index') }}" class="btn-dash">Ver mais</a></div>
                <div style="padding:20px;">
                    <div class="metric-box"><div class="metric-label">Realizados</div><div class="metric-val">{{ $pagos }}</div></div>
                    <div class="metric-box"><div class="metric-label">Pendentes</div><div class="metric-val" style="color:#fa4101;">{{ $pendentes }}</div></div>
                </div>
            </div>

            <div class="dash-card d3">
                <div class="dash-card-head"><h6><i class="bi bi-star-fill"></i> Top Avaliados</h6><a href="{{ route('avaliacoes.index') }}" class="btn-dash">Ver todas</a></div>
                @forelse($avaliacoes as $av)
                <div class="activity-item">
                    <div class="activity-icon blue"><i class="bi bi-star-fill"></i></div>
                    <div><div class="activity-title">{{ $av->prestador->nome ?? 'Prestador' }}</div>
                    <div class="activity-sub" style="color:#ffc107;">{{ str_repeat('★',$av->nota) }} <span style="color:#666;">{{ $av->nota }}.0</span></div></div>
                </div>
                @empty<div class="dash-empty">Nenhuma avaliação.</div>@endforelse
            </div>
        </div>

    @elseif(Auth::user()->isPrestador())
        @php
            $totalServs     = Auth::user()->servicos()->count();
            $solsAbertas    = \App\Models\Solicitacao::where('status','aberta')->count();
            $mediaAval      = \App\Models\Avaliacao::whereHas('prestador', fn($q) => $q->where('id',Auth::id()))->avg('nota');
        @endphp

        <div class="stat-grid">
            <div class="stat-card d1"><div class="stat-icon blue"><i class="bi bi-tools"></i></div><div><div class="stat-num">{{ $totalServs }}</div><div class="stat-label">Meus Serviços</div></div></div>
            <div class="stat-card d2"><div class="stat-icon orange"><i class="bi bi-clipboard"></i></div><div><div class="stat-num">{{ $solsAbertas }}</div><div class="stat-label">Solicitações Abertas</div></div></div>
            <div class="stat-card d3"><div class="stat-icon yellow"><i class="bi bi-star-fill"></i></div><div><div class="stat-num">{{ $mediaAval ? round($mediaAval,1) : '—' }}</div><div class="stat-label">Minha Avaliação</div></div></div>
        </div>

        <div class="cards-grid">
            <div class="dash-card d1">
                <div class="dash-card-head"><h6><i class="bi bi-tools"></i> Meus Serviços</h6><a href="{{ route('servicos.index') }}" class="btn-dash">Ver todos</a></div>
                @forelse(Auth::user()->servicos()->latest()->take(4)->get() as $sv)
                <div class="dash-row">
                    <span class="row-title">{{ Str::limit($sv->titulo,28) }}</span>
                    <span class="tag tag-blue">R$ {{ number_format($sv->preco,2,',','.') }}</span>
                </div>
                @empty<div class="dash-empty">Nenhum serviço cadastrado.</div>@endforelse
                <div class="dash-card-footer"><a href="{{ route('servicos.create') }}" class="btn-dash-fill"><i class="bi bi-plus-lg"></i> Novo Serviço</a></div>
            </div>

            <div class="dash-card d2">
                <div class="dash-card-head"><h6><i class="bi bi-clipboard-check"></i> Solicitações Abertas</h6><a href="{{ route('solicitacoes.index') }}" class="btn-dash">Ver todas</a></div>
                @forelse(\App\Models\Solicitacao::where('status','aberta')->latest()->take(4)->get() as $s)
                <div class="dash-row">
                    <span class="row-title">{{ Str::limit($s->titulo,28) }}</span>
                    <span class="tag tag-orange">Aberta</span>
                </div>
                @empty<div class="dash-empty">Nenhuma solicitação aberta.</div>@endforelse
            </div>

            <div class="dash-card d3">
                <div class="dash-card-head"><h6><i class="bi bi-calendar-check"></i> Agendamentos</h6><a href="{{ route('agendamentos.index') }}" class="btn-dash">Ver todos</a></div>
                @forelse(Auth::user()->agendamentosComoPrestador()->with('cliente')->latest()->take(4)->get() as $ag)
                <div class="dash-row">
                    <span class="row-title">{{ $ag->cliente->nome ?? '—' }}</span>
                    <span class="tag tag-yellow">{{ \Carbon\Carbon::parse($ag->data)->format('d/m') }}</span>
                </div>
                @empty<div class="dash-empty">Nenhum agendamento.</div>@endforelse
            </div>
        </div>

    @else
        @php
            $totalSols = Auth::user()->solicitacoes()->count();
            $totalAgs  = Auth::user()->agendamentosComoCliente()->count();
        @endphp

        <div class="stat-grid">
            <div class="stat-card d1"><div class="stat-icon orange"><i class="bi bi-clipboard-check"></i></div><div><div class="stat-num">{{ $totalSols }}</div><div class="stat-label">Minhas Solicitações</div></div></div>
            <div class="stat-card d2"><div class="stat-icon green"><i class="bi bi-calendar-check"></i></div><div><div class="stat-num">{{ $totalAgs }}</div><div class="stat-label">Meus Agendamentos</div></div></div>
        </div>

        <div class="cards-grid">
            <div class="dash-card d1">
                <div class="dash-card-head"><h6><i class="bi bi-clipboard-check"></i> Minhas Solicitações</h6><a href="{{ route('solicitacoes.index') }}" class="btn-dash">Ver todas</a></div>
                @forelse(Auth::user()->solicitacoes()->latest()->take(4)->get() as $s)
                <div class="dash-row">
                    <span class="row-title">{{ Str::limit($s->titulo,28) }}</span>
                    <span class="tag tag-blue">{{ str_replace('_',' ',$s->status) }}</span>
                </div>
                @empty<div class="dash-empty">Nenhuma solicitação ainda.</div>@endforelse
                <div class="dash-card-footer"><a href="{{ route('solicitacoes.create') }}" class="btn-dash-fill"><i class="bi bi-plus-lg"></i> Nova Solicitação</a></div>
            </div>

            <div class="dash-card d2">
                <div class="dash-card-head"><h6><i class="bi bi-calendar-check"></i> Meus Agendamentos</h6><a href="{{ route('agendamentos.index') }}" class="btn-dash">Ver todos</a></div>
                @forelse(Auth::user()->agendamentosComoCliente()->with('servico')->latest()->take(4)->get() as $ag)
                <div class="dash-row">
                    <span class="row-title">{{ Str::limit($ag->servico->titulo,25) }}</span>
                    <span class="tag tag-yellow">{{ \Carbon\Carbon::parse($ag->data)->format('d/m') }}</span>
                </div>
                @empty<div class="dash-empty">Nenhum agendamento ainda.</div>@endforelse
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

        <div class="cards-grid">
            <div class="dash-card d1">
                <div class="dash-card-head"><h6><i class="bi bi-heart"></i> Serviços Disponíveis</h6><a href="{{ route('servicos.index') }}" class="btn-dash">Ver todos</a></div>
                @forelse(\App\Models\Servico::where('status','ativo')->latest()->take(4)->get() as $sv)
                <div class="activity-item">
                    <div class="activity-icon blue"><i class="bi bi-tools"></i></div>
                    <div><div class="activity-title">{{ Str::limit($sv->titulo,30) }}</div>
                    <div class="activity-sub" style="color:#fa4101;font-weight:600;">R$ {{ number_format($sv->preco,2,',','.') }}</div></div>
                </div>
                @empty<div class="dash-empty">Nenhum serviço disponível.</div>@endforelse
            </div>

            <div class="dash-card d2">
                <div class="dash-card-head"><h6><i class="bi bi-wallet2"></i> Últimos Pagamentos</h6><a href="{{ route('pagamentos.index') }}" class="btn-dash">Ver tudo</a></div>
                @forelse(Auth::user()->pagamentos()->latest()->take(4)->get() as $pag)
                <div class="dash-row">
                    <span class="row-title">{{ Str::limit($pag->descricao ?? 'Pagamento',25) }}</span>
                    <span class="tag {{ $pag->status==='pago' ? 'tag-green' : 'tag-yellow' }}">R$ {{ number_format($pag->valor,2,',','.') }}</span>
                </div>
                @empty<div class="dash-empty">Nenhum pagamento realizado.</div>@endforelse
            </div>
        </div>
    @endif

</div>
@endsection