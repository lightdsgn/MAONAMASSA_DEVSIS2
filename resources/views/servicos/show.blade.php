@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-tools me-2"></i>{{ $servico->titulo }}</h4>
    <a href="{{ route('servicos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>

<div class="row g-4">
    <div class="col-md-5">
        @if($servico->foto)
            <img src="{{ asset('storage/'.$servico->foto) }}" class="img-fluid rounded shadow" style="max-height:350px;width:100%;object-fit:cover;">
        @else
            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height:250px;font-size:5rem;">🔧</div>
        @endif
    </div>
    <div class="col-md-7">
        <span class="badge {{ $servico->status === 'ativo' ? 'bg-success' : 'bg-secondary' }} mb-2">{{ ucfirst($servico->status) }}</span>
        <h3 class="fw-bold">{{ $servico->titulo }}</h3>
        <p class="text-muted"><i class="bi bi-tag me-1"></i>{{ $servico->categoria ?? 'Sem categoria' }}</p>
        <p><i class="bi bi-person me-1"></i><strong>Prestador:</strong> {{ $servico->usuario->nome }}</p>
        @if($servico->preco_estimado)
        <p class="h4 text-success fw-bold">R$ {{ number_format($servico->preco_estimado,2,',','.') }}</p>
        @endif
        <p class="mt-3">{{ $servico->descricao }}</p>

        {{-- Avaliação média --}}
        @php $nota = $servico->notaMedia(); $total = $servico->avaliacoes->count(); @endphp
        <div class="mt-3">
            <strong>Avaliação:</strong>
            @for($i=1;$i<=5;$i++)
                <i class="bi bi-star{{ $i <= $nota ? '-fill text-warning' : ' text-muted' }}"></i>
            @endfor
            <span class="text-muted">({{ $total }} {{ Str::plural('avaliação', $total) }})</span>
        </div>

        <div class="mt-4 d-flex gap-2">
            @if(Auth::user()->isCliente())
                <a href="{{ route('agendamentos.create', ['servico_id'=>$servico->id]) }}" class="btn btn-primary">
                    <i class="bi bi-calendar-check me-1"></i>Agendar
                </a>
                <a href="{{ route('avaliacoes.create', ['servico_id'=>$servico->id]) }}" class="btn btn-outline-warning">
                    <i class="bi bi-star me-1"></i>Avaliar
                </a>
            @endif
            @if(Auth::user()->isAdm() || $servico->usuario_id === Auth::id())
                <a href="{{ route('servicos.edit', $servico) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil me-1"></i>Editar
                </a>
            @endif
        </div>
    </div>
</div>

{{-- Lista de avaliações --}}
@if($servico->avaliacoes->count())
<hr class="mt-5">
<h5 class="fw-bold mb-3">Avaliações dos clientes</h5>
@foreach($servico->avaliacoes()->with('usuario')->latest()->get() as $av)
<div class="card mb-2 p-3">
    <div class="d-flex justify-content-between">
        <strong>{{ $av->usuario->nome }}</strong>
        <span>
            @for($i=1;$i<=5;$i++)
                <i class="bi bi-star{{ $i <= $av->nota ? '-fill text-warning' : ' text-muted' }}"></i>
            @endfor
        </span>
    </div>
    @if($av->comentario)<p class="mb-0 text-muted small mt-1">{{ $av->comentario }}</p>@endif
</div>
@endforeach
@endif
@endsection
