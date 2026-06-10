@extends('layouts.app')
@section('content')

<style>
    .dash { padding: 36px 32px; font-family: 'Sora', sans-serif; }
    .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; gap: 16px; }
    .page-title { font-size: 1.3rem; font-weight: 900; color: #111; letter-spacing: -0.5px; margin: 0; display: flex; align-items: center; gap: 10px; }
    .page-title i { color: #fa4101; }
    .btn-outline-back { border: 1.5px solid #ddd; background: transparent; color: #555; border-radius: 9px; padding: 8px 16px; font-size: 0.82rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: border-color 0.2s, color 0.2s; font-family: 'Sora', sans-serif; }
    .btn-outline-back:hover { border-color: #fa4101; color: #fa4101; }

    .show-grid { display: grid; grid-template-columns: 280px 1fr; gap: 24px; align-items: start; }

    .profile-card { background: #fff; border: 1.5px solid #ececec; border-radius: 16px; overflow: hidden; }
    .profile-banner { height: 80px; background: linear-gradient(135deg, #fa4101, #c73200); }
    .profile-body { padding: 0 24px 24px; text-align: center; }
    .profile-avatar { width: 80px; height: 80px; border-radius: 50%; border: 3px solid #fff; object-fit: cover; margin-top: -40px; display: block; margin-left: auto; margin-right: auto; }
    .profile-initials { width: 80px; height: 80px; border-radius: 50%; border: 3px solid #fff; background: #111; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 900; color: #fff; margin-top: -40px; margin-left: auto; margin-right: auto; }
    .profile-name { font-size: 1rem; font-weight: 900; color: #111; margin: 12px 0 2px; }
    .profile-email { font-size: 0.75rem; color: #aaa; margin-bottom: 12px; }
    .tag { display: inline-flex; align-items: center; font-size: 0.68rem; font-weight: 700; padding: 4px 12px; border-radius: 20px; }
    .tag-adm       { background: #fff1ec; color: #c73200; }
    .tag-prestador { background: #e8f6ef; color: #145c37; }
    .tag-cliente   { background: #ebf2ff; color: #0947b3; }

    .profile-meta { margin-top: 20px; display: flex; flex-direction: column; gap: 10px; }
    .profile-meta-item { display: flex; align-items: center; gap: 10px; font-size: 0.8rem; color: #666; }
    .profile-meta-item i { color: #fa4101; width: 16px; text-align: center; }

    .info-card { background: #fff; border: 1.5px solid #ececec; border-radius: 16px; overflow: hidden; margin-bottom: 20px; }
    .info-card-header { padding: 16px 24px; border-bottom: 1.5px solid #f0f0f0; display: flex; align-items: center; gap: 8px; }
    .info-card-header span { font-size: 0.78rem; font-weight: 800; color: #111; text-transform: uppercase; letter-spacing: .4px; }
    .info-card-header i { color: #fa4101; }
    .info-card-body { padding: 20px 24px; }

    .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .info-item { display: flex; flex-direction: column; gap: 3px; }
    .info-label { font-size: 0.68rem; font-weight: 700; color: #bbb; text-transform: uppercase; letter-spacing: .5px; }
    .info-value { font-size: 0.88rem; font-weight: 600; color: #333; }

    .actions-card { background: #fff; border: 1.5px solid #ececec; border-radius: 16px; padding: 20px 24px; }
    .btn-action { display: flex; align-items: center; justify-content: center; gap: 7px; width: 100%; padding: 10px 16px; border-radius: 9px; font-size: 0.82rem; font-weight: 700; cursor: pointer; text-decoration: none; border: none; margin-bottom: 8px; transition: all 0.2s; font-family: 'Sora', sans-serif; }
    .btn-action:last-child { margin-bottom: 0; }
    .btn-edit { background: #fa4101; color: #fff; }
    .btn-edit:hover { background: #c73200; color: #fff; }
    .btn-del { background: transparent; color: #dc3545; border: 1.5px solid #dc3545; }
    .btn-del:hover { background: #dc3545; color: #fff; }

    @media(max-width:900px) { .show-grid { grid-template-columns: 1fr; } }
    @media(max-width:576px) { .dash { padding: 16px; } .info-grid { grid-template-columns: 1fr; } }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="fa-solid fa-user"></i> Detalhes do Usuário</h4>
        <a href="{{ route('usuarios.index') }}" class="btn-outline-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="show-grid">

        {{-- Coluna lateral: perfil + ações --}}
        <div>
            <div class="profile-card" style="margin-bottom:16px">
                <div class="profile-banner"></div>
                <div class="profile-body">
                    @if($usuario->foto)
                        <img src="{{ $usuario->foto }}" class="profile-avatar" alt="">
                    @else
                        <div class="profile-initials">{{ strtoupper(substr($usuario->nome, 0, 1)) }}</div>
                    @endif
                    <div class="profile-name">{{ $usuario->nome }}</div>
                    <div class="profile-email">{{ $usuario->email }}</div>
                    <span class="tag tag-{{ $usuario->tipo }}">{{ ucfirst($usuario->tipo) }}</span>
                    <div class="profile-meta">
                        @if($usuario->telefone)
                        <div class="profile-meta-item"><i class="fa-solid fa-phone"></i> {{ $usuario->telefone }}</div>
                        @endif
                        @if($usuario->cidade)
                        <div class="profile-meta-item"><i class="fa-solid fa-location-dot"></i> {{ $usuario->cidade }}{{ $usuario->estado ? '/'.$usuario->estado : '' }}</div>
                        @endif
                        <div class="profile-meta-item"><i class="fa-solid fa-calendar"></i> Desde {{ $usuario->created_at->format('d/m/Y') }}</div>
                    </div>
                </div>
            </div>

            <div class="actions-card">
                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn-action btn-edit">
                    <i class="fa-solid fa-pencil"></i> Editar Usuário
                </a>
                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                    onsubmit="return confirm('Deletar este usuário permanentemente?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-action btn-del">
                        <i class="fa-solid fa-trash"></i> Excluir Usuário
                    </button>
                </form>
            </div>
        </div>

        {{-- Coluna principal --}}
        <div>
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>Informações Gerais</span>
                </div>
                <div class="info-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">ID</span>
                            <span class="info-value">#{{ $usuario->id }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tipo</span>
                            <span class="info-value">{{ ucfirst($usuario->tipo) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Nome</span>
                            <span class="info-value">{{ $usuario->nome }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">E-mail</span>
                            <span class="info-value">{{ $usuario->email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Telefone</span>
                            <span class="info-value">{{ $usuario->telefone ?? '—' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Cadastrado em</span>
                            <span class="info-value">{{ $usuario->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if($usuario->tipo === 'prestador')
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fa-solid fa-briefcase"></i>
                    <span>Dados do Prestador</span>
                </div>
                <div class="info-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Tipo Pessoa</span>
                            <span class="info-value">{{ $usuario->tipo_pessoa === 'fisico' ? 'Física' : ($usuario->tipo_pessoa === 'juridico' ? 'Jurídica' : '—') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">CPF / CNPJ</span>
                            <span class="info-value">{{ $usuario->cpf_cnpj ?? '—' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Razão Social</span>
                            <span class="info-value">{{ $usuario->razao_social ?? '—' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Nome Fantasia</span>
                            <span class="info-value">{{ $usuario->nome_fantasia ?? '—' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="info-card">
                <div class="info-card-header">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Endereço</span>
                </div>
                <div class="info-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">CEP</span>
                            <span class="info-value">{{ $usuario->cep ?? '—' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Logradouro</span>
                            <span class="info-value">{{ $usuario->logradouro ?? '—' }}{{ $usuario->numero ? ', '.$usuario->numero : '' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Complemento</span>
                            <span class="info-value">{{ $usuario->complemento ?? '—' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Bairro</span>
                            <span class="info-value">{{ $usuario->bairro ?? '—' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Cidade / UF</span>
                            <span class="info-value">{{ $usuario->cidade ?? '—' }}{{ $usuario->estado ? '/'.$usuario->estado : '' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection