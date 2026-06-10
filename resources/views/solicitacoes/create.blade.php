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

    .form-card {
        background: #fff; border: 1.5px solid #ececec;
        border-radius: 16px; overflow: hidden;
    }
    .form-card-header {
        padding: 20px 28px; border-bottom: 1.5px solid #f0f0f0;
        display: flex; align-items: center; gap: 10px;
    }
    .form-card-header span {
        font-size: 0.82rem; font-weight: 800; color: #111;
        text-transform: uppercase; letter-spacing: .4px;
    }
    .form-card-header i { color: #fa4101; }
    .form-card-body { padding: 28px; }
    .form-card-footer {
        padding: 20px 28px; border-top: 1.5px solid #f0f0f0;
        display: flex; align-items: center; gap: 10px;
    }

    .form-label { font-size: 0.8rem; font-weight: 700; color: #444; margin-bottom: 6px; }
    .form-control, .form-select {
        border: 1.5px solid #e8e8e8; border-radius: 10px;
        font-size: 0.85rem; font-family: 'Sora', sans-serif;
        color: #333; padding: 10px 14px; transition: border-color .2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #fa4101; box-shadow: 0 0 0 3px rgba(250,65,1,.08); outline: none;
    }
    textarea.form-control { resize: vertical; min-height: 110px; }

    .btn-submit {
        background: #fa4101; color: #fff; border: none;
        border-radius: 9px; padding: 10px 24px;
        font-size: 0.85rem; font-weight: 700;
        display: inline-flex; align-items: center; gap: 7px;
        cursor: pointer; transition: background .2s; font-family: 'Sora', sans-serif;
    }
    .btn-submit:hover { background: #c73200; }

    @media(max-width:576px) { .dash { padding: 16px; } .form-card-body { padding: 18px 16px; } }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title">
            <i class="fa-solid fa-circle-plus"></i> Nova Solicitação
        </h4>
        <a href="{{ route('solicitacoes.index') }}" class="btn-outline-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <i class="fa-solid fa-clipboard-list"></i>
            <span>Dados da Solicitação</span>
        </div>

        <form action="{{ route('solicitacoes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-card-body">
                <div class="row g-3">

                    <div class="col-md-8">
                        <label class="form-label">Título <span class="text-danger">*</span></label>
                        <input type="text" name="titulo"
                            class="form-control @error('titulo') is-invalid @enderror"
                            value="{{ old('titulo') }}"
                            placeholder="Ex: Preciso de um eletricista para instalação..." required>
                        @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Categoria <span class="text-danger">*</span></label>
                        <select name="categoria" class="form-select @error('categoria') is-invalid @enderror" required>
                            <option value="">Selecione...</option>
                            @foreach(['Elétrica','Hidráulica','Pintura','Marcenaria','Limpeza','Jardinagem','Informática','Alvenaria','Outros'] as $cat)
                                <option value="{{ $cat }}" {{ old('categoria') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('categoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Disponibilidade</label>
                        <input type="date" name="disponibilidade" class="form-control"
                            value="{{ old('disponibilidade') }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Descrição <span class="text-danger">*</span></label>
                        <textarea name="descricao" rows="4"
                            class="form-control @error('descricao') is-invalid @enderror"
                            placeholder="Descreva com detalhes o que você precisa..." required>{{ old('descricao') }}</textarea>
                        @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        @error('foto') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                </div>
            </div>
            <div class="form-card-footer">
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-paper-plane"></i> Enviar Solicitação
                </button>
            </div>
        </form>
    </div>

</div>
@endsection