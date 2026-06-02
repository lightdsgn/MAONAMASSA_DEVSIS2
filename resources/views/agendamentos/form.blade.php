@php
    $isEdit = isset($agendamento) && $agendamento;
    $selectedServico = old('servico_id', $servico_id ?? null);
@endphp

<div class="row g-3">
    @if (! $isEdit)
    <div class="col-12">
        <label class="form-label fw-semibold">Serviço *</label>
        <select name="servico_id" class="form-select @error('servico_id') is-invalid @enderror" required>
            <option value="">Selecione um serviço...</option>
            @foreach($servicos as $s)
            <option value="{{ $s->id }}" {{ $selectedServico == $s->id ? 'selected' : '' }}>
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
    @elseif(Auth::user()->isCliente())
    <div class="col-12">
        <label class="form-label fw-semibold">Serviço</label>
        <input type="text" class="form-control" value="{{ $agendamento->servico->titulo }}" disabled>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Data</label>
        <input type="date" name="data" class="form-control" value="{{ old('data', $agendamento->data) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Horário</label>
        <input type="time" name="horario" class="form-control" value="{{ old('horario', $agendamento->horario) }}">
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Observações</label>
        <textarea name="observacoes" class="form-control" rows="3">{{ old('observacoes', $agendamento->observacoes) }}</textarea>
    </div>
    @else
    <div class="col-md-6">
        <label class="form-label fw-semibold">Serviço</label>
        <input type="text" class="form-control" value="{{ $agendamento->servico->titulo }}" disabled>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select">
            @foreach(['pendente','confirmado','concluido','cancelado'] as $st)
            <option value="{{ $st }}" {{ (old('status', $agendamento->status) === $st) ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
            @endforeach
        </select>
    </div>
    @endif
</div>
