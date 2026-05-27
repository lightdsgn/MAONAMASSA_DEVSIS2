@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-star me-2"></i>Avaliação</h4>
    <a href="{{ route('avaliacoes.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4" style="max-width:600px;">
    <h5 class="fw-bold">{{ $avaliacao->servico->titulo }}</h5>
    <p class="text-muted">Prestador: {{ $avaliacao->servico->usuario->nome }}</p>
    <div class="mb-3">
        @for($i=1;$i<=5;$i++)
            <i class="bi bi-star{{ $i <= $avaliacao->nota ? '-fill text-warning' : ' text-muted' }} fs-4"></i>
        @endfor
        <span class="ms-2 fw-bold">{{ $avaliacao->nota }}/5</span>
    </div>
    @if($avaliacao->comentario)
    <blockquote class="blockquote">
        <p class="text-muted">{{ $avaliacao->comentario }}</p>
    </blockquote>
    @endif
    <hr>
    <small class="text-muted">Por: {{ $avaliacao->usuario->nome }} · {{ $avaliacao->created_at->format('d/m/Y') }}</small>
</div>
@endsection
