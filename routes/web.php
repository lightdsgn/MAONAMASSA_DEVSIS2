<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\SolicitacaoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\PagamentoController;

// ---------------------------------------------------
// Páginas públicas
// ---------------------------------------------------
Route::get('/', fn() => view('home'))->name('home');

// Leitura pública de serviços e produtos (visitantes podem navegar)
Route::get('/servicos',          [ServicoController::class, 'index'])->name('servicos.index');
Route::get('/produtos',          [ProdutoController::class, 'index'])->name('produtos.index');

// ---------------------------------------------------
// Autenticação
// ---------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/registro', [AuthController::class, 'showRegistro'])->name('registro');
    Route::post('/registro',[AuthController::class, 'registro']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ---------------------------------------------------
// Área autenticada
// ---------------------------------------------------
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Perfil
    Route::get('/perfil', [UsuarioController::class, 'perfil'])->name('perfil');
    Route::put('/perfil', [UsuarioController::class, 'atualizarPerfil'])->name('perfil.atualizar');

    // Serviços (criação/edição/exclusão — requer auth; index/show já declarados acima)
    Route::post('/servicos',              [ServicoController::class, 'store'])->name('servicos.store');
    Route::get('/servicos/create',        [ServicoController::class, 'create'])->name('servicos.create');
    Route::get('/servicos/{servico}/edit',[ServicoController::class, 'edit'])->name('servicos.edit');
    Route::put('/servicos/{servico}',     [ServicoController::class, 'update'])->name('servicos.update');
    Route::delete('/servicos/{servico}',  [ServicoController::class, 'destroy'])->name('servicos.destroy');

    // Produtos (criação/edição/exclusão — requer auth; index/show já declarados acima)
    Route::post('/produtos',              [ProdutoController::class, 'store'])->name('produtos.store');
    Route::get('/produtos/create',        [ProdutoController::class, 'create'])->name('produtos.create');
    Route::get('/produtos/{produto}/edit',[ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::put('/produtos/{produto}',     [ProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/{produto}',  [ProdutoController::class, 'destroy'])->name('produtos.destroy');

    // Solicitações
    Route::resource('solicitacoes', SolicitacaoController::class);

    // Orçamentos
    Route::resource('orcamentos', OrcamentoController::class);
    Route::post('/orcamentos/{orcamento}/aceitar', [OrcamentoController::class, 'aceitar'])
        ->name('orcamentos.aceitar');
    Route::post('/orcamentos/{orcamento}/recusar', [OrcamentoController::class, 'recusar'])
        ->name('orcamentos.recusar');

    // Agendamentos
    Route::resource('agendamentos', AgendamentoController::class);

    // Avaliações
    Route::resource('avaliacoes', AvaliacaoController::class)->except(['edit', 'update']);

    // Pagamentos
    Route::resource('pagamentos', PagamentoController::class);

    // Área ADM — CRUD completo de usuários
    Route::middleware('tipo:adm')->group(function () {
        Route::resource('usuarios', UsuarioController::class);
    });
});

Route::get('/servicos/{servico}',[ServicoController::class, 'show'])->name('servicos.show');
Route::get('/produtos/{produto}',[ProdutoController::class, 'show'])->name('produtos.show');

