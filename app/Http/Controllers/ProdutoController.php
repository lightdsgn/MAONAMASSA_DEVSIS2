<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Produto;

class ProdutoController extends Controller
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
        $produtos = Produto::with('usuario')
            ->when($busca, function ($query) use ($busca) {
                $query->where('nome', 'like', "%$busca%")
                      ->orWhere('categoria', 'like', "%$busca%");
            })->paginate(10);

        return view('produtos.index', compact('produtos', 'busca'));
    }

    public function create()
    {
        $this->checkPrestador();
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $this->checkPrestador();
        $request->validate([
            'nome'       => 'required|string|max:255',
            'descricao'  => 'required|string',
            'categoria'  => 'required|string',
            'preco'      => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'foto'       => 'nullable|image|max:2048',
            'status'     => 'required|in:ativo,inativo',
        ]);

        $data = $request->except('foto');
        $data['usuario_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos/produtos', 'public');
        }

        Produto::create($data);
        return redirect()->route('produtos.index')->with('sucesso', 'Produto cadastrado!');
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        $this->checkPrestador();
        if (Auth::user()->tipo !== 'adm' && $produto->usuario_id !== Auth::id()) {
            abort(403, 'Você não pode editar o produto de outro prestador.');
        }
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $this->checkPrestador();
        if (Auth::user()->tipo !== 'adm' && $produto->usuario_id !== Auth::id()) {
            abort(403, 'Você não pode editar o produto de outro prestador.');
        }

        $request->validate([
            'nome'       => 'required|string|max:255',
            'descricao'  => 'required|string',
            'categoria'  => 'required|string',
            'preco'      => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'foto'       => 'nullable|image|max:2048',
            'status'     => 'required|in:ativo,inativo',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($produto->foto) {
                Storage::disk('public')->delete($produto->foto);
            }
            $data['foto'] = $request->file('foto')->store('fotos/produtos', 'public');
        }

        $produto->update($data);
        return redirect()->route('produtos.index')->with('sucesso', 'Produto atualizado!');
    }

    public function destroy(Produto $produto)
    {
        $this->checkPrestador();
        if (Auth::user()->tipo !== 'adm' && $produto->usuario_id !== Auth::id()) {
            abort(403, 'Você não pode deletar o produto de outro prestador.');
        }
        if ($produto->foto) {
            Storage::disk('public')->delete($produto->foto);
        }
        $produto->delete();
        return redirect()->route('produtos.index')->with('sucesso', 'Produto deletado!');
    }
}