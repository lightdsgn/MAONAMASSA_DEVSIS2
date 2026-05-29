@extends('layouts.app')

@section('navbar-menu')
<div class="d-flex gap-4">
    <a href="#" class="text-white fw-semibold text-decoration-none">Início</a>
    <a href="#como-funciona" class="text-white fw-semibold text-decoration-none">Como Funciona</a>
    <a href="#sobre" class="text-white fw-semibold text-decoration-none">Sobre</a>
    <a href="#por-que" class="text-white fw-semibold text-decoration-none">Benefícios</a>
</div>
@endsection

@section('navbar-botoes')
@guest
    <a href="{{ route('registro') }}" class="botaocadastro">Cadastro</a>
    <a href="{{ route('login') }}" class="botaologin ms-2">Login</a>
@endguest
@endsection

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;900&display=swap');
    * { font-family: 'Sora', sans-serif; }
    body { background-color: #fff; overflow-x: hidden; }

    .botaocadastro {
        background-color: transparent;
        color: #ffffff;
        border: 2px solid #ffffff;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .botaologin {
        background-color: #0a0a0a;
        color: #ffffff;
        border: 2px solid #0a0a0a;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .botaocadastro:hover { background-color: #ffffff; color: #fa4101; transform: scale(1.05); }
    .botaologin:hover { transform: scale(1.05); }

    /* HERO */
    .hero {
        background-color: #fff;
        padding: 60px 80px 0 80px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        overflow: hidden;
        min-height: 520px;
    }
    .hero-text { padding-bottom: 80px; }
    .hero-text h1 {
        font-size: 4.5rem;
        font-weight: 900;
        line-height: 0.95;
        color: #111;
        letter-spacing: -3px;
    }
    .hero-text h1 span {
        background: linear-gradient(90deg, #fa4101, #f97316);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .hero-text p {
        color: #444;
        font-size: 1.05rem;
        margin: 20px 0;
        max-width: 420px;
        line-height: 1.6;
    }
    .hero-buttons { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 24px; }
    .btn-hero {
        padding: 12px 24px;
        border: 2px solid #fa4101;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
        color: #fa4101;
        text-decoration: none;
        text-transform: uppercase;
        transition: all 0.2s;
    }
    .btn-hero:hover { background-color: #fa4101; color: #fff; }

    .hero-image-wrapper {
        position: relative;
        width: 520px;
        min-width: 320px;
        flex-shrink: 0;
        display: flex;
        align-items: flex-end;
        justify-content: center;
    }
    .hero-image-wrapper .circulo {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 400px;
        height: 400px;
        background: linear-gradient(135deg, #fa4101, #f97316);
        border-radius: 50%;
        z-index: 0;
    }
    .hero-image-wrapper img {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 520px;
        object-fit: contain;
    }

    /* CURVA branca → laranja */
    .curva-down {
        background: #fff;
        line-height: 0;
        margin-bottom: -2px;
    }
    .curva-down svg { display: block; width: 100%; }

    /* CURVA laranja → branca */
    .curva-up {
        background: #fa4101;
        line-height: 0;
        margin-bottom: -2px;
    }
    .curva-up svg { display: block; width: 100%; }

    /* COMO FUNCIONA */
    .como-funciona {
        background-color: #fa4101;
        padding: 60px 60px 80px;
        text-align: center;
    }
    .como-funciona h2 {
        font-size: 2.2rem;
        font-weight: 900;
        color: #fff;
        text-transform: uppercase;
        margin-bottom: 40px;
    }
    .como-funciona img { max-width: 900px; width: 100%; }
    .como-funciona p {
        color: #fff;
        margin-top: 30px;
        font-size: 1rem;
        max-width: 750px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.8;
    }

    /* SOBRE */
    .sobre {
        background: #fff;
        padding: 80px 80px;
        display: flex;
        gap: 80px;
        align-items: center;
    }
    .sobre-text h2 {
        font-size: 3rem;
        font-weight: 900;
        color: #fa4101;
        text-transform: uppercase;
        margin-bottom: 20px;
    }
    .sobre-text p {
        color: #333;
        line-height: 1.9;
        font-size: 1rem;
        margin-bottom: 16px;
    }
    .sobre-text p span { color: #fa4101; font-weight: 700; }
    .sobre img {
        width: 420px;
        min-width: 280px;
        border-radius: 20px;
        flex-shrink: 0;
        transition: transform 0.3s;
    }
    .sobre img:hover { transform: scale(1.03); }

    /* POR QUE */
    .por-que { background: #111; padding: 80px 60px; }
    .por-que h2 {
        font-size: 2.2rem;
        font-weight: 900;
        color: #fff;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 50px;
    }
    .por-que h2 span { color: #fa4101; }
    .por-que img { max-width: 800px; width: 100%; display: block; margin: 0 auto; }

    /* FOOTER */
    .footer {
        background: #0a0a0a;
        padding: 60px;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 40px;
        border-top: 3px solid #fa4101;
    }
    .footer-brand h3 { font-weight: 900; font-size: 1.5rem; color: #fff; }
    .footer-brand h3 span { color: #fa4101; }
    .footer-brand p { color: #666; font-size: 0.85rem; margin-top: 8px; }
    .footer-col h5 { color: #fff; font-weight: 700; font-size: 0.95rem; margin-bottom: 16px; }
    .footer-col a {
        display: block; color: #666; font-size: 0.85rem;
        text-decoration: none; margin-bottom: 8px; transition: color 0.2s;
    }
    .footer-col a:hover { color: #fa4101; }
    .footer-bottom {
        background: #0a0a0a; text-align: center;
        padding: 16px; color: #444; font-size: 0.8rem;
        border-top: 1px solid #1a1a1a;
    }

    /* RESPONSIVO */
    @media (max-width: 768px) {
        .hero { flex-direction: column; padding: 40px 24px 0; min-height: auto; }
        .hero-text h1 { font-size: 2.8rem; letter-spacing: -1px; }
        .hero-image-wrapper { width: 100%; margin-top: 40px; }
        .hero-image-wrapper .circulo { width: 280px; height: 280px; }
        .sobre { flex-direction: column; padding: 40px 24px; gap: 32px; }
        .sobre img { width: 100%; }
        .como-funciona { padding: 40px 24px; }
        .por-que { padding: 40px 24px; }
        .footer { padding: 40px 24px; flex-direction: column; }
    }
</style>

{{-- HERO --}}
<section class="hero">
    <div class="hero-text">
        <h1>Aqui a gente põem<br>a <span>Mão na Massa</span><br>por você!</h1>
        <p>Conectamos clientes a prestadores de serviço confiáveis, de forma rápida, <strong>prática</strong> e segura.</p>
        <div class="hero-buttons">
            <a href="{{ route('servicos.index') }}" class="btn-hero">Serviços</a>
            <a href="{{ route('produtos.index') }}" class="btn-hero">Produtos</a>
            <a href="{{ route('solicitacoes.index') }}" class="btn-hero">Agendamento</a>
            <a href="#sobre" class="btn-hero">Parcerias</a>
        </div>
    </div>
    <div class="hero-image-wrapper">
        <div class="circulo"></div>
        <img src="/BANNER.png" alt="Prestador">
    </div>
</section>

{{-- CURVA branca → laranja --}}
<div class="curva-down">
    <svg viewBox="0 0 1440 100" preserveAspectRatio="none" style="height:100px;">
        <path d="M0,0 C480,100 960,100 1440,0 L1440,100 L0,100 Z" fill="#fa4101"/>
    </svg>
</div>

{{-- COMO FUNCIONA --}}
<section class="como-funciona" id="como-funciona">
    <h2>Como Funciona?</h2>
    <img src="/COMOFUNCIONA.png" alt="Como Funciona">
    <p>Após o agendamento, o profissional irá <strong>executar o serviço</strong> ao qual você pode <strong>avaliar</strong> em diferentes critérios. Além disso, o pagamento fica retido em nossa plataforma até a conclusão do processo e sua confirmação!</p>
</section>

{{-- CURVA laranja → branca --}}
<div class="curva-up">
    <svg viewBox="0 0 1440 100" preserveAspectRatio="none" style="height:100px;">
        <path d="M0,100 C480,0 960,0 1440,100 L1440,0 L0,0 Z" fill="#fff"/>
    </svg>
</div>

{{-- SOBRE --}}
<section class="sobre" id="sobre">
    <div class="sobre-text">
        <h2>Sobre Nós</h2>
        <p>A empresa <span>Mão na Massa</span> surgiu com o propósito de modernizar o acesso a serviços domésticos e de manutenção, unindo tecnologia e praticidade. Fundada em 2025 em Chapecó/SC, a startup nasceu da necessidade de <span>encontrar profissionais confiáveis</span> para atividades do dia a dia.</p>
        <p>A partir disso, a empresa desenvolveu uma plataforma online capaz de conectar clientes a prestadores de serviço verificados, garantindo uma experiência mais segura, organizada e transparente para ambas as partes.</p>
    </div>
    <img class="imgsobre" src="/SOBRE.png" alt="Sobre nós">
</section>

{{-- POR QUE --}}
<section class="por-que" id="por-que">
    <h2>Por que nos <span>Escolher</span>?</h2>
    <img src="/PORQUEESOLHER.png" alt="Por que nos escolher">
</section>

{{-- FOOTER --}}
<footer class="footer">
    <div class="footer-brand">
        <h3>Mão na <span>Massa</span></h3>
        <p>Mão na Massa 2025 · Todos os direitos reservados</p>
    </div>
    <div class="footer-col">
        <h5>Acessar plataforma</h5>
        <a href="{{ route('solicitacoes.index') }}">Solicitar serviço</a>
        <a href="{{ route('servicos.index') }}">Buscar prestadores</a>
        <a href="{{ route('produtos.index') }}">Produtos e materiais</a>
        <a href="{{ route('orcamentos.index') }}">Orçamentos</a>
    </div>
    <div class="footer-col">
        <h5>Suporte</h5>
        <a href="#">Central de Ajuda</a>
        <a href="#">Perguntas frequentes</a>
        <a href="#">Fale conosco</a>
        <a href="#">Políticas e termos</a>
        <a href="#">Segurança</a>
    </div>
</footer>
<div class="footer-bottom">
    Mão na Massa 2025 · Todos os direitos reservados
</div>

@endsection