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
    .page-title i { color: #fa4101; }

    .btn-outline-back {
        border: 1.5px solid #ddd; background: transparent; color: #555;
        border-radius: 9px; padding: 8px 16px;
        font-size: 0.82rem; font-weight: 700; text-decoration: none;
        display: inline-flex; align-items: center; gap: 6px;
        transition: border-color 0.2s, color 0.2s; font-family: 'Sora', sans-serif;
    }
    .btn-outline-back:hover { border-color: #fa4101; color: #fa4101; }

    .form-card {
        background: #fff; border: 1.5px solid #ececec;
        border-radius: 16px; overflow: hidden;
    }
    .form-card-header {
        padding: 20px 28px; border-bottom: 1.5px solid #f0f0f0;
        display: flex; align-items: center; justify-content: space-between;
    }
    .form-card-header-left { display: flex; align-items: center; gap: 10px; }
    .form-card-header span.title {
        font-size: 0.82rem; font-weight: 800; color: #111;
        text-transform: uppercase; letter-spacing: .4px;
    }
    .form-card-header i { color: #fa4101; }

    .tag {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.68rem; font-weight: 700;
        padding: 4px 11px; border-radius: 20px; white-space: nowrap;
    }
    .tag::before { content:''; width:5px; height:5px; border-radius:50%; background:currentColor; opacity:.5; }
    .tag-pendente  { background: #fdf6e3; color: #8a6000; }
    .tag-pago      { background: #e8f6ef; color: #145c37; }
    .tag-cancelado { background: #f0f0f0; color: #888; }
    .tag-estornado { background: #fff1ec; color: #c73200; }

    .form-card-body { padding: 28px; }
    .form-card-footer {
        padding: 20px 28px; border-top: 1.5px solid #f0f0f0;
        display: flex; align-items: center; justify-content: space-between; gap: 10px;
    }

    .form-label { font-size: 0.8rem; font-weight: 700; color: #444; margin-bottom: 6px; }
    .form-control, .form-select {
        border: 1.5px solid #e8e8e8; border-radius: 10px;
        font-size: 0.85rem; font-family: 'Sora', sans-serif;
        color: #333; padding: 10px 14px; transition: border-color .2s;
        width: 100%;
    }
    .form-control:focus, .form-select:focus {
        border-color: #fa4101; box-shadow: 0 0 0 3px rgba(250,65,1,.08); outline: none;
    }
    .form-control.is-invalid, .form-select.is-invalid { border-color: #dc3545; }
    .invalid-feedback { font-size: 0.75rem; color: #dc3545; margin-top: 4px; display: block; }

    /* info box do agendamento selecionado */
    .agend-info {
        background: #fff8f5; border: 1.5px solid #fdd0bc;
        border-radius: 10px; padding: 12px 16px;
        display: flex; align-items: center; gap: 12px;
        margin-top: 8px;
    }
    .agend-info i { color: #fa4101; font-size: 18px; flex-shrink: 0; }
    .agend-info-text { font-size: 0.78rem; color: #555; line-height: 1.6; }
    .agend-info-text strong { color: #111; font-weight: 700; }

    /* input com prefixo R$ */
    .input-group-custom { position: relative; }
    .input-group-custom .prefix {
        position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
        font-size: 0.85rem; font-weight: 700; color: #aaa;
        pointer-events: none;
    }
    .input-group-custom .form-control { padding-left: 34px; }

    .btn-submit {
        background: #fa4101; color: #fff; border: none;
        border-radius: 9px; padding: 10px 24px;
        font-size: 0.85rem; font-weight: 700;
        display: inline-flex; align-items: center; gap: 7px;
        cursor: pointer; transition: background .2s; font-family: 'Sora', sans-serif;
    }
    .btn-submit:hover { background: #c73200; }

    .btn-view {
        text-decoration: none; color: #666;
        border: 1.5px solid #e8e8e8; border-radius: 9px; padding: 9px 16px;
        font-size: 0.82rem; font-weight: 700;
        display: inline-flex; align-items: center; gap: 6px;
        transition: all .2s; font-family: 'Sora', sans-serif;
    }
    .btn-view:hover { border-color: #fa4101; color: #fa4101; }

    .section-divider {
        font-size: 0.7rem; font-weight: 800; color: #ccc;
        text-transform: uppercase; letter-spacing: 1px;
        margin-bottom: 14px; margin-top: 6px;
        display: flex; align-items: center; gap: 10px;
    }
    .section-divider::after {
        content: ''; flex: 1; height: 1px; background: #f0f0f0;
    }

    @media(max-width:576px) {
        .dash { padding: 16px; }
        .form-card-body { padding: 18px 16px; }
        .form-card-footer { flex-direction: column-reverse; }
        .btn-submit, .btn-view { width: 100%; justify-content: center; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title">
            <i class="fa-solid fa-pencil"></i> Editar Pagamento
        </h4>
        <a href="{{ route('pagamentos.index') }}" class="btn-outline-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="form-card">

        {{-- HEADER DO CARD --}}
        <div class="form-card-header">
            <div class="form-card-header-left">
                <i class="fa-solid fa-credit-card"></i>
                <span class="title">Pgto. #{{ $pagamento->id }} — {{ $pagamento->agendamento->servico->titulo }}</span>
            </div>
            <span class="tag tag-{{ $pagamento->status }}">{{ ucfirst($pagamento->status) }}</span>
        </div>

        <form action="{{ route('pagamentos.update', $pagamento) }}" method="POST">
            @csrf @method('PUT')

            <div class="form-card-body">
                <div class="row g-3">

                    {{-- AGENDAMENTO --}}
                    <div class="col-12">
                        <div class="section-divider">Agendamento</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Agendamento <span class="text-danger">*</span></label>
                        <select name="agendamento_id" id="agendamento_id"
                            class="form-select @error('agendamento_id') is-invalid @enderror" required>
                            <option value="">Selecione um agendamento</option>
                            @foreach($agendamentos as $agend)
                                <option value="{{ $agend->id }}"
                                    data-servico="{{ $agend->servico->titulo }}"
                                    data-cliente="{{ $agend->cliente->nome }}"
                                    data-prestador="{{ $agend->servico->usuario->nome }}"
                                    {{ $pagamento->agendamento_id == $agend->id ? 'selected' : '' }}>
                                    #{{ $agend->id }} — {{ $agend->servico->titulo }} ({{ $agend->cliente->nome }})
                                </option>
                            @endforeach
                        </select>
                        @error('agendamento_id') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        {{-- Info box dinâmica --}}
                        <div class="agend-info" id="agend-info"
                            style="{{ $pagamento->agendamento_id ? '' : 'display:none' }}">
                            <i class="fa-solid fa-circle-info"></i>
                            <div class="agend-info-text" id="agend-info-text">
                                <strong>Serviço:</strong> {{ $pagamento->agendamento->servico->titulo }}<br>
                                <strong>Cliente:</strong> {{ $pagamento->agendamento->cliente->nome }}
                                &nbsp;&bull;&nbsp;
                                <strong>Prestador:</strong> {{ $pagamento->agendamento->servico->usuario->nome }}
                            </div>
                        </div>
                    </div>

                    {{-- VALOR + MÉTODO --}}
                    <div class="col-12">
                        <div class="section-divider" style="margin-top:10px">Dados do Pagamento</div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Valor <span class="text-danger">*</span></label>
                        <div class="input-group-custom">
                            <span class="prefix">R$</span>
                            <input type="number" name="valor" step="0.01" min="0.01"
                                class="form-control @error('valor') is-invalid @enderror"
                                value="{{ old('valor', $pagamento->valor) }}"
                                placeholder="0,00" required>
                        </div>
                        @error('valor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Método <span class="text-danger">*</span></label>
                        <select name="metodo" class="form-select @error('metodo') is-invalid @enderror" required>
                            <option value="">Selecione...</option>
                            @foreach([
                                'pix'            => 'PIX',
                                'cartao_credito' => 'Cartão de Crédito',
                                'cartao_debito'  => 'Cartão de Débito',
                                'boleto'         => 'Boleto',
                                'dinheiro'       => 'Dinheiro',
                            ] as $val => $label)
                                <option value="{{ $val }}" {{ old('metodo', $pagamento->metodo) === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('metodo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="">Selecione...</option>
                            @foreach([
                                'pendente'  => 'Pendente',
                                'pago'      => 'Pago',
                                'cancelado' => 'Cancelado',
                                'estornado' => 'Estornado',
                            ] as $val => $label)
                                <option value="{{ $val }}" {{ old('status', $pagamento->status) === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Data do Pagamento</label>
                        <input type="date" name="data_pagamento"
                            class="form-control @error('data_pagamento') is-invalid @enderror"
                            value="{{ old('data_pagamento', $pagamento->data_pagamento) }}">
                        @error('data_pagamento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                </div>
            </div>

            <div class="form-card-footer">
                <a href="{{ route('pagamentos.show', $pagamento) }}" class="btn-view">
                    <i class="fa-solid fa-eye"></i> Ver Pagamento
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> Salvar Alterações
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    // Atualiza o info box ao trocar agendamento
    const select = document.getElementById('agendamento_id');
    const box    = document.getElementById('agend-info');
    const text   = document.getElementById('agend-info-text');

    select.addEventListener('change', function () {
        const opt = this.options[this.selectedIndex];
        if (!this.value) { box.style.display = 'none'; return; }
        text.innerHTML =
            '<strong>Serviço:</strong> '   + opt.dataset.servico   + '<br>' +
            '<strong>Cliente:</strong> '   + opt.dataset.cliente   +
            ' &bull; <strong>Prestador:</strong> ' + opt.dataset.prestador;
        box.style.display = 'flex';
    });
</script>

@endsection