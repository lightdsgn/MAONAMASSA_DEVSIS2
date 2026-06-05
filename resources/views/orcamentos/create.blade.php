@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-receipt me-2"></i>Novo Orçamento</h4>
    <a href="{{ route('orcamentos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <form action="{{ route('orcamentos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="solicitacao_id" class="form-label fw-600">Solicitação <span class="text-danger">*</span></label>
            <select name="solicitacao_id" id="solicitacao_id" class="form-control @error('solicitacao_id') is-invalid @enderror" required>
                <option value="">Selecione uma solicitação</option>
                @foreach($solicitacoes ?? [] as $sol)
                    <option value="{{ $sol->id }}" {{ old('solicitacao_id') == $sol->id ? 'selected' : '' }}>{{ $sol->titulo }}</option>
                @endforeach
            </select>
            @error('solicitacao_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="servico_id" class="form-label fw-600">Serviço <span class="text-danger">*</span></label>
            <select name="servico_id" id="servico_id" class="form-control @error('servico_id') is-invalid @enderror" required>
                <option value="">Selecione um serviço</option>
                @foreach($servicos ?? [] as $serv)
                    <option value="{{ $serv->id }}" {{ old('servico_id') == $serv->id ? 'selected' : '' }}>{{ $serv->titulo }}</option>
                @endforeach
            </select>
            @error('servico_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="mao_de_obra" class="form-label fw-600">Mão de Obra</label>
            <input type="number" name="mao_de_obra" id="mao_de_obra" step="0.01" class="form-control @error('mao_de_obra') is-invalid @enderror" value="{{ old('mao_de_obra') }}" placeholder="0.00">
            @error('mao_de_obra') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="valor_total" class="form-label fw-600">Valor Total <span class="text-danger">*</span></label>
            <input type="number" name="valor_total" id="valor_total" step="0.01" class="form-control @error('valor_total') is-invalid @enderror" required value="{{ old('valor_total') }}" placeholder="0.00">
            @error('valor_total') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="prazo" class="form-label fw-600">Prazo <span class="text-danger">*</span></label>
            <input type="text" name="prazo" id="prazo" class="form-control @error('prazo') is-invalid @enderror" required value="{{ old('prazo') }}" placeholder="Ex: 15 dias">
            @error('prazo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="observacoes" class="form-label fw-600">Observações</label>
            <textarea name="observacoes" id="observacoes" class="form-control @error('observacoes') is-invalid @enderror" rows="3" placeholder="Observações adicionais...">{{ old('observacoes') }}</textarea>
            @error('observacoes') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label fw-600">Status <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="">Selecione um status</option>
                <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="aceito"   {{ old('status') == 'aceito'   ? 'selected' : '' }}>Aceito</option>
                <option value="recusado" {{ old('status') == 'recusado' ? 'selected' : '' }}>Recusado</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mt-4"><button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Salvar</button></div>
    </form>
</div>
@endsection
