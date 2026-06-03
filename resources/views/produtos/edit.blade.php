@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-pencil me-2"></i>Editar Produto</h4>
    <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <form action="{{ route('produtos.update', $produto) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label fw-600">Nome do Produto <span class="text-danger">*</span></label>
            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" required value="{{ isset($produto) ? $produto->nome : old('nome') }}" placeholder="Ex: Almofada Decorativa">
            @error('nome') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label fw-600">Descrição <span class="text-danger">*</span></label>
            <textarea name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="4" required placeholder="Descreva seu produto...">{{ isset($produto) ? $produto->descricao : old('descricao') }}</textarea>
            @error('descricao') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label fw-600">Categoria <span class="text-danger">*</span></label>
            <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror" required>
                <option value="">Selecione uma categoria</option>
                <option value="decoracao" {{ (isset($produto) && $produto->categoria == 'decoracao') || old('categoria') == 'decoracao' ? 'selected' : '' }}>Decoração</option>
                <option value="alimentacao" {{ (isset($produto) && $produto->categoria == 'alimentacao') || old('categoria') == 'alimentacao' ? 'selected' : '' }}>Alimentação</option>
                <option value="vestuario" {{ (isset($produto) && $produto->categoria == 'vestuario') || old('categoria') == 'vestuario' ? 'selected' : '' }}>Vestuário</option>
                <option value="outros" {{ (isset($produto) && $produto->categoria == 'outros') || old('categoria') == 'outros' ? 'selected' : '' }}>Outros</option>
            </select>
            @error('categoria') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label fw-600">Preço <span class="text-danger">*</span></label>
            <input type="number" name="preco" id="preco" step="0.01" class="form-control @error('preco') is-invalid @enderror" required value="{{ isset($produto) ? $produto->preco : old('preco') }}" placeholder="0.00">
            @error('preco') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="quantidade" class="form-label fw-600">Quantidade <span class="text-danger">*</span></label>
            <input type="number" name="quantidade" id="quantidade" class="form-control @error('quantidade') is-invalid @enderror" required value="{{ isset($produto) ? $produto->quantidade : old('quantidade') }}" placeholder="0">
            @error('quantidade') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label fw-600">Foto</label>
            <input type="file" name="foto" id="foto" accept="image/*" class="form-control @error('foto') is-invalid @enderror">
            @if(isset($produto) && $produto->foto)
                <small class="text-muted">Foto atual: {{ $produto->foto }}</small>
            @endif
            @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label fw-600">Status <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="">Selecione um status</option>
                <option value="ativo" {{ (isset($produto) && $produto->status == 'ativo') || old('status') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ (isset($produto) && $produto->status == 'inativo') || old('status') == 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mt-4"><button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Atualizar</button></div>
    </form>
</div>
@endsection
