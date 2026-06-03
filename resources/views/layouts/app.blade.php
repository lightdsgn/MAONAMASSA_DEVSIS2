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

        body {
            background-color: #f0ede8;
            padding-top: 64px;
            min-height: 100vh;
            margin: 0;
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
            padding: 0 20px;
            z-index: 1040;
            box-shadow: 0 2px 16px rgba(250,65,1,0.35);
        }

        .nav-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; transition: opacity 0.2s; }
        .nav-logo:hover { opacity: 0.88; }
        .nav-logo img { height: 36px; }

        .nav-actions { display: flex; align-items: center; gap: 10px; }

        .nav-icon-btn {
            width: 36px; height: 36px; border-radius: 9px;
            background: rgba(0,0,0,0.15); border: 1px solid rgba(255,255,255,0.15);
            color: #fff; display: flex; align-items: center; justify-content: center;
            cursor: pointer; position: relative; transition: background 0.2s; text-decoration: none;
        }
        .nav-icon-btn:hover { background: rgba(0,0,0,0.28); color: #fff; }
        .notif-dot {
            position: absolute; top: 8px; right: 8px;
            width: 7px; height: 7px; background: #fff;
            border: 2px solid #fa4101; border-radius: 50%;
        }

        .user-chip {
            display: flex; align-items: center; gap: 8px;
            background: rgba(0,0,0,0.18); border: 1px solid rgba(255,255,255,0.15);
            border-radius: 40px; padding: 4px 12px 4px 4px;
            cursor: pointer; transition: background 0.2s; position: relative;
        }
        .user-chip:hover { background: rgba(0,0,0,0.3); }
        .user-avatar {
            width: 28px; height: 28px; border-radius: 50%;
            background: #fff; display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 11px; color: #fa4101; letter-spacing: -0.5px;
        }
        .user-chip-name { color: #fff; font-size: 0.82rem; font-weight: 600; }
        .user-tipo-badge {
            background: rgba(255,255,255,0.2); color: #fff;
            font-size: 0.58rem; font-weight: 700; letter-spacing: 0.5px;
            padding: 2px 7px; border-radius: 4px;
        }
        .user-chevron { color: rgba(255,255,255,0.65); font-size: 11px; transition: transform 0.2s; }
        .user-chip.open .user-chevron { transform: rotate(180deg); }

        .user-dropdown {
            position: absolute; top: calc(100% + 10px); right: 0;
            background: #fff; border-radius: 14px;
            border: 0.5px solid rgba(0,0,0,0.1);
            box-shadow: 0 10px 36px rgba(0,0,0,0.13);
            min-width: 220px; overflow: hidden;
            opacity: 0; visibility: hidden;
            transform: translateY(-6px); transition: all 0.22s ease; z-index: 999;
        }
        .user-chip.open .user-dropdown { opacity: 1; visibility: visible; transform: translateY(0); }

        .dropdown-header { padding: 13px 16px; border-bottom: 0.5px solid #f0f0f0; background: #fafafa; }
        .dropdown-header .dh-name { font-weight: 700; font-size: 0.88rem; color: #1a1a1a; }
        .dropdown-header .dh-email { font-size: 0.72rem; color: #999; margin-top: 1px; }

        .dropdown-item-custom {
            display: flex; align-items: center; gap: 10px;
            padding: 11px 16px; font-size: 0.82rem; color: #444;
            text-decoration: none; border-bottom: 0.5px solid #f5f5f5;
            transition: all 0.15s; background: transparent;
            border-left: none; border-right: none; border-top: none;
            width: 100%; text-align: left; cursor: pointer;
        }
        .dropdown-item-custom:last-child { border-bottom: none; }
        .dropdown-item-custom:hover { background: #fef6f3; color: #fa4101; }
        .dropdown-item-custom.danger { color: #dc3545; }
        .dropdown-item-custom.danger:hover { background: #fff5f5; }
        .dropdown-item-custom i { width: 16px; text-align: center; }

        .nav-btn {
            display: flex; align-items: center; gap: 7px;
            padding: 7px 15px; border-radius: 8px;
            font-size: 0.8rem; font-weight: 700; letter-spacing: 0.3px;
            text-decoration: none; transition: all 0.2s; cursor: pointer; border: none;
        }
        .nav-btn-outline { background: transparent; color: #fff; border: 1.5px solid rgba(255,255,255,0.5); }
        .nav-btn-outline:hover { background: rgba(255,255,255,0.15); color: #fff; border-color: #fff; }
        .nav-btn-dark { background: #0a0a0a; color: #fff; border: 1.5px solid #0a0a0a; }
        .nav-btn-dark:hover { background: #1a1a1a; color: #fff; }
        .nav-btn-back { background: rgba(0,0,0,0.18); color: #fff; border: 1px solid rgba(255,255,255,0.2); }
        .nav-btn-back:hover { background: rgba(0,0,0,0.32); color: #fff; }

        /* ── LAYOUT ── */
        .page-wrapper { display: flex; min-height: calc(100vh - 64px); }

        /* ── SIDEBAR WRAP (controla largura) ── */
        .sidebar-wrap {
            position: sticky;
            top: 64px;
            height: calc(100vh - 64px);
            flex-shrink: 0;
            width: 220px;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 100;
            display: flex;
            align-items: stretch;
        }
        .sidebar-wrap.collapsed { width: 64px; }

        /* ── SIDEBAR ── */
        .sidebar {
            flex: 1;
            background: #0f0f0f;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            scrollbar-color: #2a2a2a transparent;
            border-right: 1px solid #1e1e1e;
            padding: 14px 8px 14px;
            gap: 15px;
        }
        .sidebar::-webkit-scrollbar { width: 3px; }
        .sidebar::-webkit-scrollbar-thumb { background: #2a2a2a; border-radius: 3px; }

        .sb-toggle-float {
            position: absolute;
            right: -16px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 56px;
            background: #0f0f0f;
            border: 1.5px solid #2c2c2c;
            border-left: none;
            border-radius: 0 50px 50px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 200;
            transition: background 0.2s, width 0.15s;
            padding: 0;
        }
        .sb-toggle-float:hover {
            background: #1c1c1c;
            width: 20px;
        }
        .sb-toggle-float i {
            font-size: 10px;
            color: #fa4101;
            transition: transform 0.3s;
            margin-left: 2px;
        }
        .sidebar-wrap.collapsed .sb-toggle-float i { transform: rotate(180deg); }

        /* label de seção */
        .sb-label {
            font-size: 0.56rem; font-weight: 700; letter-spacing: 1.8px;
            text-transform: uppercase; color: #3a3a3a;
            padding: 10px 8px 4px;
            white-space: nowrap; overflow: hidden;
            transition: opacity 0.15s, height 0.2s, padding 0.2s;
        }
        .sidebar-wrap.collapsed .sb-label { opacity: 0; height: 0; padding: 0; pointer-events: none; }

        .sb-divider {
            height: 1px; background: #1c1c1c;
            margin: 4px 2px 2px;
            transition: opacity 0.15s;
        }
        .sidebar-wrap.collapsed .sb-divider { opacity: 0; margin: 2px 0; }

        /* item */
        .sb-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 9px 10px;
            border-radius: 10px;
            color: #777;
            text-decoration: none;
            font-size: 0.81rem;
            font-weight: 500;
            white-space: nowrap;
            transition: all 0.18s ease;
            position: relative;
        }
        .sb-link:hover { background: #181818; color: #ccc; }
        .sb-link:hover .sb-icon { color: #fa4101; }
        .sb-link.active {
            background: #fa4101;
            color: #fff;
            box-shadow: 0 4px 14px rgba(250,65,1,0.28);
        }
        .sb-link.active .sb-icon { color: #fff; }

        .sb-icon {
            font-size: 15px; min-width: 18px;
            text-align: center; flex-shrink: 0;
            color: #4a4a4a; transition: color 0.18s;
        }
        .sb-link.active .sb-icon { color: #fff; }

        .sb-text { overflow: hidden; text-overflow: ellipsis; }

        /* colapsado: centraliza ícone */
        .sidebar-wrap.collapsed .sb-text { display: none; }
        .sidebar-wrap.collapsed .sb-link { justify-content: center; padding: 10px 0; }

        /* tooltip colapsado */
        .sidebar-wrap.collapsed .sb-link::after {
            content: attr(data-tooltip);
            position: fixed;
            left: 76px;
            background: #111;
            color: #eee;
            font-size: 0.74rem;
            font-weight: 600;
            padding: 5px 11px;
            border-radius: 8px;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.15s;
            z-index: 2000;
            border: 1px solid #2a2a2a;
            box-shadow: 0 4px 16px rgba(0,0,0,0.4);
        }
        .sidebar-wrap.collapsed .sb-link:hover::after { opacity: 1; }

        .sb-spacer { flex: 1; min-height: 8px; }

        /* ── MAIN ── */
        .main-content { flex: 1; min-width: 0; padding: 0; }
        .alert { border-radius: 8px !important; }

        /* ── MOBILE ── */
        .mobile-menu-toggle {
            display: none; background: none; border: none;
            color: #fff; font-size: 22px; cursor: pointer; padding: 6px;
        }
        .mobile-sidebar-overlay {
            display: none; position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.6); z-index: 1030;
            opacity: 0; transition: opacity 0.3s;
        }
        .mobile-sidebar-overlay.active { opacity: 1; }

        @media (max-width: 768px) {
            .mobile-menu-toggle { display: flex; align-items: center; }
            .mobile-sidebar-overlay { display: block; }
            .user-chip-name, .user-tipo-badge { display: none !important; }
            .sidebar-wrap {
                position: fixed;
                left: -220px;
                top: 64px;
                height: calc(100vh - 64px);
                z-index: 1035;
                width: 220px !important;
                transition: left 0.3s cubic-bezier(0.4,0,0.2,1);
            }
            .sidebar-wrap.mobile-open { left: 0; }
            .sb-toggle-float { display: none; }
            .page-wrapper { flex-direction: column; }
            .main-content { width: 100%; }
        }
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
                <i class="fa-solid fa-circle-arrow-left"></i> VOLTAR
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

            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Menu">
                <i class="bi bi-list"></i>
            </button>
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
    <div class="sidebar-wrap" id="sidebarWrap">

        <aside class="sidebar">

            <div class="sb-label">Geral</div>
            <a href="{{ route('perfil') }}" class="sb-link {{ request()->is('perfil*') ? 'active' : '' }}" data-tooltip="Meu Perfil">
                <i class="fa fa-circle-user sb-icon"></i><span class="sb-text">Meu Perfil</span>
            </a>

            @if(Auth::user()->isCliente())
                <div class="sb-divider"></div>
                <div class="sb-label">Minha Área</div>
                <a href="{{ route('solicitacoes.index') }}" class="sb-link {{ request()->is('solicitacoes*') ? 'active' : '' }}" data-tooltip="Solicitações">
                    <i class="bi bi-clipboard-check sb-icon"></i><span class="sb-text">Solicitações</span>
                </a>
                <a href="{{ route('agendamentos.index') }}" class="sb-link {{ request()->is('agendamentos*') ? 'active' : '' }}" data-tooltip="Agendamentos">
                    <i class="bi bi-calendar-check sb-icon"></i><span class="sb-text">Agendamentos</span>
                </a>
                <a href="{{ route('avaliacoes.index') }}" class="sb-link {{ request()->is('avaliacoes*') ? 'active' : '' }}" data-tooltip="Avaliações">
                    <i class="bi bi-star sb-icon"></i><span class="sb-text">Avaliações</span>
                </a>
                <a href="{{ route('pagamentos.index') }}" class="sb-link {{ request()->is('pagamentos*') ? 'active' : '' }}" data-tooltip="Pagamentos">
                    <i class="bi bi-credit-card sb-icon"></i><span class="sb-text">Pagamentos</span>
                </a>
                <div class="sb-divider"></div>
                <div class="sb-label">Explorar</div>
                <a href="{{ route('servicos.index') }}" class="sb-link {{ request()->is('servicos*') ? 'active' : '' }}" data-tooltip="Serviços">
                    <i class="bi bi-tools sb-icon"></i><span class="sb-text">Serviços</span>
                </a>
                <a href="{{ route('produtos.index') }}" class="sb-link {{ request()->is('produtos*') ? 'active' : '' }}" data-tooltip="Produtos">
                    <i class="bi bi-bag sb-icon"></i><span class="sb-text">Produtos</span>
                </a>
            @endif

            @if(Auth::user()->isPrestador())
                <div class="sb-divider"></div>
                <div class="sb-label">Meu Negócio</div>
                <a href="{{ route('servicos.index') }}" class="sb-link {{ request()->is('servicos*') ? 'active' : '' }}" data-tooltip="Meus Serviços">
                    <i class="bi bi-tools sb-icon"></i><span class="sb-text">Meus Serviços</span>
                </a>
                <a href="{{ route('produtos.index') }}" class="sb-link {{ request()->is('produtos*') ? 'active' : '' }}" data-tooltip="Meus Produtos">
                    <i class="bi bi-bag sb-icon"></i><span class="sb-text">Meus Produtos</span>
                </a>
                <a href="{{ route('orcamentos.index') }}" class="sb-link {{ request()->is('orcamentos*') ? 'active' : '' }}" data-tooltip="Orçamentos">
                    <i class="bi bi-receipt sb-icon"></i><span class="sb-text">Orçamentos</span>
                </a>
                <div class="sb-divider"></div>
                <div class="sb-label">Clientes</div>
                <a href="{{ route('solicitacoes.index') }}" class="sb-link {{ request()->is('solicitacoes*') ? 'active' : '' }}" data-tooltip="Solicitações">
                    <i class="bi bi-clipboard-check sb-icon"></i><span class="sb-text">Solicitações</span>
                </a>
                <a href="{{ route('agendamentos.index') }}" class="sb-link {{ request()->is('agendamentos*') ? 'active' : '' }}" data-tooltip="Agendamentos">
                    <i class="bi bi-calendar-check sb-icon"></i><span class="sb-text">Agendamentos</span>
                </a>
                <a href="{{ route('avaliacoes.index') }}" class="sb-link {{ request()->is('avaliacoes*') ? 'active' : '' }}" data-tooltip="Avaliações">
                    <i class="bi bi-star sb-icon"></i><span class="sb-text">Avaliações</span>
                </a>
                <a href="{{ route('pagamentos.index') }}" class="sb-link {{ request()->is('pagamentos*') ? 'active' : '' }}" data-tooltip="Pagamentos">
                    <i class="bi bi-credit-card sb-icon"></i><span class="sb-text">Pagamentos</span>
                </a>
            @endif

            @if(Auth::user()->isAdm())
                <div class="sb-divider"></div>
                <div class="sb-label">Administração</div>
                <a href="{{ route('dashboard') }}" class="sb-link {{ request()->is('dashboard') ? 'active' : '' }}" data-tooltip="Dashboard">
                    <i class="fa fa-house sb-icon"></i><span class="sb-text">Dashboard</span>
                </a>
                <a href="{{ route('usuarios.index') }}" class="sb-link {{ request()->is('usuarios*') ? 'active' : '' }}" data-tooltip="Usuários">
                    <i class="fa fa-users sb-icon"></i><span class="sb-text">Usuários</span>
                </a>
                <a href="{{ route('servicos.index') }}" class="sb-link {{ request()->is('servicos*') ? 'active' : '' }}" data-tooltip="Serviços">
                    <i class="fa fa-tools sb-icon"></i><span class="sb-text">Serviços</span>
                </a>
                <a href="{{ route('produtos.index') }}" class="sb-link {{ request()->is('produtos*') ? 'active' : '' }}" data-tooltip="Produtos">
                    <i class="fa fa-cart-shopping sb-icon"></i><span class="sb-text">Produtos</span>
                </a>
                <a href="{{ route('solicitacoes.index') }}" class="sb-link {{ request()->is('solicitacoes*') ? 'active' : '' }}" data-tooltip="Solicitações">
                    <i class="bi bi-clipboard-check sb-icon"></i><span class="sb-text">Solicitações</span>
                </a>
                <a href="{{ route('orcamentos.index') }}" class="sb-link {{ request()->is('orcamentos*') ? 'active' : '' }}" data-tooltip="Orçamentos">
                    <i class="fa fa-receipt sb-icon"></i><span class="sb-text">Orçamentos</span>
                </a>
                <a href="{{ route('agendamentos.index') }}" class="sb-link {{ request()->is('agendamentos*') ? 'active' : '' }}" data-tooltip="Agendamentos">
                    <i class="fa fa-clock sb-icon"></i><span class="sb-text">Agendamentos</span>
                </a>
                <a href="{{ route('avaliacoes.index') }}" class="sb-link {{ request()->is('avaliacoes*') ? 'active' : '' }}" data-tooltip="Avaliações">
                    <i class="fa fa-star sb-icon"></i><span class="sb-text">Avaliações</span>
                </a>
                <a href="{{ route('pagamentos.index') }}" class="sb-link {{ request()->is('pagamentos*') ? 'active' : '' }}" data-tooltip="Pagamentos">
                    <i class="fa-solid fa-credit-card sb-icon"></i><span class="sb-text">Pagamentos</span>
                </a>
            @endif

            <div class="sb-spacer"></div>
        </aside>

        <button class="sb-toggle-float" id="sidebarToggle" title="Expandir/Colapsar">
            <i class="bi bi-chevron-left"></i>
        </button>

    </div>
    @endauth

    <main class="main-content">
        @if(session('sucesso'))
            <div class="alert alert-success alert-dismissible fade show m-3" style="border-left:4px solid #198754;">
                <i class="bi bi-check-circle me-2"></i>{{ session('sucesso') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('erro'))
            <div class="alert alert-danger alert-dismissible fade show m-3" style="border-left:4px solid #dc3545;">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('erro') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show m-3" style="border-left:4px solid #dc3545;">
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

    const wrap      = document.getElementById('sidebarWrap');
    const toggleBtn = document.getElementById('sidebarToggle');

    if (wrap && toggleBtn) {
        if (localStorage.getItem('sidebarCollapsed') === 'true') wrap.classList.add('collapsed');
        toggleBtn.addEventListener('click', function () {
            wrap.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', wrap.classList.contains('collapsed'));
        });
    }

    const mobileToggle  = document.getElementById('mobileMenuToggle');
    const mobileOverlay = document.getElementById('mobileSidebarOverlay');
    if (mobileToggle && wrap) {
        mobileToggle.addEventListener('click', function () {
            wrap.classList.toggle('mobile-open');
            mobileOverlay.classList.toggle('active');
        });
        mobileOverlay.addEventListener('click', function () {
            wrap.classList.remove('mobile-open');
            mobileOverlay.classList.remove('active');
        });
    }

    const chip = document.getElementById('userChip');
    if (chip) {
        chip.addEventListener('click', function (e) { e.stopPropagation(); chip.classList.toggle('open'); });
        document.addEventListener('click', function (e) { if (!chip.contains(e.target)) chip.classList.remove('open'); });
    }
});
</script>

@yield('scripts')
</body>
</html>