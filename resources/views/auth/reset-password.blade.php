@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4" style="width: 100%; max-width: 420px;">
        <div class="text-center mb-4">
            <i class="bi bi-lock-fill text-warning" style="font-size: 2.5rem;"></i>
            <h5 class="fw-bold mt-2">Redefinir Senha</h5>
            <p class="text-muted small">Escolha uma nova senha para sua conta.</p>
        </div>

        <form action="{{ route('password.store') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-3">
                <label class="form-label fw-semibold">E-mail</label>
                <input type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $request->email) }}" required autocomplete="username">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nova Senha</label>
                <input type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Mínimo 6 caracteres" required autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Confirmar Nova Senha</label>
                <input type="password" name="password_confirmation"
                    class="form-control"
                    placeholder="Repita a senha" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">
                <i class="bi bi-check-lg me-1"></i> Redefinir Senha
            </button>
        </form>
    </div>
</div>
@endsection
