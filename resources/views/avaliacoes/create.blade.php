@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-star-half me-2"></i>Avaliar Serviço</h4>
    <a href="{{ route('avaliacoes.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4" style="max-width:600px;">
    <form action="{{ route('avaliacoes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Serviço *</label>
            <select name="servico_id" class="form-select @error('servico_id') is-invalid @enderror" required>
                <option value="">Selecione o serviço...</option>
                @foreach($servicos as $s)
                <option value="{{ $s->id }}" {{ (old('servico_id', $servico_id) == $s->id) ? 'selected' : '' }}>
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
        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Enviar Avaliação</button>
    </form>
</div>
@endsection
