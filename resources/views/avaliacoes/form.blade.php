@php
    $selectedServico = old('servico_id', $servico_id ?? null);
@endphp

<div class="mb-3">
    <label class="form-label fw-semibold">Serviço *</label>
    <select name="servico_id" class="form-select @error('servico_id') is-invalid @enderror" required>
        <option value="">Selecione o serviço...</option>
        @foreach($servicos as $s)
        <option value="{{ $s->id }}" {{ $selectedServico == $s->id ? 'selected' : '' }}>
            {{ $s->titulo }} — {{ $s->usuario->nome }}
        </option>
        @endforeach
    </select>
    @error('servico_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Nota *</label>
    <div class="d-flex gap-2" id="estrelas">
        @for($i=1;$i<=5;$i++)
        <input type="radio" class="btn-check" name="nota" id="nota{{ $i }}" value="{{ $i }}"
            {{ old('nota') == $i ? 'checked' : '' }}>
        <label class="btn btn-outline-warning" for="nota{{ $i }}">
            <i class="bi bi-star-fill"></i> {{ $i }}
        </label>
        @endfor
    </div>
    @error('nota') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Comentário</label>
    <textarea name="comentario" class="form-control" rows="4" placeholder="Conte sua experiência...">{{ old('comentario') }}</textarea>
</div>
