<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agendamento;
use App\Models\Orcamento;
use App\Models\Servico;
use App\Models\Solicitacao;

class AgendamentoController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->busca;
        $user  = Auth::user();

        $query = Agendamento::with(['cliente', 'servico.usuario']);

        if ($user->isCliente()) {
            $query->where('cliente_id', $user->id);
        } elseif ($user->isPrestador()) {
            $query->whereHas('servico', fn($q) => $q->where('usuario_id', $user->id));
        }

        if ($busca) {
            $query->where(function ($q) use ($busca) {
                $q->whereHas('servico', function ($sub) use ($busca) {
                    $sub->where('titulo', 'like', "%{$busca}%");
                })
                ->orWhere('status', 'like', "%{$busca}%");
            });
        }

        $agendamentos = $query->orderByDesc('data')->paginate(10);

        return view('agendamentos.index', compact('agendamentos', 'busca'));
    }

    public function create(Request $request)
    {
        if (!Auth::user()->isCliente()) {
            abort(403, 'Acesso negado.');
        }

        $servico_id = $request->servico_id;
        $orcamento_id = $request->orcamento_id;
        $servicos = Servico::where('status', 'ativo');

        if ($orcamento_id) {
            $orcamento = Orcamento::findOrFail($orcamento_id);

            if ($orcamento->status !== 'aceito') {
                abort(403, 'Só é possível agendar um orçamento aceito.');
            }

            $servicos->where('usuario_id', $orcamento->usuario_id);

            if (! $servico_id) {
                $servico_id = $servicos->value('id');
            }
        }

        $servicos = $servicos->get();

        return view('agendamentos.create', compact('servicos', 'servico_id', 'orcamento_id'));
    }

    public function store(\App\Http\Requests\StoreAgendamentoRequest $request)
    {
        if (! Auth::user()->isCliente()) {
            abort(403, 'Acesso negado.');
        }

        $servico = Servico::findOrFail($request->servico_id);
        $orcamentoId = $request->input('orcamento_id');

        if ($orcamentoId) {
            $orcamento = Orcamento::findOrFail($orcamentoId);

            if ($orcamento->status !== 'aceito') {
                return back()->withErrors(['orcamento_id' => 'Orçamento precisa estar aceito para agendar.']);
            }

            if ($orcamento->usuario_id !== $servico->usuario_id) {
                return back()->withErrors(['servico_id' => 'O serviço selecionado deve pertencer ao prestador do orçamento.']);
            }

        } else {
            $solicitacao = Solicitacao::create([
                'usuario_id'     => Auth::id(),
                'titulo'         => "Solicitação de agendamento - {$servico->titulo}",
                'descricao'      => trim("Agendamento solicitado para o serviço {$servico->titulo} em {$request->data} às {$request->horario}. " . ($request->observacoes ?? '')),
                'categoria'      => $servico->categoria ?? 'Geral',
                'disponibilidade'=> $request->data,
                'status'         => 'em_andamento',
            ]);

            $orcamento = Orcamento::create([
                'solicitacao_id' => $solicitacao->id,
                'usuario_id'     => $servico->usuario_id,
                'mao_de_obra'    => $servico->preco_estimado ?? 0,
                'valor_total'    => $servico->preco_estimado ?? 0,
                'prazo'          => 1,
                'observacoes'    => 'Orçamento gerado automaticamente a partir do agendamento.',
                'status'         => 'aceito',
            ]);

            $orcamentoId = $orcamento->id;
        }

        Agendamento::create([
            'cliente_id'   => Auth::id(),
            'servico_id'   => $request->servico_id,
            'orcamento_id' => $orcamentoId,
            'data'         => $request->data,
            'horario'      => $request->horario,
            'observacoes'  => $request->observacoes,
            'status'       => 'pendente',
        ]);

        return redirect()->route('agendamentos.index')->with('sucesso', 'Agendamento realizado com sucesso!');
    }

    public function show(Agendamento $agendamento)
    {
        $this->authorize($agendamento);
        return view('agendamentos.show', compact('agendamento'));
    }

    public function edit(Agendamento $agendamento)
    {
        $this->authorize($agendamento);
        $servicos = Servico::where('status', 'ativo')->get();
        return view('agendamentos.edit', compact('agendamento', 'servicos'));
    }

    public function update(Request $request, Agendamento $agendamento)
    {
        $this->authorize($agendamento);
        $user = Auth::user();

        // Apenas prestador/adm pode mudar status
        if ($user->isCliente()) {
            $request->validate([
                'data'        => 'required|date',
                'horario'     => 'required',
                'observacoes' => 'nullable|string|max:500',
            ]);
            $agendamento->update($request->only('data', 'horario', 'observacoes'));
        } else {
            $request->validate([
                'status' => 'required|in:pendente,confirmado,concluido,cancelado',
            ]);
            $agendamento->update($request->only('status'));
        }

        return redirect()->route('agendamentos.index')->with('sucesso', 'Agendamento atualizado!');
    }

    public function destroy(Agendamento $agendamento)
    {
        $this->authorize($agendamento);

        if ($agendamento->status === 'concluido') {
            return back()->withErrors([
                'status' => 'Agendamentos concluídos não podem ser removidos.'
            ]);
        }

        $agendamento->delete();

        return redirect()->route('agendamentos.index')->with('sucesso', 'Agendamento cancelado!');
    }

    public function aceitar(Agendamento $agendamento)
    {
        $user = Auth::user();
        if (! $user->isPrestador() || $agendamento->servico->usuario_id !== $user->id) {
            abort(403, 'Acesso negado.');
        }
        if ($agendamento->status !== 'pendente') {
            return back()->withErrors([
                'status' => 'Somente agendamentos pendentes podem ser confirmados.'
            ]);
        }

        $agendamento->update(['status' => 'confirmado']);
        return back()->with('sucesso', 'Agendamento confirmado.');
    }

    public function recusar(Agendamento $agendamento)
    {
        $user = Auth::user();
        if (! $user->isPrestador() || $agendamento->servico->usuario_id !== $user->id) {
            abort(403, 'Acesso negado.');
        }
        if ($agendamento->status !== 'pendente') {
            return back()->withErrors([
                'status' => 'Somente agendamentos pendentes podem ser recusados.'
            ]);
        }

        $agendamento->update(['status' => 'cancelado']);
        return back()->with('sucesso', 'Agendamento recusado.');
    }

    public function concluir(Agendamento $agendamento)
    {
        $user = Auth::user();

        if (! $user->isPrestador() || $agendamento->servico->usuario_id !== $user->id) {
            abort(403, 'Acesso negado.');
        }

        if ($agendamento->status !== 'confirmado') {
            return back()->withErrors([
                'status' => 'Somente agendamentos confirmados podem ser concluídos.'
            ]);
        }

        $agendamento->update([
            'status' => 'concluido'
        ]);

        if ($agendamento->orcamento?->solicitacao) {
            $agendamento->orcamento->solicitacao->update([
                'status' => 'concluida'
            ]);
        }

        return back()->with('sucesso', 'Serviço concluído.');
    }

    private function authorize(Agendamento $agendamento): void
    {
        $user = Auth::user();
        if ($user->isAdm()) return;
        if ($user->isCliente() && $agendamento->cliente_id === $user->id) return;
        if ($user->isPrestador() && $agendamento->servico->usuario_id === $user->id) return;
        abort(403, 'Acesso negado.');
    }
}
