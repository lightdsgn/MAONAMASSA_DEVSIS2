
    @extends('layouts.app')

    @section('content')
    <script src="https://kit.fontawesome.com/7cfadf3f16.js" crossorigin="anonymous"></script>
    <style>
        
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800;900&display=swap');

    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; font-family:'Sora',sans-serif; }
    html { scroll-behavior:smooth; }
    body { background:#fff; overflow-x:hidden; }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(40px); } 
        to   { opacity:1; transform:translateY(0); }
    }
    @keyframes fadeLeft {
        from { opacity:0; transform:translateX(-40px); }
        to   { opacity:1; transform:translateX(0); }
    }
    @keyframes fadeRight {
        from { opacity:0; transform:translateX(40px); }
        to   { opacity:1; transform:translateX(0); }
    }
    @keyframes scaleIn {
        from { opacity:0; transform:scale(0.92); }
        to   { opacity:1; transform:scale(1); }
    }
    @keyframes float {
        0%,100% { transform:translateY(0); }
        50%      { transform:translateY(-14px); }
    }
    @keyframes pulse-dot {
        0%,100% { opacity:1; transform:scale(1); }
        50%     { opacity:0.5; transform:scale(1.4); }
    }
    @keyframes heroImageFade {
        from { opacity:0; transform:translateY(40px) scale(0.95); }
        to   { opacity:1; transform:translateY(0) scale(1); }
    }

    .anim-up    { opacity:0; animation:fadeUp    0.8s ease forwards paused; }
    .anim-left  { opacity:0; animation:fadeLeft  0.8s ease forwards paused; }
    .anim-right { opacity:0; animation:fadeRight 0.8s ease forwards paused; }
    .anim-scale { opacity:0; animation:scaleIn   0.8s ease forwards paused; }
    .delay-1 { animation-delay:0.15s; }
    .delay-2 { animation-delay:0.30s; }
    .delay-3 { animation-delay:0.45s; }
    .delay-4 { animation-delay:0.60s; }

    .hero {
        min-height: auto;
        background:
            radial-gradient(ellipse 55% 70% at 75% 50%, rgba(250,65,1,0.08) 0%, transparent 70%);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 60px;
        padding: 30px 8% 80PX;
        position: relative;
    }



    .hero-image {
        flex-shrink: 0;
        width: clamp(300px, 38vw, 650px);
        animation: heroImageFade 0.8s ease forwards, float 3.5s ease-in-out 0.8s infinite; 
        filter: drop-shadow(0 20px 40px rgba(250,65,1,0.3));
        align-self: flex-end;
    }

    .hero-image img {
        width: 110%;
        height: auto;
        display: block;
        object-fit: contain;
        margin-bottom: 0;
        
    }


    .hero::before {
        content: "";
        position: absolute;
        inset: 0;
        bottom: -120px; /* estende o grid pra baixo da curva */
        background-image:
            linear-gradient(rgba(250,65,1,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(250,65,1,0.03) 1px, transparent 1px);
        background-size: 52px 52px;
        pointer-events: none;
        z-index: 0;
    }
    .hero-text {
        flex: 1;
        max-width: 860px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(250,65,1,0.08);
        border: 1px solid rgba(250,65,1,0.2);
        color: #fa4101;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 6px 14px;
        border-radius: 20px;
        margin-bottom: 24px;
    }
    .hero-tag .dot {
        width: 7px; height: 7px;
        background: #fa4101;
        border-radius: 50%;
        animation: pulse-dot 1.6s ease infinite;
    }

    .hero-text h1 {
        font-size: clamp(2.8rem, 5vw, 5rem);
        font-weight: 900;
        line-height: 1;
        color: #111;
        letter-spacing: -3px;
    }
    .hero-text h1 em {
        font-style: normal;
        color: #fa4101;
    }

    .hero-text > p {
        margin-top: 22px;
        font-size: 1.05rem;
        line-height: 1.85;
        color: #555;
        max-width: 480px;
    }

    .hero-stats {
        display: flex;
        gap: 36px;
        margin-top: 36px;
        padding-top: 28px;
        border-top: 1px solid rgba(0,0,0,0.07);
        width: 100%;
    }
    .stat strong {
        display: block;
        font-size: 1.9rem;
        font-weight: 900;
        color: #fa4101;
        line-height: 1;
    }
    .stat span {
        display: block;
        font-size: 0.72rem;
        font-weight: 700;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-top: 5px;
    }

    .hero-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 32px;
    }
    .btn-primary-hero {
        padding: 14px 28px;
        background: #fa4101;
        color: #fff;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.88rem;
        border: 2px solid #fa4101;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s;
    }
    .btn-primary-hero:hover {
        background: #d93600;
        border-color: #d93600;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(250,65,1,0.3);
    }
    .btn-outline-hero {
        padding: 14px 28px;
        background: transparent;
        color: #fa4101;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.88rem;
        border: 2px solid #fa4101;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s;
    }
    .btn-outline-hero:hover {
        background: #fa4101;
        color: #fff;
        transform: translateY(-3px);
    }


    .wave-down {
        line-height: 0;
        position: relative;
        z-index: 2;
        margin-bottom:-1px;
        
    }
    .wave-down svg { display:block; width:100%; }
    .wave-up { background:#fff; line-height:0; margin-bottom:0; }
.wave-up svg { display:block; width:100%; }
    .como-funciona {
        background: #fa4101;
        padding: 80px 8%;
        text-align: center;
    }
    .como-funciona h2 {
        color: #fff;
        font-size: clamp(1.8rem, 3.5vw, 2.8rem);
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -1px;
        margin-bottom: 48px;
    }
    .cf-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        max-width: 1100px;
        margin: 0 auto;
    }
    .cf-card {
        background: #fff;
        border-radius: 14px;
        border:10px solid #fff;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        opacity: 0;
        transform: translateY(40px);
    }
    .cf-card.visible {
        opacity: 1;
        transform: translateY(0);
    }
    .cf-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 24px 48px rgba(0,0,0,0.2);
    }
    .cf-img-wrap { position: relative; }
    .cf-img-wrap img { width: 100%; height: 180px; object-fit: cover; display: block; }
    .cf-badge {
        position: absolute;
        top: 10px; left: 10px;
        background: #000000;
        color: #fff;
        font-size: 0.72rem;
        font-weight: 900;
        padding: 6px 12px;
        border-radius: 16px;
    }
    .cf-label {
        background: #000000;
        color: #fff;
        font-size: 0.8rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 16px;
        border-radius: 0 0 14px 14px;
        text-align: center;
        transition: background 0.3s;
    }
    .cf-card:hover .cf-label { background: #000000; }
    .cf-desc {
        padding: 16px;
        font-size: 0.85rem;
        color: #444;
        line-height: 1.7;
        text-align: center;
    }
    .como-funciona > p {
        color: rgba(255,255,255,0.9);
        margin-top: 40px;
        line-height: 1.9;
        font-size: 1rem;
        max-width: 720px;
        margin-left: auto;
        margin-right: auto;
    }


    .sobre {
        padding: 100px 8%;
        display: flex;
        align-items: center;
        gap: 80px;
        background: #fff;
    }
    .sobre-text { flex:1; }
    .sobre-text h2 {
        font-size: clamp(2rem, 4vw, 3.2rem);
        font-weight: 900;
        width:400px;
        color: #fa4101;
        text-transform: uppercase;
        letter-spacing: -2px;
        margin-bottom: 24px;
        line-height: 1;
    }
    .sobre-text p {
        color: #444;
        font-size: 1.02rem;
        line-height: 1.9;
        margin-bottom: 18px;
    }
    .sobre-text b { color: #fa4101; }
    .sobre-badges { display:flex; flex-wrap:wrap; gap:10px; margin-top:16px; }
    .sobre-badge {
        background: #fff5f0;
        border: 1px solid rgba(250,65,1,0.18);
        border-radius: 10px;
        padding: 10px 16px;
        font-size: 0.82rem;
        font-weight: 700;
        color: #fa4101;
    }


    .sobre-img-wrap img { width: 100%; height: auto; display: block; object-fit: contain; transition:0.5s; margin-top:50px; }
    .sobre-img-wrap img:hover { transform: scale(1.05); }
    .vantagens .sobre-img-wrap img:hover { transform: none; }
    .vantagens {
        background: #111;
        padding: 100px 8%;
        text-align: center;
    }
    .vantagens h2 {
        color: #fff;
        font-size: clamp(1.8rem, 3.5vw, 2.8rem);
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -1px;
        margin-bottom: 56px;
    }
    .vantagens h2 span { color: #fa4101; }

    .footer {
        background: #0a0a0a;
        padding: 70px 8%;
        display: flex;
        justify-content: space-between;
        gap: 50px;
        flex-wrap: wrap;
        border-top: 3px solid #fa4101;
    }
    .footer h3 { font-size:1.5rem; font-weight:900; color:#fff; }
    .footer h3 span { color:#fa4101; }
    .footer > div > p { color:#555; margin-top:10px; font-size:0.88rem; }
    .footer-col h4 { color:#fff; font-weight:700; margin-bottom:14px; font-size:0.9rem; }
    .footer-col a {
        display:block; color:#555; text-decoration:none;
        margin-bottom:10px; font-size:0.85rem; transition:all 0.2s;
    }
    .footer-col a:hover { color:#fa4101; padding-left:5px; }
    .footer-bottom {
        background:#0a0a0a; border-top:1px solid #1a1a1a;
        text-align:center; padding:18px; color:#444; font-size:0.8rem;
    }
    @media(max-width:992px){
        .hero {
            flex-direction: column-reverse;
            align-items: center;
            text-align: center;
            padding: 40px 6% 0;
            gap: 0;
        }
        .hero-text {
            align-items: center;
            max-width: 100%;
            padding-bottom: 40px;
        }
        .hero-image {
            width: clamp(220px, 70vw, 360px);
            animation: none;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            margin-bottom:50px;
            margin-top:50px;
        }
        .hero-text > p { max-width: 100%; }
        .hero-stats { justify-content: center; }
        .hero-buttons { justify-content: center; }
        .hero-image {
            width: clamp(220px, 70vw, 360px);
            animation: none;
        }
        .sobre { flex-direction:column; text-align:center; gap:40px; padding:70px 6%; }
        .sobre-img-wrap img { max-width:500px; margin:0 auto; }
        .sobre-badges { justify-content:center; }
    }

    @media(max-width:768px){
        .hero { padding: 30px 5% 0; }
            .cf-grid { grid-template-columns: 1fr; max-width: 380px; }

        .btn-primary-hero, .btn-outline-hero {
            width: auto;
            padding: 12px 20px;
            font-size: 0.78rem;
        }
        .hero-buttons { gap: 8px; }
        .footer { flex-direction:column; padding:50px 5%; }
        .wave-down svg, .wave-up svg { height:70px; }
        .hero-stats { gap:20px; flex-wrap:wrap; }
        .hero-image { width: clamp(200px, 65vw, 300px); }
    }

    @media(max-width:480px){
        .hero-text h1 { letter-spacing: -1.5px; }
        .btn-primary-hero, .btn-outline-hero { font-size: 0.75rem; padding: 11px 16px; }
    }
    </style>

    <section class="hero" >
        <div class="hero-text">

            <h1 class="anim-up delay-1">
                Aqui a gente põe<br>
                a <em>Mão na Massa</em><br>
                por você
            </h1>
            <p class="anim-up delay-2">
                Conectamos clientes a prestadores de serviço confiáveis,
                de forma rápida, prática e segura.
            </p>
            <div class="hero-stats anim-up delay-3">
                <div class="stat"><strong>500+</strong><span>Prestadores</span></div>
                <div class="stat"><strong>2k+</strong><span>Serviços feitos</span></div>
                <div class="stat"><strong>4.9</strong><span>Avaliação média</span></div>
            </div>
            <div class="hero-buttons anim-up delay-4">
                <a href="{{ route('servicos.index') }}" class="btn-primary-hero">Ver Serviços</a>
                <a href="{{ route('produtos.index') }}" class="btn-outline-hero">Produtos</a>
                <a href="{{ route('solicitacoes.index') }}" class="btn-outline-hero">Agendamento</a>
            </div>
        </div>

        <div class="hero-image">
            <img src="/BANNER.png" alt="Prestador">
        </div>
    </section>

    <div class="wave-down">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" height="120"><path
            fill="#fa4101"d="M0,0C480,70 960,70 1440,0L 1440,120L0,120Z"/></svg>
    </div>

    <section class="como-funciona" id="como-funciona">
        <h2 class="anim-up">Como Funciona?</h2>
        <div class="cf-grid">
            <div class="cf-card anim-up delay-1">
                <div class="cf-img-wrap">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80">

                    <span class="cf-badge">01</span>
                </div>
                <div class="cf-label">Busque por um serviço</div>
                <div class="cf-desc">Encontre serviços e auxílios de vários nichos e complexidades com diferentes profissionais.</div>
            </div>
            <div class="cf-card anim-up delay-2">
                <div class="cf-img-wrap">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80">

                    <span class="cf-badge">02</span>
                </div>
                <div class="cf-label">Escolha o profissional</div>
                <div class="cf-desc">Encontre profissionais por categoria, preço e localização. Veja avaliações e horários.</div>
            </div>
            <div class="cf-card anim-up delay-3">
                <div class="cf-img-wrap">
    <img src="https://hsvp.org.br/wp-content/uploads/2021/08/Centros-Avancados_Agendar-Consulta_CONSULTAS_17.jpg">
                    <span class="cf-badge">03</span>
                </div>
                <div class="cf-label">Agende online</div>
                <div class="cf-desc">Selecione data, horário e forma de pagamento. Tudo seguro e prático.</div>
            </div>
        </div>
        <p class="anim-up delay-4">
            Após o agendamento, o profissional executa o serviço.
            Você avalia diversos critérios e o pagamento fica protegido
            até a conclusão do trabalho e sua aprovação.
        </p>
    </section>

<div class="wave-up">
    <svg viewBox="0 0 1440 120" preserveAspectRatio="none" height="50">
        <path fill="#fa4101" d="M0,120 C480,0 960,0 1440,120 L1440,0 L0,0 Z"/>
    </svg>
</div>

    {{-- SOBRE --}}
    <section class="sobre" id="sobre">
        <div class="sobre-text anim-left">
            <h2>Sobre Nós</h2>
            <p>A <b>Mão na Massa</b> nasceu para modernizar o acesso a serviços domésticos e de manutenção, unindo tecnologia e praticidade. Fundada em 2025 em Chapecó/SC.</p>
            <p>Nossa plataforma conecta clientes a profissionais verificados, garantindo mais segurança, praticidade e transparência para ambas as partes.</p>
            <div class="sobre-badges">
                <span class="sobre-badge">Prestadores verificados</span>
                <span class="sobre-badge">Pagamento protegido</span>
                <span class="sobre-badge">Avaliações reais</span>
            </div>
        </div>
        <div class="sobre-img-wrap anim-right">
            <img src="/SOBRE.png" alt="Sobre a Mão na Massa">
        </div>
    </section>

    <section class="vantagens" id="vantagens">
        <h2 class="anim-up">Por que nos <span>Escolher?</span></h2>
        <div class="sobre-img-wrap anim-left" style="display: flex; justify-content: center; margin: 0 auto;">
            <img style="width: 80%;" src="/PORQUEESOLHER.png" alt="">
        </div>
    </section>


    <footer class="footer">
        <div>
            <h3>Mão na <span>Massa</span></h3>
            <p>Conectando clientes e profissionais.</p>
        </div>
        <div class="footer-col">
            <h4>Plataforma</h4>
            <a href="{{ route('solicitacoes.index') }}">Solicitar serviço</a>
            <a href="{{ route('servicos.index') }}">Prestadores</a>
            <a href="{{ route('produtos.index') }}">Produtos</a>
            <a href="{{ route('orcamentos.index') }}">Orçamentos</a>
        </div>
        <div class="footer-col">
            <h4>Suporte</h4>
            <a href="#">Ajuda</a>
            <a href="#">FAQ</a>
            <a href="#">Contato</a>
            <a href="#">Segurança</a>
        </div>
    </footer>
    <div class="footer-bottom">
        © 2025 Mão na Massa — Todos os direitos reservados.
    </div>

    @endsection

    @section('scripts')
    <script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.style.animationPlayState = 'running';
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.anim-up,.anim-left,.anim-right,.anim-scale')
        .forEach(el => observer.observe(el));
    </script>
    @endsection