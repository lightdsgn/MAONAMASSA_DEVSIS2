<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mão na Massa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Sora', sans-serif; }
        body { background-color: #f8f9fa; }

        /* Sidebar */
        .sidebar {
            width: 240px;
            min-height: calc(100vh - 80px);
            background: #0a0a0a;
            padding: 16px 0;
            flex-shrink: 0;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: #aaa;
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.2s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: rgba(250,65,1,0.15);
            color: #fa4101;
            border-left: 3px solid #fa4101;
        }
        .sidebar .nav-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #555;
            padding: 12px 20px 4px;
        }
        .main-content { padding: 24px; }

        /* Navbar */
        .navbar-logo { transition: 0.3s; }
        .navbar-logo:hover { transform: scale(1.05); }
        .navbar-nav .nav-link {
            position: relative;
            margin: 0 12px;
            color: #fff;
            font-weight: 500;
            padding: 8px 0;
            transition: 0.2s;
        }
        .navbar-nav .nav-link::after {
            content: "";
            position: absolute;
            left: 50%; bottom: 5px;
            width: 0%;
            height: 2px;
            background: #fff;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .navbar-nav .nav-link:hover::after { width: 60%; }
        .navbar-nav .nav-link:hover { font-weight: 700; }

        .botaocadastro {
            background: transparent; color: #fff;
            border: 2px solid #fff; padding: 5px 14px;
            border-radius: 6px; font-weight: 600;
            text-decoration: none; transition: all 0.2s;
        }
        .botaologin {
            background: #0a0a0a; color: #fff;
            border: 2px solid #0a0a0a; padding: 5px 14px;
            border-radius: 6px; font-weight: 600;
            text-decoration: none; transition: all 0.2s;
        }
        .botaocadastro:hover { background: #fff; color: #fa4101; transform: scale(1.05); }
        .botaologin:hover { transform: scale(1.05); }

        .user-badge {
            background: rgba(255,255,255,0.15);
            border-radius: 20px;
            padding: 4px 12px;
            color: #fff;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#fa4101;height:80px;">
    <div class="container-fluid px-4">
        <a class="navbar-logo" href="{{ route('home') }}">
            <img src="/logomaonamassa.png" height="48">
        </a>

        <ul class="navbar-nav mx-auto d-none d-lg-flex">
            @yield('navbar-links')
            @auth
            <li class="nav-item"><a class="nav-link" href="{{ route('servicos.index') }}">Serviços</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('produtos.index') }}">Produtos</a></li>
            @endauth
        </ul>

        <div class="d-flex align-items-center gap-2">
            @auth
                <span class="user-badge d-none d-lg-block">
                    <i class="bi bi-person-fill me-1"></i>{{ Auth::user()->nome }}
                    <span class="badge bg-dark ms-1" style="font-size:0.65rem;">{{ strtoupper(Auth::user()->tipo) }}</span>
                </span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-dark">
                        <i class="bi bi-box-arrow-right me-1"></i>Sair
                    </button>
                </form>
            @else
                @yield('navbar-botoes')
                @if(!Route::is('login') && !Route::is('registro'))
                <a href="{{ route('registro') }}" class="botaocadastro"><i class="bi bi-person-plus me-1"></i>Cadastro</a>
                <a href="{{ route('login') }}" class="botaologin"><i class="bi bi-box-arrow-in-right me-1" style="color:#fa4101"></i>Login</a>
                @endif
            @endauth
        </div>
    </div>
</nav>

<div class="d-flex">
    @auth
    <div class="sidebar">
        <div class="nav-title">Geral</div>
        <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">
            <i class="bi bi-house me-2"></i>Início
        </a>
        <a href="{{ route('perfil') }}" class="{{ request()->is('perfil*') ? 'active' : '' }}">
            <i class="bi bi-person-circle me-2"></i>Meu Perfil
        </a>

        @if(Auth::user()->isCliente())
            <div class="nav-title mt-2">Minha Área</div>
            <a href="{{ route('solicitacoes.index') }}" class="{{ request()->is('solicitacoes*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check me-2"></i>Solicitações
            </a>
            <a href="{{ route('agendamentos.index') }}" class="{{ request()->is('agendamentos*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check me-2"></i>Agendamentos
            </a>
            <a href="{{ route('avaliacoes.index') }}" class="{{ request()->is('avaliacoes*') ? 'active' : '' }}">
                <i class="bi bi-star me-2"></i>Minhas Avaliações
            </a>
            <a href="{{ route('pagamentos.index') }}" class="{{ request()->is('pagamentos*') ? 'active' : '' }}">
                <i class="bi bi-credit-card me-2"></i>Pagamentos
            </a>
            <div class="nav-title mt-2">Explorar</div>
            <a href="{{ route('servicos.index') }}" class="{{ request()->is('servicos*') ? 'active' : '' }}">
                <i class="bi bi-tools me-2"></i>Serviços
            </a>
            <a href="{{ route('produtos.index') }}" class="{{ request()->is('produtos*') ? 'active' : '' }}">
                <i class="bi bi-bag me-2"></i>Produtos
            </a>
        @endif

        @if(Auth::user()->isPrestador())
            <div class="nav-title mt-2">Meu Negócio</div>
            <a href="{{ route('servicos.index') }}" class="{{ request()->is('servicos*') ? 'active' : '' }}">
                <i class="bi bi-tools me-2"></i>Meus Serviços
            </a>
            <a href="{{ route('produtos.index') }}" class="{{ request()->is('produtos*') ? 'active' : '' }}">
                <i class="bi bi-bag me-2"></i>Meus Produtos
            </a>
            <a href="{{ route('orcamentos.index') }}" class="{{ request()->is('orcamentos*') ? 'active' : '' }}">
                <i class="bi bi-receipt me-2"></i>Orçamentos
            </a>
            <div class="nav-title mt-2">Clientes</div>
            <a href="{{ route('solicitacoes.index') }}" class="{{ request()->is('solicitacoes*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check me-2"></i>Solicitações
            </a>
            <a href="{{ route('agendamentos.index') }}" class="{{ request()->is('agendamentos*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check me-2"></i>Agendamentos
            </a>
            <a href="{{ route('avaliacoes.index') }}" class="{{ request()->is('avaliacoes*') ? 'active' : '' }}">
                <i class="bi bi-star me-2"></i>Avaliações
            </a>
            <a href="{{ route('pagamentos.index') }}" class="{{ request()->is('pagamentos*') ? 'active' : '' }}">
                <i class="bi bi-credit-card me-2"></i>Pagamentos
            </a>
        @endif

        @if(Auth::user()->isAdm())
            <div class="nav-title mt-2">Administração</div>
            <a href="{{ route('usuarios.index') }}" class="{{ request()->is('usuarios*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i>Usuários
            </a>
            <a href="{{ route('servicos.index') }}" class="{{ request()->is('servicos*') ? 'active' : '' }}">
                <i class="bi bi-tools me-2"></i>Serviços
            </a>
            <a href="{{ route('produtos.index') }}" class="{{ request()->is('produtos*') ? 'active' : '' }}">
                <i class="bi bi-bag me-2"></i>Produtos
            </a>
            <a href="{{ route('solicitacoes.index') }}" class="{{ request()->is('solicitacoes*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check me-2"></i>Solicitações
            </a>
            <a href="{{ route('orcamentos.index') }}" class="{{ request()->is('orcamentos*') ? 'active' : '' }}">
                <i class="bi bi-receipt me-2"></i>Orçamentos
            </a>
            <a href="{{ route('agendamentos.index') }}" class="{{ request()->is('agendamentos*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check me-2"></i>Agendamentos
            </a>
            <a href="{{ route('avaliacoes.index') }}" class="{{ request()->is('avaliacoes*') ? 'active' : '' }}">
                <i class="bi bi-star me-2"></i>Avaliações
            </a>
            <a href="{{ route('pagamentos.index') }}" class="{{ request()->is('pagamentos*') ? 'active' : '' }}">
                <i class="bi bi-credit-card me-2"></i>Pagamentos
            </a>
        @endif
    </div>
    @endauth

    <div class="main-content flex-grow-1">
        @if(session('sucesso'))
            <div class="alert alert-success alert-dismissible fade show m-0 mb-3" style="border-radius:0;border-left:4px solid #198754;">
                <i class="bi bi-check-circle me-2"></i>{{ session('sucesso') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('erro'))
            <div class="alert alert-danger alert-dismissible fade show m-0 mb-3" style="border-radius:0;border-left:4px solid #dc3545;">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('erro') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show m-0 mb-3" style="border-radius:0;border-left:4px solid #dc3545;">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
