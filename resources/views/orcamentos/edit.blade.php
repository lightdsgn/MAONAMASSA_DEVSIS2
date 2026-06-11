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
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
    }
    .form-card-header-left { display: flex; align-items: center; gap: 10px; }
    .form-card-header i { color: #fa4101; }
    .form-card-header .card-title {
        font-size: 0.82rem; font-weight: 800; color: #111;
        text-transform: uppercase; letter-spacing: .4px;
    }
    .form-card-header .card-sub { font-size: 0.75rem; color: #aaa; margin-top: 1px; }

    .status-tag {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.68rem; font-weight: 700;
        padding: 4px 11px; border-radius: 20px; white-space: nowrap;
    }
    .status-tag::before { content:''; width:5px; height:5px; border-radius:50%; background:currentColor; opacity:.5; }
    .status-pendente { background: #fdf6e3; color: #8a6000; }
    .status-aceito   { background: #e8f6ef; color: #145c37; }
    .status-recusado { background: #fff1ec; color: #c73200; }

    .form-card-body { padding: 28px; }
    .form-card-footer {
        padding: 20px 28px; border-top: 1.5px solid #f0f0f0;
        display: flex; align-items: center; justify-content: space-between; gap: 10px;
    }

    .form-label { font-size: 0.8rem; font-weight: 700; color: #444; margin-bottom: 6px; display: block; }
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
    textarea.form-control { resize: vertical; min-height: 100px; }
    .invalid-feedback { font-size: 0.75rem; color: #dc3545; margin-top: 4px; display: block; }

    /* prefixo R$ */
    .input-prefix-wrap { position: relative; }
    .input-prefix-wrap .prefix {
        position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
        font-size: 0.85rem; font-weight: 700; color: #aaa; pointer-events: none;
    }
    .input-prefix-wrap .form-control { padding-left: 34px; }

    /* info box seleção */
    .select-info {
        background: #fff8f5; border: 1.5px solid #fdd0bc;
        border-radius: 10px; padding: 10px 14px; margin-top: 8px;
        font-size: 0.78rem; color: #555; line-height: 1.6;
        display: none;
    }
    .select-info.visible { display: block; }
    .select-info strong { color: #fa4101; font-weight: 700; }

    /* total calculado */
    .total-preview {
        background: #f7f7f7; border: 1.5px solid #eee;
        border-radius: 10px; padding: 12px 16px; margin-top: 8px;
        display: flex; align-items: center; justify-content: space-between;
    }
    .total-preview .label { font-size: 0.75rem; font-weight: 700; color: #aaa; text-transform: uppercase; letter-spacing: 0.6px; }
    .total-preview .value { font-size: 1.1rem; font-weight: 900; color: #fa4101; letter-spacing: -0.5px; }

    /* section divider */
    .section-divider {
        font-size: 0.7rem; font-weight: 800; color: #ccc;
        text-transform: uppercase; letter-spacing: 1px;
        margin-bottom: 14px; margin-top: 6px;
        display: flex; align-items: center; gap: 10px;
    }
    .section-divider::after { content: ''; flex: 1; height: 1px; background: #f0f0f0; }

    .row { display: flex; flex-wrap: wrap; gap: 16px; }
    .col-full  { flex: 1 1 100%; }
    .col-half  { flex: 1 1 calc(50% - 8px); min-width: 180px; }
    .col-third { flex: 1 1 calc(33.33% - 11px); min-width: 150px; }

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

    @media(max-width:576px) {
        .dash { padding: 16px; }
        .form-card-body { padding: 18px 16px; }
        .col-half, .col-third { flex: 1 1 100%; }
        .form-card-footer { flex-direction: column-reverse; }
        .btn-submit, .btn-view { width: 100%; justify-content: center; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title">
            <i class="fa-solid fa-file-invoice-dollar"></i> Editar Orçamento
        </h4>
        <a href="{{ route('orcamentos.index') }}" class="btn-outline-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="form-card">

        <div class="form-card-header">
            <div class="form-card-header-left">
                <i class="fa-solid fa-file-invoice-dollar"></i>
                <div>
                    <div class="card-title">Orçamento #{{ $orcamento->id }}</div>
                    <div class="card-sub">{{ $orcamento->solicitacao->titulo ?? 'Solicitação não encontrada' }}</div>
                </div>
            </div>
            <span class="status-tag status-{{ $orcamento->status }}">{{ ucfirst($orcamento->status) }}</span>
        </div>

        <form action="{{ route('orcamentos.update', $orcamento) }}" method="POST">
            @csrf @method('PUT')

            <div class="form-card-body">

                {{-- VÍNCULOS --}}
                <div class="section-divider">Vínculos</div>
                <div class="row">

                    <div class="col-half">
                        <label class="form-label">Solicitação <span class="text-danger">*</span></label>
                        <select name="solicitacao_id" id="solicitacao_id"
                            class="form-select @error('solicitacao_id') is-invalid @enderror" required>
                            <option value="">Selecione uma solicitação</option>
                            @foreach($solicitacoes ?? [] as $sol)
                                <option value="{{ $sol->id }}"
                                    data-titulo="{{ $sol->titulo }}"
                                    data-categoria="{{ $sol->categoria ?? '' }}"
                                    {{ old('solicitacao_id', $orcamento->solicitacao_id) == $sol->id ? 'selected' : '' }}>
                                    #{{ $sol->id }} — {{ Str::limit($sol->titulo, 40) }}
                                </option>
                            @endforeach
                        </select>
                        @error('solicitacao_id') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        <div class="select-info {{ $orcamento->solicitacao_id ? 'visible' : '' }}" id="sol-info">
                            <strong>{{ $orcamento->solicitacao->titulo ?? '' }}</strong>
                            @if($orcamento->solicitacao->categoria ?? false)
                                &bull; {{ $orcamento->solicitacao->categoria }}
                            @endif
                        </div>
                    </div>

                    <div class="col-half">
                        <label class="form-label">Serviço <span class="text-danger">*</span></label>
                        <select name="servico_id" id="servico_id"
                            class="form-select @error('servico_id') is-invalid @enderror" required>
                            <option value="">Selecione um serviço</option>
                            @foreach($servicos ?? [] as $serv)
                                <option value="{{ $serv->id }}"
                                    data-titulo="{{ $serv->titulo }}"
                                    data-prestador="{{ $serv->usuario->nome ?? '' }}"
                                    data-preco="{{ $serv->preco_estimado ?? '' }}"
                                    {{ old('servico_id', $orcamento->servico_id) == $serv->id ? 'selected' : '' }}>
                                    {{ $serv->titulo }}
                                </option>
                            @endforeach
                        </select>
                        @error('servico_id') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        <div class="select-info {{ $orcamento->servico_id ? 'visible' : '' }}" id="serv-info">
                            <strong>{{ $orcamento->servico->titulo ?? '' }}</strong>
                            @if($orcamento->servico->usuario->nome ?? false)
                                &bull; {{ $orcamento->servico->usuario->nome }}
                            @endif
                            @if($orcamento->servico->preco_estimado ?? false)
                                &bull; Preço estimado: R$ {{ number_format($orcamento->servico->preco_estimado, 2, ',', '.') }}
                            @endif
                        </div>
                    </div>

                </div>

                {{-- VALORES --}}
                <div class="section-divider" style="margin-top:20px;">Valores</div>
                <div class="row">

                    <div class="col-half">
                        <label class="form-label">Mão de Obra</label>
                        <div class="input-prefix-wrap">
                            <span class="prefix">R$</span>
                            <input type="number" name="mao_de_obra" id="mao_de_obra"
                                step="0.01" min="0"
                                class="form-control @error('mao_de_obra') is-invalid @enderror"
                                value="{{ old('mao_de_obra', $orcamento->mao_de_obra) }}"
                                placeholder="0,00"
                                oninput="calcTotal()">
                        </div>
                        @error('mao_de_obra') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-half">
                        <label class="form-label">Valor Total <span class="text-danger">*</span></label>
                        <div class="input-prefix-wrap">
                            <span class="prefix">R$</span>
                            <input type="number" name="valor_total" id="valor_total"
                                step="0.01" min="0"
                                class="form-control @error('valor_total') is-invalid @enderror"
                                value="{{ old('valor_total', $orcamento->valor_total) }}"
                                placeholder="0,00" required
                                oninput="calcTotal()">
                        </div>
                        @error('valor_total') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-full">
                        <div class="total-preview">
                            <span class="label">Total do Orçamento</span>
                            <span class="value" id="totalDisplay">
                                R$ {{ number_format($orcamento->valor_total, 2, ',', '.') }}
                            </span>
                        </div>
                    </div>

                </div>

                {{-- PRAZO E STATUS --}}
                <div class="section-divider" style="margin-top:20px;">Prazo & Status</div>
                <div class="row">

                    <div class="col-half">
                        <label class="form-label">Prazo <span class="text-danger">*</span></label>
                        <input type="text" name="prazo"
                            class="form-control @error('prazo') is-invalid @enderror"
                            value="{{ old('prazo', $orcamento->prazo) }}"
                            placeholder="Ex: 15 dias" required>
                        @error('prazo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-half">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="">Selecione...</option>
                            @foreach([
                                'pendente' => 'Pendente',
                                'aceito'   => 'Aceito',
                                'recusado' => 'Recusado',
                            ] as $val => $label)
                                <option value="{{ $val }}" {{ old('status', $orcamento->status) === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                </div>

                {{-- OBSERVAÇÕES --}}
                <div class="section-divider" style="margin-top:20px;">Observações</div>
                <div class="row">
                    <div class="col-full">
                        <textarea name="observacoes" rows="3"
                            class="form-control @error('observacoes') is-invalid @enderror"
                            placeholder="Observações adicionais sobre o orçamento...">{{ old('observacoes', $orcamento->observacoes) }}</textarea>
                        @error('observacoes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

            </div>

            <div class="form-card-footer">
                <a href="{{ route('orcamentos.show', $orcamento) }}" class="btn-view">
                    <i class="fa-solid fa-eye"></i> Ver Orçamento
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> Salvar Alterações
                </button>
            </div>

        </form>
    </div>

</div>

<script>
    // Info box da solicitação
    document.getElementById('solicitacao_id').addEventListener('change', function () {
        const opt  = this.options[this.selectedIndex];
        const box  = document.getElementById('sol-info');
        if (!this.value) { box.classList.remove('visible'); return; }
        box.innerHTML = '<strong>' + opt.dataset.titulo + '</strong>'
            + (opt.dataset.categoria ? ' &bull; ' + opt.dataset.categoria : '');
        box.classList.add('visible');
    });

    // Info box do serviço
    document.getElementById('servico_id').addEventListener('change', function () {
        const opt = this.options[this.selectedIndex];
        const box = document.getElementById('serv-info');
        if (!this.value) { box.classList.remove('visible'); return; }
        let html = '<strong>' + opt.dataset.titulo + '</strong>';
        if (opt.dataset.prestador) html += ' &bull; ' + opt.dataset.prestador;
        if (opt.dataset.preco)     html += ' &bull; Preço estimado: R$ ' + parseFloat(opt.dataset.preco).toLocaleString('pt-BR', {minimumFractionDigits:2});
        box.innerHTML = html;
        box.classList.add('visible');
    });

    // Preview do total
    function calcTotal() {
        const total = parseFloat(document.getElementById('valor_total').value) || 0;
        document.getElementById('totalDisplay').textContent =
            'R$ ' + total.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }
</script>

@endsection