<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return back()->withErrors(['email' => 'E-mail ou senha incorretos.'])->withInput();
        }

        Auth::login($usuario, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'))->with('sucesso', 'Bem-vindo, ' . $usuario->nome . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function showRegistro()
    {
        return view('auth.registro');
    }

    public function registro(Request $request)
    {
        $request->validate([
            'nome'         => 'required|string|max:255',
            'email'        => 'required|email|unique:usuarios',
            'password'     => 'required|min:6|confirmed',
            'tipo'         => 'required|in:cliente,prestador',
            'telefone'     => 'nullable|string|max:20',
            'tipo_pessoa'  => 'nullable|in:fisico,juridico',
            'cpf_cnpj'     => 'nullable|string|max:18|unique:usuarios',
            'razao_social' => 'nullable|string|max:255',
            'nome_fantasia'=> 'nullable|string|max:255',
            'especialidade'=> 'nullable|string|max:255',
            'cep'          => 'nullable|string|max:9',
            'logradouro'   => 'nullable|string|max:255',
            'numero'       => 'nullable|string|max:20',
            'complemento'  => 'nullable|string|max:255',
            'bairro'       => 'nullable|string|max:255',
            'cidade'       => 'nullable|string|max:255',
            'estado'       => 'nullable|string|max:2',
        ]);

        $usuario = Usuario::create([
            'nome'          => $request->nome,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'tipo'          => $request->tipo,
            'telefone'      => $request->telefone,
            'tipo_pessoa'   => $request->tipo_pessoa,
            'cpf_cnpj'      => $request->cpf_cnpj ?: null,
            'razao_social'  => $request->razao_social,
            'nome_fantasia' => $request->nome_fantasia,
            'especialidade' => $request->especialidade,
            'cep'           => $request->cep,
            'logradouro'    => $request->logradouro,
            'numero'        => $request->numero,
            'complemento'   => $request->complemento,
            'bairro'        => $request->bairro,
            'cidade'        => $request->cidade,
            'estado'        => $request->estado,
        ]);

        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('sucesso', 'Cadastro realizado! Bem-vindo, ' . $usuario->nome . '!');
    }
}
