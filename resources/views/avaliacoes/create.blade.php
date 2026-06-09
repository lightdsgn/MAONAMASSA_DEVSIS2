@extends('layouts.app')
@section('content')

<style>
    .dash { padding: 36px 32px; font-family: 'Sora', sans-serif; }

    .page-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 28px; gap: 16px;
    }
    .page-title {
        font-size: 1.3rem; font-weight: 900; color: #111;
        letter-spacing: -0.5px; margin: 0;
        display: flex; align-items: center; gap: 10px;
    }
    .page-title i { color: #fa4101; font-size: 1.2rem; }

    .btn-outline-back {
        border: 1.5px solid #ddd; background: transparent; color: #555;
        border-radius: 9px; padding: 8px 16px;
        font-size: 0.82rem; font-weight: 700; text-decoration: none;
        display: inline-flex; align-items: center; gap: 6px;
        transition: border-color 0.2s, color 0.2s;
        font-family: 'Sora', sans-serif;
    }
    .btn-outline-back:hover { border-color: #fa4101; color: #fa4101; }

    .av-form-card {
        background: #fff;
        border: 1.5px solid #ececec;
        border-radius: 16px;
        padding: 28px 32px;
        max-width: 580px;
    }

    /* Info do serviço */
    .servico-info {
        background: #fafafa;
        border: 1.5px solid #ececec;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .servico-info-titulo {
        font-size: 1rem; font-weight: 800; color: #111; letter-spacing: -0.2px;
    }
    .servico-info-meta {
        display: flex; flex-wrap: wrap; gap: 12px;
    }
    .servico-info-item {
        display: flex; align-items: center; gap: 6px;
        font-size: 0.78rem; color: #888;
    }
    .servico-info-item i { color: #ccc; font-size: 12px; }
    .servico-info-item strong { color: #555; font-weight: 600; }

    /* Estrelas interativas */
    .star-rating { display: flex; gap: 6px; margin-bottom: 4px; }
    .star-rating input[type="radio"] { display: none; }
    .star-rating label {
        font-size: 2rem; cursor: pointer; color: #ddd;
        transition: color 0.15s, transform 0.15s;
        line-height: 1;
    }
    .star-rating input[type="radio"]:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label { color: #f9a825; }
    /* Trick: hover reversal — stars must be laid out RTL in HTML */
    /* RTL trick: stars rendered 5→1 in HTML so ~ selector works correctly */
    .star-rating { flex-direction: row-reverse; justify-content: flex-end; }
    .star-rating label:hover,
    .star-rating label:hover ~ label,
    .star-rating input[type="radio"]:checked ~ label { color: #f9a825; }

    .form-label-custom {
        font-size: 0.82rem; font-weight: 700; color: #444;
        margin-bottom: 8px; display: block;
    }

    .btn-submit {
        background: #fa4101; color: #fff; border: none;
        border-radius: 9px; padding: 10px 24px;
        font-size: 0.85rem; font-weight: 700;
        display: inline-flex; align-items: center; gap: 7px;
        transition: background 0.2s; font-family: 'Sora', sans-serif; cursor: pointer;
    }
    .btn-submit:hover { background: #c73200; }

    @media(max-width:576px) {
        .dash { padding: 16px; }
        .av-form-card { padding: 20px 16px; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="fa-solid fa-star-half-stroke"></i> Avaliar Serviço</h4>
        <a href="{{ route('avaliacoes.index') }}" class="btn-outline-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="av-form-card">

        {{-- Resumo do agendamento/serviço --}}
        <div class="servico-info">
            <div class="servico-info-titulo">{{ $agendamento->servico->titulo }}</div>
            <div class="servico-info-meta">
                <div class="servico-info-item">
                    <i class="fa-solid fa-person-gear"></i>
                    <span>Prestador: <strong>{{ $agendamento->servico->usuario->nome }}</strong></span>
                </div>
                <div class="servico-info-item">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Concluído em: <strong>{{ $agendamento->updated_at?->format('d/m/Y') ?? '—' }}</strong></span>
                </div>
            </div>
        </div>

        <form action="{{ route('avaliacoes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="agendamento_id" value="{{ $agendamento->id }}">

            {{-- Nota --}}
            <div class="mb-4">
                <label class="form-label-custom">Nota <span class="text-danger">*</span></label>
                <div class="star-rating">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" name="nota" value="{{ $i }}" id="nota{{ $i }}"
                            {{ old('nota') == $i ? 'checked' : '' }}>
                        <label for="nota{{ $i }}" title="{{ $i }} estrela{{ $i > 1 ? 's' : '' }}">
                            <i class="fa-solid fa-star"></i>
                        </label>
                    @endfor
                </div>
                @error('nota')
                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            {{-- Comentário --}}
            <div class="mb-4">
                <label for="comentario" class="form-label-custom">Comentário</label>
                <textarea name="comentario" id="comentario"
                    class="form-control @error('comentario') is-invalid @enderror"
                    rows="4"
                    placeholder="Conte como foi sua experiência com o serviço...">{{ old('comentario') }}</textarea>
                @error('comentario')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mb-3" style="font-size:0.82rem;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-check"></i> Enviar Avaliação
            </button>
        </form>

    </div>
</div>

<script>
// Highlight stars on hover using pure CSS trick (RTL layout)
// The star-rating CSS handles this via flex-direction: row-reverse
</script>
@endsection