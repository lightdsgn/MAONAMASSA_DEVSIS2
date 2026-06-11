@extends('layouts.app')
@section('content')

<style>
    .dash { padding: 36px 32px; font-family: 'Sora', sans-serif; }

    .page-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 28px; gap: 16px;
    }
    .page-title {
        font-size: 1.3rem; font-weight: 900; color: #111;
        letter-spacing: -0.5px; margin: 0;
        display: flex; align-items: center; gap: 10px;
    }
    .page-title i { color: #fa4101; }

    .btn-outline-back {
        border: 1.5px solid #ddd; background: transparent; color: #555;
        border-radius: 9px; padding: 8px 16px;
        font-size: 0.82rem; font-weight: 700; text-decoration: none;
        display: inline-flex; align-items: center; gap: 6px;
        transition: border-color 0.2s, color 0.2s; font-family: 'Sora', sans-serif;
    }
    .btn-outline-back:hover { border-color: #fa4101; color: #fa4101; }

    /* ── LAYOUT PRINCIPAL ── */
    .show-wrap {
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 20px;
        align-items: start;
    }

    /* ── CARD FOTO ── */
    .foto-card {
        background: #fff; border: 1.5px solid #ececec;
        border-radius: 16px; overflow: hidden;
    }
    .foto-card img {
        width: 100%; aspect-ratio: 1/1;
        object-fit: cover; display: block;
    }
    .foto-placeholder {
        width: 100%; aspect-ratio: 1/1;
        background: #f7f7f7;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        gap: 10px;
    }
    .foto-placeholder i { font-size: 52px; color: #ddd; }
    .foto-placeholder span { font-size: 0.75rem; color: #ccc; font-weight: 600; }

    .foto-footer {
        padding: 14px 18px; border-top: 1.5px solid #f0f0f0;
        display: flex; align-items: center; justify-content: space-between;
    }
    .estoque-wrap { display: flex; flex-direction: column; gap: 2px; }
    .estoque-label { font-size: 0.68rem; font-weight: 700; color: #bbb; text-transform: uppercase; letter-spacing: 0.8px; }
    .estoque-num   { font-size: 1.1rem; font-weight: 900; color: #111; letter-spacing: -0.5px; }
    .estoque-sub   { font-size: 0.7rem; color: #bbb; }

    .status-tag {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.7rem; font-weight: 700;
        padding: 5px 12px; border-radius: 20px; white-space: nowrap;
    }
    .status-tag::before { content:''; width:5px; height:5px; border-radius:50%; background:currentColor; opacity:.6; }
    .status-ativo    { background: #e8f6ef; color: #145c37; }
    .status-inativo  { background: #f0f0f0; color: #888; }

    /* ── CARD INFO ── */
    .info-card {
        background: #fff; border: 1.5px solid #ececec;
        border-radius: 16px; overflow: hidden;
    }
    .info-card-header {
        padding: 20px 24px; border-bottom: 1.5px solid #f0f0f0;
        display: flex; align-items: flex-start; justify-content: space-between; gap: 12px;
    }
    .produto-nome  { font-size: 1.1rem; font-weight: 900; color: #111; letter-spacing: -0.3px; line-height: 1.3; }
    .produto-cat   { font-size: 0.78rem; color: #aaa; margin-top: 4px; display: flex; align-items: center; gap: 5px; }
    .produto-cat i { font-size: 11px; }

    .info-card-body { padding: 24px; }

    /* preço destaque */
    .preco-card {
        background: #fff8f5; border: 1.5px solid #fdd0bc;
        border-radius: 12px; padding: 16px 20px;
        margin-bottom: 22px;
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
    }
    .preco-label { font-size: 0.7rem; font-weight: 700; color: #fa4101; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 4px; }
    .preco-num   { font-size: 1.8rem; font-weight: 900; color: #fa4101; letter-spacing: -1px; line-height: 1; }

    /* section divider */
    .section-divider {
        font-size: 0.7rem; font-weight: 800; color: #ccc;
        text-transform: uppercase; letter-spacing: 1px;
        margin-bottom: 14px;
        display: flex; align-items: center; gap: 10px;
    }
    .section-divider::after { content: ''; flex: 1; height: 1px; background: #f0f0f0; }

    /* info grid */
    .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px; }
    .info-item {}
    .info-label { font-size: 0.7rem; font-weight: 700; color: #bbb; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 4px; }
    .info-value { font-size: 0.88rem; font-weight: 600; color: #222; }
    .info-value.muted { color: #999; font-weight: 500; }

    /* descrição */
    .descricao-box {
        background: #fafafa; border: 1.5px solid #f0f0f0;
        border-radius: 10px; padding: 14px 16px;
        font-size: 0.85rem; color: #555; line-height: 1.7;
    }

    /* footer ações */
    .info-card-footer {
        padding: 18px 24px; border-top: 1.5px solid #f0f0f0;
        display: flex; align-items: center; gap: 10px;
    }
    .btn-edit {
        background: #fa4101; color: #fff; border: none;
        border-radius: 9px; padding: 9px 20px;
        font-size: 0.82rem; font-weight: 700;
        display: inline-flex; align-items: center; gap: 7px;
        cursor: pointer; transition: background .2s;
        text-decoration: none; font-family: 'Sora', sans-serif;
    }
    .btn-edit:hover { background: #c73200; color: #fff; }

    .btn-delete {
        background: transparent; color: #dc3545;
        border: 1.5px solid #f5c6cb; border-radius: 9px; padding: 8px 18px;
        font-size: 0.82rem; font-weight: 700;
        display: inline-flex; align-items: center; gap: 7px;
        cursor: pointer; transition: all .2s; font-family: 'Sora', sans-serif;
    }
    .btn-delete:hover { background: #dc3545; color: #fff; border-color: #dc3545; }

    @media(max-width:768px) {
        .show-wrap { grid-template-columns: 1fr; }
        .dash { padding: 16px; }
        .info-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title">
            <i class="fa-solid fa-box"></i> {{ $produto->nome }}
        </h4>
        <a href="{{ route('produtos.index') }}" class="btn-outline-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="show-wrap">

        {{-- ── COLUNA FOTO ── --}}
        <div class="foto-card">
            @if($produto->foto)
                <img src="{{ asset('storage/' . $produto->foto) }}" alt="{{ $produto->nome }}">
            @else
                <div class="foto-placeholder">
                    <i class="fa-solid fa-box-open"></i>
                    <span>Sem foto</span>
                </div>
            @endif

            <div class="foto-footer">
                <div class="estoque-wrap">
                    <span class="estoque-label">Estoque</span>
                    <span class="estoque-num">{{ $produto->quantidade }}</span>
                    <span class="estoque-sub">unidades disponíveis</span>
                </div>
                <span class="status-tag status-{{ $produto->status }}">{{ ucfirst($produto->status) }}</span>
            </div>
        </div>

        {{-- ── COLUNA INFO ── --}}
        <div class="info-card">

            <div class="info-card-header">
                <div>
                    <div class="produto-nome">{{ $produto->nome }}</div>
                    <div class="produto-cat">
                        <i class="fa-solid fa-tag"></i>
                        {{ $produto->categoria ?? 'Sem categoria' }}
                    </div>
                </div>
            </div>

            <div class="info-card-body">

                {{-- Preço --}}
                <div class="preco-card">
                    <div>
                        <div class="preco-label">Preço</div>
                        <div class="preco-num">R$ {{ number_format($produto->preco, 2, ',', '.') }}</div>
                    </div>
                    <i class="fa-solid fa-tag" style="font-size:28px; color:#fdd0bc;"></i>
                </div>

                {{-- Detalhes --}}
                <div class="section-divider">Detalhes</div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Vendedor</div>
                        <div class="info-value">
                            <i class="fa-solid fa-user" style="color:#fa4101; font-size:11px; margin-right:4px;"></i>
                            {{ $produto->usuario->nome }}
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Categoria</div>
                        <div class="info-value {{ $produto->categoria ? '' : 'muted' }}">
                            {{ $produto->categoria ?? 'Não informada' }}
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Cadastrado em</div>
                        <div class="info-value muted">
                            {{ \Carbon\Carbon::parse($produto->created_at)->format('d/m/Y') }}
                        </div>
                    </div>
                    @if($produto->updated_at != $produto->created_at)
                    <div class="info-item">
                        <div class="info-label">Atualizado em</div>
                        <div class="info-value muted">
                            {{ \Carbon\Carbon::parse($produto->updated_at)->format('d/m/Y') }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Descrição --}}
                @if($produto->descricao)
                <div class="section-divider">Descrição</div>
                <div class="descricao-box">{{ $produto->descricao }}</div>
                @endif

            </div>

            @if(Auth::user()->isAdm() || $produto->usuario_id === Auth::id())
            <div class="info-card-footer">
                <a href="{{ route('produtos.edit', $produto) }}" class="btn-edit">
                    <i class="fa-solid fa-pencil"></i> Editar Produto
                </a>
                @if(Auth::user()->isAdm())
                <form action="{{ route('produtos.destroy', $produto) }}" method="POST"
                    onsubmit="return confirm('Excluir este produto permanentemente?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <i class="fa-solid fa-trash"></i> Excluir
                    </button>
                </form>
                @endif
            </div>
            @endif

        </div>

    </div>

</div>
@endsection