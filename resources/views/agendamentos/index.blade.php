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

    .info-banner {
        background: #ebf5ff; border: 1.5px solid #c8e4fb;
        border-radius: 12px; padding: 11px 18px;
        font-size: 0.82rem; font-weight: 600; color: #0c5fa5;
        display: flex; align-items: center; gap: 9px;
        margin-bottom: 20px;
    }
    .info-banner i { font-size: 15px; flex-shrink: 0; }

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

    .agendamentos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .ag-card {
        background: #fff;
        border-radius: 16px;
        border: 1.5px solid #ececec;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.22s, box-shadow 0.22s;
        animation: fadeUp 0.4s ease both;
    }
    .ag-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.09);
    }

    .ag-banner { height: 8px; flex-shrink: 0; }
    .banner-pendente   { background: #ffc107; }
    .banner-confirmado { background: #17a2b8; }
    .banner-concluido  { background: #28a745; }
    .banner-cancelado  { background: #adb5bd; }

    .ag-body { padding: 18px 20px; flex: 1; display: flex; flex-direction: column; }

    .ag-top {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: 10px;
        margin-bottom: 12px;
    }
    .ag-servico { font-size: 0.95rem; font-weight: 800; color: #111; line-height: 1.3; letter-spacing: -0.2px; }
    .ag-id { font-size: 0.68rem; font-weight: 700; color: #bbb; margin-top: 2px; font-family: monospace; }

    .tag {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.65rem; font-weight: 700;
        padding: 3px 9px; border-radius: 20px;
        white-space: nowrap; flex-shrink: 0;
    }
    .tag::before { content:''; width:5px; height:5px; border-radius:50%; background:currentColor; opacity:.6; }
    .tag-pendente   { background: #fdf6e3; color: #8a6000; }
    .tag-confirmado { background: #e0f5f8; color: #0c6674; }
    .tag-concluido  { background: #e8f6ef; color: #145c37; }
    .tag-cancelado  { background: #f0f0f0; color: #888; }

    .ag-meta { display: flex; flex-direction: column; gap: 5px; margin-bottom: 14px; }
    .ag-meta-item { display: flex; align-items: center; gap: 7px; font-size: 0.77rem; color: #999; }
    .ag-meta-item i { font-size: 13px; color: #ccc; flex-shrink: 0; }
    .ag-meta-item strong { color: #555; font-weight: 600; }

    .ag-bottom {
        display: flex; align-items: center;
        justify-content: space-between; gap: 8px;
        margin-top: auto;
    }

    .datetime-block {
        display: flex; flex-direction: column; gap: 4px;
    }
    .date-pill, .time-pill {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.75rem; font-weight: 700;
        padding: 4px 10px; border-radius: 8px;
    }
    .date-pill { background: #f5f5f5; color: #555; }
    .time-pill { background: #fff4ef; color: #fa4101; }
    .date-pill i, .time-pill i { font-size: 11px; }

    .ag-footer {
        padding: 13px 20px;
        border-top: 1.5px solid #f5f5f5;
        display: flex; align-items: center; gap: 7px;
        flex-wrap: wrap;
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
    
    .act-accept { border-color: #b2e8c8; color: #145c37; }
    .act-accept:hover { background: #e8f6ef; color: #145c37; }
    .act-reject { border-color: #ffd5c2; color: #c73200; }
    .act-reject:hover { background: #fff1ec; color: #c73200; }
    .act-done   { border-color: #b2e8c8; color: #145c37; }
    .act-done:hover   { background: #e8f6ef; color: #145c37; }
    .act-star   { border-color: #fde9a2; color: #b07d00; }
    .act-star:hover   { background: #fdf6e3; color: #b07d00; }

    /* label dos botões de ação p/ contexto */
    .act-label {
        font-size: 0.7rem; font-weight: 700;
        color: #aaa; margin-left: 2px; white-space: nowrap;
    }

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
        .agendamentos-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="bi bi-calendar-check"></i> Agendamentos</h4>
        @if(Auth::user()->isCliente())
        <a href="{{ route('agendamentos.create') }}" class="btn-dash-fill">
            <i class="bi bi-plus-lg"></i> Novo Agendamento
        </a>
        @endif
    </div>

    @if(Auth::user()->isPrestador())
    <div class="info-banner">
        <i class="bi bi-info-circle-fill"></i>
        Veja os agendamentos que foram solicitados à você!
    </div>
    @endif

    <form method="GET" action="{{ route('agendamentos.index') }}" class="search-bar">
        <input type="text" name="busca" class="search-input"
            placeholder="Buscar por serviço ou status..."
            value="{{ $busca ?? '' }}">
        <button type="submit" class="search-btn"><i class="bi bi-search"></i></button>
        @if($busca ?? false)
        <a href="{{ route('agendamentos.index') }}" class="clear-btn"><i class="bi bi-x"></i> Limpar</a>
        @endif
    </form>

    <div class="agendamentos-grid">
        @forelse($agendamentos as $i => $ag)
        @php
            $statusSlug  = $ag->status ?? 'cancelado';
            $bannerClass = 'banner-' . $statusSlug;
            $tagClass    = 'tag-'    . $statusSlug;
        @endphp
        <div class="ag-card d{{ ($i % 6) + 1 }}">

            <div class="ag-banner {{ $bannerClass }}"></div>

            <div class="ag-body">

                <div class="ag-top">
                    <div>
                        <div class="ag-servico">{{ $ag->servico->titulo }}</div>
                        <div class="ag-id">#{{ $ag->id }}</div>
                    </div>
                    <span class="tag {{ $tagClass }}">{{ ucfirst($ag->status) }}</span>
                </div>

                <div class="ag-meta">
                    @if(Auth::user()->isCliente())
                    <div class="ag-meta-item">
                        <i class="bi bi-person-gear"></i>
                        <span>Prestador: <strong>{{ $ag->servico->usuario->nome }}</strong></span>
                    </div>
                    @else
                    <div class="ag-meta-item">
                        <i class="bi bi-person"></i>
                        <span>Cliente: <strong>{{ $ag->cliente->nome }}</strong></span>
                    </div>
                    @endif
                </div>

                <div class="ag-bottom">
                    <div class="datetime-block">
                        <div class="date-pill">
                            <i class="bi bi-calendar3"></i>
                            {{ \Carbon\Carbon::parse($ag->data)->format('d/m/Y') }}
                        </div>
                        <div class="time-pill">
                            <i class="bi bi-clock"></i>
                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $ag->horario)->format('H:i') }}
                        </div>
                    </div>
                </div>

            </div>

            <div class="ag-footer">

                {{-- PRESTADOR: aceitar / recusar pendentes --}}
                @if(Auth::user()->isPrestador())
                    @if($ag->status === 'pendente')
                        <form action="{{ route('agendamentos.aceitar', $ag) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Deseja confirmar este agendamento?');">
                            @csrf
                            <button type="submit" class="act-btn act-accept" title="Aceitar"><i class="bi bi-check-lg"></i></button>
                        </form>
                        <form action="{{ route('agendamentos.recusar', $ag) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Deseja recusar este agendamento?');">
                            @csrf
                            <button type="submit" class="act-btn act-reject" title="Recusar"><i class="bi bi-x-lg"></i></button>
                        </form>
                    @endif
                    <a href="{{ route('agendamentos.show', $ag) }}" class="act-btn act-view" title="Ver"><i class="bi bi-eye"></i></a>
                @endif

                {{-- CLIENTE: concluir / avaliar / editar / excluir --}}
                @if(Auth::user()->isCliente())
                    @if($ag->status === 'confirmado')
                        <form action="{{ route('agendamentos.concluir', $ag) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Confirma que o serviço já ocorreu?');">
                            @csrf
                            <button type="submit" class="act-btn act-done" title="Marcar como concluído"><i class="bi bi-check2-all"></i></button>
                        </form>
                    @endif

                    @if($ag->status === 'concluido')
                        @php
                            $jaAvaliou = \App\Models\Avaliacao::where('servico_id', $ag->servico_id)
                                            ->where('usuario_id', Auth::id())
                                            ->exists();
                        @endphp
                        @unless($jaAvaliou)
                        <a href="{{ route('avaliacoes.create', ['servico_id' => $ag->servico_id]) }}"
                            class="act-btn act-star" title="Avaliar serviço">
                            <i class="bi bi-star"></i>
                        </a>
                        @endunless
                    @endif

                    <a href="{{ route('agendamentos.show', $ag) }}" class="act-btn act-view" title="Ver"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{ route('agendamentos.edit', $ag) }}" class="act-btn act-edit" title="Editar"><i class="fa-solid fa-pencil"></i></a>
                    <form action="{{ route('agendamentos.destroy', $ag) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Cancelar este agendamento?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="act-btn act-delete" title="Cancelar"><i class="fa-solid fa-trash"></i></button>
                    </form>
                @endif

            </div>

        </div>
        @empty
        <div class="empty-state">
            <i class="bi bi-calendar-x"></i>
            <p>Nenhum agendamento encontrado{{ ($busca ?? false) ? ' para "'.$busca.'"' : '' }}.</p>
        </div>
        @endforelse
    </div>

    @if($agendamentos->hasPages())
    <div class="pagination-wrap">
        {{ $agendamentos->appends(['busca' => $busca])->links() }}
    </div>
    @endif

</div>
@endsection