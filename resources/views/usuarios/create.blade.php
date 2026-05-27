@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-person-plus me-2"></i>Novo Usuário</h4>
    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Voltar
    </a>
</div>

<div class="card p-4">
    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nome</label>
                <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                    value="{{ old('nome') }}" required>
                @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">E-mail</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Telefone</label>
                <input type="text" name="telefone" class="form-control" value="{{ old('telefone') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Tipo</label>
                <select name="tipo" class="form-select @error('tipo') is-invalid @enderror" required
                    onchange="togglePrestador(this.value)">
                    <option value="">Selecione...</option>
                    <option value="cliente" {{ old('tipo') === 'cliente' ? 'selected' : '' }}>Cliente</option>
                    <option value="prestador" {{ old('tipo') === 'prestador' ? 'selected' : '' }}>Prestador</option>
                    <option value="adm" {{ old('tipo') === 'adm' ? 'selected' : '' }}>ADM</option>
                </select>
                @error('tipo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Senha</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Confirmar Senha</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>

            {{-- Campos Prestador --}}
            <div id="campos-prestador" class="col-12 d-none">
                <hr><h6 class="fw-bold text-muted">Dados do Prestador</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tipo Pessoa</label>
                        <select name="tipo_pessoa" class="form-select">
                            <option value="">Selecione...</option>
                            <option value="fisico" {{ old('tipo_pessoa') === 'fisico' ? 'selected' : '' }}>Física</option>
                            <option value="juridico" {{ old('tipo_pessoa') === 'juridico' ? 'selected' : '' }}>Jurídica</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">CPF / CNPJ</label>
                        <input type="text" name="cpf_cnpj" class="form-control" value="{{ old('cpf_cnpj') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Razão Social</label>
                        <input type="text" name="razao_social" class="form-control" value="{{ old('razao_social') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nome Fantasia</label>
                        <input type="text" name="nome_fantasia" class="form-control" value="{{ old('nome_fantasia') }}">
                    </div>
                </div>
            </div>

            {{-- Endereço --}}
            <div class="col-12"><hr><h6 class="fw-bold text-muted">Endereço</h6></div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">CEP</label>
                <input type="text" name="cep" class="form-control" value="{{ old('cep') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Logradouro</label>
                <input type="text" name="logradouro" class="form-control" value="{{ old('logradouro') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Número</label>
                <input type="text" name="numero" class="form-control" value="{{ old('numero') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Complemento</label>
                <input type="text" name="complemento" class="form-control" value="{{ old('complemento') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Bairro</label>
                <input type="text" name="bairro" class="form-control" value="{{ old('bairro') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Cidade</label>
                <input type="text" name="cidade" class="form-control" value="{{ old('cidade') }}">
            </div>
            <div class="col-md-1">
                <label class="form-label fw-semibold">UF</label>
                <input type="text" name="estado" class="form-control" maxlength="2" value="{{ old('estado') }}">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-check-lg me-1"></i> Salvar
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