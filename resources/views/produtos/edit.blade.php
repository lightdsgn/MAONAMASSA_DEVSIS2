@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-pencil me-2"></i>Editar Produto</h4>
    <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <form action="{{ route('produtos.update', $produto) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('produtos._form', ['produto' => $produto])
        <div class="mt-4"><button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Atualizar</button></div>
    </form>
</div>
@endsection
