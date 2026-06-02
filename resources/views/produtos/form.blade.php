<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Nome *</label>
        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
            value="{{ old('nome', $produto->nome ?? '') }}" required>
        @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select">
            <option value="ativo"   {{ old('status', $produto->status ?? 'ativo')   === 'ativo'   ? 'selected' : '' }}>Ativo</option>
            <option value="inativo" {{ old('status', $produto->status ?? '') === 'inativo' ? 'selected' : '' }}>Inativo</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Categoria</label>
        <input type="text" name="categoria" class="form-control" value="{{ old('categoria', $produto->categoria ?? '') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Preço (R$) *</label>
        <input type="number" step="0.01" name="preco" class="form-control @error('preco') is-invalid @enderror"
            value="{{ old('preco', $produto->preco ?? '') }}" required>
        @error('preco') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Quantidade</label>
        <input type="number" min="0" name="quantidade" class="form-control"
            value="{{ old('quantidade', $produto->quantidade ?? 0) }}">
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Descrição</label>
        <textarea name="descricao" class="form-control" rows="3">{{ old('descricao', $produto->descricao ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Foto</label>
        @if(isset($produto) && $produto?->foto)
            <div class="mb-2"><img src="{{ asset('storage/'.$produto->foto) }}" height="80" class="rounded"></div>
        @endif
        <input type="file" name="foto" class="form-control" accept="image/*">
    </div>
</div>
