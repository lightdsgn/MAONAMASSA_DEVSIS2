@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="bi bi-person-plus me-2"></i>Novo Usuário</h4>
    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Voltar
    </a>
</div>

<div class="card p-4">
    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('usuarios.form', ['usuario' => null])
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-check-lg me-1"></i> Salvar
            </button>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
function togglePrestador(tipo) {
    const campos = document.getElementById('campos-prestador');
    if (tipo === 'prestador') {
        campos.classList.remove('d-none');
    } else {
        campos.classList.add('d-none');
    }
}
</script>
@endsection