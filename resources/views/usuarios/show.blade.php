@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-person me-2"></i>Detalhes do Usuário</h4>
    <div>
        <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-warning me-2">
            <i class="bi bi-pencil me-1"></i> Editar
        </a>
        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Voltar
        </a>
    </div>
</div>

<div class="card p-4">
    <div class="row g-4">
        <div class="col-md-3 text-center">
            @if($usuario->foto)
                <img src="{{ asset('storage/' . $usuario->foto) }}" class="rounded-circle img-fluid mb-3"
                    style="width:120px;height:120px;object-fit:cover;">
            @else
                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white mx-auto mb-3"
                    style="width:120px;height:120px;font-size:48px;">
                    {{ strtoupper(substr($usuario->nome, 0, 1)) }}
                </div>
            @endif
            <span class="badge fs-6
                {{ $usuario->tipo === 'adm' ? 'bg-danger' : '' }}
                {{ $usuario->tipo === 'prestador' ? 'bg-success' : '' }}
                {{ $usuario->tipo === 'cliente' ? 'bg-primary' : '' }}">
                {{ ucfirst($usuario->tipo) }}
            </span>
        </div>
        <div class="col-md-9">
            <h5 class="fw-bold">{{ $usuario->nome }}</h5>
            <p class="text-muted mb-1"><i class="bi bi-envelope me-2"></i>{{ $usuario->email }}</p>
            <p class="text-muted mb-3"><i class="bi bi-telephone me-2"></i>{{ $usuario->telefone ?? 'Não informado' }}</p>

            @if($usuario->tipo === 'prestador')
            <hr>
            <h6 class="fw-bold">Dados do Prestador</h6>
            <p class="mb-1"><strong>Tipo:</strong> {{ $usuario->tipo_pessoa === 'fisico' ? 'Pessoa Física' : ($usuario->tipo_pessoa === 'juridico' ? 'Pessoa Jurídica' : '-') }}</p>
            <p class="mb-1"><strong>CPF/CNPJ:</strong> {{ $usuario->cpf_cnpj ?? '-' }}</p>
            <p class="mb-1"><strong>Razão Social:</strong> {{ $usuario->razao_social ?? '-' }}</p>
            <p class="mb-1"><strong>Nome Fantasia:</strong> {{ $usuario->nome_fantasia ?? '-' }}</p>
            @endif

            <hr>
            <h6 class="fw-bold">Endereço</h6>
            <p class="mb-0">
                {{ $usuario->logradouro ?? '-' }}, {{ $usuario->numero ?? '' }}
                {{ $usuario->complemento ? '- ' . $usuario->complemento : '' }}<br>
                {{ $usuario->bairro ?? '' }} - {{ $usuario->cidade ?? '' }}/{{ $usuario->estado ?? '' }}<br>
                CEP: {{ $usuario->cep ?? '-' }}
            </p>
        </div>
    </div>
</div>
@endsection