@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4" style="width: 100%; max-width: 420px;">
        <div class="text-center mb-4">
            <i class="bi bi-key-fill text-warning" style="font-size: 2.5rem;"></i>
            <h5 class="fw-bold mt-2">Recuperar Senha</h5>
            <p class="text-muted small">Informe seu e-mail e enviaremos um link para redefinir sua senha.</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">E-mail</label>
                <input type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="seu@email.com" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">
                <i class="bi bi-envelope me-1"></i> Enviar Link de Recuperação
            </button>
        </form>

        <hr>
        <p class="text-center text-muted mb-0">
            Lembrou a senha?
            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Entrar</a>
        </p>
    </div>
</div>
@endsection
