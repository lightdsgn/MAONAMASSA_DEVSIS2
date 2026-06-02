@extends('layouts.app')
@section('content')

<style>
    .dash { padding: 36px 32px; font-family: 'Sora', sans-serif; }

    .page-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 24px; gap: 16px;
    }
    .page-title {
        font-size: 1.3rem; font-weight: 900; color: #111;
        letter-spacing: -0.5px; margin: 0;
        display: flex; align-items: center; gap: 10px;
    }
    .page-title i { color: #fa4101; }

    .btn-dash-fill {
        background: #fa4101; color: #fff; border: none;
        border-radius: 9px; padding: 9px 18px;
        font-size: 0.82rem; font-weight: 700;
        text-decoration: none; display: inline-flex; align-items: center; gap: 7px;
        transition: background 0.2s; font-family: 'Sora', sans-serif; cursor: pointer;
    }
    .btn-dash-fill:hover { background: #c73200; color: #fff; }

    .search-bar { display: flex; gap: 8px; margin-bottom: 20px; }
    .search-input {
        flex: 1; padding: 10px 16px;
        border: 1.5px solid #e8e8e8; border-radius: 10px;
        font-size: 0.85rem; font-family: 'Sora', sans-serif;
        background: #fff; color: #333; outline: none;
        transition: border-color 0.2s;
    }
    .search-input:focus { border-color: #fa4101; }
    .search-input::placeholder { color: #bbb; }
    .search-btn {
        padding: 10px 16px; border-radius: 10px;
        background: #fa4101; border: none; color: #fff;
        font-size: 15px; cursor: pointer; transition: background 0.2s;
        display: flex; align-items: center;
    }
    .search-btn:hover { background: #c73200; }
    .clear-btn {
        padding: 10px 14px; border-radius: 10px;
        background: #fff; border: 1.5px solid #e8e8e8;
        color: #888; font-size: 0.8rem; font-weight: 600;
        cursor: pointer; transition: all 0.2s;
        text-decoration: none; display: flex; align-items: center; gap: 5px;
        font-family: 'Sora', sans-serif;
    }
    .clear-btn:hover { border-color: #ccc; color: #555; }

    .table-card {
        background: #fff; border-radius: 14px;
        border: 1.5px solid #ececec; overflow: hidden;
        animation: fadeUp 0.4s ease both;
    }

    .usr-table { width: 100%; border-collapse: collapse; }
    .usr-table thead tr { background: #111; }
    .usr-table thead th {
        padding: 13px 16px;
        font-size: 0.7rem; font-weight: 700;
        color: #777; text-transform: uppercase;
        letter-spacing: 0.8px; white-space: nowrap; border: none;
    }
    .usr-table tbody tr {
        border-bottom: 1px solid #f5f5f5;
        transition: background 0.15s;
    }
    .usr-table tbody tr:last-child { border-bottom: none; }
    .usr-table tbody tr:hover { background: #fafafa; }
    .usr-table td {
        padding: 12px 16px;
        font-size: 0.83rem; color: #444;
        vertical-align: middle;
    }

    .td-id { font-size: 0.72rem; font-weight: 700; color: #ccc; font-family: monospace; }

    .user-cell { display: flex; align-items: center; gap: 11px; }
    .user-photo {
        width: 36px; height: 36px; border-radius: 10px;
        object-fit: cover; flex-shrink: 0;
        border: 1.5px solid #ececec;
    }
    .user-initials {
        width: 36px; height: 36px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; font-weight: 800; flex-shrink: 0;
    }
    .user-name  { font-weight: 700; color: #222; font-size: 0.85rem; line-height: 1.2; }
    .user-email { font-size: 0.72rem; color: #aaa; margin-top: 1px; }

    .td-phone { color: #888; font-size: 0.8rem; }

    .tag {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.68rem; font-weight: 700;
        padding: 4px 10px; border-radius: 20px; white-space: nowrap;
    }
    .tag::before { content:''; width:5px; height:5px; border-radius:50%; background:currentColor; opacity:.55; }
    .tag-adm      { background: #fff1ec; color: #c73200; }
    .tag-prestador { background: #e8f6ef; color: #145c37; }
    .tag-cliente  { background: #ebf2ff; color: #0947b3; }

    .actions { display: flex; align-items: center; gap: 6px; }
    .act-btn {
        width: 32px; height: 32px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 14px; cursor: pointer; transition: all 0.2s;
        border: 1.5px solid; text-decoration: none; background: transparent;
        flex-shrink: 0;
    }
    .act-view   { border-color: #bde0ff; color: #0d6efd; }
    .act-view:hover   { background: #ebf2ff; color: #0d6efd; }
    .act-edit   { border-color: #fde9a2; color: #b07d00; }
    .act-edit:hover   { background: #fdf6e3; color: #b07d00; }
    .act-delete { border-color: #ffc9b8; color: #c73200; }
    .act-delete:hover { background: #fff1ec; color: #c73200; }

    .empty-state { padding: 52px 20px; text-align: center; }
    .empty-state i { font-size: 40px; color: #e0e0e0; display: block; margin-bottom: 12px; }
    .empty-state p { font-size: 0.88rem; color: #bbb; margin: 0; font-weight: 500; }

    .pagination-wrap { margin-top: 18px; }
    .pagination-wrap .pagination { gap: 4px; }
    .pagination-wrap .page-link {
        border-radius: 8px !important; border: 1.5px solid #ececec;
        color: #666; font-size: 0.8rem; font-weight: 600;
        font-family: 'Sora', sans-serif; padding: 6px 12px; transition: all 0.2s;
    }
    .pagination-wrap .page-link:hover { border-color: #fa4101; color: #fa4101; background: #fff8f5; }
    .pagination-wrap .page-item.active .page-link { background: #fa4101; border-color: #fa4101; color: #fff; }
    .pagination-wrap .page-item.disabled .page-link { opacity: 0.4; }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(14px); }
        to   { opacity:1; transform:translateY(0); }
    }

    @media(max-width:768px) {
        .dash { padding: 16px; }
        .td-phone { display: none; }
        .user-email { display: none; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title"><i class="bi bi-people"></i> Usuários</h4>
        <a href="{{ route('usuarios.create') }}" class="btn-dash-fill">
            <i class="bi bi-plus-lg"></i> Novo Usuário
        </a>
    </div>

    <form method="GET" action="{{ route('usuarios.index') }}" class="search-bar">
        <input type="text" name="busca" class="search-input"
            placeholder="Buscar por nome ou e-mail..."
            value="{{ $busca ?? '' }}">
        <button type="submit" class="search-btn"><i class="bi bi-search"></i></button>
        @if($busca ?? false)
        <a href="{{ route('usuarios.index') }}" class="clear-btn"><i class="bi bi-x"></i> Limpar</a>
        @endif
    </form>

    <div class="table-card">
        <div style="overflow-x:auto;">
            <table class="usr-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuário</th>
                        <th>Telefone</th>
                        <th>Tipo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                    @php
                        $cor = match($usuario->tipo) {
                            'adm'       => ['bg'=>'#fff1ec','color'=>'#c73200'],
                            'prestador' => ['bg'=>'#e8f6ef','color'=>'#145c37'],
                            default     => ['bg'=>'#ebf2ff','color'=>'#0947b3'],
                        };
                    @endphp
                    <tr>
                        <td><span class="td-id">#{{ $usuario->id }}</span></td>

                        <td>
                            <div class="user-cell">
                                @if($usuario->foto)
                                    <img src="{{ asset('storage/'.$usuario->foto) }}" class="user-photo" alt="">
                                @else
                              
                                @endif
                                <div>
                                    <div class="user-name">{{ $usuario->nome }}</div>
                                    <div class="user-email">{{ $usuario->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="td-phone">
                            {{ $usuario->telefone ?? '—' }}
                        </td>

                        <td>
                            <span class="tag tag-{{ $usuario->tipo }}">{{ ucfirst($usuario->tipo) }}</span>
                        </td>

                        <td>
                            <div class="actions">
                                <a href="{{ route('usuarios.show', $usuario) }}" class="act-btn act-view" title="Ver"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('usuarios.edit', $usuario) }}" class="act-btn act-edit" title="Editar"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-inline" onsubmit="return confirm('Deletar este usuário?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="act-btn act-delete" title="Deletar"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="bi bi-people"></i>
                                <p>Nenhum usuário encontrado{{ ($busca ?? false) ? ' para "'.$busca.'"' : '' }}.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($usuarios->hasPages())
    <div class="pagination-wrap">
        {{ $usuarios->appends(['busca' => $busca])->links() }}
    </div>
    @endif

</div>
@endsection