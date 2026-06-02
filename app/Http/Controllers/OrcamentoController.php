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

    private function checkCliente()
    {
        if (Auth::user()->tipo !== 'cliente' && Auth::user()->tipo !== 'adm') {
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
        $solicitacoes = Solicitacao::whereDoesntHave('orcamentos')->get();
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
        ]);

        $solicitacao = Solicitacao::findOrFail($request->solicitacao_id);

        if ($solicitacao->prestador_id !== Auth::id()) {
            abort(403, 'Você só pode orçar solicitações aceitas por você.');
        }

        $data = $request->only([
            'solicitacao_id',
            'mao_de_obra',
            'valor_total',
            'prazo',
            'observacoes'
        ]);

        $data['usuario_id'] = Auth::id();
        $data['status'] = 'pendente';

        Orcamento::create($data);

        return redirect()
            ->route('orcamentos.index')
            ->with('sucesso', 'Orçamento cadastrado!');
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
        $solicitacoes = Solicitacao::whereDoesntHave('orcamentos')
            ->orWhere('id', $orcamento->solicitacao_id)->get();
        return view('orcamentos.edit', compact('orcamento', 'solicitacoes'));
    }

    public function update(Request $request, Orcamento $orcamento)
    {
        $this->checkPrestador();
        if (Auth::user()->tipo !== 'adm' && $orcamento->usuario_id !== Auth::id()) {
            abort(403, 'Você não pode editar o orçamento de outro prestador.');
        }

        $rules = [
            'solicitacao_id' => 'required|exists:solicitacoes,id|unique:orcamentos,solicitacao_id,' . $orcamento->id,
            'mao_de_obra'    => 'required|numeric|min:0',
            'valor_total'    => 'required|numeric|min:0',
            'prazo'          => 'required|integer|min:1',
            'observacoes'    => 'nullable|string',
        ];

        if (Auth::user()->isAdm()) {
            $rules['status'] = 'required|in:pendente,aceito,recusado';
        }

        $request->validate($rules);

        $data = $request->only(['solicitacao_id', 'mao_de_obra', 'valor_total', 'prazo', 'observacoes']);
        if (Auth::user()->isAdm()) {
            $data['status'] = $request->status;
        }

        $orcamento->update($data);
        return redirect()->route('orcamentos.index')->with('sucesso', 'Orçamento atualizado!');
    }

    public function aceitar(Orcamento $orcamento)
    {
        $this->checkCliente();
        if (Auth::id() !== $orcamento->solicitacao->usuario_id && !Auth::user()->isAdm()) {
            abort(403, 'Você não pode aceitar este orçamento.');
        }
        if ($orcamento->status !== 'pendente') {
            return back()->with('erro', 'Orçamento já foi respondido.');
        }

        $orcamento->update(['status' => 'aceito']);
        $orcamento->solicitacao->update(['status' => 'em_andamento']);

        return redirect()->route('orcamentos.show', $orcamento)->with('sucesso', 'Orçamento aceito!');
    }

    public function recusar(Orcamento $orcamento)
    {
        $this->checkCliente();
        if (Auth::id() !== $orcamento->solicitacao->usuario_id && !Auth::user()->isAdm()) {
            abort(403, 'Você não pode recusar este orçamento.');
        }
        if ($orcamento->status !== 'pendente') {
            return back()->with('erro', 'Orçamento já foi respondido.');
        }

        $orcamento->update(['status' => 'recusado']);

        return redirect()->route('orcamentos.show', $orcamento)->with('sucesso', 'Orçamento recusado!');
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