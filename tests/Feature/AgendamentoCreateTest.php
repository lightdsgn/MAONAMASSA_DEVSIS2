<?php

use App\Models\Servico;
use App\Models\Usuario;

it('shows active services on agendamento create for cliente', function () {
    // criar prestador e serviço
    $prestador = Usuario::create([
        'nome' => 'Prestador Teste',
        'email' => 'prestador.teste@example.com',
        'password' => 'password',
        'tipo' => 'prestador',
    ]);

    $servico = Servico::create([
        'usuario_id' => $prestador->id,
        'titulo' => 'Serviço de Teste',
        'descricao' => 'Descrição',
        'categoria' => 'Geral',
        'preco_estimado' => 100,
        'status' => 'ativo',
    ]);

    // criar cliente e autenticar
    $cliente = Usuario::create([
        'nome' => 'Cliente Teste',
        'email' => 'cliente.teste@example.com',
        'password' => 'password',
        'tipo' => 'cliente',
    ]);

    actingAs($cliente)
        ->get('/agendamentos/create')
        ->assertStatus(200)
        ->assertViewHas('servicos', function ($servicos) use ($servico) {
            return collect($servicos)->contains(fn($s) => $s->id === $servico->id);
        });
});
