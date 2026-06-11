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
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
    }
    .form-card-header-left { display: flex; align-items: center; gap: 10px; }
    .form-card-header i { color: #fa4101; }
    .form-card-header .card-title {
        font-size: 0.82rem; font-weight: 800; color: #111;
        text-transform: uppercase; letter-spacing: .4px;
    }
    .form-card-header .card-sub { font-size: 0.75rem; color: #aaa; margin-top: 1px; }

    .status-tag {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.68rem; font-weight: 700;
        padding: 4px 11px; border-radius: 20px; white-space: nowrap;
    }
    .status-tag::before { content:''; width:5px; height:5px; border-radius:50%; background:currentColor; opacity:.5; }
    .status-ativo   { background: #e8f6ef; color: #145c37; }
    .status-inativo { background: #f0f0f0; color: #888; }

    .form-card-body { padding: 28px; }
    .form-card-footer {
        padding: 20px 28px; border-top: 1.5px solid #f0f0f0;
        display: flex; align-items: center; justify-content: space-between; gap: 10px;
    }

    .form-label { font-size: 0.8rem; font-weight: 700; color: #444; margin-bottom: 6px; display: block; }
    .form-control, .form-select {
        border: 1.5px solid #e8e8e8; border-radius: 10px;
        font-size: 0.85rem; font-family: 'Sora', sans-serif;
        color: #333; padding: 10px 14px; transition: border-color .2s;
        width: 100%;
    }
    .form-control:focus, .form-select:focus {
        border-color: #fa4101; box-shadow: 0 0 0 3px rgba(250,65,1,.08); outline: none;
    }
    .form-control.is-invalid, .form-select.is-invalid { border-color: #dc3545; }
    textarea.form-control { resize: vertical; min-height: 110px; }
    .invalid-feedback { font-size: 0.75rem; color: #dc3545; margin-top: 4px; display: block; }

    /* input com prefixo R$ */
    .input-prefix-wrap { position: relative; }
    .input-prefix-wrap .prefix {
        position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
        font-size: 0.85rem; font-weight: 700; color: #aaa; pointer-events: none;
    }
    .input-prefix-wrap .form-control { padding-left: 34px; }

    /* preview de foto */
    .foto-preview-wrap {
        display: flex; align-items: center; gap: 16px;
        background: #fafafa; border: 1.5px solid #f0f0f0;
        border-radius: 10px; padding: 12px 16px; margin-bottom: 10px;
    }
    .foto-preview-wrap img {
        width: 64px; height: 64px; border-radius: 8px;
        object-fit: cover; border: 1.5px solid #eee; flex-shrink: 0;
    }
    .foto-preview-wrap .foto-info { font-size: 0.78rem; color: #888; line-height: 1.6; }
    .foto-preview-wrap .foto-info strong { color: #444; font-weight: 700; display: block; }

    /* file input estilizado */
    .file-input-wrap { position: relative; }
    .file-input-wrap input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; z-index: 2;
    }
    .file-input-btn {
        display: inline-flex; align-items: center; gap: 8px;
        border: 1.5px dashed #ddd; border-radius: 10px;
        padding: 10px 16px; font-size: 0.82rem; font-weight: 600;
        color: #888; background: #fafafa; cursor: pointer;
        transition: border-color .2s, color .2s; width: 100%;
    }
    .file-input-btn:hover { border-color: #fa4101; color: #fa4101; }
    .file-input-btn i { font-size: 15px; }

    /* section divider */
    .section-divider {
        font-size: 0.7rem; font-weight: 800; color: #ccc;
        text-transform: uppercase; letter-spacing: 1px;
        margin-bottom: 14px; margin-top: 6px;
        display: flex; align-items: center; gap: 10px;
    }
    .section-divider::after { content: ''; flex: 1; height: 1px; background: #f0f0f0; }

    .btn-submit {
        background: #fa4101; color: #fff; border: none;
        border-radius: 9px; padding: 10px 24px;
        font-size: 0.85rem; font-weight: 700;
        display: inline-flex; align-items: center; gap: 7px;
        cursor: pointer; transition: background .2s; font-family: 'Sora', sans-serif;
    }
    .btn-submit:hover { background: #c73200; }

    .btn-view {
        text-decoration: none; color: #666;
        border: 1.5px solid #e8e8e8; border-radius: 9px; padding: 9px 16px;
        font-size: 0.82rem; font-weight: 700;
        display: inline-flex; align-items: center; gap: 6px;
        transition: all .2s; font-family: 'Sora', sans-serif;
    }
    .btn-view:hover { border-color: #fa4101; color: #fa4101; }

    .row { display: flex; flex-wrap: wrap; gap: 16px; }
    .col-full { flex: 1 1 100%; }
    .col-half { flex: 1 1 calc(50% - 8px); min-width: 200px; }
    .col-third { flex: 1 1 calc(33.33% - 11px); min-width: 160px; }

    @media(max-width:576px) {
        .dash { padding: 16px; }
        .form-card-body { padding: 18px 16px; }
        .col-half, .col-third { flex: 1 1 100%; }
        .form-card-footer { flex-direction: column-reverse; }
        .btn-submit, .btn-view { width: 100%; justify-content: center; }
    }
</style>

<div class="dash">

    <div class="page-header">
        <h4 class="page-title">
            <i class="fa-solid fa-screwdriver-wrench"></i> Editar Serviço
        </h4>
        <a href="{{ route('servicos.index') }}" class="btn-outline-back">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="form-card">

        <div class="form-card-header">
            <div class="form-card-header-left">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                <div>
                    <div class="card-title">{{ Str::limit($servico->titulo, 45) }}</div>
                    <div class="card-sub">Serviço #{{ $servico->id }}</div>
                </div>
            </div>
            <span class="status-tag status-{{ $servico->status }}">{{ ucfirst($servico->status) }}</span>
        </div>

        <form action="{{ route('servicos.update', $servico) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="form-card-body">

                {{-- INFORMAÇÕES BÁSICAS --}}
                <div class="section-divider">Informações Básicas</div>
                <div class="row">

                    <div class="col-full">
                        <label class="form-label">Título do Serviço <span class="text-danger">*</span></label>
                        <input type="text" name="titulo"
                            class="form-control @error('titulo') is-invalid @enderror"
                            value="{{ old('titulo', $servico->titulo) }}"
                            placeholder="Ex: Encanador Profissional" required>
                        @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-half">
                        <label class="form-label">Categoria <span class="text-danger">*</span></label>
                        <select name="categoria" class="form-select @error('categoria') is-invalid @enderror" required>
                            <option value="">Selecione...</option>
                            @foreach([
                                'encanamento' => 'Encanamento',
                                'eletricidade'=> 'Eletricidade',
                                'limpeza'     => 'Limpeza',
                                'reparo'      => 'Reparo',
                                'culinaria'   => 'Culinária',
                                'outros'      => 'Outros',
                            ] as $val => $label)
                                <option value="{{ $val }}" {{ old('categoria', $servico->categoria) === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-half">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="">Selecione...</option>
                            <option value="ativo"   {{ old('status', $servico->status) === 'ativo'   ? 'selected' : '' }}>Ativo</option>
                            <option value="inativo" {{ old('status', $servico->status) === 'inativo' ? 'selected' : '' }}>Inativo</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-half">
                        <label class="form-label">Preço Estimado <span class="text-danger">*</span></label>
                        <div class="input-prefix-wrap">
                            <span class="prefix">R$</span>
                            <input type="number" name="preco_estimado" step="0.01" min="0"
                                class="form-control @error('preco_estimado') is-invalid @enderror"
                                value="{{ old('preco_estimado', $servico->preco_estimado) }}"
                                placeholder="0,00" required>
                        </div>
                        @error('preco_estimado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-full">
                        <label class="form-label">Descrição <span class="text-danger">*</span></label>
                        <textarea name="descricao" rows="4"
                            class="form-control @error('descricao') is-invalid @enderror"
                            placeholder="Descreva seu serviço com detalhes..." required>{{ old('descricao', $servico->descricao) }}</textarea>
                        @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                </div>

                {{-- FOTO --}}
                <div class="section-divider" style="margin-top: 20px;">Foto do Serviço</div>

                @if($servico->foto)
                <div class="foto-preview-wrap">
                    <img src="{{ asset('storage/' . $servico->foto) }}" alt="Foto atual">
                    <div class="foto-info">
                        <strong>Foto atual</strong>
                        Envie uma nova imagem abaixo para substituir.
                    </div>
                </div>
                @endif

                <div class="file-input-wrap" id="fileWrap">
                    <input type="file" name="foto" id="foto" accept="image/*" onchange="previewFile(this)">
                    <div class="file-input-btn" id="fileBtn">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span id="fileBtnText">Clique para selecionar uma imagem</span>
                    </div>
                </div>
                @error('foto') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror

                {{-- preview ao selecionar --}}
                <div id="newPreview" style="display:none; margin-top:10px;">
                    <div class="foto-preview-wrap">
                        <img id="newPreviewImg" src="" alt="Nova foto">
                        <div class="foto-info">
                            <strong>Nova foto selecionada</strong>
                            <span id="newPreviewName"></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-card-footer">
                <a href="{{ route('servicos.show', $servico) }}" class="btn-view">
                    <i class="fa-solid fa-eye"></i> Ver Serviço
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> Salvar Alterações
                </button>
            </div>

        </form>
    </div>

</div>

<script>
    function previewFile(input) {
        const file = input.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('newPreviewImg').src = e.target.result;
            document.getElementById('newPreviewName').textContent = file.name;
            document.getElementById('newPreview').style.display = 'block';
            document.getElementById('fileBtnText').textContent = file.name;
        };
        reader.readAsDataURL(file);
    }
</script>

@endsection