@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4 text-center" style="width: 100%; max-width: 480px;">
        <i class="bi bi-envelope-check-fill text-warning" style="font-size: 3rem;"></i>
        <h5 class="fw-bold mt-3">Verifique seu E-mail</h5>
        <p class="text-muted">
            Obrigado por se cadastrar! Antes de continuar, clique no link de verificação que enviamos para o seu e-mail.
            Se não recebeu, clique abaixo para reenviar.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>
                Um novo link de verificação foi enviado para o seu e-mail.
            </div>
        @endif

        <div class="d-flex justify-content-center gap-3 mt-3">
            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-envelope me-1"></i> Reenviar E-mail
                </button>
            </form>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="bi bi-box-arrow-right me-1"></i> Sair
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
