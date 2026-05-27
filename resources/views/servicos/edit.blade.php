@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-pencil me-2"></i>Editar Serviço</h4>
    <a href="{{ route('servicos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <form action="{{ route('servicos.update', $servico) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('servicos._form', ['servico' => $servico])
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Atualizar</button>
        </div>
    </form>
</div>
@endsection
