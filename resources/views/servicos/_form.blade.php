<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Título *</label>
        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror"
            value="{{ old('titulo', $servico->titulo ?? '') }}" required>
        @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select">
            <option value="ativo"   {{ old('status', $servico->status ?? 'ativo') === 'ativo'   ? 'selected' : '' }}>Ativo</option>
            <option value="inativo" {{ old('status', $servico->status ?? '') === 'inativo' ? 'selected' : '' }}>Inativo</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Categoria</label>
        <select name="categoria" class="form-select @error('categoria') is-invalid @enderror">
            <option value="">Selecione...</option>
            @foreach(['Elétrica','Hidráulica','Pintura','Marcenaria','Limpeza','Jardinagem','Informática','Alvenaria','Outros'] as $cat)
            <option value="{{ $cat }}" {{ old('categoria', $servico->categoria ?? '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        @error('categoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Preço estimado (R$)</label>
        <input type="number" step="0.01" name="preco_estimado" class="form-control"
            value="{{ old('preco_estimado', $servico->preco_estimado ?? '') }}">
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Descrição</label>
        <textarea name="descricao" class="form-control" rows="4">{{ old('descricao', $servico->descricao ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Foto</label>
        @if(isset($servico) && $servico?->foto)
            <div class="mb-2"><img src="{{ asset('storage/'.$servico->foto) }}" height="80" class="rounded"></div>
        @endif
        <input type="file" name="foto" class="form-control" accept="image/*">
    </div>
</div>
