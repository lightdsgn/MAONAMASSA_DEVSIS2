@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-plus-circle me-2"></i>Novo Produto</h4>
    <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label fw-600">Nome do Produto <span class="text-danger">*</span></label>
            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" required value="{{ old('nome') }}" placeholder="Ex: Almofada Decorativa">
            @error('nome') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label fw-600">Descrição <span class="text-danger">*</span></label>
            <textarea name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="4" required placeholder="Descreva seu produto...">{{ old('descricao') }}</textarea>
            @error('descricao') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label fw-600">Categoria <span class="text-danger">*</span></label>
            <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror" required>
                <option value="">Selecione uma categoria</option>
                <option value="decoracao" {{ old('categoria') == 'decoracao' ? 'selected' : '' }}>Decoração</option>
                <option value="alimentacao" {{ old('categoria') == 'alimentacao' ? 'selected' : '' }}>Alimentação</option>
                <option value="vestuario" {{ old('categoria') == 'vestuario' ? 'selected' : '' }}>Vestuário</option>
                <option value="outros" {{ old('categoria') == 'outros' ? 'selected' : '' }}>Outros</option>
            </select>
            @error('categoria') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label fw-600">Preço <span class="text-danger">*</span></label>
            <input type="number" name="preco" id="preco" step="0.01" class="form-control @error('preco') is-invalid @enderror" required value="{{ old('preco') }}" placeholder="0.00">
            @error('preco') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="quantidade" class="form-label fw-600">Quantidade <span class="text-danger">*</span></label>
            <input type="number" name="quantidade" id="quantidade" class="form-control @error('quantidade') is-invalid @enderror" required value="{{ old('quantidade') }}" placeholder="0">
            @error('quantidade') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label fw-600">Foto</label>
            <input type="file" name="foto" id="foto" accept="image/*" class="form-control @error('foto') is-invalid @enderror">
            @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label fw-600">Status <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="">Selecione um status</option>
                <option value="ativo" {{ old('status') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ old('status') == 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mt-4"><button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Salvar</button></div>
    </form>
</div>
@endsection
