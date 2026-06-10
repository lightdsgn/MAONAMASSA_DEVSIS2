@extends('layouts.app')

@section('content')

<style>
    :root {
        --ifsc-green: #fa4101;
        --ifsc-green-dark: #ff771c;
        --ifsc-green-light: #EBF5EF;
        --ifsc-yellow: #ffd000;
    }

    .hero-card {
        background: var(--ifsc-green);
        border-radius: 12px;
        border-bottom: 5px solid var(--ifsc-yellow);
    }

    .hero-tag {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 4px 12px;
        border-radius: 4px;
    }

    .hero-tag-outline {
        background: transparent;
        border: 1px solid rgba(255,255,255,0.4);
        color: rgba(255,255,255,0.9);
    }

    .hero-tag-yellow {
        background: var(--ifsc-yellow);
        color: #1a1a1a;
    }

    .content-card {
        border-radius: 10px;
        border: 1px solid #e4e7eb;
        background: #fff;
    }

    .tech-tag {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 4px;
        font-size: 0.82rem;
        font-weight: 500;
        background: #f4f6f8;
        color: #374151;
        border: 1px solid #dde1e7;
        margin: 3px 2px;
    }

    .feature-row-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 16px 0;
        border-bottom: 1px solid #f0f2f5;
    }

    .feature-row-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .feature-row-item:first-child {
        padding-top: 0;
    }

    .feature-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .team-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .team-chip {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 9px 16px 9px 10px;
        border: 1px solid #e0e5ea;
        border-radius: 8px;
        background: #fff;
    }

    .team-chip-initial {
        width: 34px;
        height: 34px;
        border-radius: 6px;
        background: var(--ifsc-green);
        color: #fff;
        font-size: 0.78rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .team-chip-name {
        font-size: 0.88rem;
        font-weight: 600;
        color: #1a1a1a;
        white-space: nowrap;
    }

    .academic-bar {
        background: var(--ifsc-green-light);
        border: 1px solid #c6dfd0;
        border-radius: 8px;
        padding: 12px 18px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .academic-bar-text {
        font-size: 0.84rem;
        color: #374151;
    }

    .academic-bar-text strong {
        color: var(--ifsc-green-dark);
    }
</style>

<div class="container-fluid py-4">

    {{-- ===== HERO ===== --}}
    <div class="hero-card p-4 p-md-4 mb-4">
        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
            <span class="hero-tag hero-tag-outline">
                <i class="bi bi-mortarboard-fill me-1"></i>IFSC · Câmpus Chapecó
            </span>
            <span class="hero-tag hero-tag-yellow">Módulo 08</span>
            <span class="hero-tag hero-tag-outline">2026/1</span>
        </div>

        <h1 class="text-white fw-bold mb-1" style="font-size: 1.75rem;">
            Configurações do Sistema
        </h1>
        <p class="mb-0" style="color: rgba(255,255,255,0.75); font-size: 0.95rem;">
            Plataforma <strong style="color:#fff;">Mão na Massa</strong>
            &mdash; Desenvolvimento de Sistemas II
        </p>
    </div>

    {{-- ===== SOBRE + TECNOLOGIAS ===== --}}
    <div class="row mb-4">

        <div class="col-md-6 mb-3 mb-md-0">
            <div class="content-card p-4 h-100">
                <h6 class="fw-bold text-dark mb-3">
                    <i class="bi bi-info-circle-fill me-2" style="color: var(--ifsc-green);"></i>
                    Sobre o Sistema
                </h6>
                <p class="text-muted mb-2" style="font-size: 0.92rem; line-height: 1.65;">
                    O <strong>Mão na Massa</strong> é uma plataforma para conectar
                    clientes a prestadores de serviços de forma rápida, segura e organizada.
                </p>
                <p class="text-muted mb-0" style="font-size: 0.92rem; line-height: 1.65;">
                    O sistema contempla cadastro de usuários, gerenciamento de serviços,
                    orçamentos, agendamentos, pagamentos e avaliações.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="content-card p-4 h-100">
                <h6 class="fw-bold text-dark mb-3">
                    <i class="bi bi-stack me-2" style="color: var(--ifsc-green);"></i>
                    Tecnologias Utilizadas
                </h6>
                <div>
                    <span class="tech-tag">Laravel 13</span>
                    <span class="tech-tag">PHP 8.5</span>
                    <span class="tech-tag">MySQL</span>
                    <span class="tech-tag">Bootstrap 5</span>
                    <span class="tech-tag">Larapex Charts</span>
                    <span class="tech-tag">Blade Templates</span>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== RECURSOS ===== --}}
    <div class="content-card p-4 mb-4">
        <h6 class="fw-bold text-dark mb-3">
            <i class="bi bi-lightning-charge-fill me-2" style="color: var(--ifsc-green);"></i>
            Recursos da Plataforma
        </h6>

        <div class="feature-row-item">
            <div class="feature-icon" style="background: #fa4101;">
                <i style="color: #fff;" class="fa-solid fa-circle-user"></i>
            </div>
            <div>
                <div class="fw-semibold mb-1" style="font-size: 0.92rem;">Segurança e Controle de Acesso</div>
                <p class="text-muted mb-0" style="font-size: 0.87rem;">
                    Perfis distintos para Administrador, Cliente e Prestador,
                    com permissões individuais por nível.
                </p>
            </div>
        </div>

        <div class="feature-row-item">
            <div class="feature-icon" style="background: #fa4101;">
               <i style="color: #fff;" class="fa-solid fa-chart-pie"></i>
            </div>
            <div>
                <div class="fw-semibold mb-1" style="font-size: 0.92rem;">Dashboard com Indicadores</div>
                <p class="text-muted mb-0" style="font-size: 0.87rem;">
                    Visualização em tempo real das operações e métricas
                    da plataforma através de gráficos interativos.
                </p>
            </div>
        </div>

        <div class="feature-row-item">
            <div class="feature-icon" style="background: #fa4101;">
                <i style="color: #fff;" class="fa-solid fa-pen-ruler"></i>
            </div>
            <div>
                <div class="fw-semibold mb-1" style="font-size: 0.92rem;">Sistema de Avaliações</div>
                <p class="text-muted mb-0" style="font-size: 0.87rem;">
                    Reputação pública dos prestadores baseada em avaliações
                    dos clientes, garantindo qualidade e transparência.
                </p>
            </div>
        </div>

    </div>

    {{-- ===== EQUIPE ===== --}}
    <div class="content-card p-4 mb-4">
        <h6 class="fw-bold text-dark mb-3">
            <i class="bi bi-people-fill me-2" style="color: var(--ifsc-green);"></i>
            Equipe de Desenvolvimento
        </h6>

        <div class="team-row">
            @foreach([
                ['nome' => 'Lucas Dacroce',   'iniciais' => 'LD'],
                ['nome' => 'Erik Martins',     'iniciais' => 'EM'],
                ['nome' => 'Bruno do Prado',   'iniciais' => 'BP'],
                ['nome' => 'João Siqueira',    'iniciais' => 'JS'],
                ['nome' => 'Mateus Francisco', 'iniciais' => 'MF'],
            ] as $membro)
            <div class="team-chip">
                <div class="team-chip-initial">{{ $membro['iniciais'] }}</div>
                <span class="team-chip-name">{{ $membro['nome'] }}</span>
            </div>
            @endforeach
        </div>
    </div>


    <div class="academic-bar">
        <span class="academic-bar-text">
            <strong>IFSC · Câmpus Chapecó</strong> - Desenvolvimento de Sistemas II - Módulo 08 - Semestre 2026/1
        </span>
        <span style="font-size: 0.78rem; font-weight: 600; color: var(--ifsc-green-dark);">
            Mão na Massa v1.0
        </span>
    </div>

</div>

@endsection