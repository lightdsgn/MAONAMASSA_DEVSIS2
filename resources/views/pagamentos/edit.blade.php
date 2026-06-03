@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-pencil me-2"></i>Editar Pagamento #{{ $pagamento->id }}</h4>
    <a href="{{ route('pagamentos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4">
    <form action="{{ route('pagamentos.update', $pagamento) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="agendamento_id" class="form-label fw-600">Agendamento <span class="text-danger">*</span></label>
            <select name="agendamento_id" id="agendamento_id" class="form-control @error('agendamento_id') is-invalid @enderror" required>
                <option value="">Selecione um agendamento</option>
                @foreach($agendamentos ?? [] as $agend)
                    <option value="{{ $agend->id }}" {{ (isset($pagamento) && $pagamento->agendamento_id == $agend->id) || old('agendamento_id') == $agend->id ? 'selected' : '' }}>Agendamento #{{ $agend->id }}</option>
                @endforeach
            </select>
            @error('agendamento_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="valor" class="form-label fw-600">Valor <span class="text-danger">*</span></label>
            <input type="number" name="valor" id="valor" step="0.01" class="form-control @error('valor') is-invalid @enderror" required value="{{ isset($pagamento) ? $pagamento->valor : old('valor') }}" placeholder="0.00">
            @error('valor') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="metodo" class="form-label fw-600">Método de Pagamento <span class="text-danger">*</span></label>
            <select name="metodo" id="metodo" class="form-control @error('metodo') is-invalid @enderror" required>
                <option value="">Selecione um método</option>
                <option value="dinheiro" {{ (isset($pagamento) && $pagamento->metodo == 'dinheiro') || old('metodo') == 'dinheiro' ? 'selected' : '' }}>Dinheiro</option>
                <option value="cartao" {{ (isset($pagamento) && $pagamento->metodo == 'cartao') || old('metodo') == 'cartao' ? 'selected' : '' }}>Cartão</option>
                <option value="pix" {{ (isset($pagamento) && $pagamento->metodo == 'pix') || old('metodo') == 'pix' ? 'selected' : '' }}>PIX</option>
                <option value="transferencia" {{ (isset($pagamento) && $pagamento->metodo == 'transferencia') || old('metodo') == 'transferencia' ? 'selected' : '' }}>Transferência</option>
            </select>
            @error('metodo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label fw-600">Status <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="">Selecione um status</option>
                <option value="pendente" {{ (isset($pagamento) && $pagamento->status == 'pendente') || old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="confirmado" {{ (isset($pagamento) && $pagamento->status == 'confirmado') || old('status') == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                <option value="cancelado" {{ (isset($pagamento) && $pagamento->status == 'cancelado') || old('status') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="data_pagamento" class="form-label fw-600">Data do Pagamento</label>
            <input type="date" name="data_pagamento" id="data_pagamento" class="form-control @error('data_pagamento') is-invalid @enderror" value="{{ isset($pagamento) && $pagamento->data_pagamento ? $pagamento->data_pagamento : old('data_pagamento') }}">
            @error('data_pagamento') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mt-4"><button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Atualizar</button></div>
    </form>
</div>
@endsection
