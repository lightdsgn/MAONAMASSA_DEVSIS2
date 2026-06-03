@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-pencil me-2"></i>Editar Avaliação</h4>
    <a href="{{ route('avaliacoes.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4" style="max-width:600px;">
    <form action="{{ route('avaliacoes.update', $avaliacao) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="nota" class="form-label fw-600">Nota <span class="text-danger">*</span></label>
            <div class="d-flex gap-2">
                @for($i = 1; $i <= 5; $i++)
                    <input type="radio" name="nota" value="{{ $i }}" id="nota{{ $i }}" {{ (isset($avaliacao) && $avaliacao->nota == $i) || old('nota') == $i ? 'checked' : '' }}>
                    <label for="nota{{ $i }}" style="cursor:pointer;"><i class="bi bi-star-fill text-warning"></i></label>
                @endfor
            </div>
            @error('nota') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="comentario" class="form-label fw-600">Comentário</label>
            <textarea name="comentario" id="comentario" class="form-control @error('comentario') is-invalid @enderror" rows="4" placeholder="Deixe seu comentário...">{{ isset($avaliacao) ? $avaliacao->comentario : old('comentario') }}</textarea>
            @error('comentario') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Atualizar</button>
        </div>
    </form>
</div>
@endsection
