<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agendamento;
use App\Models\Servico;

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
            $query->whereHas('servico', fn($q) => $q->where('titulo', 'like', "%$busca%"))
                  ->orWhere('status', 'like', "%$busca%");
        }

        $agendamentos = $query->orderByDesc('data')->paginate(10);

        return view('agendamentos.index', compact('agendamentos', 'busca'));
    }

    public function create(Request $request)
    {
        $servico_id = $request->servico_id;
        $servicos   = Servico::where('status', 'ativo')->get();
        return view('agendamentos.create', compact('servicos', 'servico_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'servico_id'  => 'required|exists:servicos,id',
            'data'        => 'required|date|after_or_equal:today',
            'horario'     => 'required',
            'observacoes' => 'nullable|string|max:500',
        ]);

        Agendamento::create([
            'cliente_id'  => Auth::id(),
            'servico_id'  => $request->servico_id,
            'data'        => $request->data,
            'horario'     => $request->horario,
            'observacoes' => $request->observacoes,
            'status'      => 'pendente',
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
        $agendamento->delete();
        return redirect()->route('agendamentos.index')->with('sucesso', 'Agendamento cancelado!');
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
