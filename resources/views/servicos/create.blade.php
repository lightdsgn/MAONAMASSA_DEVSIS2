@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-plus-circle me-2"></i>Novo Serviço</h4>
    <a href="{{ route('servicos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <form action="{{ route('servicos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label fw-600">Título do Serviço <span class="text-danger">*</span></label>
            <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" required value="{{ old('titulo') }}" placeholder="Ex: Encanador Profissional">
            @error('titulo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label fw-600">Descrição <span class="text-danger">*</span></label>
            <textarea name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="4" required placeholder="Descreva seu serviço...">{{ old('descricao') }}</textarea>
            @error('descricao') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label fw-600">Categoria <span class="text-danger">*</span></label>
            <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror" required>
                <option value="">Selecione uma categoria</option>
                <option value="encanamento" {{ old('categoria') == 'encanamento' ? 'selected' : '' }}>Encanamento</option>
                <option value="eletricidade" {{ old('categoria') == 'eletricidade' ? 'selected' : '' }}>Eletricidade</option>
                <option value="limpeza" {{ old('categoria') == 'limpeza' ? 'selected' : '' }}>Limpeza</option>
                <option value="reparo" {{ old('categoria') == 'reparo' ? 'selected' : '' }}>Reparo</option>
                <option value="culinaria" {{ old('categoria') == 'culinaria' ? 'selected' : '' }}>Culinária</option>
                <option value="outros" {{ old('categoria') == 'outros' ? 'selected' : '' }}>Outros</option>
            </select>
            @error('categoria') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="preco_estimado" class="form-label fw-600">Preço Estimado <span class="text-danger">*</span></label>
            <input type="number" name="preco_estimado" id="preco_estimado" step="0.01" class="form-control @error('preco_estimado') is-invalid @enderror" required value="{{ old('preco_estimado') }}" placeholder="0.00">
            @error('preco_estimado') <small class="text-danger">{{ $message }}</small> @enderror
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
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Salvar</button>
        </div>
    </form>
</div>
@endsection
