@extends('layouts.app')
@section('content')

<style>
    .dash { padding: 36px 32px; font-family: 'Sora', sans-serif; }
    .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; gap: 16px; }
    .page-title { font-size: 1.3rem; font-weight: 900; color: #111; letter-spacing: -0.5px; margin: 0; display: flex; align-items: center; gap: 10px; }
    .page-title i { color: #fa4101; }

    .form-card { background: #fff; border: 1.5px solid #ececec; border-radius: 16px; overflow: hidden; margin-bottom: 20px; }
    .form-card-header { padding: 16px 28px; border-bottom: 1.5px solid #f0f0f0; display: flex; align-items: center; gap: 10px; }
    .form-card-header span { font-size: 0.78rem; font-weight: 800; color: #111; text-transform: uppercase; letter-spacing: .4px; }
    .form-card-header i { color: #fa4101; }
    .form-card-body { padding: 28px; }
    .form-card-footer { padding: 20px 28px; border-top: 1.5px solid #f0f0f0; }

    .form-label { font-size: 0.8rem; font-weight: 700; color: #444; margin-bottom: 6px; }
    .form-control, .form-select { border: 1.5px solid #e8e8e8; border-radius: 10px; font-size: 0.85rem; font-family: 'Sora', sans-serif; color: #333; padding: 10px 14px; transition: border-color .2s; }
    .form-control:focus, .form-select:focus { border-color: #fa4101; box-shadow: 0 0 0 3px rgba(250,65,1,.08); outline: none; }
    .form-control:disabled { background: #fafafa; color: #aaa; cursor: not-allowed; }

    .btn-submit { background: #fa4101; color: #fff; border: none; border-radius: 9px; padding: 10px 24px; font-size: 0.85rem; font-weight: 700; display: inline-flex; align-items: center; gap: 7px; cursor: pointer; transition: background .2s; font-family: 'Sora', sans-serif; }
    .btn-submit:hover { background: #c73200; }

    .avatar-wrap { display: flex; align-items: center; gap: 16px; margin-bottom: 4px; }
    .avatar-img { width: 64px; height: 64px; border-radius: 50%; object-fit: cover; border: 2px solid #ececec; }
    .avatar-initials { width: 64px; height: 64px; border-radius: 50%; background: #111; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 900; color: #fff; flex-shrink: 0; }

    @media(max-width:576px) { .dash { padding: 16px; } .form-card-body { padding: 18px 16px; } }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="fa-solid fa-user-circle"></i> Meu Perfil</h4>
    </div>

    <form action="{{ route('perfil.atualizar') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        {{-- Dados básicos --}}
        <div class="form-card">
            <div class="form-card-header">
                <i class="fa-solid fa-user"></i>
                <span>Dados Pessoais</span>
            </div>
            <div class="form-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nome <span class="text-danger">*</span></label>
                        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
                            value="{{ old('nome', $usuario->nome) }}" required>
                        @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">E-mail</label>
                        <input type="email" class="form-control" value="{{ $usuario->email }}" disabled>
                        <small class="text-muted" style="font-size:.72rem">O e-mail não pode ser alterado.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control"
                            value="{{ old('telefone', $usuario->telefone) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Foto de Perfil</label>
                        <div class="avatar-wrap">
                            @if($usuario->foto)
                                <img src="{{ $usuario->foto }}" class="avatar-img" alt="">
                            @else
                                <div class="avatar-initials">{{ strtoupper(substr($usuario->nome, 0, 1)) }}</div>
                            @endif
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>
                        @error('foto') <div class="text-danger" style="font-size:.78rem">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Dados do prestador --}}
        @if($usuario->tipo === 'prestador')
        <div class="form-card">
            <div class="form-card-header">
                <i class="fa-solid fa-briefcase"></i>
                <span>Dados do Prestador</span>
            </div>
            <div class="form-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Tipo Pessoa</label>
                        <select name="tipo_pessoa" class="form-select">
                            <option value="">Selecione...</option>
                            <option value="fisico"   {{ old('tipo_pessoa', $usuario->tipo_pessoa) === 'fisico'   ? 'selected' : '' }}>Física</option>
                            <option value="juridico" {{ old('tipo_pessoa', $usuario->tipo_pessoa) === 'juridico' ? 'selected' : '' }}>Jurídica</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">CPF / CNPJ</label>
                        <input type="text" name="cpf_cnpj" class="form-control"
                            value="{{ old('cpf_cnpj', $usuario->cpf_cnpj) }}">
                        @error('cpf_cnpj') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Razão Social</label>
                        <input type="text" name="razao_social" class="form-control"
                            value="{{ old('razao_social', $usuario->razao_social) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nome Fantasia</label>
                        <input type="text" name="nome_fantasia" class="form-control"
                            value="{{ old('nome_fantasia', $usuario->nome_fantasia) }}">
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Endereço --}}
        <div class="form-card">
            <div class="form-card-header">
                <i class="fa-solid fa-location-dot"></i>
                <span>Endereço</span>
            </div>
            <div class="form-card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">CEP</label>
                        <input type="text" name="cep" class="form-control" value="{{ old('cep', $usuario->cep) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Logradouro</label>
                        <input type="text" name="logradouro" class="form-control" value="{{ old('logradouro', $usuario->logradouro) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Número</label>
                        <input type="text" name="numero" class="form-control" value="{{ old('numero', $usuario->numero) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Complemento</label>
                        <input type="text" name="complemento" class="form-control" value="{{ old('complemento', $usuario->complemento) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Bairro</label>
                        <input type="text" name="bairro" class="form-control" value="{{ old('bairro', $usuario->bairro) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cidade</label>
                        <input type="text" name="cidade" class="form-control" value="{{ old('cidade', $usuario->cidade) }}">
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">UF</label>
                        <input type="text" name="estado" class="form-control" maxlength="2" value="{{ old('estado', $usuario->estado) }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-footer">
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> Salvar Alterações
                </button>
            </div>
        </div>

    </form>
</div>
@endsection