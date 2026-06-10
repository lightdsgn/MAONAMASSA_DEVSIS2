@extends('layouts.app')

@section('content')

<style>
.dash{
    padding:36px 32px;
    font-family:'Sora',sans-serif;
}

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.page-title{
    font-size:1.4rem;
    font-weight:900;
    color:#111;
}

.page-title i{
    color:#fa4101;
}

.btn-back{
    border:1px solid #ddd;
    padding:10px 18px;
    border-radius:10px;
    text-decoration:none;
    color:#555;
    font-weight:700;
}

.btn-back:hover{
    color:#fa4101;
    border-color:#fa4101;
}

.show-grid{
    display:grid;
    grid-template-columns:320px 1fr;
    gap:24px;
}

.card-custom{
    background:#fff;
    border:1.5px solid #ececec;
    border-radius:16px;
    overflow:hidden;
}

.card-header-custom{
    padding:16px 22px;
    border-bottom:1px solid #f1f1f1;
    font-weight:800;
}

.card-header-custom i{
    color:#fa4101;
}

.card-body-custom{
    padding:22px;
}

.service-image{
    width:100%;
    height:250px;
    object-fit:cover;
}

.placeholder{
    height:250px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#f5f5f5;
    font-size:5rem;
}

.service-title{
    font-size:1.2rem;
    font-weight:900;
    margin-top:15px;
}

.service-price{
    font-size:1.5rem;
    font-weight:900;
    color:#198754;
    margin-top:10px;
}

.tag{
    display:inline-block;
    padding:5px 12px;
    border-radius:30px;
    font-size:.7rem;
    font-weight:700;
}

.tag-ativo{
    background:#e8f6ef;
    color:#198754;
}

.tag-inativo{
    background:#eee;
    color:#666;
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:18px;
}

.info-label{
    font-size:.7rem;
    color:#aaa;
    text-transform:uppercase;
    font-weight:700;
}

.info-value{
    font-size:.9rem;
    font-weight:600;
    color:#333;
}

.btn-action{
    width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    padding:10px;
    border-radius:10px;
    text-decoration:none;
    font-weight:700;
    margin-bottom:10px;
}

.btn-orange{
    background:#fa4101;
    color:white;
}

.btn-orange:hover{
    background:#c73200;
    color:white;
}

.btn-outline-orange{
    border:1px solid #fa4101;
    color:#fa4101;
    background:white;
}

.btn-outline-orange:hover{
    background:#fa4101;
    color:white;
}

.avaliacao-card{
    border:1px solid #ececec;
    border-radius:12px;
    padding:15px;
    margin-bottom:12px;
}

.avaliacao-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:8px;
}

.avaliacao-user{
    font-weight:800;
}

.avaliacao-comment{
    color:#666;
    margin-top:8px;
}

@media(max-width:900px){
    .show-grid{
        grid-template-columns:1fr;
    }
}
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title">
            <i class="bi bi-tools"></i>
            Detalhes do Serviço
        </h4>

        <a href="{{ route('servicos.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>
    </div>

    <div class="show-grid">

        {{-- COLUNA ESQUERDA --}}
        <div>

            <div class="card-custom">

                @if($servico->foto)
                    <img src="{{ asset('storage/'.$servico->foto) }}"
                         class="service-image">
                @else
                    <div class="placeholder">
                        🔧
                    </div>
                @endif

                <div class="card-body-custom">

                    <span class="tag tag-{{ $servico->status }}">
                        {{ ucfirst($servico->status) }}
                    </span>

                    <div class="service-title">
                        {{ $servico->titulo }}
                    </div>

                    @if($servico->preco_estimado)
                        <div class="service-price">
                            R$ {{ number_format($servico->preco_estimado,2,',','.') }}
                        </div>
                    @endif

                    @php
                        $nota = $servico->notaMedia();
                        $total = $servico->avaliacoes->count();
                    @endphp

                    <div class="mt-3">
                        <strong>Avaliação</strong>
                        <br>

                        @for($i=1;$i<=5;$i++)
                            <i class="bi bi-star{{ $i <= round($nota) ? '-fill text-warning' : ' text-muted' }}"></i>
                        @endfor

                        <div class="text-muted mt-1">
                            {{ number_format($nota,1) }}
                            ({{ $total }} avaliações)
                        </div>
                    </div>

                </div>

            </div>

            <div class="card-custom mt-3">
                <div class="card-header-custom">
                    <i class="bi bi-lightning"></i>
                    Ações
                </div>

                <div class="card-body-custom">

                    @if(Auth::user()->isCliente())
                        <a href="{{ route('agendamentos.create',['servico_id'=>$servico->id]) }}"
                           class="btn-action btn-orange">
                            <i class="bi bi-calendar-check"></i>
                            Agendar Serviço
                        </a>
                    @endif

                    @if(Auth::user()->isAdm() || $servico->usuario_id == Auth::id())
                        <a href="{{ route('servicos.edit',$servico) }}"
                           class="btn-action btn-outline-orange">
                            <i class="bi bi-pencil"></i>
                            Editar Serviço
                        </a>
                    @endif

                </div>
            </div>

        </div>

        {{-- COLUNA DIREITA --}}
        <div>

            <div class="card-custom mb-3">
                <div class="card-header-custom">
                    <i class="bi bi-info-circle"></i>
                    Informações do Serviço
                </div>

                <div class="card-body-custom">

                    <div class="info-grid">

                        <div>
                            <div class="info-label">ID</div>
                            <div class="info-value">#{{ $servico->id }}</div>
                        </div>

                        <div>
                            <div class="info-label">Status</div>
                            <div class="info-value">{{ ucfirst($servico->status) }}</div>
                        </div>

                        <div>
                            <div class="info-label">Categoria</div>
                            <div class="info-value">
                                {{ $servico->categoria ?? 'Não informada' }}
                            </div>
                        </div>

                        <div>
                            <div class="info-label">Prestador</div>
                            <div class="info-value">
                                {{ $servico->usuario->nome }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="card-custom mb-3">
                <div class="card-header-custom">
                    <i class="bi bi-file-text"></i>
                    Descrição
                </div>

                <div class="card-body-custom">
                    {{ $servico->descricao }}
                </div>
            </div>

            @if($servico->avaliacoes->count())

            <div class="card-custom">

                <div class="card-header-custom">
                    <i class="bi bi-star-fill"></i>
                    Avaliações dos Clientes
                </div>

                <div class="card-body-custom">

                    @foreach($servico->avaliacoes()->with('usuario')->latest()->get() as $av)

                        <div class="avaliacao-card">

                            <div class="avaliacao-top">

                                <span class="avaliacao-user">
                                    {{ $av->usuario->nome }}
                                </span>

                                <span>
                                    @for($i=1;$i<=5;$i++)
                                        <i class="bi bi-star{{ $i <= $av->nota ? '-fill text-warning' : '' }}"></i>
                                    @endfor
                                </span>

                            </div>

                            @if($av->comentario)
                                <div class="avaliacao-comment">
                                    {{ $av->comentario }}
                                </div>
                            @endif

                        </div>

                    @endforeach

                </div>

            </div>

            @endif

        </div>

    </div>

</div>

@endsection