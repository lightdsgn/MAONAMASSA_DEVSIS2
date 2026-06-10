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
    .form-card-header { padding: 16px 28px; border-bottom: 1.5px solid #f0f0f0; display: flex; align-items: center; justify-content: space-between; }
    .form-card-header-left { display: flex; align-items: center; gap: 10px; }
    .form-card-header span.title { font-size: 0.78rem; font-weight: 800; color: #111; text-transform: uppercase; letter-spacing: .4px; }
    .form-card-header i { color: #fa4101; }
    .form-card-body { padding: 28px; }
    .form-card-footer { padding: 20px 28px; border-top: 1.5px solid #f0f0f0; display: flex; align-items: center; justify-content: space-between; gap: 10px; }

    .tag { display: inline-flex; align-items: center; gap: 5px; font-size: 0.68rem; font-weight: 700; padding: 4px 11px; border-radius: 20px; white-space: nowrap; }
    .tag-pendente   { background: #fdf6e3; color: #8a6000; }
    .tag-confirmado { background: #e0f5f8; color: #0c6674; }
    .tag-concluido  { background: #e8f6ef; color: #145c37; }
    .tag-cancelado  { background: #f0f0f0; color: #888; }

    .form-label { font-size: 0.8rem; font-weight: 700; color: #444; margin-bottom: 6px; }
    .form-control, .form-select { border: 1.5px solid #e8e8e8; border-radius: 10px; font-size: 0.85rem; font-family: 'Sora', sans-serif; color: #333; padding: 10px 14px; transition: border-color .2s; }
    .form-control:focus, .form-select:focus { border-color: #fa4101; box-shadow: 0 0 0 3px rgba(250,65,1,.08); outline: none; }
    .form-control:disabled { background: #fafafa; color: #aaa; }
    textarea.form-control { resize: vertical; min-height: 90px; }

    .btn-submit { background: #fa4101; color: #fff; border: none; border-radius: 9px; padding: 10px 24px; font-size: 0.85rem; font-weight: 700; display: inline-flex; align-items: center; gap: 7px; cursor: pointer; transition: background .2s; font-family: 'Sora', sans-serif; }
    .btn-submit:hover { background: #c73200; }
    .btn-view { text-decoration: none; color: #666; border: 1.5px solid #e8e8e8; border-radius: 9px; padding: 9px 16px; font-size: 0.82rem; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; transition: all .2s; font-family: 'Sora', sans-serif; }
    .btn-view:hover { border-color: #fa4101; color: #fa4101; }

    .role-note { font-size: 0.72rem; color: #aaa; font-weight: 600; margin-top: 6px; display: flex; align-items: center; gap: 5px; }

    @media(max-width:576px) { .dash { padding: 16px; } .form-card-body { padding: 18px 16px; } }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="fa-solid fa-calendar-pen"></i> Editar Agendamento</h4>
        <a href="{{ route('agendamentos.index') }}" class="btn-outline-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-header-left">
                <i class="fa-solid fa-calendar-check"></i>
                <span class="title">#{{ $agendamento->id }} — {{ Str::limit($agendamento->servico->titulo, 35) }}</span>
            </div>
            <span class="tag tag-{{ $agendamento->status }}">
                {{ ucfirst($agendamento->status) }}
            </span>
        </div>

        <form action="{{ route('agendamentos.update', $agendamento->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-card-body">
                <div class="row g-3">

                    {{-- Campo serviço sempre desabilitado no edit --}}
                    <div class="col-12">
                        <label class="form-label">Serviço</label>
                        <input type="text" class="form-control" value="{{ $agendamento->servico->titulo }} — {{ $agendamento->servico->usuario->nome }}" disabled>
                    </div>

                    @if(Auth::user()->isCliente())
                        {{-- Cliente pode alterar data, horário e observações --}}
                        <div class="col-md-6">
                            <label class="form-label">Data <span class="text-danger">*</span></label>
                            <input type="date" name="data" class="form-control @error('data') is-invalid @enderror"
                                value="{{ old('data', $agendamento->data) }}" min="{{ date('Y-m-d') }}">
                            @error('data') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Horário <span class="text-danger">*</span></label>
                            <input type="time" name="horario" class="form-control @error('horario') is-invalid @enderror"
                                value="{{ old('horario', \Carbon\Carbon::createFromFormat('H:i:s', $agendamento->horario)->format('H:i')) }}">
                            @error('horario') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Observações</label>
                            <textarea name="observacoes" class="form-control"
                                placeholder="Algum detalhe importante para o prestador...">{{ old('observacoes', $agendamento->observacoes) }}</textarea>
                        </div>
                        <div class="col-12">
                            <p class="role-note"><i class="fa-solid fa-circle-info"></i> Como cliente, você pode alterar data, horário e observações. O status é gerenciado pelo prestador.</p>
                        </div>

                    @else
                        {{-- Prestador/ADM só altera status --}}
                        <div class="col-md-6">
                            <label class="form-label">Data</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Horário</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::createFromFormat('H:i:s', $agendamento->horario)->format('H:i') }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select">
                                @foreach(['pendente' => 'Pendente', 'confirmado' => 'Confirmado', 'concluido' => 'Concluído', 'cancelado' => 'Cancelado'] as $val => $label)
                                    <option value="{{ $val }}" {{ old('status', $agendamento->status) === $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <p class="role-note"><i class="fa-solid fa-circle-info"></i> Como prestador, você gerencia o status do agendamento.</p>
                        </div>
                    @endif

                </div>
            </div>

            <div class="form-card-footer">
                <a href="{{ route('agendamentos.show', $agendamento->id) }}" class="btn-view">
                    <i class="fa-solid fa-eye"></i> Ver Agendamento
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> Salvar Alterações
                </button>
            </div>
        </form>
    </div>

</div>
@endsection