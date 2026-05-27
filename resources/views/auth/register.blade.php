{{--
    Este arquivo (register.blade.php) não é utilizado pelas rotas do projeto.
    O cadastro é feito via auth/registro.blade.php (rota: /registro).
    Este arquivo foi mantido por compatibilidade e reescrito sem Tailwind.
--}}
@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4" style="width: 100%; max-width: 480px; border-radius: 15px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold">🔧 Mão na Massa</h2>
            <p class="text-muted">Crie sua conta</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nome</label>
                <input type="text" name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">E-mail</label>
                <input type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Senha</label>
                <input type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Mínimo 8 caracteres" required autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Confirmar Senha</label>
                <input type="password" name="password_confirmation"
                    class="form-control"
                    placeholder="Repita a senha" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">
                <i class="bi bi-person-plus me-1"></i> Cadastrar
            </button>
        </form>

        <hr>
        <p class="text-center text-muted mb-0">
            Já tem conta?
            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Entrar</a>
        </p>
    </div>
</div>
@endsection
