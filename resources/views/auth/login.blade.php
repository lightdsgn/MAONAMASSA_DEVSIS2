@extends('layouts.app')

@section('content')

<style>
    body{
        font-family: Sora;
    }
    input, select{ 
        border: 2px solid #fa4101; 
        border-radius: 7px;
        width: 100%;
        padding: 8px 20px;
        padding-left: 8px;
    }
    input:focus, select:focus {
        border-color: #fa4101;
        box-shadow: 0 0 0 4px rgba(250, 65, 1, 0.15);
    }
    label{
        font-weight: 600;
        color: #000000;

    }

    .titulo{
        font-size: 25px;
        color: #ffffff;
        font-family: Sora;
        font-weight: 900;
        margin-bottom: -5px;
        margin-top: 40px;
        background: linear-gradient(90deg, #fa4101, #f97316);
        padding: 10px 20px;
        max-width: 100%;
        border-radius: 15px;
        margin: auto;

    }
    h6{

        color: #000000;
        font-family: Sora;
        font-weight: 900;
    }

</style>
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4" style="width: 100%; max-width: 420px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold">🔧 Mão na Massa</h2>
            <p class="text-muted">Entre na sua conta</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">E-mail</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="seu@email.com" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Senha</label>
                <input type="password" name="password" class="form-control" placeholder="••••••" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Lembrar de mim</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">
                <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
            </button>
        </form>

        <hr>
        <p class="text-center text-muted mb-0">
            Não tem conta?
            <a href="{{ route('registro') }}" class="text-decoration-none fw-semibold">Cadastre-se</a>
        </p>
    </div>
</div>
@endsection