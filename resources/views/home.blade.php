@extends('layouts.app')
@section('content')
<style>

    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;900&display=swap');

    * { font-family: 'Sora', sans-serif;}
    body{
        background-color: #fff;
    }
    .navbar-nav .nav-link {
    position: relative;
    margin: 0 20px;
    color: #fff;
    font-weight: 500;
    padding: 8px 0;
    transition: 0.2s;
}

.navbar-nav .nav-link::after {
    content: "";
    position: absolute;
    
    left: 50%;
    bottom:5px;
    width: 0%;
    height: 2.4px;
    background: #fff;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.navbar-nav .nav-link:hover::after {
    width: 60%;
}

.navbar-nav .nav-link:hover {
    font-weight: 700;
}
    .botaocadastro{
        background-color: transparent;
        color: #ffffff;
        border: 2px solid #ffffff;
        padding: 6px 14px;
        margin-right:0px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .botaologin{
        background-color: #0a0a0a;
        color: #ffffff;
        border: 2px solid #0a0a0a;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
       
    }
    .botaocadastro:hover{
        background-color: #ffffff;
        color: #fa4101;
        transform:scale(1.05);
    }

    .botaologin:hover{
        transform:scale(1.05);
    }

.hero {
    background-color: #fff;
    padding: 0px 60px 0 60px;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    position: relative;
    z-index: 1;
}
.hero-image-wrapper {
    position: relative;
    width: 800px;
    margin-bottom: -160px;
    z-index: 1; 
}

.hero-image-wrapper img {
    width: 100%;
    height: auto;
    position: relative;
    z-index: 1;
    margin-left: -120px;
}
.curva-topo {
    position: relative;
    z-index: 3; 
    line-height: 0;
}

.curva-topo svg {
    display: block;
    width: 100%;
    height: 120px;
}
.hero-text {
    padding-bottom: 80px; margin-left: 50px;
    margin-top: -50px;

}
    .hero-text h1 {
        font-size: 5rem;
        font-weight: 900;
       
        line-height: 0.95;
        color: #111;
        letter-spacing: -4px;
    }
    .hero-text h1 span {
        background: linear-gradient(90deg, #fa4101, #f97316);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .hero-text p {
        color: #000000;
        font-size: 1.1rem;
        margin: 20px 0;
        max-width: 420px;
    }
    .hero-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 24px;
    }
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
    .btn-hero:hover {
        background-color: #fa4101;
        color: #fff;
    }

    .como-funciona {
        background-color: #fa4101;
        padding: 80px 60px;
        text-align: center;
    }
    .como-funciona h2 {
        font-size: 2.2rem;
        font-weight: 900;
        color: #fff;
        text-transform: uppercase;
        margin-bottom: 50px;
    }

    .sobre {
        background: #fff;
        padding: 80px 60px;
        display: flex;
        gap: 80px;
        align-items: center;
    }
    .sobre-text h2 {
        font-size: 50px;
        font-weight:800;
        color: #fa4101;
        text-transform: uppercase;
        margin-top: -80px;
    }
    .sobre-text p {
        color: #000000;
        line-height: 1.8;
        font-size: 20px;
    
    }
    .sobre-text p span {
        color: #fa4101;
        font-weight: 700;
    }
    .sobre-image {
        min-width: 320px;
        width: 320px;
        height: 280px;
        background: linear-gradient(135deg, #1e293b, #fa4101);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 5rem;
        flex-shrink: 0;
    }

  
    .por-que {
        background: #111;
        padding: 80px 60px;
    }
    .por-que h2 {
        font-size: 2.2rem;
        font-weight: 900;
        color: #fff;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 50px;
    }
    .por-que h2 span {
        color: #fa4101;
    }
    .motivos {
        display: flex;
        flex-direction: column;
        gap: 16px;
        max-width: 800px;
        margin: 0 auto;
    }
    .motivo {
        border: 2px solid #fa4101;
        border-radius: 12px;
        padding: 24px 28px;
        display: flex;
        align-items: center;
        gap: 24px;
    }
    .motivo-icon {
        font-size: 2rem;
        min-width: 50px;
        text-align: center;
    }
    .motivo-title {
        font-weight: 900;
        font-size: 1rem;
        text-transform: uppercase;
        color: #fff;
        min-width: 200px;
    }
    .motivo-desc {
        color: #aaa;
        font-size: 0.9rem;
        line-height: 1.5;
    }

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
    .footer-brand h3 {
        font-weight: 900;
        font-size: 1.5rem;
        color: #fff;
    }
    .footer-brand h3 span { color: #fa4101; }
    .footer-brand p {
        color: #666;
        font-size: 0.85rem;
        margin-top: 8px;
    }
    .footer-col h5 {
        color: #fff;
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 16px;
    }
    .footer-col a {
        display: block;
        color: #666;
        font-size: 0.85rem;
        text-decoration: none;
        margin-bottom: 8px;
        transition: color 0.2s;
    }
    .footer-col a:hover { color: #fa4101; }
    .footer-bottom {
        background: #0a0a0a;
        text-align: center;
        padding: 16px;
        color: #444;
        font-size: 0.8rem;
        border-top: 1px solid #1a1a1a;
    }
    .imgsobre{
        transition: all 0.2s;
    }
    .imgsobre:hover{
        transform: scale(1.03);
    }
</style>


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
        <img  src="/BANNER.png" alt="Prestador">

</section>
<div class="curva-topo">
    <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
        <path d="M0,120 C360,0 1080,0 1440,120 L1440,120 L0,120 Z" fill="#fa4101"></path>
    </svg>
</div>
<section class="como-funciona">
    
    <h2>Como Funciona?</h2>
    <div class="steps">
        <IMG src="/COMOFUNCIONA.png" alt="Como Funciona">
    </div>
    <p style="color: #fff; margin-top:25px;font-size:20px">
        Após o agendamento, o profissional irá <strong>executar o serviço</strong> ao qual você pode<strong> avaliar</strong> em diferentes critérios <br>além disso o pagamento fica retido em nossa plataforma até a conclusão do processo e sua confirmação!
    </p>
</section>
<div class="curva-topo">
    <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
        <path d="M0,120 C360,0 1080,0 1440,120 L1440,120 L0,120 Z" fill="#fa4101"></path>
    </svg>
</div>
<section class="sobre" id="sobre">
    <div class="sobre-text">
        <h2>Sobre Nós</h2>
        <p>A empresa <span>Mão na Massa</span> surgiu com o propósito de modernizar o acesso a serviços domésticos e de manutenção, unindo tecnologia e praticidade. Fundada em 2025 em Chapecó/SC, a startup nasceu da necessidade de <span>encontrar profissionais confiáveis</span>, para atividades do dia a dia.</p>
        <p>A partir disso, a empresa desenvolveu uma plataforma online capaz de conectar clientes a prestadores de serviço verificados, garantindo uma experiência mais segura, organizada e transparente para ambas as partes.</p>
    </div>
    <img class="imgsobre" src="/SOBRE.png" alt="">
</section>


<section class="por-que">
    <h2>Por que nos <span>Escolher</span>?</h2>
    <div class="motivos">
        <img  src="/PORQUEESOLHER.png" alt="">
    </div>
</section>


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