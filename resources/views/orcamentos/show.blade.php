@extends('layouts.app')

@section('content')

<style>
    .dash {
        padding: 36px 32px;
        font-family: 'Sora', sans-serif;
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        gap: 16px;
    }

    .page-title {
        font-size: 1.3rem;
        font-weight: 900;
        color: #111;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .page-title i {
        color: #fa4101;
    }

    .btn-back {
        border: 1.5px solid #ddd;
        background: transparent;
        color: #555;
        border-radius: 9px;
        padding: 8px 16px;
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: 0.2s;
    }

    .btn-back:hover {
        border-color: #fa4101;
        color: #fa4101;
    }

    .wrap {
        display: grid;
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .card {
        background: #fff;
        border: 1.5px solid #ececec;
        border-radius: 16px;
        padding: 22px;
    }

    .section-title {
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        color: #bbb;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #f0f0f0;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }

    .item-label {
        font-size: 0.7rem;
        font-weight: 700;
        color: #bbb;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .item-value {
        font-size: 0.9rem;
        font-weight: 600;
        color: #222;
    }

    .highlight {
        font-size: 1.6rem;
        font-weight: 900;
        color: #fa4101;
        letter-spacing: -0.5px;
    }

    .status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 700;
        width: fit-content;
    }

    .pendente { background: #fff4cc; color: #8a6000; }
    .aceito { background: #e8f6ef; color: #145c37; }
    .recusado { background: #ffe3e3; color: #b30000; }

    .actions {
        display: flex;
        gap: 10px;
        margin-top: 16px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 9px 16px;
        border-radius: 9px;
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: none;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-primary {
        background: #fa4101;
        color: #fff;
    }

    .btn-primary:hover {
        background: #c73200;
    }

    .btn-success {
        background: #28a745;
        color: #fff;
    }

    .btn-danger {
        background: #dc3545;
        color: #fff;
    }

    .btn-outline {
        border: 1.5px solid #ddd;
        background: transparent;
        color: #555;
    }

    .btn-outline:hover {
        border-color: #fa4101;
        color: #fa4101;
    }

    @media(max-width:768px) {
        .grid {
            grid-template-columns: 1fr;
        }
        .dash {
            padding: 16px;
        }
    }
</style>

<div class="dash">

    {{-- HEADER --}}
    <div class="page-header">
        <h4 class="page-title">
            <i class="fa-solid fa-file-invoice"></i>
            Orçamento #{{ $orcamento->id }}
        </h4>

        <a href="{{ route('orcamentos.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="wrap">

        {{-- INFO PRINCIPAL --}}
        <div class="card">

            <div class="section-title">Informações principais</div>

            <div class="grid">
                <div>
                    <div class="item-label">Solicitação</div>
                    <div class="item-value">{{ $orcamento->solicitacao->titulo }}</div>
                </div>

                <div>
                    <div class="item-label">Prestador</div>
                    <div class="item-value">{{ $orcamento->usuario->nome }}</div>
                </div>

                <div>
                    <div class="item-label">Mão de obra</div>
                    <div class="item-value">R$ {{ number_format($orcamento->mao_de_obra,2,',','.') }}</div>
                </div>

                <div>
                    <div class="item-label">Valor total</div>
                    <div class="item-value highlight">
                        R$ {{ number_format($orcamento->valor_total,2,',','.') }}
                    </div>
                </div>

                <div>
                    <div class="item-label">Prazo</div>
                    <div class="item-value">{{ $orcamento->prazo }} dias</div>
                </div>

                <div>
                    <div class="item-label">Status</div>
                    <div class="status {{ $orcamento->status }}">
                        {{ ucfirst($orcamento->status) }}
                    </div>
                </div>
            </div>

        </div>

        {{-- OBSERVAÇÕES --}}
        @if($orcamento->observacoes)
        <div class="card">
            <div class="section-title">Observações</div>
            <div class="item-value" style="color:#666; line-height:1.6;">
                {{ $orcamento->observacoes }}
            </div>
        </div>
        @endif

        {{-- AÇÕES --}}
        <div class="card">

            <div class="section-title">Ações</div>

            <div class="actions">

                @if(Auth::id() === $orcamento->solicitacao->usuario_id && $orcamento->status === 'pendente')
                    <form action="{{ route('orcamentos.aceitar', $orcamento) }}" method="POST">
                        @csrf
                        <button class="btn btn-success" type="submit">
                            Aceitar
                        </button>
                    </form>

                    <form action="{{ route('orcamentos.recusar', $orcamento) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" type="submit">
                            Recusar
                        </button>
                    </form>
                @endif

                @if(Auth::user()->isAdm() || $orcamento->usuario_id === Auth::id())
                    <a href="{{ route('orcamentos.edit', $orcamento) }}" class="btn btn-outline">
                        <i class="fa-solid fa-pen"></i> Editar
                    </a>
                @endif

                @if(Auth::id() === $orcamento->solicitacao->usuario_id && $orcamento->status === 'aceito')
                    @php
                        $servDefault = $orcamento->usuario->servicos()->where('status', 'ativo')->first();
                    @endphp

                    <a href="{{ route('agendamentos.create', [
                        'servico_id' => $servDefault->id ?? null,
                        'orcamento_id' => $orcamento->id
                    ]) }}" class="btn btn-primary">
                        Agendar Serviço
                    </a>
                @endif

            </div>

        </div>

    </div>

</div>

@endsection