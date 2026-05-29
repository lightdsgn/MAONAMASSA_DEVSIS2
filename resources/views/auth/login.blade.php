@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800;900&display=swap');

    .login-wrap {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        font-family: 'Sora', sans-serif;
    }

    .login-card {
        width: 100%;
        max-width: 420px;
        background: #fff;
        border: 2px solid #fa4101;
        border-radius: 18px;
        padding: 40px 36px;
        box-shadow: 0 8px 32px rgba(250,65,1,0.08);
        animation: fadeUp 0.6s ease forwards;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .login-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .login-header h2 {
        font-size: 1.6rem;
        font-weight: 900;
        color: #fa4101;
        letter-spacing: -0.5px;
        margin-bottom: 6px;
    }

    .login-header p {
        font-size: 0.88rem;
        color: #888;
        margin: 0;
    }

    .field {
        margin-bottom: 20px;
    }

    .field label {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 0.85rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 8px;
    }

    .field label i {
        color: #fa4101;
        font-size: 14px;
    }

    .field input[type="email"],
    .field input[type="password"] {
        width: 100%;
        padding: 11px 14px;
        font-size: 0.92rem;
        font-family: 'Sora', sans-serif;
        color: #111;
        background: #fff;
        border: 1.5px solid #ddd;
        border-radius: 10px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-shadow: none;
        -webkit-appearance: none;
    }

    .field input[type="email"]:hover,
    .field input[type="password"]:hover {
        border-color: #fa4101;
    }

    .field input[type="email"]:focus,
    .field input[type="password"]:focus {
        border-color: #fa4101;
        border-width: 2px;
        box-shadow: 0 0 0 3px rgba(250,65,1,0.15);
    }

    .field input.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: block;
        font-size: 0.8rem;
        color: #dc3545;
        margin-top: 5px;
    }

    .check-row {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 24px;
    }

    .check-row input[type="checkbox"] {
        width: 18px;
        height: 18px;
        min-width: 18px;
        border: 2px solid #fa4101;
        border-radius: 5px;
        background: #fff;
        appearance: none;
        -webkit-appearance: none;
        cursor: pointer;
        outline: none;
        transition: background 0.2s, border-color 0.2s;
        position: relative;
    }

    .check-row input[type="checkbox"]:checked {
        background: #fa4101;
        border-color: #fa4101;
    }

    .check-row input[type="checkbox"]:checked::after {
        content: '';
        position: absolute;
        left: 4px;
        top: 1px;
        width: 6px;
        height: 10px;
        border: 2px solid #fff;
        border-top: none;
        border-left: none;
        transform: rotate(45deg);
    }

    .check-row input[type="checkbox"]:focus {
        box-shadow: 0 0 0 3px rgba(250,65,1,0.15);
    }

    .check-row label {
        font-size: 0.87rem;
        color: #555;
        cursor: pointer;
        user-select: none;
        margin: 0;
    }

    .btn-entrar {
        width: 100%;
        padding: 13px;
        background: #fa4101;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 0.92rem;
        font-weight: 800;
        font-family: 'Sora', sans-serif;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.2s, transform 0.2s;
    }

    .btn-entrar:hover {
        background: #d93600;
        transform: translateY(-2px);
    }

    .btn-entrar:active {
        transform: translateY(0);
    }

    .login-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 0.86rem;
        color: #888;
    }

    .login-footer a {
        color: #fa4101;
        font-weight: 700;
        text-decoration: none;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="login-wrap">
    <div class="login-card">

        <div class="login-header">
            <h2>Bem-vindo de volta</h2>
            <p>Entre na sua conta para continuar</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="field">
                <label for="email">
                    <i class="fas fa-envelope"></i> E-mail
                </label>
                <input type="email" id="email" name="email"
                    value="{{ old('email') }}"
                    placeholder="seu@email.com"
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                    required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">
                    <i class="fas fa-lock"></i> Senha
                </label>
                <input type="password" id="password" name="password"
                    placeholder="••••••••"
                    required>
            </div>

            <div class="check-row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Lembrar de mim</label>
            </div>

            <button type="submit" class="btn-entrar">
                <i class="fas fa-sign-in-alt me-1"></i> Entrar
            </button>
        </form>

        <div class="login-footer">
            Não tem conta? <a href="{{ route('registro') }}">Cadastre-se</a>
        </div>

    </div>
</div>

@endsection