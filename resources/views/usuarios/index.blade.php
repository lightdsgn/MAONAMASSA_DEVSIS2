@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-people me-2"></i>Usuários</h4>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Novo Usuário
    </a>
</div>

{{-- Busca --}}
<form method="GET" action="{{ route('usuarios.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="busca" class="form-control" placeholder="Buscar por nome ou e-mail..."
            value="{{ $busca ?? '' }}">
        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
        @if($busca)
            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Limpar</a>
        @endif
    </div>
</form>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>
                        @if($usuario->foto)
                            <img src="{{ asset('storage/' . $usuario->foto) }}"
                                class="rounded-circle" width="40" height="40" style="object-fit:cover;">
                        @else
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white"
                                style="width:40px;height:40px;font-size:18px;">
                                {{ strtoupper(substr($usuario->nome, 0, 1)) }}
                            </div>
                        @endif
                    </td>
                    <td>{{ $usuario->nome }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->telefone ?? '-' }}</td>
                    <td>
                        <span class="badge
                            {{ $usuario->tipo === 'adm' ? 'bg-danger' : '' }}
                            {{ $usuario->tipo === 'prestador' ? 'bg-success' : '' }}
                            {{ $usuario->tipo === 'cliente' ? 'bg-primary' : '' }}">
                            {{ ucfirst($usuario->tipo) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('usuarios.show', $usuario) }}" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Deletar este usuário?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Nenhum usuário encontrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $usuarios->appends(['busca' => $busca])->links() }}
</div>
@endsection