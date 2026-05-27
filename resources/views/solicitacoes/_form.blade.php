<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Título *</label>
        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror"
            value="{{ old('titulo', $solicitacao->titulo ?? '') }}" required>
        @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Categoria *</label>
        <select name="categoria" class="form-select @error('categoria') is-invalid @enderror" required>
            <option value="">Selecione...</option>
            @foreach(['Elétrica','Hidráulica','Pintura','Marcenaria','Limpeza','Jardinagem','Informática','Alvenaria','Outros'] as $cat)
            <option value="{{ $cat }}" {{ old('categoria', $solicitacao->categoria ?? '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        @error('categoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    @if(isset($solicitacao) && $solicitacao)
    <div class="col-md-4">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select">
            @foreach(['aberta','em_andamento','concluida','cancelada'] as $st)
            <option value="{{ $st }}" {{ old('status', $solicitacao->status) === $st ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$st)) }}</option>
            @endforeach
        </select>
    </div>
    @endif
    <div class="col-md-4">
        <label class="form-label fw-semibold">Disponibilidade</label>
        <input type="date" name="disponibilidade" class="form-control"
            value="{{ old('disponibilidade', $solicitacao->disponibilidade ?? '') }}">
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Descrição *</label>
        <textarea name="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="4" required>{{ old('descricao', $solicitacao->descricao ?? '') }}</textarea>
        @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Foto</label>
        @if(isset($solicitacao) && $solicitacao?->foto)
            <div class="mb-2"><img src="{{ asset('storage/'.$solicitacao->foto) }}" height="80" class="rounded"></div>
        @endif
        <input type="file" name="foto" class="form-control" accept="image/*">
    </div>
</div>
