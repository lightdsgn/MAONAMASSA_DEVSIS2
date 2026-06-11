<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Usuario;

class UsuarioController extends Controller
{

    private function checkAdm()
    {
        if (Auth::user()->tipo !== 'adm') {
            abort(403, 'Acesso negado.');
        }
    }

    public function index(Request $request)
    {
        $this->checkAdm();
        $busca = $request->busca;
        $usuarios = Usuario::when($busca, function ($query) use ($busca) {
            $query->where('nome', 'like', "%$busca%")
                  ->orWhere('email', 'like', "%$busca%");
        })->paginate(10);

        return view('usuarios.index', compact('usuarios', 'busca'));
    }

    public function create()
    {
        $this->checkAdm();
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $this->checkAdm();
        $request->validate([
            'nome'       => 'required|string|max:255',
            'email'      => 'required|email|unique:usuarios',
            'password'   => 'required|min:6|confirmed',
            'tipo'       => 'required|in:cliente,prestador,adm',
            'telefone'   => 'nullable|string|max:20',
            'foto'       => 'nullable|image|max:2048',
            'tipo_pessoa' => 'nullable|in:fisico,juridico',
            'cpf_cnpj'   => 'nullable|string|max:18|unique:usuarios',
        ]);

        $data = $request->except(['password', 'password_confirmation', 'foto', '_token', '_method']);

        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos/usuarios', 'public');
        }

        Usuario::create($data);
        return redirect()->route('usuarios.index')->with('sucesso', 'Usuário criado com sucesso!');
    }

    public function show(Usuario $usuario)
    {
        $this->checkAdm();
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        $this->checkAdm();
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $this->checkAdm();
        $request->validate([
            'nome'       => 'required|string|max:255',
            'email'      => 'required|email|unique:usuarios,email,' . $usuario->id,
            'tipo'       => 'required|in:cliente,prestador,adm',
            'telefone'   => 'nullable|string|max:20',
            'foto'       => 'nullable|image|max:2048',
            'tipo_pessoa' => 'nullable|in:fisico,juridico',
            'cpf_cnpj'   => 'nullable|string|max:18|unique:usuarios,cpf_cnpj,' . $usuario->id,
        ]);

        $data = $request->except(['password', 'password_confirmation', 'foto', '_token', '_method']);


        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            if ($usuario->foto) {
                Storage::disk('public')->delete($usuario->foto);
            }
            $data['foto'] = $request->file('foto')->store('fotos/usuarios', 'public');
        }

        foreach ($data as $key => $value) {
            $usuario->$key = $value;
        }
        $usuario->save();
        return redirect()->route('usuarios.index')->with('sucesso', 'Usuário atualizado!');
    }

    public function destroy(Usuario $usuario)
    {
        $this->checkAdm();
        if ($usuario->foto) {
            Storage::disk('public')->delete($usuario->foto);
        }
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('sucesso', 'Usuário deletado!');
    }


    public function perfil()
    {
        $usuario = Auth::user();
        return view('usuarios.perfil', compact('usuario'));
    }

    public function atualizarPerfil(Request $request)
    {
        $usuario = Auth::user();
        $request->validate([
            'nome'       => 'required|string|max:255',
            'telefone'   => 'nullable|string|max:20',
            'foto'       => 'nullable|image|max:2048',
            'tipo_pessoa' => 'nullable|in:fisico,juridico',
            'cpf_cnpj'   => 'nullable|string|max:18|unique:usuarios,cpf_cnpj,' . $usuario->id,
            'cep'        => 'nullable|string|max:9',
            'logradouro' => 'nullable|string|max:255',
            'numero'     => 'nullable|string|max:20',
            'complemento'=> 'nullable|string|max:255',
            'bairro'     => 'nullable|string|max:255',
            'cidade'     => 'nullable|string|max:255',
            'estado'     => 'nullable|string|max:2',
        ]);

        $data = $request->except(['foto', '_token', '_method']);

        if ($request->hasFile('foto')) {
            if ($usuario->foto) {
                Storage::disk('public')->delete($usuario->foto);
            }
            $data['foto'] = $request->file('foto')->store('fotos/usuarios', 'public');
        }

        DB::table('usuarios')->where('id', $usuario->id)->update($data);
        return redirect()->route('perfil')->with('sucesso', 'Perfil atualizado!');
    }
}