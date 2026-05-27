@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-pencil me-2"></i>Editar Usuário</h4>
    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Voltar
    </a>
</div>

<div class="card p-4">
    <form action="{{ route('usuarios.update', $usuario) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nome</label>
                <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                    value="{{ old('nome', $usuario->nome) }}" required>
                @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">E-mail</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $usuario->email) }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Telefone</label>
                <input type="text" name="telefone" class="form-control"
                    value="{{ old('telefone', $usuario->telefone) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Tipo</label>
                <select name="tipo" class="form-select" required onchange="togglePrestador(this.value)">
                    <option value="cliente" {{ $usuario->tipo === 'cliente' ? 'selected' : '' }}>Cliente</option>
                    <option value="prestador" {{ $usuario->tipo === 'prestador' ? 'selected' : '' }}>Prestador</option>
                    <option value="adm" {{ $usuario->tipo === 'adm' ? 'selected' : '' }}>ADM</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Nova Senha <small class="text-muted">(deixe em branco para manter)</small></label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Confirmar Nova Senha</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Foto</label>
                @if($usuario->foto)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $usuario->foto) }}" class="rounded" height="80">
                    </div>
                @endif
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>

            {{-- Campos Prestador --}}
            <div id="campos-prestador" class="{{ $usuario->tipo === 'prestador' ? '' : 'd-none' }} col-12">
                <hr><h6 class="fw-bold text-muted">Dados do Prestador</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tipo Pessoa</label>
                        <select name="tipo_pessoa" class="form-select">
                            <option value="">Selecione...</option>
                            <option value="fisico" {{ $usuario->tipo_pessoa === 'fisico' ? 'selected' : '' }}>Física</option>
                            <option value="juridico" {{ $usuario->tipo_pessoa === 'juridico' ? 'selected' : '' }}>Jurídica</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">CPF / CNPJ</label>
                        <input type="text" name="cpf_cnpj" class="form-control"
                            value="{{ old('cpf_cnpj', $usuario->cpf_cnpj) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Razão Social</label>
                        <input type="text" name="razao_social" class="form-control"
                            value="{{ old('razao_social', $usuario->razao_social) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nome Fantasia</label>
                        <input type="text" name="nome_fantasia" class="form-control"
                            value="{{ old('nome_fantasia', $usuario->nome_fantasia) }}">
                    </div>
                </div>
            </div>

            {{-- Endereço --}}
            <div class="col-12"><hr><h6 class="fw-bold text-muted">Endereço</h6></div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">CEP</label>
                <input type="text" name="cep" class="form-control" value="{{ old('cep', $usuario->cep) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Logradouro</label>
                <input type="text" name="logradouro" class="form-control" value="{{ old('logradouro', $usuario->logradouro) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Número</label>
                <input type="text" name="numero" class="form-control" value="{{ old('numero', $usuario->numero) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Complemento</label>
                <input type="text" name="complemento" class="form-control" value="{{ old('complemento', $usuario->complemento) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Bairro</label>
                <input type="text" name="bairro" class="form-control" value="{{ old('bairro', $usuario->bairro) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Cidade</label>
                <input type="text" name="cidade" class="form-control" value="{{ old('cidade', $usuario->cidade) }}">
            </div>
            <div class="col-md-1">
                <label class="form-label fw-semibold">UF</label>
                <input type="text" name="estado" class="form-control" maxlength="2" value="{{ old('estado', $usuario->estado) }}">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-check-lg me-1"></i> Atualizar
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function togglePrestador(tipo) {
    const campos = document.getElementById('campos-prestador');
    if (tipo === 'prestador') {
        campos.classList.remove('d-none');
    } else {
        campos.classList.add('d-none');
    }
}
</script>
@endsection