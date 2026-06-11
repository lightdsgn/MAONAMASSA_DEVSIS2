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
        transition: border-color 0.2s, color 0.2s;
    }
    .btn-outline-back:hover { border-color: #fa4101; color: #fa4101; }

    .form-card {
        background: #fff; border: 1.5px solid #ececec;
        border-radius: 16px; overflow: hidden;
    }

    .form-card-header {
        padding: 20px 28px; border-bottom: 1.5px solid #f0f0f0;
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
    }

    .form-card-header-left { display: flex; align-items: center; gap: 10px; }

    .card-title {
        font-size: 0.82rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: .4px;
    }

    .card-sub { font-size: 0.75rem; color: #aaa; }

    .status-tag {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.68rem; font-weight: 700;
        padding: 4px 11px; border-radius: 20px;
    }
    .status-ativo { background: #e8f6ef; color: #145c37; }
    .status-inativo { background: #f0f0f0; color: #888; }

    .form-card-body { padding: 28px; }

    .form-card-footer {
        padding: 20px 28px; border-top: 1.5px solid #f0f0f0;
        display: flex; align-items: center; justify-content: space-between;
    }

    .form-label { font-size: 0.8rem; font-weight: 700; margin-bottom: 6px; display: block; }

    .form-control, .form-select {
        border: 1.5px solid #e8e8e8; border-radius: 10px;
        padding: 10px 14px; font-size: 0.85rem; width: 100%;
    }

    .form-control:focus, .form-select:focus {
        border-color: #fa4101; outline: none;
    }

    .input-prefix-wrap { position: relative; }
    .input-prefix-wrap .prefix {
        position: absolute; left: 14px; top: 50%;
        transform: translateY(-50%);
        color: #aaa; font-weight: 700;
    }
    .input-prefix-wrap .form-control { padding-left: 34px; }

    .file-input-wrap { position: relative; }
    .file-input-wrap input { position: absolute; inset: 0; opacity: 0; cursor: pointer; }

    .file-input-btn {
        border: 1.5px dashed #ddd;
        padding: 10px 16px;
        border-radius: 10px;
        display: flex; gap: 8px; align-items: center;
        color: #888;
    }

    .section-divider {
        font-size: 0.7rem; font-weight: 800; color: #ccc;
        margin: 14px 0;
        display: flex; align-items: center; gap: 10px;
    }
    .section-divider::after {
        content: ''; flex: 1; height: 1px; background: #f0f0f0;
    }

    .btn-submit {
        background: #fa4101; color: #fff; border: none;
        padding: 10px 24px; border-radius: 9px;
        font-weight: 700;
    }

    .btn-view {
        border: 1.5px solid #e8e8e8;
        padding: 9px 16px;
        border-radius: 9px;
        text-decoration: none;
        color: #666;
    }

    .row { display: flex; flex-wrap: wrap; gap: 16px; }
    .col-full { flex: 1 1 100%; }
    .col-half { flex: 1 1 calc(50% - 8px); min-width: 200px; }

    @media(max-width:576px) {
        .dash { padding: 16px; }
        .form-card-footer { flex-direction: column-reverse; gap: 10px; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title">
            <i class="fa-solid fa-box"></i> Editar Produto
        </h4>
        <a href="{{ route('produtos.index') }}" class="btn-outline-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="form-card">

        <div class="form-card-header">
            <div class="form-card-header-left">
                <i class="fa-solid fa-box"></i>
                <div>
                    <div class="card-title">{{ Str::limit($produto->nome, 45) }}</div>
                    <div class="card-sub">Produto #{{ $produto->id }}</div>
                </div>
            </div>

            <span class="status-tag status-{{ $produto->status }}">
                {{ ucfirst($produto->status) }}
            </span>
        </div>

        <form action="{{ route('produtos.update', $produto) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="form-card-body">

                <div class="section-divider">Informações Básicas</div>

                <div class="row">

                    <div class="col-full">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control"
                            value="{{ old('nome', $produto->nome) }}" required>
                    </div>

                    <div class="col-full">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control" required>{{ old('descricao', $produto->descricao) }}</textarea>
                    </div>

                    <div class="col-half">
                        <label class="form-label">Categoria</label>
                        <select name="categoria" class="form-select" required>
                            <option value="Decoração" {{ $produto->categoria=='decoracao'?'selected':'' }}>Decoração</option>
                            <option value="Elétrica" {{ $produto->categoria=='eletrica'?'selected':'' }}>Elétrica</option>
                            <option value="Hidráulica" {{ $produto->categoria=='hidraulica'?'selected':'' }}>Hidráulica</option>
                            <option value="Outros" {{ $produto->categoria=='outros'?'selected':'' }}>Outros</option>
                        </select>
                    </div>

                    <div class="col-half">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="ativo" {{ $produto->status=='ativo'?'selected':'' }}>Ativo</option>
                            <option value="inativo" {{ $produto->status=='inativo'?'selected':'' }}>Inativo</option>
                        </select>
                    </div>

                    <div class="col-half">
                        <label class="form-label">Preço</label>
                        <div class="input-prefix-wrap">
                            <span class="prefix">R$</span>
                            <input type="number" name="preco" step="0.01"
                                class="form-control"
                                value="{{ old('preco', $produto->preco) }}" required>
                        </div>
                    </div>

                    <div class="col-half">
                        <label class="form-label">Quantidade</label>
                        <input type="number" name="quantidade"
                            class="form-control"
                            value="{{ old('quantidade', $produto->quantidade) }}" required>
                    </div>

                </div>

                <div class="section-divider">Foto</div>

                @if($produto->foto)
                    <div style="margin-bottom:10px;">
                        <img src="{{ asset('storage/'.$produto->foto) }}"
                             style="width:80px;border-radius:8px;">
                    </div>
                @endif

                <div class="file-input-wrap">
                    <input type="file" name="foto">
                    <div class="file-input-btn">
                        <i class="fa-solid fa-upload"></i> Alterar imagem
                    </div>
                </div>

            </div>

            <div class="form-card-footer">
                <a href="{{ route('produtos.index') }}" class="btn-view">Cancelar</a>
                <button class="btn-submit">Salvar</button>
            </div>

        </form>

    </div>
</div>

@endsection