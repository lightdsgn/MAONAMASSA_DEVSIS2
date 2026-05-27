@extends('layouts.app')
@section('content')
<div class="py-4">
    <h4 class="fw-bold mb-4">
        <i class="bi bi-speedometer2 me-2"></i>Painel — Olá, {{ Auth::user()->nome }}!
    </h4>

    @if(Auth::user()->isAdm())
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-center p-4 border-0 shadow-sm" style="border-left:4px solid #fa4101!important;">
                <i class="bi bi-people display-5 text-warning"></i>
                <h2 class="fw-bold mt-2">{{ \App\Models\Usuario::count() }}</h2>
                <p class="text-muted mb-0">Usuários</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-4 border-0 shadow-sm">
                <i class="bi bi-tools display-5 text-primary"></i>
                <h2 class="fw-bold mt-2">{{ \App\Models\Servico::count() }}</h2>
                <p class="text-muted mb-0">Serviços</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-4 border-0 shadow-sm">
                <i class="bi bi-clipboard-check display-5 text-success"></i>
                <h2 class="fw-bold mt-2">{{ \App\Models\Solicitacao::count() }}</h2>
                <p class="text-muted mb-0">Solicitações</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-4 border-0 shadow-sm">
                <i class="bi bi-calendar-check display-5 text-info"></i>
                <h2 class="fw-bold mt-2">{{ \App\Models\Agendamento::count() }}</h2>
                <p class="text-muted mb-0">Agendamentos</p>
            </div>
        </div>
    </div>
    @endif

    @if(Auth::user()->isCliente())
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <h6 class="fw-bold"><i class="bi bi-clipboard-check me-2 text-warning"></i>Minhas Solicitações</h6>
                @php $sols = Auth::user()->solicitacoes()->latest()->take(3)->get(); @endphp
                @forelse($sols as $s)
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span>{{ Str::limit($s->titulo,30) }}</span>
                    <span class="badge bg-info">{{ str_replace('_',' ',$s->status) }}</span>
                </div>
                @empty <p class="text-muted small mt-2">Nenhuma solicitação ainda.</p> @endforelse
                <a href="{{ route('solicitacoes.index') }}" class="btn btn-sm btn-outline-primary mt-3">Ver todas</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <h6 class="fw-bold"><i class="bi bi-calendar-check me-2 text-success"></i>Meus Agendamentos</h6>
                @php $ags = Auth::user()->agendamentosComoCliente()->with('servico')->latest()->take(3)->get(); @endphp
                @forelse($ags as $ag)
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span>{{ Str::limit($ag->servico->titulo,25) }}</span>
                    <span class="badge bg-warning text-dark">{{ \Carbon\Carbon::parse($ag->data)->format('d/m') }}</span>
                </div>
                @empty <p class="text-muted small mt-2">Nenhum agendamento ainda.</p> @endforelse
                <a href="{{ route('agendamentos.index') }}" class="btn btn-sm btn-outline-success mt-3">Ver todos</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <h6 class="fw-bold"><i class="bi bi-tools me-2 text-primary"></i>Serviços Disponíveis</h6>
                <p class="text-muted">Encontre profissionais para o que você precisa.</p>
                <a href="{{ route('servicos.index') }}" class="btn btn-primary">Ver Serviços</a>
            </div>
        </div>
    </div>
    @endif

    @if(Auth::user()->isPrestador())
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <h6 class="fw-bold"><i class="bi bi-tools me-2 text-primary"></i>Meus Serviços</h6>
                @php $servs = Auth::user()->servicos()->latest()->take(3)->get(); @endphp
                @forelse($servs as $s)
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span>{{ Str::limit($s->titulo,30) }}</span>
                    <span class="badge {{ $s->status==='ativo'?'bg-success':'bg-secondary' }}">{{ $s->status }}</span>
                </div>
                @empty <p class="text-muted small mt-2">Nenhum serviço cadastrado.</p> @endforelse
                <a href="{{ route('servicos.create') }}" class="btn btn-sm btn-primary mt-3">+ Novo Serviço</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <h6 class="fw-bold"><i class="bi bi-clipboard-check me-2 text-warning"></i>Solicitações Abertas</h6>
                @php $sols = \App\Models\Solicitacao::where('status','aberta')->latest()->take(3)->get(); @endphp
                @forelse($sols as $s)
                <div class="py-2 border-bottom">
                    <a href="{{ route('solicitacoes.show', $s) }}" class="text-decoration-none">{{ Str::limit($s->titulo,35) }}</a>
                </div>
                @empty <p class="text-muted small mt-2">Nenhuma solicitação aberta.</p> @endforelse
                <a href="{{ route('solicitacoes.index') }}" class="btn btn-sm btn-outline-warning mt-3">Ver todas</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <h6 class="fw-bold"><i class="bi bi-calendar-check me-2 text-success"></i>Próximos Agendamentos</h6>
                @php
                    $ags = \App\Models\Agendamento::whereHas('servico', fn($q)=>$q->where('usuario_id',Auth::id()))
                           ->where('status','confirmado')->where('data','>=',now()->toDateString())
                           ->with('cliente','servico')->take(3)->get();
                @endphp
                @forelse($ags as $ag)
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="small">{{ $ag->cliente->nome }}</span>
                    <span class="badge bg-info">{{ \Carbon\Carbon::parse($ag->data)->format('d/m') }}</span>
                </div>
                @empty <p class="text-muted small mt-2">Nenhum agendamento confirmado.</p> @endforelse
                <a href="{{ route('agendamentos.index') }}" class="btn btn-sm btn-outline-success mt-3">Ver todos</a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
