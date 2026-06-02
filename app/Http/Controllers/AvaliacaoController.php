<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Avaliacao;
use App\Models\Servico;
use App\Models\Agendamento;

class AvaliacaoController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->busca;
        $user  = Auth::user();

        $query = Avaliacao::with(['servico.usuario', 'usuario', 'agendamento']);

        if ($user->isPrestador()) {
            $query->whereHas('servico', fn($q) => $q->where('usuario_id', $user->id));
        } elseif ($user->isCliente()) {
            $query->where('usuario_id', $user->id);
        }

        if ($busca) {
            $query->whereHas('servico', fn($q) => $q->where('titulo', 'like', "%$busca%"));
        }

        $avaliacoes = $query->orderByDesc('created_at')->paginate(10);

        return view('avaliacoes.index', compact('avaliacoes', 'busca'));
    }

    public function create(Request $request)
    {
        if (!Auth::user()->isCliente()) {
            abort(403, 'Acesso negado.');
        }

        $agendamento_id = $request->agendamento_id;

        $agendamentos = Agendamento::with('servico')
            ->where('cliente_id', Auth::id())
            ->where('status', 'concluido')
            ->whereDoesntHave('avaliacoes')
            ->get();

        return view('avaliacoes.create', compact('agendamentos', 'agendamento_id'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isCliente()) {
            abort(403, 'Acesso negado.');
        }

        $request->validate([
            'agendamento_id' => 'required|exists:agendamentos,id',
            'nota'           => 'required|integer|min:1|max:5',
            'comentario'     => 'nullable|string|max:1000',
        ]);

        $agendamento = Agendamento::with('servico')->findOrFail($request->agendamento_id);

        if ($agendamento->cliente_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        if ($agendamento->status !== 'concluido') {
            return back()->withErrors([
                'agendamento_id' => 'Você só pode avaliar agendamentos concluídos.'
            ]);
        }

        $jaAvaliou = Avaliacao::where('agendamento_id', $agendamento->id)
            ->where('usuario_id', Auth::id())
            ->exists();

        if ($jaAvaliou) {
            return back()->withErrors([
                'agendamento_id' => 'Você já avaliou este agendamento.'
            ]);
        }

        Avaliacao::create([
            'agendamento_id' => $agendamento->id,
            'servico_id'     => $agendamento->servico_id,
            'usuario_id'     => Auth::id(),
            'nota'           => $request->nota,
            'comentario'     => $request->comentario,
        ]);

        return redirect()->route('avaliacoes.index')->with('sucesso', 'Avaliação registrada!');
    }

    public function show(Avaliacao $avaliacao)
    {
        return view('avaliacoes.show', compact('avaliacao'));
    }

    public function destroy(Avaliacao $avaliacao)
    {
        $user = Auth::user();

        if (!$user->isAdm() && $avaliacao->usuario_id !== $user->id) {
            abort(403, 'Acesso negado.');
        }

        $avaliacao->delete();

        return redirect()->route('avaliacoes.index')->with('sucesso', 'Avaliação removida!');
    }
}