<div class="row g-3">
    <div class="col-12">
        <label class="form-label fw-semibold">Agendamento *</label>
        <select name="agendamento_id" class="form-select @error('agendamento_id') is-invalid @enderror" required
            {{ isset($pagamento) && $pagamento->id ? 'disabled' : '' }}>
            <option value="">Selecione um agendamento concluído...</option>
            @foreach($agendamentos as $ag)
            <option value="{{ $ag->id }}"
                {{ old('agendamento_id', $pagamento->agendamento_id ?? request('agendamento_id')) == $ag->id ? 'selected' : '' }}>
                #{{ $ag->id }} — {{ $ag->servico->titulo }} ({{ $ag->cliente->nome }}) — {{ \Carbon\Carbon::parse($ag->data)->format('d/m/Y') }}
            </option>
            @endforeach
        </select>
        {{-- Campo oculto quando estiver no edit (disabled não envia o valor) --}}
        @isset($pagamento)
        <input type="hidden" name="agendamento_id" value="{{ $pagamento->agendamento_id }}">
        @endisset
        @error('agendamento_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Valor (R$) *</label>
        <input type="number" step="0.01" min="0.01" name="valor"
            class="form-control @error('valor') is-invalid @enderror"
            value="{{ old('valor', $pagamento->valor ?? '') }}" required>
        @error('valor') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Método de Pagamento *</label>
        <select name="metodo" class="form-select @error('metodo') is-invalid @enderror" required>
            <option value="">Selecione...</option>
            @foreach(['pix' => 'PIX', 'cartao_credito' => 'Cartão de Crédito', 'cartao_debito' => 'Cartão de Débito', 'boleto' => 'Boleto', 'dinheiro' => 'Dinheiro'] as $val => $label)
            <option value="{{ $val }}" {{ old('metodo', $pagamento->metodo ?? '') === $val ? 'selected' : '' }}>
                {{ $label }}
            </option>
            @endforeach
        </select>
        @error('metodo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Status *</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            @foreach(['pendente' => 'Pendente', 'pago' => 'Pago', 'cancelado' => 'Cancelado', 'estornado' => 'Estornado'] as $val => $label)
            <option value="{{ $val }}" {{ old('status', $pagamento->status ?? 'pendente') === $val ? 'selected' : '' }}>
                {{ $label }}
            </option>
            @endforeach
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Data do Pagamento</label>
        <input type="date" name="data_pagamento"
            class="form-control @error('data_pagamento') is-invalid @enderror"
            value="{{ old('data_pagamento', $pagamento->data_pagamento ?? '') }}">
        @error('data_pagamento') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
