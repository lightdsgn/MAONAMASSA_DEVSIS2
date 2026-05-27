@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-star-half me-2"></i>Avaliar Serviço</h4>
    <a href="{{ route('avaliacoes.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4" style="max-width:600px;">
    <form action="{{ route('avaliacoes.store') }}" method="POST">
        @csrf
        @include('avaliacoes._form', ['servico_id' => $servico_id])
        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Enviar Avaliação</button>
    </form>
</div>
@endsection
