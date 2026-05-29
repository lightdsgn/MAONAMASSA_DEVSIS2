<div class="row g-3">
    <div class="col-12">
        <label class="form-label fw-semibold">Solicitação *</label>
        <select name="solicitacao_id" class="form-select @error('solicitacao_id') is-invalid @enderror" required>
            <option value="">Selecione...</option>
            @foreach($solicitacoes as $sol)
            <option value="{{ $sol->id }}"
                {{ old('solicitacao_id', $orcamento->solicitacao_id ?? request('solicitacao_id')) == $sol->id ? 'selected' : '' }}>
                #{{ $sol->id }} — {{ $sol->titulo }}
            </option>
            @endforeach
        </select>
        @error('solicitacao_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Mão de Obra (R$) *</label>
        <input type="number" step="0.01" name="mao_de_obra" class="form-control @error('mao_de_obra') is-invalid @enderror"
            value="{{ old('mao_de_obra', $orcamento->mao_de_obra ?? '') }}" required>
        @error('mao_de_obra') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Valor Total (R$) *</label>
        <input type="number" step="0.01" name="valor_total" class="form-control @error('valor_total') is-invalid @enderror"
            value="{{ old('valor_total', $orcamento->valor_total ?? '') }}" required>
        @error('valor_total') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Prazo (dias) *</label>
        <input type="number" min="1" name="prazo" class="form-control @error('prazo') is-invalid @enderror"
            value="{{ old('prazo', $orcamento->prazo ?? '') }}" required>
        @error('prazo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Status</label>
        @if(Auth::user()->isAdm())
        <select name="status" class="form-select">
            @foreach(['pendente','aceito','recusado'] as $st)
            <option value="{{ $st }}" {{ old('status', $orcamento->status ?? 'pendente') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
            @endforeach
        </select>
        @else
        <input type="text" class="form-control" value="{{ ucfirst($orcamento->status ?? 'pendente') }}" disabled>
        <input type="hidden" name="status" value="{{ old('status', $orcamento->status ?? 'pendente') }}">
        @endif
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Observações</label>
        <textarea name="observacoes" class="form-control" rows="3">{{ old('observacoes', $orcamento->observacoes ?? '') }}</textarea>
    </div>
</div>
