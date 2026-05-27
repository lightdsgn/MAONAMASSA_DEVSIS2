@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-calendar-plus me-2"></i>Novo Agendamento</h4>
    <a href="{{ route('agendamentos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <form action="{{ route('agendamentos.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-semibold">Serviço *</label>
                <select name="servico_id" class="form-select @error('servico_id') is-invalid @enderror" required>
                    <option value="">Selecione um serviço...</option>
                    @foreach($servicos as $s)
                    <option value="{{ $s->id }}" {{ (old('servico_id', $servico_id) == $s->id) ? 'selected' : '' }}>
                        {{ $s->titulo }} — {{ $s->usuario->nome }}
                        @if($s->preco_estimado)(R$ {{ number_format($s->preco_estimado,2,',','.') }})@endif
                    </option>
                    @endforeach
                </select>
                @error('servico_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Data *</label>
                <input type="date" name="data" class="form-control @error('data') is-invalid @enderror"
                    value="{{ old('data') }}" min="{{ date('Y-m-d') }}" required>
                @error('data') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Horário *</label>
                <input type="time" name="horario" class="form-control @error('horario') is-invalid @enderror"
                    value="{{ old('horario') }}" required>
                @error('horario') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Observações</label>
                <textarea name="observacoes" class="form-control" rows="3">{{ old('observacoes') }}</textarea>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Confirmar Agendamento</button>
        </div>
    </form>
</div>
@endsection
