@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h2 class="fw-bold">
                <i class="bi bi-gear-fill text-warning"></i>
                Configurações do Sistema
            </h2>

            <p class="text-muted mb-0">
                Central de informações e personalização do sistema Mão na Massa.
            </p>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">

                    <h5 class="fw-bold">
                        <i class="bi bi-info-circle"></i>
                        Sobre o Sistema
                    </h5>

                    <hr>

                    <p>
                        O Mão na Massa é uma plataforma desenvolvida para conectar
                        clientes a prestadores de serviços de maneira rápida,
                        segura e organizada.
                    </p>

                    <p>
                        O sistema permite cadastro de usuários, gerenciamento
                        de serviços, solicitações, orçamentos, agendamentos,
                        pagamentos e avaliações.
                    </p>

                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">

                    <h5 class="fw-bold">
                        <i class="bi bi-code-slash"></i>
                        Tecnologias Utilizadas
                    </h5>

                    <hr>

                    <ul>
                        <li>Laravel 13</li>
                        <li>PHP 8.5</li>
                        <li>MySQL</li>
                        <li>Bootstrap 5</li>
                        <li>Larapex Charts</li>
                        <li>Blade Templates</li>
                    </ul>

                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">

                    <i class="bi bi-shield-check display-5 text-success"></i>

                    <h5 class="mt-3">
                        Segurança
                    </h5>

                    <p class="text-muted">
                        Controle de acesso por perfis:
                        Administrador, Cliente e Prestador.
                    </p>

                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">

                    <i class="bi bi-graph-up-arrow display-5 text-primary"></i>

                    <h5 class="mt-3">
                        Dashboard
                    </h5>

                    <p class="text-muted">
                        Indicadores em tempo real para análise
                        das operações da plataforma.
                    </p>

                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">

                    <i class="bi bi-stars display-5 text-warning"></i>

                    <h5 class="mt-3">
                        Avaliações
                    </h5>

                    <p class="text-muted">
                        Sistema de reputação para garantir
                        qualidade e confiança.
                    </p>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection