@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-pencil me-2"></i>Editar Serviço</h4>
    <a href="{{ route('servicos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <form action="{{ route('servicos.update', $servico) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="titulo" class="form-label fw-600">Título do Serviço <span class="text-danger">*</span></label>
            <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" required value="{{ isset($servico) ? $servico->titulo : old('titulo') }}" placeholder="Ex: Encanador Profissional">
            @error('titulo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label fw-600">Descrição <span class="text-danger">*</span></label>
            <textarea name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="4" required placeholder="Descreva seu serviço...">{{ isset($servico) ? $servico->descricao : old('descricao') }}</textarea>
            @error('descricao') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label fw-600">Categoria <span class="text-danger">*</span></label>
            <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror" required>
                <option value="">Selecione uma categoria</option>
                <option value="encanamento" {{ (isset($servico) && $servico->categoria == 'encanamento') || old('categoria') == 'encanamento' ? 'selected' : '' }}>Encanamento</option>
                <option value="eletricidade" {{ (isset($servico) && $servico->categoria == 'eletricidade') || old('categoria') == 'eletricidade' ? 'selected' : '' }}>Eletricidade</option>
                <option value="limpeza" {{ (isset($servico) && $servico->categoria == 'limpeza') || old('categoria') == 'limpeza' ? 'selected' : '' }}>Limpeza</option>
                <option value="reparo" {{ (isset($servico) && $servico->categoria == 'reparo') || old('categoria') == 'reparo' ? 'selected' : '' }}>Reparo</option>
                <option value="culinaria" {{ (isset($servico) && $servico->categoria == 'culinaria') || old('categoria') == 'culinaria' ? 'selected' : '' }}>Culinária</option>
                <option value="outros" {{ (isset($servico) && $servico->categoria == 'outros') || old('categoria') == 'outros' ? 'selected' : '' }}>Outros</option>
            </select>
            @error('categoria') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="preco_estimado" class="form-label fw-600">Preço Estimado <span class="text-danger">*</span></label>
            <input type="number" name="preco_estimado" id="preco_estimado" step="0.01" class="form-control @error('preco_estimado') is-invalid @enderror" required value="{{ isset($servico) ? $servico->preco_estimado : old('preco_estimado') }}" placeholder="0.00">
            @error('preco_estimado') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label fw-600">Foto</label>
            <input type="file" name="foto" id="foto" accept="image/*" class="form-control @error('foto') is-invalid @enderror">
            @if(isset($servico) && $servico->foto)
                <small class="text-muted">Foto atual: {{ $servico->foto }}</small>
            @endif
            @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label fw-600">Status <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="">Selecione um status</option>
                <option value="ativo" {{ (isset($servico) && $servico->status == 'ativo') || old('status') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ (isset($servico) && $servico->status == 'inativo') || old('status') == 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Atualizar</button>
        </div>
    </form>
</div>
@endsection
