@extends('layouts.app')
@section('content')

<style>
    .dash { padding: 36px 32px; font-family: 'Sora', sans-serif; }
    .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; gap: 16px; }
    .page-title { font-size: 1.3rem; font-weight: 900; color: #111; letter-spacing: -0.5px; margin: 0; display: flex; align-items: center; gap: 10px; }
    .page-title i { color: #fa4101; }
    .btn-outline-back { border: 1.5px solid #ddd; background: transparent; color: #555; border-radius: 9px; padding: 8px 16px; font-size: 0.82rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: border-color 0.2s, color 0.2s; font-family: 'Sora', sans-serif; }
    .btn-outline-back:hover { border-color: #fa4101; color: #fa4101; }

    .form-card { background: #fff; border: 1.5px solid #ececec; border-radius: 16px; overflow: hidden; margin-bottom: 20px; }
    .form-card-header { padding: 16px 28px; border-bottom: 1.5px solid #f0f0f0; display: flex; align-items: center; gap: 10px; }
    .form-card-header span { font-size: 0.78rem; font-weight: 800; color: #111; text-transform: uppercase; letter-spacing: .4px; }
    .form-card-header i { color: #fa4101; }
    .form-card-body { padding: 28px; }
    .form-card-footer { padding: 20px 28px; border-top: 1.5px solid #f0f0f0; display: flex; align-items: center; gap: 10px; }

    .form-label { font-size: 0.8rem; font-weight: 700; color: #444; margin-bottom: 6px; }
    .form-control, .form-select { border: 1.5px solid #e8e8e8; border-radius: 10px; font-size: 0.85rem; font-family: 'Sora', sans-serif; color: #333; padding: 10px 14px; transition: border-color .2s; }
    .form-control:focus, .form-select:focus { border-color: #fa4101; box-shadow: 0 0 0 3px rgba(250,65,1,.08); outline: none; }
    textarea.form-control { resize: vertical; min-height: 90px; }

    .info-banner { background: #ebf5ff; border: 1.5px solid #c8e4fb; border-radius: 12px; padding: 11px 18px; font-size: 0.82rem; font-weight: 600; color: #0c5fa5; display: flex; align-items: center; gap: 9px; margin-bottom: 20px; }
    .info-banner i { font-size: 15px; flex-shrink: 0; }

    .btn-submit { background: #fa4101; color: #fff; border: none; border-radius: 9px; padding: 10px 24px; font-size: 0.85rem; font-weight: 700; display: inline-flex; align-items: center; gap: 7px; cursor: pointer; transition: background .2s; font-family: 'Sora', sans-serif; }
    .btn-submit:hover { background: #c73200; }

    @media(max-width:576px) { .dash { padding: 16px; } .form-card-body { padding: 18px 16px; } }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="fa-solid fa-calendar-plus"></i> Novo Agendamento</h4>
        <a href="{{ route('agendamentos.index') }}" class="btn-outline-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    @if($orcamento_id)
    <div class="info-banner">
        <i class="fa-solid fa-circle-info"></i>
        Agendamento vinculado a um orçamento aceito. O serviço já foi pré-selecionado.
    </div>
    @endif

    <div class="form-card">
        <div class="form-card-header">
            <i class="fa-solid fa-calendar-check"></i>
            <span>Dados do Agendamento</span>
        </div>

        <form action="{{ route('agendamentos.store') }}" method="POST">
            @csrf
            @if($orcamento_id)
                <input type="hidden" name="orcamento_id" value="{{ $orcamento_id }}">
            @endif

            <div class="form-card-body">
                <div class="row g-3">

                    <div class="col-12">
                        <label class="form-label">Serviço <span class="text-danger">*</span></label>
                        <select name="servico_id" class="form-select @error('servico_id') is-invalid @enderror" required>
                            <option value="">Selecione um serviço...</option>
                            @foreach($servicos as $s)
                            <option value="{{ $s->id }}"
                                {{ old('servico_id', $servico_id) == $s->id ? 'selected' : '' }}>
                                {{ $s->titulo }} — {{ $s->usuario->nome }}
                                @if($s->preco_estimado) (R$ {{ number_format($s->preco_estimado, 2, ',', '.') }}) @endif
                            </option>
                            @endforeach
                        </select>
                        @error('servico_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Data <span class="text-danger">*</span></label>
                        <input type="date" name="data"
                            class="form-control @error('data') is-invalid @enderror"
                            value="{{ old('data') }}" min="{{ date('Y-m-d') }}" required>
                        @error('data') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Horário <span class="text-danger">*</span></label>
                        <input type="time" name="horario"
                            class="form-control @error('horario') is-invalid @enderror"
                            value="{{ old('horario') }}" required>
                        @error('horario') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Observações</label>
                        <textarea name="observacoes" class="form-control"
                            placeholder="Algum detalhe importante para o prestador...">{{ old('observacoes') }}</textarea>
                    </div>

                </div>
            </div>

            <div class="form-card-footer">
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-calendar-check"></i> Confirmar Agendamento
                </button>
            </div>
        </form>
    </div>

</div>
@endsection