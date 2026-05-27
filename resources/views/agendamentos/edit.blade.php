@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-pencil me-2"></i>Editar Agendamento #{{ $agendamento->id }}</h4>
    <a href="{{ route('agendamentos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <form action="{{ route('agendamentos.update', $agendamento) }}" method="POST">
        @csrf @method('PUT')
        @include('agendamentos._form', ['agendamento' => $agendamento, 'servicos' => $servicos ?? [], 'servico_id' => $servico_id ?? null])
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Atualizar</button>
        </div>
    </form>
</div>
@endsection
