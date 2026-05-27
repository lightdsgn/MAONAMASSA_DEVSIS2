@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-receipt me-2"></i>Novo Orçamento</h4>
    <a href="{{ route('orcamentos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <form action="{{ route('orcamentos.store') }}" method="POST">
        @csrf
        @include('orcamentos._form', ['orcamento' => null])
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Salvar</button>
        </div>
    </form>
</div>
@endsection
