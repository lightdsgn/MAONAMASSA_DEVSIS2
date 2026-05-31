<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Solicitacao;

class SolicitacaoController extends Controller
{
    private function checkCliente()
    {
        if (Auth::user()->tipo !== 'cliente' && Auth::user()->tipo !== 'adm') {
            abort(403, 'Acesso negado.');
        }
    }

    public function index(Request $request)
    {
        $busca = $request->busca;
        $user  = Auth::user();

        $query = Solicitacao::with('usuario');

        // Prestador só vê solicitações abertas e ainda sem orçamento
        if ($user->isPrestador()) {
            $query->where('status', 'aberta')
                  ->whereDoesntHave('orcamento');
        }

        // Cliente só vê as próprias solicitações
        if ($user->isCliente()) {
            $query->where('usuario_id', $user->id);
        }

        $query->when($busca, function ($q) use ($busca) {
            $q->where('titulo', 'like', "%$busca%")
              ->orWhere('categoria', 'like', "%$busca%")
              ->orWhere('status', 'like', "%$busca%");
        });

        $solicitacoes = $query->latest()->paginate(10);

        return view('solicitacoes.index', compact('solicitacoes', 'busca'));
    }

    public function create()
    {
        $this->checkCliente();
        return view('solicitacoes.create');
    }

    public function store(Request $request)
    {
        $this->checkCliente();
        $request->validate([
            'titulo'          => 'required|string|max:255',
            'descricao'       => 'required|string',
            'categoria'       => 'required|string',
            'foto'            => 'nullable|image|max:2048',
            'disponibilidade' => 'nullable|date',
        ]);

        $data = $request->except('foto');
        $data['usuario_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos/solicitacoes', 'public');
        }

        Solicitacao::create($data);
        return redirect()->route('solicitacoes.index')->with('sucesso', 'Solicitação criada!');
    }

    public function show(Solicitacao $solicitacao)
    {
        return view('solicitacoes.show', compact('solicitacao'));
    }

    public function edit(Solicitacao $solicitacao)
    {
        $this->checkCliente();
        if (Auth::user()->tipo !== 'adm' && $solicitacao->usuario_id !== Auth::id()) {
            abort(403, 'Você não pode editar a solicitação de outro cliente.');
        }
        return view('solicitacoes.edit', compact('solicitacao'));
    }

    public function update(Request $request, Solicitacao $solicitacao)
    {
        $this->checkCliente();
        if (Auth::user()->tipo !== 'adm' && $solicitacao->usuario_id !== Auth::id()) {
            abort(403, 'Você não pode editar a solicitação de outro cliente.');
        }

        $request->validate([
            'titulo'          => 'required|string|max:255',
            'descricao'       => 'required|string',
            'categoria'       => 'required|string',
            'foto'            => 'nullable|image|max:2048',
            'disponibilidade' => 'nullable|date',
            'status'          => 'required|in:aberta,em_andamento,concluida,cancelada',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($solicitacao->foto) {
                Storage::disk('public')->delete($solicitacao->foto);
            }
            $data['foto'] = $request->file('foto')->store('fotos/solicitacoes', 'public');
        }

        $solicitacao->update($data);
        return redirect()->route('solicitacoes.index')->with('sucesso', 'Solicitação atualizada!');
    }

    public function destroy(Solicitacao $solicitacao)
    {
        $this->checkCliente();
        if (Auth::user()->tipo !== 'adm' && $solicitacao->usuario_id !== Auth::id()) {
            abort(403, 'Você não pode deletar a solicitação de outro cliente.');
        }
        if ($solicitacao->foto) {
            Storage::disk('public')->delete($solicitacao->foto);
        }
        $solicitacao->delete();
        return redirect()->route('solicitacoes.index')->with('sucesso', 'Solicitação deletada!');
    }
}