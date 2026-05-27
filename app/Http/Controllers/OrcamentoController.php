<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Orcamento;
use App\Models\Solicitacao;

class OrcamentoController extends Controller
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
        $orcamentos = Orcamento::with(['solicitacao', 'usuario'])
            ->when($busca, function ($query) use ($busca) {
                $query->whereHas('solicitacao', function ($q) use ($busca) {
                    $q->where('titulo', 'like', "%$busca%");
                })->orWhere('status', 'like', "%$busca%");
            })->paginate(10);

        return view('orcamentos.index', compact('orcamentos', 'busca'));
    }

    public function create()
    {
        $this->checkPrestador();
        $solicitacoes = Solicitacao::whereDoesntHave('orcamento')->get();
        return view('orcamentos.create', compact('solicitacoes'));
    }

    public function store(Request $request)
    {
        $this->checkPrestador();
        $request->validate([
            'solicitacao_id' => 'required|exists:solicitacoes,id|unique:orcamentos,solicitacao_id',
            'mao_de_obra'    => 'required|numeric|min:0',
            'valor_total'    => 'required|numeric|min:0',
            'prazo'          => 'required|integer|min:1',
            'observacoes'    => 'nullable|string',
            'status'         => 'required|in:pendente,aceito,recusado',
        ]);

        $data = $request->all();
        $data['usuario_id'] = Auth::id();

        Orcamento::create($data);
        return redirect()->route('orcamentos.index')->with('sucesso', 'Orçamento cadastrado!');
    }

    public function show(Orcamento $orcamento)
    {
        return view('orcamentos.show', compact('orcamento'));
    }

    public function edit(Orcamento $orcamento)
    {
        $this->checkPrestador();
        if (Auth::user()->tipo !== 'adm' && $orcamento->usuario_id !== Auth::id()) {
            abort(403, 'Você não pode editar o orçamento de outro prestador.');
        }
        $solicitacoes = Solicitacao::whereDoesntHave('orcamento')
            ->orWhere('id', $orcamento->solicitacao_id)->get();
        return view('orcamentos.edit', compact('orcamento', 'solicitacoes'));
    }

    public function update(Request $request, Orcamento $orcamento)
    {
        $this->checkPrestador();
        if (Auth::user()->tipo !== 'adm' && $orcamento->usuario_id !== Auth::id()) {
            abort(403, 'Você não pode editar o orçamento de outro prestador.');
        }

        $request->validate([
            'solicitacao_id' => 'required|exists:solicitacoes,id|unique:orcamentos,solicitacao_id,' . $orcamento->id,
            'mao_de_obra'    => 'required|numeric|min:0',
            'valor_total'    => 'required|numeric|min:0',
            'prazo'          => 'required|integer|min:1',
            'observacoes'    => 'nullable|string',
            'status'         => 'required|in:pendente,aceito,recusado',
        ]);

        $orcamento->update($request->all());
        return redirect()->route('orcamentos.index')->with('sucesso', 'Orçamento atualizado!');
    }

    public function destroy(Orcamento $orcamento)
    {
        $this->checkPrestador();
        if (Auth::user()->tipo !== 'adm' && $orcamento->usuario_id !== Auth::id()) {
            abort(403, 'Você não pode deletar o orçamento de outro prestador.');
        }
        $orcamento->delete();
        return redirect()->route('orcamentos.index')->with('sucesso', 'Orçamento deletado!');
    }
}