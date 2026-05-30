@extends('layouts.app')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800;900&display=swap');

    .dash { padding: 60px; font-family: 'Sora', sans-serif; padding-top: 150px; }

    /* ── HERO SAUDAÇÃO ── */
    .dash-hero {
        background: linear-gradient(135deg, #fa4101 0%, #c73200 100%);
        border-radius: 16px;
        padding: 28px 32px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }
    .dash-hero::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,0.07);
    }
    .dash-hero::after {
        content: '';
        position: absolute;
        bottom: -60px; right: 80px;
        width: 140px; height: 140px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
    .dash-hero h4 {
        color: #fff;
        font-size: 1.5rem;
        font-weight: 800;
        margin: 0 0 4px;
        letter-spacing: -0.5px;
    }
    .dash-hero p {
        color: rgba(255,255,255,0.8);
        font-size: 0.88rem;
        margin: 0;
    }
    .dash-hero .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.18);
        border: 1px solid rgba(255,255,255,0.25);
        color: #fff;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .hero-dot { width: 7px; height: 7px; background: #fff; border-radius: 50%; animation: blink 1.6s ease infinite; }
    @keyframes blink { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.4;transform:scale(1.3)} }

    /* ── STAT CARDS ── */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }
    .stat-card {
        background: #fff;
        border-radius: 14px;
        padding: 20px 22px;
        border: 1.5px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: transform 0.2s, box-shadow 0.2s;
        animation: fadeUp 0.5s ease both;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
    .stat-icon {
        width: 50px; height: 50px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .stat-icon.orange  { background: rgba(250,65,1,0.1);  color: #fa4101; }
    .stat-icon.blue    { background: rgba(13,110,253,0.1); color: #0d6efd; }
    .stat-icon.green   { background: rgba(25,135,84,0.1);  color: #198754; }
    .stat-icon.yellow  { background: rgba(255,193,7,0.12); color: #e6a800; }
    .stat-num {
        font-size: 1.7rem;
        font-weight: 900;
        color: #111;
        line-height: 1;
        letter-spacing: -1px;
    }
    .stat-label { font-size: 0.75rem; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 3px; }

    /* ── CONTENT CARDS ── */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }
    .dash-card {
        background: #fff;
        border-radius: 14px;
        border: 1.5px solid #f0f0f0;
        overflow: hidden;
        animation: fadeUp 0.5s ease both;
        transition: box-shadow 0.2s;
    }
    .dash-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.07); }
    .dash-card-head {
        padding: 18px 20px 14px;
        border-bottom: 1.5px solid #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .dash-card-head h6 {
        font-size: 0.85rem;
        font-weight: 800;
        color: #111;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }
    .dash-card-head h6 i { color: #fa4101; font-size: 16px; }
    .dash-card-body { padding: 8px 0; }
    .dash-card-footer { padding: 12px 20px; border-top: 1.5px solid #f5f5f5; }

    .dash-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        transition: background 0.15s;
        gap: 12px;
    }
    .dash-row:hover { background: #fafafa; }
    .dash-row + .dash-row { border-top: 1px solid #f5f5f5; }
    .dash-row .row-title {
        font-size: 0.84rem;
        font-weight: 600;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 160px;
    }

    .dash-empty {
        padding: 20px;
        font-size: 0.82rem;
        color: #bbb;
        text-align: center;
    }

    /* badges */
    .tag {
        display: inline-block;
        font-size: 0.68rem;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 20px;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .tag-orange  { background: rgba(250,65,1,0.1);  color: #c73200; }
    .tag-blue    { background: rgba(13,110,253,0.1); color: #0947b3; }
    .tag-green   { background: rgba(25,135,84,0.1);  color: #145c37; }
    .tag-yellow  { background: rgba(255,193,7,0.14); color: #8a6000; }
    .tag-gray    { background: #f0f0f0; color: #666; }

    /* btn links */
    .btn-dash {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.78rem;
        font-weight: 700;
        padding: 7px 14px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s;
        border: 1.5px solid;
        font-family: 'Sora', sans-serif;
        cursor: pointer;
        background: none;
    }
    .btn-dash-primary { border-color: #fa4101; color: #fa4101; }
    .btn-dash-primary:hover { background: #fa4101; color: #fff; }
    .btn-dash-outline { border-color: #ddd; color: #555; }
    .btn-dash-outline:hover { border-color: #fa4101; color: #fa4101; }

    .btn-dash-fill {
        background: #fa4101; color: #fff;
        border: none; border-radius: 8px;
        padding: 9px 18px;
        font-size: 0.82rem; font-weight: 700;
        text-decoration: none;
        display: inline-flex; align-items: center; gap: 6px;
        transition: background 0.2s;
        font-family: 'Sora', sans-serif;
    }
    .btn-dash-fill:hover { background: #c73200; color: #fff; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.10s; }
    .delay-3 { animation-delay: 0.15s; }
    .delay-4 { animation-delay: 0.20s; }

    @media (max-width: 576px) {
        .dash { padding: 16px; }
        .dash-hero { padding: 22px 20px; }
        .dash-hero h4 { font-size: 1.2rem; }
    }
</style>

<div class="dash">

    {{-- HERO --}}
    <div class="dash-hero">
        <span class="hero-badge"><span class="hero-dot"></span>
            @if(Auth::user()->isAdm()) Administrador
            @elseif(Auth::user()->isPrestador()) Prestador
            @else Cliente
            @endif
        </span>
        <h4>Olá, {{ Auth::user()->nome }}! </h4>
        <p>Bem-vindo ao seu painel. Aqui está um resumo da sua conta.</p>
    </div>

    {{-- ── ADM ── --}}
    @if(Auth::user()->isAdm())

    <div class="stat-grid">
        <div class="stat-card delay-1">
            <div class="stat-icon orange"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="stat-num">{{ \App\Models\Usuario::count() }}</div>
                <div class="stat-label">Usuários</div>
            </div>
        </div>
        <div class="stat-card delay-2">
            <div class="stat-icon blue"><i class="bi bi-tools"></i></div>
            <div>
                <div class="stat-num">{{ \App\Models\Servico::count() }}</div>
                <div class="stat-label">Serviços</div>
            </div>
        </div>
        <div class="stat-card delay-3">
            <div class="stat-icon green"><i class="bi bi-clipboard-check"></i></div>
            <div>
                <div class="stat-num">{{ \App\Models\Solicitacao::count() }}</div>
                <div class="stat-label">Solicitações</div>
            </div>
        </div>
        <div class="stat-card delay-4">
            <div class="stat-icon yellow"><i class="bi bi-calendar-check"></i></div>
            <div>
                <div class="stat-num">{{ \App\Models\Agendamento::count() }}</div>
                <div class="stat-label">Agendamentos</div>
            </div>
        </div>
    </div>

    <div class="cards-grid">
        <div class="dash-card delay-1">
            <div class="dash-card-head">
                <h6><i class="bi bi-people"></i> Últimos Usuários</h6>
                <a href="{{ route('usuarios.index') }}" class="btn-dash btn-dash-outline">Ver todos</a>
            </div>
            <div class="dash-card-body">
                @php $usuarios = \App\Models\Usuario::latest()->take(4)->get(); @endphp
                @forelse($usuarios as $u)
                <div class="dash-row">
                    <span class="row-title">{{ $u->nome }}</span>
                    <span class="tag {{ $u->tipo === 'adm' ? 'tag-orange' : ($u->tipo === 'prestador' ? 'tag-blue' : 'tag-gray') }}">
                        {{ strtoupper($u->tipo) }}
                    </span>
                </div>
                @empty
                <div class="dash-empty">Nenhum usuário.</div>
                @endforelse
            </div>
        </div>

        <div class="dash-card delay-2">
            <div class="dash-card-head">
                <h6><i class="bi bi-clipboard-check"></i> Solicitações Recentes</h6>
                <a href="{{ route('solicitacoes.index') }}" class="btn-dash btn-dash-outline">Ver todas</a>
            </div>
            <div class="dash-card-body">
                @php $sols = \App\Models\Solicitacao::latest()->take(4)->get(); @endphp
                @forelse($sols as $s)
                <div class="dash-row">
                    <span class="row-title">{{ Str::limit($s->titulo, 28) }}</span>
                    <span class="tag tag-blue">{{ str_replace('_',' ',$s->status) }}</span>
                </div>
                @empty
                <div class="dash-empty">Nenhuma solicitação.</div>
                @endforelse
            </div>
        </div>

        <div class="dash-card delay-3">
            <div class="dash-card-head">
                <h6><i class="bi bi-calendar-check"></i> Agendamentos Recentes</h6>
                <a href="{{ route('agendamentos.index') }}" class="btn-dash btn-dash-outline">Ver todos</a>
            </div>
            <div class="dash-card-body">
                @php $ags = \App\Models\Agendamento::with('cliente','servico')->latest()->take(4)->get(); @endphp
                @forelse($ags as $ag)
                <div class="dash-row">
                    <span class="row-title">{{ $ag->cliente->nome ?? '—' }}</span>
                    <span class="tag tag-yellow">{{ \Carbon\Carbon::parse($ag->data)->format('d/m/y') }}</span>
                </div>
                @empty
                <div class="dash-empty">Nenhum agendamento.</div>
                @endforelse
            </div>
        </div>
    </div>

    @endif

    {{-- ── CLIENTE ── --}}
    @if(Auth::user()->isCliente())
    @php
        $totalSols = Auth::user()->solicitacoes()->count();
        $totalAgs  = Auth::user()->agendamentosComoCliente()->count();
    @endphp

    <div class="stat-grid">
        <div class="stat-card delay-1">
            <div class="stat-icon orange"><i class="bi bi-clipboard-check"></i></div>
            <div>
                <div class="stat-num">{{ $totalSols }}</div>
                <div class="stat-label">Minhas Solicitações</div>
            </div>
        </div>
        <div class="stat-card delay-2">
            <div class="stat-icon green"><i class="bi bi-calendar-check"></i></div>
            <div>
                <div class="stat-num">{{ $totalAgs }}</div>
                <div class="stat-label">Meus Agendamentos</div>
            </div>
        </div>
    </div>

    <div class="cards-grid">
        <div class="dash-card delay-1">
            <div class="dash-card-head">
                <h6><i class="bi bi-clipboard-check"></i> Minhas Solicitações</h6>
                <a href="{{ route('solicitacoes.index') }}" class="btn-dash btn-dash-outline">Ver todas</a>
            </div>
            <div class="dash-card-body">
                @php $sols = Auth::user()->solicitacoes()->latest()->take(4)->get(); @endphp
                @forelse($sols as $s)
                <div class="dash-row">
                    <span class="row-title">{{ Str::limit($s->titulo, 28) }}</span>
                    <span class="tag tag-blue">{{ str_replace('_',' ',$s->status) }}</span>
                </div>
                @empty
                <div class="dash-empty">Nenhuma solicitação ainda.</div>
                @endforelse
            </div>
            <div class="dash-card-footer">
                <a href="{{ route('solicitacoes.create') }}" class="btn-dash-fill">
                    <i class="bi bi-plus-lg"></i> Nova Solicitação
                </a>
            </div>
        </div>

        <div class="dash-card delay-2">
            <div class="dash-card-head">
                <h6><i class="bi bi-calendar-check"></i> Meus Agendamentos</h6>
                <a href="{{ route('agendamentos.index') }}" class="btn-dash btn-dash-outline">Ver todos</a>
            </div>
            <div class="dash-card-body">
                @php $ags = Auth::user()->agendamentosComoCliente()->with('servico')->latest()->take(4)->get(); @endphp
                @forelse($ags as $ag)
                <div class="dash-row">
                    <span class="row-title">{{ Str::limit($ag->servico->titulo, 25) }}</span>
                    <span class="tag tag-yellow">{{ \Carbon\Carbon::parse($ag->data)->format('d/m') }}</span>
                </div>
                @empty
                <div class="dash-empty">Nenhum agendamento ainda.</div>
                @endforelse
            </div>
        </div>

        <div class="dash-card delay-3">
            <div class="dash-card-head">
                <h6><i class="bi bi-tools"></i> Explorar</h6>
            </div>
            <div class="dash-card-body" style="padding: 20px;">
                <p style="font-size:0.85rem;color:#888;margin-bottom:16px;">
                    Encontre profissionais verificados para qualquer serviço.
                </p>
                <a href="{{ route('servicos.index') }}" class="btn-dash-fill" style="width:100%;justify-content:center;">
                    <i class="bi bi-search"></i> Ver Serviços
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- ── PRESTADOR ── --}}
    @if(Auth::user()->isPrestador())
    @php
        $totalServs = Auth::user()->servicos()->count();
        $totalSolsAbertas = \App\Models\Solicitacao::where('status','aberta')->count();
    @endphp

    <div class="stat-grid">
        <div class="stat-card delay-1">
            <div class="stat-icon blue"><i class="bi bi-tools"></i></div>
            <div>
                <div class="stat-num">{{ $totalServs }}</div>
                <div class="stat-label">Meus Serviços</div>
            </div>
        </div>
        <div class="stat-card delay-2">
            <div class="stat-icon orange"><i class="bi bi-clipboard"></i></div>
            <div>
                <div class="stat-num">{{ $totalSolsAbertas }}</div>
                <div class="stat-label">Solicitações Abertas</div>
            </div>
        </div>
    </div>

    <div class="cards-grid">
        <div class="dash-card delay-1">
            <div class="dash-card-head">
                <h6><i class="bi bi-tools"></i> Meus Serviços</h6>
                <a href="{{ route('servicos.index') }}" class="btn-dash btn-dash-outline">Ver todos</a>
            </div>
            <div class="dash-card-body">
                @php $servs = Auth::user()->servicos()->latest()->take(4)->get(); @endphp
                @forelse($servs as $s)
                <div class="dash-row">
                    <span class="row-title">{{ Str::limit($s->titulo, 28) }}</span>
                    <span class="tag {{ $s->status === 'ativo' ? 'tag-green' : 'tag-gray' }}">{{ $s->status }}</span>
                </div>
                @empty
                <div class="dash-empty">Nenhum serviço cadastrado.</div>
                @endforelse
            </div>
            <div class="dash-card-footer">
                <a href="{{ route('servicos.create') }}" class="btn-dash-fill">
                    <i class="bi bi-plus-lg"></i> Novo Serviço
                </a>
            </div>
        </div>

        <div class="dash-card delay-2">
            <div class="dash-card-head">
                <h6><i class="bi bi-clipboard-check"></i> Solicitações Abertas</h6>
                <a href="{{ route('solicitacoes.index') }}" class="btn-dash btn-dash-outline">Ver todas</a>
            </div>
            <div class="dash-card-body">
                @php $sols = \App\Models\Solicitacao::where('status','aberta')->latest()->take(4)->get(); @endphp
                @forelse($sols as $s)
                <div class="dash-row">
                    <a href="{{ route('solicitacoes.show', $s) }}" style="text-decoration:none;">
                        <span class="row-title" style="max-width:200px;">{{ Str::limit($s->titulo, 32) }}</span>
                    </a>
                    <span class="tag tag-orange">Aberta</span>
                </div>
                @empty
                <div class="dash-empty">Nenhuma solicitação aberta.</div>
                @endforelse
            </div>
        </div>

        <div class="dash-card delay-3">
            <div class="dash-card-head">
                <h6><i class="bi bi-calendar-check"></i> Próximos Agendamentos</h6>
                <a href="{{ route('agendamentos.index') }}" class="btn-dash btn-dash-outline">Ver todos</a>
            </div>
            <div class="dash-card-body">
                @php
                    $ags = \App\Models\Agendamento::whereHas('servico', fn($q) => $q->where('usuario_id', Auth::id()))
                           ->where('status','confirmado')
                           ->where('data','>=', now()->toDateString())
                           ->with('cliente','servico')
                           ->take(4)->get();
                @endphp
                @forelse($ags as $ag)
                <div class="dash-row">
                    <span class="row-title">{{ $ag->cliente->nome }}</span>
                    <span class="tag tag-yellow">{{ \Carbon\Carbon::parse($ag->data)->format('d/m') }}</span>
                </div>
                @empty
                <div class="dash-empty">Nenhum agendamento confirmado.</div>
                @endforelse
            </div>
        </div>
    </div>
    @endif

</div>
@endsection