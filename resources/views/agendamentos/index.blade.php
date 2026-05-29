@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-calendar-check me-2"></i>Agendamentos</h4>
    @if(Auth::user()->isCliente())
    <a href="{{ route('agendamentos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Novo Agendamento
    </a>
    @endif
</div>

@if(Auth::user()->isPrestador())
<div class="alert alert-info">Veja os agendamentos que foram solicitados à você!</div>
@endif

<form method="GET" action="{{ route('agendamentos.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="busca" class="form-control" placeholder="Buscar por serviço ou status..."
            value="{{ $busca ?? '' }}">
        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
        @if($busca ?? false) <a href="{{ route('agendamentos.index') }}" class="btn btn-outline-secondary">Limpar</a> @endif
    </div>
</form>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th><th>Serviço</th>
                    @if(Auth::user()->isCliente())
                        <th>Prestador</th>
                    @else
                        <th>Cliente</th>
                    @endif
                    <th>Data</th><th>Horário</th><th>Status</th><th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agendamentos as $ag)
                <tr>
                    <td>{{ $ag->id }}</td>
                    <td>{{ $ag->servico->titulo }}</td>
                    @if(Auth::user()->isCliente())
                        <td>{{ $ag->servico->usuario->nome }}</td>
                    @else
                        <td>{{ $ag->cliente->nome }}</td>
                    @endif
                    <td>{{ \Carbon\Carbon::parse($ag->data)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $ag->horario)->format('H:i') }}</td>
                    <td>
                        <span class="badge
                            {{ $ag->status === 'pendente'   ? 'bg-warning text-dark' : '' }}
                            {{ $ag->status === 'confirmado' ? 'bg-info' : '' }}
                            {{ $ag->status === 'concluido'  ? 'bg-success' : '' }}
                            {{ $ag->status === 'cancelado'  ? 'bg-secondary' : '' }}">
                            {{ ucfirst($ag->status) }}
                        </span>
                    </td>
                    <td>
                        @if(Auth::user()->isPrestador())
                            @if($ag->status === 'pendente')
                                <form action="{{ route('agendamentos.aceitar', $ag) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja confirmar este agendamento?');">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Aceitar</button>
                                </form>
                                <form action="{{ route('agendamentos.recusar', $ag) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja recusar este agendamento?');">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Recusar</button>
                                </form>
                            @endif
                            <a href="{{ route('agendamentos.show', $ag) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                        @else
                            @if($ag->status === 'confirmado')
                                <form action="{{ route('agendamentos.concluir', $ag) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirma que o serviço já ocorreu?');">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Confirmar</button>
                                </form>
                            @endif
                            <a href="{{ route('agendamentos.show', $ag) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('agendamentos.edit', $ag) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('agendamentos.destroy', $ag) }}" method="POST" class="d-inline" onsubmit="return confirm('Cancelar este agendamento?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-5">Nenhum agendamento encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $agendamentos->appends(['busca' => $busca])->links() }}</div>
@endsection
