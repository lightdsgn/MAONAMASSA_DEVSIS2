<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Avaliacao;
use App\Models\Servico;

class AvaliacaoController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->busca;
        $user  = Auth::user();

        $query = Avaliacao::with(['servico.usuario', 'usuario']);

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
        $servico_id = $request->servico_id;
        $servicos   = Servico::where('status', 'ativo')->get();
        return view('avaliacoes.create', compact('servicos', 'servico_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'servico_id'  => 'required|exists:servicos,id',
            'nota'        => 'required|integer|min:1|max:5',
            'comentario'  => 'nullable|string|max:1000',
        ]);

        $jaAvaliou = Avaliacao::where('servico_id', $request->servico_id)
                               ->where('usuario_id', Auth::id())
                               ->exists();

        if ($jaAvaliou) {
            return back()->withErrors(['servico_id' => 'Você já avaliou este serviço.']);
        }

        Avaliacao::create([
            'servico_id'  => $request->servico_id,
            'usuario_id'  => Auth::id(),
            'nota'        => $request->nota,
            'comentario'  => $request->comentario,
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
