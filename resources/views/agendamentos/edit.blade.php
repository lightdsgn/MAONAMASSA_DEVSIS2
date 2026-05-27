@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-pencil me-2"></i>Editar Agendamento #{{ $agendamento->id }}</h4>
    <a href="{{ route('agendamentos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <form action="{{ route('agendamentos.update', $agendamento) }}" method="POST">
        @csrf @method('PUT')
        @if(Auth::user()->isCliente())
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-semibold">Serviço</label>
                <input type="text" class="form-control" value="{{ $agendamento->servico->titulo }}" disabled>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Data</label>
                <input type="date" name="data" class="form-control" value="{{ $agendamento->data }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Horário</label>
                <input type="time" name="horario" class="form-control" value="{{ $agendamento->horario }}">
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Observações</label>
                <textarea name="observacoes" class="form-control" rows="3">{{ $agendamento->observacoes }}</textarea>
            </div>
        </div>
        @else
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Serviço</label>
                <input type="text" class="form-control" value="{{ $agendamento->servico->titulo }}" disabled>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select">
                    @foreach(['pendente','confirmado','concluido','cancelado'] as $st)
                    <option value="{{ $st }}" {{ $agendamento->status === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Atualizar</button>
        </div>
    </form>
</div>
@endsection
