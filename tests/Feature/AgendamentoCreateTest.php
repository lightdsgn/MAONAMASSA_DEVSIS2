<?php

use App\Models\Orcamento;
use App\Models\Servico;
use App\Models\Solicitacao;
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

it('allows client to create an agendamento from an accepted orçamento belonging to the same prestador', function () {
    $prestador = Usuario::create([
        'nome' => 'Prestador Teste',
        'email' => 'prestador.teste2@example.com',
        'password' => 'password',
        'tipo' => 'prestador',
    ]);

    $servico = Servico::create([
        'usuario_id' => $prestador->id,
        'titulo' => 'Serviço de Teste 2',
        'descricao' => 'Descrição',
        'categoria' => 'Geral',
        'preco_estimado' => 150,
        'status' => 'ativo',
    ]);

    $cliente = Usuario::create([
        'nome' => 'Cliente Teste 2',
        'email' => 'cliente.teste2@example.com',
        'password' => 'password',
        'tipo' => 'cliente',
    ]);

    $solicitacao = Solicitacao::create([
        'usuario_id' => $cliente->id,
        'titulo' => 'Solicitação teste',
        'descricao' => 'Descrição da solicitação',
        'categoria' => 'Geral',
    ]);

    $orcamento = Orcamento::create([
        'solicitacao_id' => $solicitacao->id,
        'usuario_id' => $prestador->id,
        'mao_de_obra' => 100,
        'valor_total' => 250,
        'prazo' => 5,
        'status' => 'aceito',
    ]);

    actingAs($cliente)
        ->get('/agendamentos/create?servico_id=' . $servico->id . '&orcamento_id=' . $orcamento->id)
        ->assertStatus(200)
        ->assertSee('Serviço de Teste 2');

    actingAs($cliente)
        ->post('/agendamentos', [
            'servico_id' => $servico->id,
            'orcamento_id' => $orcamento->id,
            'data' => now()->addDay()->format('Y-m-d'),
            'horario' => '10:00',
            'observacoes' => 'Detalhes do agendamento',
        ])
        ->assertRedirect('/agendamentos');

    $this->assertDatabaseHas('agendamentos', [
        'cliente_id' => $cliente->id,
        'servico_id' => $servico->id,
        'orcamento_id' => $orcamento->id,
        'status' => 'pendente',
    ]);
});

it('creates a solicitacao and orçamento automatically when creating an agendamento', function () {
    $prestador = Usuario::create([
        'nome' => 'Prestador Teste 3',
        'email' => 'prestador.teste3@example.com',
        'password' => 'password',
        'tipo' => 'prestador',
    ]);

    $servico = Servico::create([
        'usuario_id' => $prestador->id,
        'titulo' => 'Serviço de Teste 3',
        'descricao' => 'Descrição',
        'categoria' => 'Geral',
        'preco_estimado' => 200,
        'status' => 'ativo',
    ]);

    $cliente = Usuario::create([
        'nome' => 'Cliente Teste 3',
        'email' => 'cliente.teste3@example.com',
        'password' => 'password',
        'tipo' => 'cliente',
    ]);

    actingAs($cliente)
        ->post('/agendamentos', [
            'servico_id' => $servico->id,
            'data' => now()->addDay()->format('Y-m-d'),
            'horario' => '11:00',
            'observacoes' => 'Agendamento automático',
        ])
        ->assertRedirect('/agendamentos');

    $this->assertDatabaseHas('solicitacoes', [
        'usuario_id' => $cliente->id,
        'categoria' => 'Geral',
        'status' => 'em_andamento',
    ]);

    $this->assertDatabaseHas('orcamentos', [
        'usuario_id' => $prestador->id,
        'valor_total' => 200,
        'status' => 'aceito',
    ]);

    $this->assertDatabaseHas('agendamentos', [
        'cliente_id' => $cliente->id,
        'servico_id' => $servico->id,
        'status' => 'pendente',
    ]);
});
