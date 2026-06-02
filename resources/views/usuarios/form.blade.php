@php
    $user = $usuario ?? null;
    $tipo = old('tipo', $user->tipo ?? '');
@endphp

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Nome</label>
        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
            value="{{ old('nome', $user->nome ?? '') }}" required>
        @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">E-mail</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $user->email ?? '') }}" required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Telefone</label>
        <input type="text" name="telefone" class="form-control"
            value="{{ old('telefone', $user->telefone ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Tipo</label>
        <select name="tipo" class="form-select @error('tipo') is-invalid @enderror" required onchange="togglePrestador(this.value)">
            <option value="">Selecione...</option>
            <option value="cliente" {{ $tipo === 'cliente' ? 'selected' : '' }}>Cliente</option>
            <option value="prestador" {{ $tipo === 'prestador' ? 'selected' : '' }}>Prestador</option>
            <option value="adm" {{ $tipo === 'adm' ? 'selected' : '' }}>ADM</option>
        </select>
        @error('tipo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">{{ isset($user) ? 'Nova Senha' : 'Senha' }}</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" {{ isset($user) ? '' : 'required' }}>
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">{{ isset($user) ? 'Confirmar Nova Senha' : 'Confirmar Senha' }}</label>
        <input type="password" name="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Foto</label>
        @if(isset($user) && $user->foto)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $user->foto) }}" class="rounded" height="80">
            </div>
        @endif
        <input type="file" name="foto" class="form-control" accept="image/*">
    </div>

    <div id="campos-prestador" class="col-12 {{ $tipo === 'prestador' ? '' : 'd-none' }}">
        <hr><h6 class="fw-bold text-muted">Dados do Prestador</h6>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Tipo Pessoa</label>
                <select name="tipo_pessoa" class="form-select">
                    <option value="">Selecione...</option>
                    <option value="fisico" {{ old('tipo_pessoa', $user->tipo_pessoa ?? '') === 'fisico' ? 'selected' : '' }}>Física</option>
                    <option value="juridico" {{ old('tipo_pessoa', $user->tipo_pessoa ?? '') === 'juridico' ? 'selected' : '' }}>Jurídica</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">CPF / CNPJ</label>
                <input type="text" name="cpf_cnpj" class="form-control"
                    value="{{ old('cpf_cnpj', $user->cpf_cnpj ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Razão Social</label>
                <input type="text" name="razao_social" class="form-control"
                    value="{{ old('razao_social', $user->razao_social ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nome Fantasia</label>
                <input type="text" name="nome_fantasia" class="form-control"
                    value="{{ old('nome_fantasia', $user->nome_fantasia ?? '') }}">
            </div>
        </div>
    </div>

    <div class="col-12"><hr><h6 class="fw-bold text-muted">Endereço</h6></div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">CEP</label>
        <input type="text" name="cep" class="form-control" value="{{ old('cep', $user->cep ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Logradouro</label>
        <input type="text" name="logradouro" class="form-control" value="{{ old('logradouro', $user->logradouro ?? '') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Número</label>
        <input type="text" name="numero" class="form-control" value="{{ old('numero', $user->numero ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Complemento</label>
        <input type="text" name="complemento" class="form-control" value="{{ old('complemento', $user->complemento ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Bairro</label>
        <input type="text" name="bairro" class="form-control" value="{{ old('bairro', $user->bairro ?? '') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Cidade</label>
        <input type="text" name="cidade" class="form-control" value="{{ old('cidade', $user->cidade ?? '') }}">
    </div>
    <div class="col-md-1">
        <label class="form-label fw-semibold">UF</label>
        <input type="text" name="estado" class="form-control" maxlength="2" value="{{ old('estado', $user->estado ?? '') }}">
    </div>
</div>
