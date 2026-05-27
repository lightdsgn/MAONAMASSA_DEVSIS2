@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4" style="width: 100%; max-width: 420px;">
        <div class="text-center mb-4">
            <i class="bi bi-shield-lock-fill text-warning" style="font-size: 2.5rem;"></i>
            <h5 class="fw-bold mt-2">Área Segura</h5>
            <p class="text-muted small">Por favor, confirme sua senha antes de continuar.</p>
        </div>

        <form action="{{ route('password.confirm') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Senha</label>
                <input type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="••••••" required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">
                <i class="bi bi-shield-check me-1"></i> Confirmar
            </button>
        </form>
    </div>
</div>
@endsection
