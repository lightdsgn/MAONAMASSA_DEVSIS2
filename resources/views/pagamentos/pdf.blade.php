<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
@font-face {
    font-family: 'Sora';
    src: url('data:font/truetype;base64,{{ base64_encode(file_get_contents(storage_path("fonts/Sora-Regular.ttf"))) }}') format('truetype');
    font-weight: 400;
}
@font-face {
    font-family: 'Sora';
    src: url('data:font/truetype;base64,{{ base64_encode(file_get_contents(storage_path("fonts/Sora-ExtraBold.ttf"))) }}') format('truetype');
    font-weight: 700 900;
}
    body {
        font-family: 'Sora', sans-serif;
        font-size: 11px;
        color: #1a1a1a;
        background: #fff;
    }



    .header-bar {
        background: #fa4101;
        height: 6px;
        width: 100%;
    }
    .header {
        padding: 22px 36px 18px;
        display: table;
        width: 100%;
        border-bottom: 1px solid #f0f0f0;
        margin-bottom: 0;
    }
    .header-left  { display: table-cell; vertical-align: middle; }
    .header-right { display: table-cell; vertical-align: middle; text-align: right; width: 220px; }

    .logo-mark {
        display: inline-block;
        background: #fa4101;
        color: #fff;
        font-size: 13px;
        font-weight: 900;
        padding: 4px 10px;
        border-radius: 5px;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }
    .logo-title {
        font-size: 19px;
        font-weight: 900;
        color: #1a1a1a;
        letter-spacing: -0.5px;
        line-height: 1;
    }
    .logo-sub {
        font-size: 9px;
        color: #aaa;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-top: 3px;
    }

    .header-meta {
        font-size: 9.5px;
        color: #666;
        line-height: 2;
        text-align: right;
    }
    .header-meta .meta-label {
        font-size: 8px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #bbb;
        display: block;
    }
    .header-meta .meta-val {
        font-size: 10px;
        font-weight: 700;
        color: #333;
    }
    .period-pill {
        display: inline-block;
        background: #fff5f0;
        border: 1px solid #fdd0bc;
        color: #fa4101;
        font-size: 9px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
        margin-top: 4px;
    }


    .body { padding: 20px 36px 36px; }


    .summary-row {
        display: table;
        width: 100%;
        margin-bottom: 24px;
    }
    .summary-cell {
        display: table-cell;
        width: 33.33%;
        padding-right: 12px;
        vertical-align: top;
    }
    .summary-cell:last-child { padding-right: 0; }

    .summary-card {
        border-radius: 8px;
        padding: 14px 16px;
        position: relative;
        overflow: hidden;
    }
    .summary-card.orange { background: #fa4101; }
    .summary-card.dark   { background: #1a1a1a; }
    .summary-card.light  { background: #f7f7f7; border: 1px solid #eee; }

    .summary-card .sc-label {
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }
    .summary-card.orange .sc-label { color: rgba(255,255,255,0.7); }
    .summary-card.dark   .sc-label { color: rgba(255,255,255,0.5); }
    .summary-card.light  .sc-label { color: #aaa; }

    .summary-card .sc-value {
        font-size: 22px;
        font-weight: 900;
        line-height: 1;
        letter-spacing: -1px;
    }
    .summary-card.orange .sc-value { color: #fff; }
    .summary-card.dark   .sc-value { color: #fff; }
    .summary-card.light  .sc-value { color: #1a1a1a; }

    .summary-card .sc-sub {
        font-size: 8.5px;
        margin-top: 5px;
    }
    .summary-card.orange .sc-sub { color: rgba(255,255,255,0.65); }
    .summary-card.dark   .sc-sub { color: rgba(255,255,255,0.4); }
    .summary-card.light  .sc-sub { color: #bbb; }

    .summary-card .sc-deco {
        position: absolute;
        right: -10px;
        top: -10px;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        opacity: 0.12;
    }
    .summary-card.orange .sc-deco { background: #fff; }
    .summary-card.dark   .sc-deco { background: #fa4101; }


    .section-header {
        display: table;
        width: 100%;
        margin-bottom: 8px;
        margin-top: 22px;
    }
    .section-header-left { display: table-cell; vertical-align: middle; }
    .section-header-right { display: table-cell; vertical-align: middle; text-align: right; width: 80px; }

    .section-title {
        font-size: 9px;
        font-weight: 900;
        color: #fa4101;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        padding-left: 8px;
        border-left: 3px solid #fa4101;
    }
    .section-count {
        font-size: 8.5px;
        color: #bbb;
        font-weight: 600;
    }
    .section-line {
        border: none;
        border-top: 1px solid #f0f0f0;
        margin-bottom: 10px;
    }

    /* ══════════════════════════════════════
       TWO-COL
    ══════════════════════════════════════ */
    .two-col { display: table; width: 100%; }
    .col-l   { display: table-cell; width: 49%; vertical-align: top; padding-right: 10px; }
    .col-r   { display: table-cell; width: 49%; vertical-align: top; padding-left: 10px; }

    .mini-table {
        width: 100%;
        border-collapse: collapse;
    }
    .mini-table thead tr {
        background: #f5f5f5;
    }
    .mini-table th {
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #888;
        padding: 6px 10px;
        text-align: left;
        border-bottom: 2px solid #eee;
    }
    .mini-table th.r { text-align: right; }
    .mini-table td {
        padding: 7px 10px;
        font-size: 10px;
        border-bottom: 1px solid #f5f5f5;
        vertical-align: middle;
        color: #333;
    }
    .mini-table td.r {
        text-align: right;
        font-weight: 700;
        color: #fa4101;
        font-size: 10px;
    }
    .mini-table td.num {
        text-align: right;
        font-weight: 600;
        color: #555;
    }
    .mini-table tbody tr:last-child td { border-bottom: none; }

    .bar-wrap { background: #f0f0f0; border-radius: 4px; height: 4px; margin-top: 3px; }
    .bar-fill { background: #fa4101; border-radius: 4px; height: 4px; }

    .badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .badge-pago      { background: #d4edda; color: #145c37; }
    .badge-pendente  { background: #fff3cd; color: #7d5a00; }
    .badge-cancelado { background: #e9ecef; color: #555; }
    .badge-estornado { background: #ffe0d6; color: #c73200; }

    /* ══════════════════════════════════════
       MAIN TABLE (detalhamento)
    ══════════════════════════════════════ */
    .main-table {
        width: 100%;
        border-collapse: collapse;
    }
    .main-table thead tr {
        background: #1a1a1a;
    }
    .main-table th {
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #fff;
        padding: 8px 10px;
        text-align: left;
    }
    .main-table th.r { text-align: right; }
    .main-table td {
        padding: 8px 10px;
        font-size: 10px;
        border-bottom: 1px solid #f5f5f5;
        vertical-align: middle;
        color: #333;
    }
    .main-table td.r {
        text-align: right;
        font-weight: 800;
        color: #fa4101;
    }
    .main-table tbody tr:nth-child(even) td { background: #fafafa; }
    .main-table tbody tr:last-child td { border-bottom: none; }

    .td-id { font-size: 8px; color: #ccc; font-weight: 600; }
    .td-service { font-weight: 700; color: #1a1a1a; font-size: 10px; }
    .td-client  { font-size: 8.5px; color: #999; margin-top: 1px; }
    .td-method  { font-size: 9.5px; color: #555; }

    /* ══════════════════════════════════════
       RODAPÉ
    ══════════════════════════════════════ */
    .footer-bar {
        background: #f7f7f7;
        border-top: 1px solid #eee;
        padding: 10px 36px;
        display: table;
        width: 100%;
        margin-top: 28px;
    }
    .footer-left  { display: table-cell; vertical-align: middle; font-size: 8.5px; color: #aaa; }
    .footer-right { display: table-cell; vertical-align: middle; text-align: right; font-size: 8.5px; color: #aaa; }
    .footer-left strong { color: #fa4101; }
</style>
</head>
<body>

{{-- FAIXA TOPO --}}
<div class="header-bar"></div>

{{-- CABEÇALHO --}}
<div class="header">
    <div class="header-left">
        <div class="logo-mark">PAG</div>
        <div class="logo-title">Relatório de Pagamentos</div>
        <div class="logo-sub">Sistema de Agendamentos</div>
    </div>
    <div class="header-right">
        <span class="meta-label">Período</span>
        <div class="period-pill">
            {{ $inicio ? \Carbon\Carbon::parse($inicio)->format('d/m/Y') : '01/'.now()->format('m/Y') }}
            &nbsp;&rarr;&nbsp;
            {{ $fim ? \Carbon\Carbon::parse($fim)->format('d/m/Y') : now()->format('d/m/Y') }}
        </div>
        <div style="margin-top:8px;">
            <span class="meta-label">Emitido em</span>
            <span class="meta-val">{{ now()->format('d/m/Y \à\s H:i') }}</span>
        </div>
    </div>
</div>

<div class="body">

{{-- CARDS RESUMO --}}
<div class="summary-row" style="margin-top:18px;">
    <div class="summary-cell">
        <div class="summary-card orange">
            <div class="sc-deco"></div>
            <div class="sc-label">Total de pagamentos</div>
            <div class="sc-value">{{ $totalPagamentos }}</div>
            <div class="sc-sub">registros no período</div>
        </div>
    </div>
    <div class="summary-cell">
        <div class="summary-card dark">
            <div class="sc-deco"></div>
            <div class="sc-label">Valor total</div>
            <div class="sc-value" style="font-size:17px;">R$ {{ number_format($valorTotal, 2, ',', '.') }}</div>
            <div class="sc-sub">soma de todos os pagamentos</div>
        </div>
    </div>
    <div class="summary-cell">
        <div class="summary-card light">
            <div class="sc-label">Ticket médio</div>
            <div class="sc-value" style="font-size:17px; color:#fa4101;">
                R$ {{ $totalPagamentos > 0 ? number_format($valorTotal / $totalPagamentos, 2, ',', '.') : '0,00' }}
            </div>
            <div class="sc-sub">por pagamento</div>
        </div>
    </div>
</div>

{{-- STATUS + MÉTODO --}}
<div class="two-col">
    <div class="col-l">
        <div class="section-header">
            <div class="section-header-left">
                <div class="section-title">Por Status</div>
            </div>
        </div>
        <hr class="section-line">
        <table class="mini-table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th class="r">Qtd.</th>
                    <th class="r">Total (R$)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($porStatus as $status => $dados)
                <tr>
                    <td><span class="badge badge-{{ $status }}">{{ ucfirst($status) }}</span></td>
                    <td class="num">{{ $dados['qtd'] }}</td>
                    <td class="r">{{ number_format($dados['total'], 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-r">
        <div class="section-header">
            <div class="section-header-left">
                <div class="section-title">Por Método</div>
            </div>
        </div>
        <hr class="section-line">
        <table class="mini-table">
            <thead>
                <tr>
                    <th>Método</th>
                    <th class="r">Qtd.</th>
                    <th class="r">Total (R$)</th>
                </tr>
            </thead>
            <tbody>
                @php $maxMetodo = $porMetodo->max('total') ?: 1; @endphp
                @foreach($porMetodo as $metodo => $dados)
                <tr>
                    <td>
                        {{ ucfirst(str_replace('_', ' ', $metodo)) }}
                        <div class="bar-wrap">
                            <div class="bar-fill" style="width:{{ round(($dados['total'] / $maxMetodo) * 100) }}%"></div>
                        </div>
                    </td>
                    <td class="num">{{ $dados['qtd'] }}</td>
                    <td class="r">{{ number_format($dados['total'], 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- PRESTADORES --}}
<div class="section-header">
    <div class="section-header-left">
        <div class="section-title">Por Prestador</div>
    </div>
    <div class="section-header-right">
        <span class="section-count">{{ $porPrestador->count() }} prestadores</span>
    </div>
</div>
<hr class="section-line">
@php $maxPrest = $porPrestador->max('total') ?: 1; @endphp
<table class="mini-table">
    <thead>
        <tr>
            <th style="width:40%">Prestador</th>
            <th style="width:40%">Distribuição</th>
            <th class="r">Qtd.</th>
            <th class="r">Total (R$)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($porPrestador as $nome => $dados)
        <tr>
            <td style="font-weight:600;">{{ $nome }}</td>
            <td>
                <div class="bar-wrap">
                    <div class="bar-fill" style="width:{{ round(($dados['total'] / $maxPrest) * 100) }}%"></div>
                </div>
            </td>
            <td class="num">{{ $dados['qtd'] }}</td>
            <td class="r">{{ number_format($dados['total'], 2, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- DETALHAMENTO --}}
<div class="section-header" style="margin-top:26px;">
    <div class="section-header-left">
        <div class="section-title">Detalhamento dos Pagamentos</div>
    </div>
    <div class="section-header-right">
        <span class="section-count">{{ $totalPagamentos }} registros</span>
    </div>
</div>
<hr class="section-line">

<table class="main-table">
    <thead>
        <tr>
            <th style="width:28px">#</th>
            <th>Serviço / Cliente</th>
            <th>Prestador</th>
            <th>Método</th>
            <th>Status</th>
            <th>Data</th>
            <th class="r">Valor (R$)</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pagamentos as $pag)
        @php
            $ag        = $pag->agendamento;
            $servico   = $ag->servico;
            $cliente   = $ag->cliente;
            $prest     = $servico->usuario;
        @endphp
        <tr>
            <td><span class="td-id">#{{ $pag->id }}</span></td>
            <td>
                <div class="td-service">{{ $servico->titulo }}</div>
                <div class="td-client">{{ $cliente->nome }}</div>
            </td>
            <td style="font-size:10px;">{{ $prest->nome }}</td>
            <td><span class="td-method">{{ ucfirst(str_replace('_', ' ', $pag->metodo)) }}</span></td>
            <td><span class="badge badge-{{ $pag->status }}">{{ ucfirst($pag->status) }}</span></td>
            <td style="font-size:9.5px; white-space:nowrap; color:#555;">
                {{ $pag->data_pagamento ? \Carbon\Carbon::parse($pag->data_pagamento)->format('d/m/Y') : '—' }}
            </td>
            <td class="r">{{ number_format($pag->valor, 2, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="text-align:center; color:#bbb; padding:24px; font-size:10px;">
                Nenhum pagamento encontrado no período selecionado.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

</div>{{-- /body --}}

{{-- RODAPÉ --}}
<div class="footer-bar">
    <div class="footer-left">
        Gerado por <strong>Sistema de Agendamentos</strong>
    </div>
    <div class="footer-right">
        {{ now()->format('d/m/Y H:i') }} &nbsp;&bull;&nbsp; Pagina 1
    </div>
</div>

</body>
</html>