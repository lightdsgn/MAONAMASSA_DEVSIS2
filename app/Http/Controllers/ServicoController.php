<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Servico;

class ServicoController extends Controller
{
    private function checkPrestador()
    {
        if (Auth::user()->tipo !== 'prestador' && Auth::user()->tipo !== 'adm') {
            abort(403, 'Acesso negado.');
        }
    }

    public function index(Request $request)
    {
        $busca = $request->busca;
        $servicos = Servico::with('usuario')
            ->when($busca, function ($query) use ($busca) {
                $query->where('titulo', 'like', "%$busca%")
                      ->orWhere('categoria', 'like', "%$busca%");
            })->paginate(10);

        return view('servicos.index', compact('servicos', 'busca'));
    }

    public function create()
    {
        $this->checkPrestador();
        return view('servicos.create');
    }

    public function store(Request $request)
    {
        $this->checkPrestador();
        $request->validate([
            'titulo'         => 'required|string|max:255',
            'descricao'      => 'required|string',
            'categoria'      => 'required|string',
            'preco_estimado' => 'nullable|numeric|min:0',
            'foto'           => 'nullable|image|max:2048',
            'status'         => 'required|in:ativo,inativo',
        ]);

        $data = $request->except('foto');
        $data['usuario_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos/servicos', 'public');
        }

        Servico::create($data);
        return redirect()->route('servicos.index')->with('sucesso', 'Serviço cadastrado!');
    }

    public function show(Servico $servico)
    {
        return view('servicos.show', compact('servico'));
    }

    public function edit(Servico $servico)
    {
        $this->checkPrestador();
        if (Auth::user()->tipo !== 'adm' && $servico->usuario_id !== Auth::id()) {
            abort(403, 'Você não pode editar o serviço de outro prestador.');
        }
        return view('servicos.edit', compact('servico'));
    }

    public function update(Request $request, Servico $servico)
    {
        $this->checkPrestador();
        if (Auth::user()->tipo !== 'adm' && $servico->usuario_id !== Auth::id()) {
            abort(403, 'Você não pode editar o serviço de outro prestador.');
        }

        $request->validate([
            'titulo'         => 'required|string|max:255',
            'descricao'      => 'required|string',
            'categoria'      => 'required|string',
            'preco_estimado' => 'nullable|numeric|min:0',
            'foto'           => 'nullable|image|max:2048',
            'status'         => 'required|in:ativo,inativo',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($servico->foto) {
                Storage::disk('public')->delete($servico->foto);
            }
            $data['foto'] = $request->file('foto')->store('fotos/servicos', 'public');
        }

        $servico->update($data);
        return redirect()->route('servicos.index')->with('sucesso', 'Serviço atualizado!');
    }

    public function destroy(Servico $servico)
    {
        $this->checkPrestador();
        if (Auth::user()->tipo !== 'adm' && $servico->usuario_id !== Auth::id()) {
            abort(403, 'Você não pode deletar o serviço de outro prestador.');
        }
        if ($servico->foto) {
            Storage::disk('public')->delete($servico->foto);
        }
        $servico->delete();
        return redirect()->route('servicos.index')->with('sucesso', 'Serviço deletado!');
    }
}