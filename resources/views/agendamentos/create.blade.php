@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-calendar-plus me-2"></i>Novo Agendamento</h4>
    <a href="{{ route('agendamentos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <form action="{{ route('agendamentos.store') }}" method="POST">
        @csrf
        @include('agendamentos._form', ['servicos' => $servicos, 'servico_id' => $servico_id])
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Confirmar Agendamento</button>
        </div>
    </form>
</div>
@endsection
