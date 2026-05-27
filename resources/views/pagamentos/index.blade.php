@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-credit-card me-2"></i>Pagamentos</h4>
    @if(Auth::user()->isAdm() || Auth::user()->isPrestador())
    <a href="{{ route('pagamentos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Registrar Pagamento
    </a>
    @endif
</div>

<form method="GET" action="{{ route('pagamentos.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="busca" class="form-control" placeholder="Buscar por método ou status..."
            value="{{ $busca ?? '' }}">
        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
        @if($busca ?? false)
            <a href="{{ route('pagamentos.index') }}" class="btn btn-outline-secondary">Limpar</a>
        @endif
    </div>
</form>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Agendamento</th>
                    <th>Cliente</th>
                    <th>Prestador</th>
                    <th>Valor</th>
                    <th>Método</th>
                    <th>Status</th>
                    <th>Data Pgto.</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pagamentos as $pag)
                <tr>
                    <td>{{ $pag->id }}</td>
                    <td>
                        <a href="{{ route('agendamentos.show', $pag->agendamento) }}" class="text-decoration-none">
                            #{{ $pag->agendamento_id }} — {{ $pag->agendamento->servico->titulo }}
                        </a>
                    </td>
                    <td>{{ $pag->agendamento->cliente->nome }}</td>
                    <td>{{ $pag->agendamento->servico->usuario->nome }}</td>
                    <td class="fw-bold">R$ {{ number_format($pag->valor, 2, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-secondary text-uppercase">
                            {{ str_replace('_', ' ', $pag->metodo) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge
                            {{ $pag->status === 'pendente'  ? 'bg-warning text-dark' : '' }}
                            {{ $pag->status === 'pago'      ? 'bg-success' : '' }}
                            {{ $pag->status === 'cancelado' ? 'bg-secondary' : '' }}
                            {{ $pag->status === 'estornado' ? 'bg-danger' : '' }}">
                            {{ ucfirst($pag->status) }}
                        </span>
                    </td>
                    <td>{{ $pag->data_pagamento ? \Carbon\Carbon::parse($pag->data_pagamento)->format('d/m/Y') : '—' }}</td>
                    <td>
                        <a href="{{ route('pagamentos.show', $pag) }}" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        @if(Auth::user()->isAdm() || Auth::user()->isPrestador())
                        <a href="{{ route('pagamentos.edit', $pag) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @endif
                        @if(Auth::user()->isAdm())
                        <form action="{{ route('pagamentos.destroy', $pag) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Remover este pagamento?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-5">Nenhum pagamento encontrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $pagamentos->appends(['busca' => $busca])->links() }}</div>
@endsection
