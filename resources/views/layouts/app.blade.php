<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mão na Massa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7cfadf3f16.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Sora', sans-serif; box-sizing: border-box; }

        /* ── BODY: compensa a navbar fixa ── */
        body {
            background-color: #f0ede8;
            padding-top: 64px; /* igual à altura da navbar */
            min-height: 100vh;
        }

        /* ── NAVBAR ── */
        .navbar-main {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 64px;
            background: #fa4101;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 1040;
            border-bottom: 1px solid rgba(0,0,0,0.12);
            box-shadow: 0 2px 12px rgba(250,65,1,0.25);
        }
        
        /* Menu hambúrguer para celular */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            margin-left: auto;
            margin-right: -8px;
            transition: transform 0.3s ease;
        }
        .mobile-menu-toggle:active { transform: scale(0.95); }
        
        /* Sidebar móvel overlay */
        .mobile-sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1030;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .mobile-sidebar-overlay.active { opacity: 1; }
        
        @media (max-width: 768px) {
            .mobile-menu-toggle { display: block; }
            .mobile-sidebar-overlay { display: block; }
            .sidebar {
                position: fixed;
                left: -220px;
                top: 64px;
                height: calc(100vh - 64px);
                z-index: 1035;
                transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .sidebar.mobile-open { left: 0; }
            .page-wrapper {
                flex-direction: column;
            }
            .main-content {
                width: 100%;
            }
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: opacity 0.2s;
            margin-right: 16px;
        }
        .nav-logo:hover { opacity: 0.9; }
        .nav-logo img { height: 38px; }
        
        @media (max-width: 640px) {
            .nav-logo img { height: 32px; }
        }

        /* Lado direito da navbar */
        .nav-actions { 
            display: flex; 
            align-items: center; 
            gap: 12px;
            margin-right: 8px;
        }
        
        @media (max-width: 640px) {
            .nav-actions {
                gap: 8px;
                margin-right: 0;
            }
            .nav-actions .user-chip-name,
            .nav-actions .user-tipo-badge {
                display: none !important;
            }
        }

        /* Botão de notificações */
        .nav-icon-btn {
            width: 38px; height: 38px;
            border-radius: 8px;
            background: rgba(0,0,0,0.15);
            border: 1px solid rgba(255,255,255,0.12);
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            position: relative;
            transition: background 0.2s;
            text-decoration: none;
        }
        .nav-icon-btn:hover { background: rgba(0,0,0,0.28); color: #fff; }
        .nav-icon-btn .notif-dot {
            position: absolute;
            top: 8px; right: 8px;
            width: 7px; height: 7px;
            background: #fff;
            border: 2px solid #fa4101;
            border-radius: 50%;
        }

        /* Chip do usuário */
        .user-chip {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(0,0,0,0.18);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 40px;
            padding: 5px 12px 5px 5px;
            cursor: pointer;
            transition: background 0.2s;
            position: relative;
        }
        .user-chip:hover { background: rgba(0,0,0,0.3); }

        .user-avatar {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
            font-size: 11px;
            color: #fa4101;
            letter-spacing: -0.5px;
        }
        .user-chip-name {
            color: #fff;
            font-size: 0.82rem;
            font-weight: 600;
        }
        .user-tipo-badge {
            background: rgba(255,255,255,0.2);
            color: #fff;
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 2px 6px;
            border-radius: 4px;
        }
        .user-chevron {
            color: rgba(255,255,255,0.65);
            font-size: 11px;
            transition: transform 0.2s;
        }
        .user-chip.open .user-chevron { transform: rotate(180deg); }

        .user-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: #fff;
            border-radius: 12px;
            border: 0.5px solid rgba(0,0,0,0.1);
            box-shadow: 0 8px 28px rgba(0,0,0,0.14);
            min-width: 220px;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-6px);
            transition: all 0.22s ease;
            z-index: 999;
        }
        .user-chip.open .user-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown-header {
            padding: 13px 16px;
            border-bottom: 0.5px solid #f0f0f0;
            background: #fafafa;
        }
        .dropdown-header .dh-name {
            font-weight: 700;
            font-size: 0.88rem;
            color: #1a1a1a;
        }
        .dropdown-header .dh-email {
            font-size: 0.72rem;
            color: #999;
            margin-top: 1px;
        }
        .dropdown-item-custom {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            font-size: 0.82rem;
            color: #444;
            text-decoration: none;
            border-bottom: 0.5px solid #f5f5f5;
            transition: all 0.15s;
            background: transparent;
            border-left: none; border-right: none; border-top: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }
        .dropdown-item-custom:last-child { border-bottom: none; }
        .dropdown-item-custom:hover { background: #fef6f3; color: #fa4101; }
        .dropdown-item-custom.danger { color: #dc3545; }
        .dropdown-item-custom.danger:hover { background: #fff5f5; }
        .dropdown-item-custom i { width: 16px; text-align: center; }

        /* Botões da navbar (login/cadastro/voltar) */
        .nav-btn {
            display: flex; align-items: center; gap: 8px;
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }
        .nav-btn-outline {
            background: transparent;
            color: #fff;
            border: 1.5px solid rgba(255,255,255,0.5);
        }
        .nav-btn-outline:hover { background: rgba(255,255,255,0.15); color: #fff; border-color: #fff; }
        .nav-btn-dark {
            background: #0a0a0a;
            color: #fff;
            border: 1.5px solid #0a0a0a;
        }
        .nav-btn-dark:hover { background: #1a1a1a; color: #fff; }
        .nav-btn-back {
            background: rgba(0,0,0,0.18);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .nav-btn-back:hover { background: rgba(0,0,0,0.32); color: #fff; }

        /* ── LAYOUT ── */
        .page-wrapper { 
            display: flex; 
            min-height: calc(100vh - 64px);
        }
        
        @media (max-width: 768px) {
            .page-wrapper {
                flex-direction: column;
            }
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 220px;
            background: #111;
            padding: 10px 8px;
            flex-shrink: 0;
            position: sticky;
            top: 64px;
            height: calc(100vh - 64px);
            overflow-y: auto;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            gap: 1px;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            scrollbar-width: thin;
            scrollbar-color: #333 transparent;
            border-right: 1px solid #222;
        }
        .sidebar.collapsed { width: 60px; }
        
        @media (max-width: 768px) {
            .sidebar {
                border-right: none;
                border-bottom: 1px solid #222;
            }
        }

        .sidebar::-webkit-scrollbar { width: 3px; }
        .sidebar::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }

        /* Seção label */
        .sb-label-section {
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #555;
            padding: 10px 8px 4px;
            white-space: nowrap;
            overflow: hidden;
            transition: all 0.25s;
        }
        .sidebar.collapsed .sb-label-section {
            opacity: 0;
            height: 0;
            padding: 0;
            margin: 0;
        }

        /* Item do sidebar */
        .sb-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 8px;
            color: #666;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
            white-space: nowrap;
            transition: all 0.2s ease;
        }
        .sb-link:hover { background: rgba(250,65,1,0.1); color: #fa4101; }
        .sb-link.active { background: #fa4101; color: #fff; box-shadow: 0 3px 10px rgba(250,65,1,0.3); }

        .sb-icon {
            font-size: 16px;
            min-width: 20px;
            text-align: center;
            flex-shrink: 0;
        }
        .sb-text {
            overflow: hidden;
            text-overflow: ellipsis;
            transition: opacity 0.2s;
        }
        .sidebar.collapsed .sb-text { display: none; }
        .sidebar.collapsed .sb-link {
            justify-content: center;
            padding: 10px 0;
        }

        /* Spacer + botão de toggle */
        .sb-spacer { flex: 1; min-height: 12px; }
        .sb-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px; height: 36px;
            border-radius: 8px;
            background: rgba(250,65,1,0.1);
            border: 1px solid rgba(250,65,1,0.2);
            color: #fa4101;
            cursor: pointer;
            transition: all 0.2s;
            align-self: center;
            margin-bottom: 4px;
            flex-shrink: 0;
        }
        .sb-toggle:hover { background: rgba(250,65,1,0.22); }
        .sb-toggle i { transition: transform 0.3s; }
        .sidebar.collapsed .sb-toggle i { transform: rotate(180deg); }

        .main-content {
            flex: 1;
            min-width: 0;
            padding: 24px;
        }

     
        .alert { border-radius: 8px !important; }
         .main-content { padding: 0; }
    </style>
</head>
<body>


<nav class="navbar-main">
  
    <a class="nav-logo" href="{{ route('home') }}">
        <img src="/logomaonamassa.png" alt="Mão na Massa">
    </a>

    <div class="nav-actions">


        @if(Route::is('login') || Route::is('registro'))
            <a href="{{ route('home') }}" class="nav-btn nav-btn-back">
                <i class="fa-solid fa-circle-arrow-left"></i>VOLTAR
            </a>
        @endif

        @auth
       
            <a href="#" class="nav-icon-btn">
                <i class="bi bi-bell" style="font-size:15px;"></i>
                <span class="notif-dot"></span>
            </a>

           
            <div class="user-chip" id="userChip">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->nome, 0, 1)) }}{{ strtoupper(substr(strstr(Auth::user()->nome, ' '), 1, 1)) }}
                </div>
                <span class="user-chip-name d-none d-sm-inline">{{ Auth::user()->nome }}</span>
                <span class="user-tipo-badge d-none d-md-inline">{{ strtoupper(Auth::user()->tipo) }}</span>
                <i class="bi bi-chevron-down user-chevron"></i>

                <div class="user-dropdown">
                    <div class="dropdown-header">
                        <div class="dh-name">{{ Auth::user()->nome }}</div>
                        <div class="dh-email">{{ Auth::user()->email }}</div>
                    </div>
                    <a href="{{ route('perfil') }}" class="dropdown-item-custom">
                        <i class="fa-solid fa-user-pen"></i> Editar Perfil
                    </a>
                    <a href="{{ route('perfil') }}" class="dropdown-item-custom">
                        <i class="fa-solid fa-gear"></i> Configurações
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item-custom danger">
                            <i class="fa-solid fa-door-open"></i> Sair
                        </button>
                    </form>
                </div>
            </div>

        @else
            @yield('navbar-botoes')
            @if(!Route::is('login') && !Route::is('registro'))
                <a href="{{ route('registro') }}" class="nav-btn nav-btn-outline">
                    <i class="fa-solid fa-square-arrow-up-right"></i> CADASTRO
                </a>
                <a href="{{ route('login') }}" class="nav-btn nav-btn-dark">
                    <i class="fa-solid fa-circle-user" style="color:#fa4101;"></i> LOGIN
                </a>
            @endif
        @endauth

    </div>
</nav>


<div class="mobile-sidebar-overlay" id="mobileSidebarOverlay"></div>


<div class="page-wrapper">

    @auth
    <aside class="sidebar {{ Auth::user()->isCliente() ? 'cliente' : (Auth::user()->isPrestador() ? 'prestador' : 'adm') }}" id="sidebar">

        <div class="sb-label-section">Geral</div>
        <a href="{{ route('perfil') }}" class="sb-link {{ request()->is('perfil*') ? 'active' : '' }}">
            <i class="fa fa-circle-user sb-icon"></i>
            <span class="sb-text">Meu Perfil</span>
        </a>

        @if(Auth::user()->isCliente())
            <div class="sb-label-section" style="margin-top:6px;">Minha Área</div>
            <a href="{{ route('solicitacoes.index') }}" class="sb-link {{ request()->is('solicitacoes*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check sb-icon"></i><span class="sb-text">Solicitações</span>
            </a>
            <a href="{{ route('agendamentos.index') }}" class="sb-link {{ request()->is('agendamentos*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check sb-icon"></i><span class="sb-text">Agendamentos</span>
            </a>
            <a href="{{ route('avaliacoes.index') }}" class="sb-link {{ request()->is('avaliacoes*') ? 'active' : '' }}">
                <i class="bi bi-star sb-icon"></i><span class="sb-text">Avaliações</span>
            </a>
            <a href="{{ route('pagamentos.index') }}" class="sb-link {{ request()->is('pagamentos*') ? 'active' : '' }}">
                <i class="bi bi-credit-card sb-icon"></i><span class="sb-text">Pagamentos</span>
            </a>
            <div class="sb-label-section" style="margin-top:6px;">Explorar</div>
            <a href="{{ route('servicos.index') }}" class="sb-link {{ request()->is('servicos*') ? 'active' : '' }}">
                <i class="bi bi-tools sb-icon"></i><span class="sb-text">Serviços</span>
            </a>
            <a href="{{ route('produtos.index') }}" class="sb-link {{ request()->is('produtos*') ? 'active' : '' }}">
                <i class="bi bi-bag sb-icon"></i><span class="sb-text">Produtos</span>
            </a>
        @endif

        @if(Auth::user()->isPrestador())
            <div class="sb-label-section" style="margin-top:6px;">Meu Negócio</div>
            <a href="{{ route('servicos.index') }}" class="sb-link {{ request()->is('servicos*') ? 'active' : '' }}">
                <i class="bi bi-tools sb-icon"></i><span class="sb-text">Meus Serviços</span>
            </a>
            <a href="{{ route('produtos.index') }}" class="sb-link {{ request()->is('produtos*') ? 'active' : '' }}">
                <i class="bi bi-bag sb-icon"></i><span class="sb-text">Meus Produtos</span>
            </a>
            <a href="{{ route('orcamentos.index') }}" class="sb-link {{ request()->is('orcamentos*') ? 'active' : '' }}">
                <i class="bi bi-receipt sb-icon"></i><span class="sb-text">Orçamentos</span>
            </a>
            <div class="sb-label-section" style="margin-top:6px;">Clientes</div>
            <a href="{{ route('solicitacoes.index') }}" class="sb-link {{ request()->is('solicitacoes*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check sb-icon"></i><span class="sb-text">Solicitações</span>
            </a>
            <a href="{{ route('agendamentos.index') }}" class="sb-link {{ request()->is('agendamentos*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check sb-icon"></i><span class="sb-text">Agendamentos</span>
            </a>
            <a href="{{ route('avaliacoes.index') }}" class="sb-link {{ request()->is('avaliacoes*') ? 'active' : '' }}">
                <i class="bi bi-star sb-icon"></i><span class="sb-text">Avaliações</span>
            </a>
            <a href="{{ route('pagamentos.index') }}" class="sb-link {{ request()->is('pagamentos*') ? 'active' : '' }}">
                <i class="bi bi-credit-card sb-icon"></i><span class="sb-text">Pagamentos</span>
            </a>
        @endif

        @if(Auth::user()->isAdm())
            <div class="sb-label-section" style="margin-top:6px;">Administração</div>
            <a href="{{ route('dashboard') }}" class="sb-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="fa fa-house sb-icon"></i><span class="sb-text">Dashboard</span>
            </a>
            <a href="{{ route('usuarios.index') }}" class="sb-link {{ request()->is('usuarios*') ? 'active' : '' }}">
                <i class="fa fa-users sb-icon"></i><span class="sb-text">Usuários</span>
            </a>
            <a href="{{ route('servicos.index') }}" class="sb-link {{ request()->is('servicos*') ? 'active' : '' }}">
                <i class="fa fa-tools sb-icon"></i><span class="sb-text">Serviços</span>
            </a>
            <a href="{{ route('produtos.index') }}" class="sb-link {{ request()->is('produtos*') ? 'active' : '' }}">
                <i class="fa fa-cart-shopping sb-icon"></i><span class="sb-text">Produtos</span>
            </a>
            <a href="{{ route('solicitacoes.index') }}" class="sb-link {{ request()->is('solicitacoes*') ? 'active' : '' }}">
                <i class="fa fa-clipboard-check     sb-icon"></i><span class="sb-text">Solicitações</span>
            </a>
            <a href="{{ route('orcamentos.index') }}" class="sb-link {{ request()->is('orcamentos*') ? 'active' : '' }}">
                <i class="fa fa-receipt sb-icon"></i><span class="sb-text">Orçamentos</span>
            </a>
            <a href="{{ route('agendamentos.index') }}" class="sb-link {{ request()->is('agendamentos*') ? 'active' : '' }}">
                <i class="fa fa-clock sb-icon"></i><span class="sb-text">Agendamentos</span>
            </a>
            <a href="{{ route('avaliacoes.index') }}" class="sb-link {{ request()->is('avaliacoes*') ? 'active' : '' }}">
                <i class="fa fa-star sb-icon"></i><span class="sb-text">Avaliações</span>
            </a>
            <a href="{{ route('pagamentos.index') }}" class="sb-link {{ request()->is('pagamentos*') ? 'active' : '' }}">
                <i class="fa-solid fa-credit-card sb-icon"></i><span class="sb-text">Pagamentos</span>
            </a>
        @endif

        <div class="sb-spacer"></div>
        <button class="sb-toggle" id="sidebarToggle" title="Expandir/Colapsar">
            <i class="bi bi-chevron-left" id="toggleIcon"></i>
        </button>
    </aside>
    @endauth

    {{-- CONTEÚDO PRINCIPAL --}}
    <main class="main-content">
        @if(session('sucesso'))
            <div class="alert alert-success alert-dismissible fade show mb-3" style="border-left:4px solid #198754;">
                <i class="bi bi-check-circle me-2"></i>{{ session('sucesso') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('erro'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" style="border-left:4px solid #dc3545;">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('erro') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-3" style="border-left:4px solid #dc3545;">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

  
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');

    if (sidebar && toggleBtn) {
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            sidebar.classList.add('collapsed');
        }
        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        });
    }

  
    const chip = document.getElementById('userChip');
    if (chip) {
        chip.addEventListener('click', function (e) {
            e.stopPropagation();
            chip.classList.toggle('open');
        });
        document.addEventListener('click', function (e) {
            if (!chip.contains(e.target)) chip.classList.remove('open');
        });
    }
});
</script>

@yield('scripts')
</body>
</html>