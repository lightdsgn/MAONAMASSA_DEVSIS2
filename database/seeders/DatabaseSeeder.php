<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Usuario;
use App\Models\Servico;
use App\Models\Produto;
use App\Models\Solicitacao;
use App\Models\Orcamento;
use App\Models\Agendamento;
use App\Models\Pagamento;
use App\Models\Avaliacao;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Avaliacao::truncate();
        Pagamento::truncate();
        Agendamento::truncate();
        Orcamento::truncate();
        Solicitacao::truncate();
        Produto::truncate();
        Servico::truncate();
        Usuario::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ----------------------------------------------------------------
        // 1. USUÁRIOS PADRÃO (emails e senhas intocados)
        // ----------------------------------------------------------------

        $adm = Usuario::create([
            'nome'          => 'Administrador',
            'email'         => 'admin@maonamassa.com.br',
            'password'      => Hash::make('admin!maonamassa'),
            'tipo'          => 'adm',
            'telefone'      => '(49) 99999-0000',
            'tipo_pessoa'   => 'fisico',
            'cpf_cnpj'      => '000.000.000-00',
            'razao_social'  => 'Administrador do Sistema',
            'nome_fantasia' => 'Admin Mão na Massa',
            'especialidade' => 'Administração',
            'portfolio'     => 'Administrador do sistema.',
            'cep'           => '89801-001',
            'logradouro'    => 'Rua Marechal Bormann',
            'numero'        => '100',
            'complemento'   => 'Sala ADM',
            'bairro'        => 'Centro',
            'cidade'        => 'Chapecó',
            'estado'        => 'SC',
        ]);

        $clientePadrao = Usuario::create([
            'nome'          => 'Cliente Padrão',
            'email'         => 'cliente@maonamassa.com.br',
            'password'      => Hash::make('cliente!maonamassa'),
            'tipo'          => 'cliente',
            'telefone'      => '(49) 99111-1111',
            'tipo_pessoa'   => 'fisico',
            'cpf_cnpj'      => '111.111.111-11',
            'razao_social'  => 'Cliente Padrão',
            'nome_fantasia' => 'Cliente Padrão',
            'especialidade' => 'Contratante',
            'portfolio'     => 'Cliente padrão para testes da plataforma.',
            'cep'           => '89801-100',
            'logradouro'    => 'Rua das Flores',
            'numero'        => '123',
            'complemento'   => 'Casa',
            'bairro'        => 'Centro',
            'cidade'        => 'Chapecó',
            'estado'        => 'SC',
        ]);

        $prestadorPadrao = Usuario::create([
            'nome'          => 'Prestador Padrão',
            'email'         => 'prestador@maonamassa.com.br',
            'password'      => Hash::make('prestador!maonamassa'),
            'tipo'          => 'prestador',
            'telefone'      => '(49) 99222-2222',
            'tipo_pessoa'   => 'fisico',
            'cpf_cnpj'      => '222.222.222-22',
            'razao_social'  => 'Prestador Padrão Serviços',
            'nome_fantasia' => 'Prestador Padrão',
            'especialidade' => 'Serviços Gerais',
            'portfolio'     => 'Prestador de serviços gerais com experiência em elétrica, hidráulica e reformas.',
            'cep'           => '89802-112',
            'logradouro'    => 'Avenida Getúlio Vargas',
            'numero'        => '456',
            'complemento'   => 'Sala 01',
            'bairro'        => 'Efapi',
            'cidade'        => 'Chapecó',
            'estado'        => 'SC',
        ]);

        // ----------------------------------------------------------------
        // 2. DEMAIS PRESTADORES
        // ----------------------------------------------------------------

        $prestadores = [$prestadorPadrao]; // index 0 = prestadorPadrao

        $nomesPrestadores = [
            // nome,                     email,                 tipo_pessoa,   cpf_cnpj,               razao_social,                      fantasia,            especialidade
            ['Carlos Eduardo Ramos',  'carlos@email.com',    'fisico',   '333.333.333-33', 'Carlos Eduardo Ramos Serviços', 'Elétrica Ramos',     'elétrica'],
            ['Ana Paula Ferreira',    'ana@email.com',       'fisico',   '444.444.444-44', 'Ana Paula Ferreira Serviços',   'Ana Hidráulica',     'hidráulica'],
            ['Roberto Lima',          'roberto@email.com',   'fisico',   '555.555.555-55', 'Roberto Lima Marcenaria',       'Roberto Marceneiro', 'marcenaria'],
            ['Fernanda Costa',        'fernanda@email.com',  'juridico', '11.111.111/0001-11', 'Costa Reformas LTDA',        'Costa Reformas',     'pintura'],
            ['Marcos Oliveira',       'marcos@email.com',    'fisico',   '666.666.666-66', 'Marcos Oliveira Jardinagem',    'Marcos Jardins',     'jardinagem'],
            ['Juliana Souza',         'juliana@email.com',   'fisico',   '777.777.777-77', 'Juliana Souza Limpeza',         'Juliana Clean',      'limpeza'],
            ['Diego Alves',           'diego@email.com',     'juridico', '22.222.222/0001-22', 'Alves Construções LTDA',    'Alves Construções',  'construção civil'],
            ['Patricia Mendes',       'patricia@email.com',  'fisico',   '888.888.888-88', 'Patricia Mendes Dedetização',   'Patricia Dedet',     'dedetização'],
        ];

        $telefonesFixos = [
            '(49) 99333-3333',
            '(49) 99444-4444',
            '(49) 99555-5555',
            '(49) 99666-6666',
            '(49) 99777-7777',
            '(49) 99888-8888',
            '(49) 99123-4567',
            '(49) 99234-5678',
        ];

        $cepsFixos = [
            '89803-001', '89804-002', '89805-003', '89806-004',
            '89807-005', '89808-006', '89809-007', '89810-008',
        ];

        foreach ($nomesPrestadores as $idx => [$nome, $email, $tipoPessoa, $cpfCnpj, $razaoSocial, $fantasia, $esp]) {
            $prestadores[] = Usuario::create([
                'nome'          => $nome,
                'email'         => $email,
                'password'      => Hash::make('password'),
                'tipo'          => 'prestador',
                'telefone'      => $telefonesFixos[$idx],
                'tipo_pessoa'   => $tipoPessoa,
                'cpf_cnpj'      => $cpfCnpj,
                'razao_social'  => $razaoSocial,
                'nome_fantasia' => $fantasia,
                'especialidade' => $esp,
                'portfolio'     => "Experiência profissional em {$esp}. Atendimento em Chapecó e região.",
                'cep'           => $cepsFixos[$idx],
                'logradouro'    => 'Rua ' . explode(' ', $nome)[0],
                'numero'        => (string)(100 + $idx * 37),
                'complemento'   => 'Sala ' . ($idx + 1),
                'bairro'        => 'Centro',
                'cidade'        => 'Chapecó',
                'estado'        => 'SC',
            ]);
        }

        // ----------------------------------------------------------------
        // 3. CLIENTES
        // ----------------------------------------------------------------

        $clientes = [$clientePadrao]; // index 0 = clientePadrao

        $nomesClientes = [
            ['Lucas Martins',     'lucas1@email.com',    '123.456.789-01', '(49) 99301-1001'],
            ['Beatriz Carvalho',  'beatriz2@email.com',  '234.567.890-12', '(49) 99302-1002'],
            ['Felipe Rodrigues',  'felipe3@email.com',   '345.678.901-23', '(49) 99303-1003'],
            ['Camila Nascimento', 'camila4@email.com',   '456.789.012-34', '(49) 99304-1004'],
            ['Gabriel Pereira',   'gabriel5@email.com',  '567.890.123-45', '(49) 99305-1005'],
            ['Larissa Gomes',     'larissa6@email.com',  '678.901.234-56', '(49) 99306-1006'],
            ['Thiago Barbosa',    'thiago7@email.com',   '789.012.345-67', '(49) 99307-1007'],
            ['Isabela Moreira',   'isabela8@email.com',  '890.123.456-78', '(49) 99308-1008'],
            ['Vinícius Santos',   'vinicius9@email.com', '901.234.567-89', '(49) 99309-1009'],
            ['Mariana Ribeiro',   'mariana10@email.com', '012.345.678-90', '(49) 99310-1010'],
            ['Eduardo Lopes',     'eduardo11@email.com', '321.654.987-01', '(49) 99311-1011'],
            ['Natália Araújo',    'natalia12@email.com', '432.765.098-12', '(49) 99312-1012'],
        ];

        foreach ($nomesClientes as $i => [$nome, $email, $cpf, $telefone]) {
            $clientes[] = Usuario::create([
                'nome'          => $nome,
                'email'         => $email,
                'password'      => Hash::make('password'),
                'tipo'          => 'cliente',
                'telefone'      => $telefone,
                'tipo_pessoa'   => 'fisico',
                'cpf_cnpj'      => $cpf,
                'razao_social'  => $nome,
                'nome_fantasia' => $nome,
                'especialidade' => 'Contratante',
                'portfolio'     => 'Cliente cadastrado na plataforma.',
                'cep'           => '8980' . (($i % 9) + 1) . '-' . str_pad($i + 10, 3, '0', STR_PAD_LEFT),
                'logradouro'    => 'Rua ' . explode(' ', $nome)[0] . ' ' . explode(' ', $nome)[1],
                'numero'        => (string)(50 + $i * 13),
                'complemento'   => 'Casa ' . ($i + 1),
                'bairro'        => $i % 2 === 0 ? 'Centro' : 'Efapi',
                'cidade'        => 'Chapecó',
                'estado'        => 'SC',
            ]);
        }

        // ----------------------------------------------------------------
        // 4. SERVIÇOS (cada prestador tem 2-3 serviços)
        //    index 0 = prestadorPadrao → 3 serviços dedicados para testes
        // ----------------------------------------------------------------

        $catalogoServicos = [
            // [prestador_index, titulo, categoria, preco, status]
            [0, 'Instalação Elétrica Residencial',       'Elétrica',         280.00, 'ativo'],
            [0, 'Revisão Hidráulica Completa',           'Hidráulica',       200.00, 'ativo'],
            [0, 'Serviços Gerais de Manutenção',         'Manutenção',       150.00, 'ativo'],
            [1, 'Troca de Disjuntores e Quadro Elétrico','Elétrica',         180.00, 'ativo'],
            [1, 'Instalação de Ar-condicionado',         'Elétrica',         350.00, 'ativo'],
            [2, 'Conserto de Vazamento',                 'Hidráulica',       150.00, 'ativo'],
            [2, 'Instalação de Torneiras e Registros',   'Hidráulica',       120.00, 'ativo'],
            [2, 'Desentupimento de Esgoto',              'Hidráulica',       200.00, 'ativo'],
            [3, 'Fabricação de Móveis Planejados',       'Marcenaria',       800.00, 'ativo'],
            [3, 'Reforma de Móveis Antigos',             'Marcenaria',       300.00, 'ativo'],
            [4, 'Pintura Interna Completa',              'Pintura',          600.00, 'ativo'],
            [4, 'Pintura de Fachada',                    'Pintura',          900.00, 'ativo'],
            [4, 'Textura e Grafiato',                    'Pintura',          750.00, 'ativo'],
            [5, 'Jardinagem e Paisagismo',               'Jardinagem',       200.00, 'ativo'],
            [5, 'Poda de Árvores',                       'Jardinagem',       180.00, 'ativo'],
            [6, 'Limpeza Residencial Completa',          'Limpeza',          180.00, 'ativo'],
            [6, 'Limpeza Pós-Obra',                      'Limpeza',          400.00, 'ativo'],
            [6, 'Higienização de Sofás e Colchões',      'Limpeza',          220.00, 'ativo'],
            [7, 'Construção de Muro e Alambrado',        'Construção Civil', 1200.00, 'ativo'],
            [7, 'Reforma de Banheiro Completa',          'Construção Civil', 2500.00, 'ativo'],
            [8, 'Dedetização Residencial',               'Dedetização',      250.00, 'ativo'],
            [8, 'Controle de Cupins',                    'Dedetização',      380.00, 'ativo'],
        ];

        $servicos = [];
        foreach ($catalogoServicos as [$pIdx, $titulo, $cat, $preco, $status]) {
            $servicos[] = Servico::create([
                'usuario_id'     => $prestadores[$pIdx]->id,
                'titulo'         => $titulo,
                'descricao'      => "Serviço profissional de {$titulo}. Orçamento sem compromisso, materiais inclusos quando aplicável.",
                'categoria'      => $cat,
                'preco_estimado' => $preco,
                'status'         => $status,
            ]);
        }

        // Referências rápidas dos serviços do prestadorPadrao (índices 0, 1, 2)
        $servicoPP_Eletrica  = $servicos[0]; // Instalação Elétrica Residencial
        $servicoPP_Hidro     = $servicos[1]; // Revisão Hidráulica Completa
        $servicoPP_Geral     = $servicos[2]; // Serviços Gerais de Manutenção

        // ----------------------------------------------------------------
        // 5. PRODUTOS
        // ----------------------------------------------------------------

        $catalogoProdutos = [
            [0, 'Kit Tomadas e Interruptores',          'Elétrica',    89.90,  20],
            [0, 'Cabo Flexível 2,5mm 100m',             'Elétrica',   149.00,  15],
            [1, 'Fita Isolante Kit 10 Unidades',        'Elétrica',    25.90,  50],
            [2, 'Registro de Pressão 1/2"',             'Hidráulica',  45.00,  30],
            [2, 'Veda Rosca Teflon 50m',                'Hidráulica',  12.50,  80],
            [3, 'Verniz para Madeira 900ml',            'Marcenaria',  38.50,  25],
            [4, 'Tinta Acrílica Premium 18L',           'Pintura',    210.00,  12],
            [4, 'Rolo de Lã 23cm Kit 5un',              'Pintura',     55.00,  40],
            [6, 'Kit Produtos de Limpeza Profissional', 'Limpeza',    120.00,  18],
            [8, 'Inseticida Profissional 5L',           'Dedetização',180.00,   8],
        ];

        foreach ($catalogoProdutos as [$pIdx, $nome, $cat, $preco, $qtd]) {
            Produto::create([
                'usuario_id'  => $prestadores[$pIdx]->id,
                'nome'        => $nome,
                'descricao'   => "Produto de qualidade profissional: {$nome}.",
                'categoria'   => $cat,
                'preco'       => $preco,
                'quantidade'  => $qtd,
                'status'      => 'ativo',
            ]);
        }

        // ================================================================
        // 6. FLUXOS DEDICADOS: prestadorPadrao ↔ clientePadrao
        //    Para facilitar os testes — todos os estados representados
        // ================================================================

        // ------------------------------------------------------------------
        // 6A. FLUXO COMPLETO 1 — Concluído + Pago + Avaliado (5 estrelas)
        // ------------------------------------------------------------------
        {
            $criadoEm = Carbon::now()->subDays(40);
            $sol = Solicitacao::create([
                'usuario_id'      => $clientePadrao->id,
                'prestador_id'    => $prestadorPadrao->id,
                'titulo'          => 'Instalação elétrica na cozinha',
                'descricao'       => 'Preciso instalar 3 tomadas novas na cozinha e verificar o quadro elétrico.',
                'categoria'       => 'Elétrica',
                'status'          => 'concluida',
                'disponibilidade' => $criadoEm->copy()->addDays(3)->toDateString(),
                'created_at'      => $criadoEm,
                'updated_at'      => $criadoEm->copy()->addDays(10),
            ]);
            $orc = Orcamento::create([
                'solicitacao_id' => $sol->id,
                'usuario_id'     => $prestadorPadrao->id,
                'servico_id'     => $servicoPP_Eletrica->id,
                'mao_de_obra'    => 168.00,
                'valor_total'    => 280.00,
                'prazo'          => 2,
                'observacoes'    => 'Inclui materiais básicos. Garantia de 90 dias.',
                'status'         => 'aceito',
                'created_at'     => $criadoEm->copy()->addDay(),
                'updated_at'     => $criadoEm->copy()->addDays(2),
            ]);
            $dataExec = $criadoEm->copy()->addDays(5);
            $age = Agendamento::create([
                'cliente_id'   => $clientePadrao->id,
                'servico_id'   => $servicoPP_Eletrica->id,
                'orcamento_id' => $orc->id,
                'data'         => $dataExec->toDateString(),
                'horario'      => '09:00',
                'status'       => 'concluido',
                'observacoes'  => 'Confirmar endereço: Rua das Flores, 123.',
                'created_at'   => $criadoEm->copy()->addDays(2),
                'updated_at'   => $dataExec,
            ]);
            Pagamento::create([
                'agendamento_id' => $age->id,
                'valor'          => 280.00,
                'metodo'         => 'pix',
                'status'         => 'pago',
                'data_pagamento' => $dataExec->copy()->addDay()->toDateString(),
                'created_at'     => $dataExec,
                'updated_at'     => $dataExec->copy()->addDay(),
            ]);
            Avaliacao::create([
                'agendamento_id' => $age->id,
                'servico_id'     => $servicoPP_Eletrica->id,
                'usuario_id'     => $clientePadrao->id,
                'nota'           => 5,
                'comentario'     => 'Serviço excelente! Muito profissional e pontual.',
                'created_at'     => $dataExec->copy()->addDays(2),
                'updated_at'     => $dataExec->copy()->addDays(2),
            ]);
        }

        // ------------------------------------------------------------------
        // 6B. FLUXO COMPLETO 2 — Concluído + Pago + Avaliado (4 estrelas)
        // ------------------------------------------------------------------
        {
            $criadoEm = Carbon::now()->subDays(20);
            $sol = Solicitacao::create([
                'usuario_id'      => $clientePadrao->id,
                'prestador_id'    => $prestadorPadrao->id,
                'titulo'          => 'Revisão hidráulica no banheiro',
                'descricao'       => 'Torneira pingando e pressão baixa no chuveiro. Preciso de revisão completa.',
                'categoria'       => 'Hidráulica',
                'status'          => 'concluida',
                'disponibilidade' => $criadoEm->copy()->addDays(2)->toDateString(),
                'created_at'      => $criadoEm,
                'updated_at'      => $criadoEm->copy()->addDays(8),
            ]);
            $orc = Orcamento::create([
                'solicitacao_id' => $sol->id,
                'usuario_id'     => $prestadorPadrao->id,
                'servico_id'     => $servicoPP_Hidro->id,
                'mao_de_obra'    => 120.00,
                'valor_total'    => 200.00,
                'prazo'          => 1,
                'observacoes'    => 'Inclui troca de vedação e registro. Materiais à parte se necessário substituição total.',
                'status'         => 'aceito',
                'created_at'     => $criadoEm->copy()->addDay(),
                'updated_at'     => $criadoEm->copy()->addDays(2),
            ]);
            $dataExec = $criadoEm->copy()->addDays(4);
            $age = Agendamento::create([
                'cliente_id'   => $clientePadrao->id,
                'servico_id'   => $servicoPP_Hidro->id,
                'orcamento_id' => $orc->id,
                'data'         => $dataExec->toDateString(),
                'horario'      => '14:00',
                'status'       => 'concluido',
                'observacoes'  => 'Deixar registro geral acessível.',
                'created_at'   => $criadoEm->copy()->addDays(2),
                'updated_at'   => $dataExec,
            ]);
            Pagamento::create([
                'agendamento_id' => $age->id,
                'valor'          => 200.00,
                'metodo'         => 'cartao_credito',
                'status'         => 'pago',
                'data_pagamento' => $dataExec->toDateString(),
                'created_at'     => $dataExec,
                'updated_at'     => $dataExec,
            ]);
            Avaliacao::create([
                'agendamento_id' => $age->id,
                'servico_id'     => $servicoPP_Hidro->id,
                'usuario_id'     => $clientePadrao->id,
                'nota'           => 4,
                'comentario'     => 'Ótimo atendimento, recomendo a todos!',
                'created_at'     => $dataExec->copy()->addDays(1),
                'updated_at'     => $dataExec->copy()->addDays(1),
            ]);
        }

        // ------------------------------------------------------------------
        // 6C. FLUXO COMPLETO 3 — Concluído + Pagamento PENDENTE (sem avaliação)
        //     Útil para testar tela de cobranças em aberto
        // ------------------------------------------------------------------
        {
            $criadoEm = Carbon::now()->subDays(7);
            $sol = Solicitacao::create([
                'usuario_id'      => $clientePadrao->id,
                'prestador_id'    => $prestadorPadrao->id,
                'titulo'          => 'Manutenção geral — quintal e varanda',
                'descricao'       => 'Pequenos reparos: fixar prateleiras, ajustar dobradiças, verificar tomadas externas.',
                'categoria'       => 'Manutenção',
                'status'          => 'concluida',
                'disponibilidade' => $criadoEm->copy()->addDays(2)->toDateString(),
                'created_at'      => $criadoEm,
                'updated_at'      => $criadoEm->copy()->addDays(5),
            ]);
            $orc = Orcamento::create([
                'solicitacao_id' => $sol->id,
                'usuario_id'     => $prestadorPadrao->id,
                'servico_id'     => $servicoPP_Geral->id,
                'mao_de_obra'    => 90.00,
                'valor_total'    => 150.00,
                'prazo'          => 1,
                'observacoes'    => 'Serviço rápido, estimativa de 2h.',
                'status'         => 'aceito',
                'created_at'     => $criadoEm->copy()->addDay(),
                'updated_at'     => $criadoEm->copy()->addDays(2),
            ]);
            $dataExec = $criadoEm->copy()->addDays(4);
            $age = Agendamento::create([
                'cliente_id'   => $clientePadrao->id,
                'servico_id'   => $servicoPP_Geral->id,
                'orcamento_id' => $orc->id,
                'data'         => $dataExec->toDateString(),
                'horario'      => '10:00',
                'status'       => 'concluido',
                'observacoes'  => 'Cliente confirmado por WhatsApp.',
                'created_at'   => $criadoEm->copy()->addDays(2),
                'updated_at'   => $dataExec,
            ]);
            Pagamento::create([
                'agendamento_id' => $age->id,
                'valor'          => 150.00,
                'metodo'         => 'boleto',
                'status'         => 'pendente',
                'data_pagamento' => null,
                'created_at'     => $dataExec,
                'updated_at'     => $dataExec,
            ]);
            // Sem avaliação — propositalmente
        }

        // ------------------------------------------------------------------
        // 6D. FLUXO INCOMPLETO — Solicitação ABERTA (sem prestador vinculado)
        //     Simula cliente buscando prestador no marketplace
        // ------------------------------------------------------------------
        Solicitacao::create([
            'usuario_id'      => $clientePadrao->id,
            'prestador_id'    => null,
            'titulo'          => 'Instalar iluminação LED na sala',
            'descricao'       => 'Quero instalar spots de LED embutidos no teto da sala. Preciso de orçamento.',
            'categoria'       => 'Elétrica',
            'status'          => 'aberta',
            'disponibilidade' => Carbon::now()->addDays(5)->toDateString(),
        ]);

        // ------------------------------------------------------------------
        // 6E. FLUXO INCOMPLETO — Orçamento ENVIADO aguardando aceite do cliente
        // ------------------------------------------------------------------
        {
            $criadoEm = Carbon::now()->subDays(2);
            $sol = Solicitacao::create([
                'usuario_id'      => $clientePadrao->id,
                'prestador_id'    => $prestadorPadrao->id,
                'titulo'          => 'Desentupimento da pia da cozinha',
                'descricao'       => 'Pia está entupida há dois dias, urgente.',
                'categoria'       => 'Hidráulica',
                'status'          => 'em_andamento',
                'disponibilidade' => Carbon::now()->addDays(1)->toDateString(),
                'created_at'      => $criadoEm,
                'updated_at'      => $criadoEm,
            ]);
            Orcamento::create([
                'solicitacao_id' => $sol->id,
                'usuario_id'     => $prestadorPadrao->id,
                'servico_id'     => $servicoPP_Hidro->id,
                'mao_de_obra'    => 90.00,
                'valor_total'    => 150.00,
                'prazo'          => 1,
                'observacoes'    => 'Atendimento no mesmo dia. Inclui produto desentupidor.',
                'status'         => 'pendente', // aguardando aceite
                'created_at'     => $criadoEm->copy()->addHours(3),
                'updated_at'     => $criadoEm->copy()->addHours(3),
            ]);
        }

        // ------------------------------------------------------------------
        // 6F. FLUXO INCOMPLETO — Agendamento CONFIRMADO (futuro próximo)
        // ------------------------------------------------------------------
        {
            $criadoEm = Carbon::now()->subDays(1);
            $sol = Solicitacao::create([
                'usuario_id'      => $clientePadrao->id,
                'prestador_id'    => $prestadorPadrao->id,
                'titulo'          => 'Troca de tomadas no quarto',
                'descricao'       => 'Tomadas do quarto principal com folga, preciso trocar todas (4 tomadas).',
                'categoria'       => 'Elétrica',
                'status'          => 'em_andamento',
                'disponibilidade' => Carbon::now()->addDays(3)->toDateString(),
                'created_at'      => $criadoEm,
                'updated_at'      => $criadoEm,
            ]);
            $orc = Orcamento::create([
                'solicitacao_id' => $sol->id,
                'usuario_id'     => $prestadorPadrao->id,
                'servico_id'     => $servicoPP_Eletrica->id,
                'mao_de_obra'    => 100.00,
                'valor_total'    => 180.00,
                'prazo'          => 1,
                'observacoes'    => '4 tomadas padrão NBR. Material incluso.',
                'status'         => 'aceito',
                'created_at'     => $criadoEm,
                'updated_at'     => $criadoEm,
            ]);
            Agendamento::create([
                'cliente_id'   => $clientePadrao->id,
                'servico_id'   => $servicoPP_Eletrica->id,
                'orcamento_id' => $orc->id,
                'data'         => Carbon::now()->addDays(3)->toDateString(),
                'horario'      => '09:00',
                'status'       => 'confirmado',
                'observacoes'  => 'Preferência pelo período da manhã.',
                'created_at'   => $criadoEm,
                'updated_at'   => $criadoEm,
            ]);
        }

        // ------------------------------------------------------------------
        // 6G. FLUXO INCOMPLETO — Agendamento PENDENTE (futuro — não confirmado)
        // ------------------------------------------------------------------
        {
            $criadoEm = Carbon::now()->subHours(6);
            $sol = Solicitacao::create([
                'usuario_id'      => $clientePadrao->id,
                'prestador_id'    => $prestadorPadrao->id,
                'titulo'          => 'Verificar quadro elétrico — sobrecarga',
                'descricao'       => 'Disjuntor cai com frequência quando uso microondas e ar junto. Preciso de vistoria.',
                'categoria'       => 'Elétrica',
                'status'          => 'em_andamento',
                'disponibilidade' => Carbon::now()->addDays(6)->toDateString(),
                'created_at'      => $criadoEm,
                'updated_at'      => $criadoEm,
            ]);
            $orc = Orcamento::create([
                'solicitacao_id' => $sol->id,
                'usuario_id'     => $prestadorPadrao->id,
                'servico_id'     => $servicoPP_Eletrica->id,
                'mao_de_obra'    => 168.00,
                'valor_total'    => 280.00,
                'prazo'          => 3,
                'observacoes'    => 'Vistoria + laudo + ajuste do quadro se necessário.',
                'status'         => 'aceito',
                'created_at'     => $criadoEm,
                'updated_at'     => $criadoEm,
            ]);
            Agendamento::create([
                'cliente_id'   => $clientePadrao->id,
                'servico_id'   => $servicoPP_Eletrica->id,
                'orcamento_id' => $orc->id,
                'data'         => Carbon::now()->addDays(6)->toDateString(),
                'horario'      => '14:00',
                'status'       => 'pendente',
                'observacoes'  => 'Aguardando confirmação do prestador.',
                'created_at'   => $criadoEm,
                'updated_at'   => $criadoEm,
            ]);
        }

        // ================================================================
        // 7. FLUXOS GERAIS — 30 fluxos concluídos com outros usuários
        // ================================================================

        // Serviços dos outros prestadores (índice 3 em diante)
        $servicosGerais = array_slice($servicos, 3);

        $titulosSolicitacoes = [
            'Preciso trocar fiação do quarto',
            'Torneira pingando na cozinha',
            'Quero pintar sala e cozinha',
            'Jardim precisando de cuidados',
            'Limpeza após reforma na casa',
            'Vistoria elétrica completa',
            'Desentupimento de pia',
            'Orçamento para banheiro novo',
            'Instalação de chuveiro elétrico',
            'Pintura de fachada da loja',
            'Poda das árvores do quintal',
            'Higienização de sofás',
            'Controle de baratas e formigas',
            'Fabricar estante para escritório',
            'Reparo em muro de divisa',
            'Instalação de luminárias',
            'Conserto de vaso sanitário',
            'Limpeza geral da casa',
            'Verniz nos móveis da sala',
            'Dedetização preventiva anual',
        ];

        for ($i = 0; $i < 30; $i++) {
            // Nunca usa clientePadrao nem prestadorPadrao neste bloco
            $clientesGerais   = array_slice($clientes, 1);
            $cliente  = $clientesGerais[array_rand($clientesGerais)];
            $servico  = $servicosGerais[array_rand($servicosGerais)];
            $prestador = Usuario::find($servico->usuario_id);
            $titulo   = $titulosSolicitacoes[$i % count($titulosSolicitacoes)];
            $diasAtras = rand(5, 120);
            $criadoEm  = Carbon::now()->subDays($diasAtras);

            $solicitacao = Solicitacao::create([
                'usuario_id'      => $cliente->id,
                'prestador_id'    => $prestador->id,
                'titulo'          => $titulo,
                'descricao'       => "Olá, {$titulo}. Preciso de atendimento o quanto antes.",
                'categoria'       => $servico->categoria,
                'status'          => 'concluida',
                'disponibilidade' => $criadoEm->copy()->addDays(2)->toDateString(),
                'created_at'      => $criadoEm,
                'updated_at'      => $criadoEm,
            ]);

            $orcamento = Orcamento::create([
                'solicitacao_id' => $solicitacao->id,
                'usuario_id'     => $prestador->id,
                'servico_id'     => $servico->id,
                'mao_de_obra'    => round($servico->preco_estimado * 0.6, 2),
                'valor_total'    => $servico->preco_estimado,
                'prazo'          => rand(1, 7),
                'observacoes'    => 'Materiais inclusos. Garantia de 90 dias.',
                'status'         => 'aceito',
                'created_at'     => $criadoEm->copy()->addDay(),
                'updated_at'     => $criadoEm->copy()->addDay(),
            ]);

            $dataAgendamento = $criadoEm->copy()->addDays(rand(3, 10));

            $agendamento = Agendamento::create([
                'cliente_id'   => $cliente->id,
                'servico_id'   => $servico->id,
                'orcamento_id' => $orcamento->id,
                'data'         => $dataAgendamento->toDateString(),
                'horario'      => ['08:00', '09:00', '10:00', '13:00', '14:00', '15:00'][rand(0, 5)],
                'status'       => 'concluido',
                'observacoes'  => 'Confirmar endereço por telefone antes da visita.',
                'created_at'   => $criadoEm->copy()->addDays(2),
                'updated_at'   => $dataAgendamento,
            ]);

            $statusPag = rand(0, 9) < 8 ? 'pago' : 'pendente';
            Pagamento::create([
                'agendamento_id' => $agendamento->id,
                'valor'          => $servico->preco_estimado,
                'metodo'         => ['pix', 'cartao_credito', 'dinheiro', 'boleto'][rand(0, 3)],
                'status'         => $statusPag,
                'data_pagamento' => $statusPag === 'pago'
                    ? $dataAgendamento->copy()->addDay()->toDateString()
                    : null,
                'created_at'     => $dataAgendamento,
                'updated_at'     => $dataAgendamento,
            ]);

            $nota = rand(0, 9) < 7 ? rand(4, 5) : rand(1, 3);
            Avaliacao::create([
                'agendamento_id' => $agendamento->id,
                'servico_id'     => $servico->id,
                'usuario_id'     => $cliente->id,
                'nota'           => $nota,
                'comentario'     => $this->comentario($nota),
                'created_at'     => $dataAgendamento->copy()->addDays(rand(1, 3)),
                'updated_at'     => $dataAgendamento->copy()->addDays(rand(1, 3)),
            ]);
        }

        // ================================================================
        // 8. SOLICITAÇÕES ABERTAS — outros clientes (painel do prestador)
        // ================================================================

        $solicitacoesAbertas = [
            ['Instalação de tomadas no escritório',  'Elétrica'],
            ['Vazamento no teto do quarto',          'Hidráulica'],
            ['Pintura do corredor e hall',           'Pintura'],
            ['Limpeza de caixa d\'água',             'Limpeza'],
            ['Manutenção de jardim mensal',          'Jardinagem'],
            ['Dedetização de apartamento',           'Dedetização'],
            ['Reforma do lavabo',                    'Construção Civil'],
            ['Troca de telhas quebradas',            'Construção Civil'],
        ];

        $clientesGerais = array_slice($clientes, 1);
        foreach ($solicitacoesAbertas as [$titulo, $cat]) {
            $cliente = $clientesGerais[array_rand($clientesGerais)];
            Solicitacao::create([
                'usuario_id'      => $cliente->id,
                'titulo'          => $titulo,
                'descricao'       => "{$titulo}. Preciso de orçamento com urgência.",
                'categoria'       => $cat,
                'status'          => 'aberta',
                'disponibilidade' => Carbon::now()->addDays(rand(1, 7))->toDateString(),
            ]);
        }

        // ================================================================
        // 9. AGENDAMENTOS PENDENTES/CONFIRMADOS — outros clientes
        // ================================================================

        for ($i = 0; $i < 8; $i++) {
            $cliente = $clientesGerais[array_rand($clientesGerais)];
            $servico = $servicosGerais[array_rand($servicosGerais)];
            $status  = $i < 4 ? 'pendente' : 'confirmado';
            $data    = Carbon::now()->addDays(rand(1, 14))->toDateString();

            $sol = Solicitacao::create([
                'usuario_id'      => $cliente->id,
                'prestador_id'    => $servico->usuario_id,
                'titulo'          => 'Agendamento — ' . $servico->titulo,
                'descricao'       => 'Agendamento solicitado via plataforma.',
                'categoria'       => $servico->categoria,
                'status'          => 'em_andamento',
                'disponibilidade' => $data,
            ]);

            $orc = Orcamento::create([
                'solicitacao_id' => $sol->id,
                'usuario_id'     => $servico->usuario_id,
                'servico_id'     => $servico->id,
                'mao_de_obra'    => round($servico->preco_estimado * 0.6, 2),
                'valor_total'    => $servico->preco_estimado,
                'prazo'          => rand(1, 5),
                'status'         => 'aceito',
            ]);

            Agendamento::create([
                'cliente_id'   => $cliente->id,
                'servico_id'   => $servico->id,
                'orcamento_id' => $orc->id,
                'data'         => $data,
                'horario'      => ['08:00', '10:00', '14:00', '16:00'][rand(0, 3)],
                'status'       => $status,
            ]);
        }

        $this->command->info('');
        $this->command->info('✅ Seeder concluído com sucesso!');
        $this->command->info('');
        $this->command->info('══════════════════════════════════════════════');
        $this->command->info('  CREDENCIAIS DE ACESSO');
        $this->command->info('══════════════════════════════════════════════');
        $this->command->info('  ADM       : admin@maonamassa.com.br       / admin!maonamassa');
        $this->command->info('  CLIENTE   : cliente@maonamassa.com.br     / cliente!maonamassa');
        $this->command->info('  PRESTADOR : prestador@maonamassa.com.br   / prestador!maonamassa');
        $this->command->info('══════════════════════════════════════════════');
        $this->command->info('');
        $this->command->info('  Fluxos prestadorPadrao ↔ clientePadrao:');
        $this->command->info('  [6A] Concluído + Pago + Avaliado (5★) — 40 dias atrás');
        $this->command->info('  [6B] Concluído + Pago + Avaliado (4★) — 20 dias atrás');
        $this->command->info('  [6C] Concluído + Pagamento PENDENTE — 7 dias atrás');
        $this->command->info('  [6D] Solicitação ABERTA (sem prestador)');
        $this->command->info('  [6E] Orçamento ENVIADO — aguardando aceite do cliente');
        $this->command->info('  [6F] Agendamento CONFIRMADO — daqui 3 dias');
        $this->command->info('  [6G] Agendamento PENDENTE — daqui 6 dias');
        $this->command->info('══════════════════════════════════════════════');
    }

    private function comentario(int $nota): string
    {
        $positivos = [
            'Serviço excelente! Muito profissional e pontual.',
            'Ótimo atendimento, recomendo a todos!',
            'Trabalho impecável, superou minhas expectativas.',
            'Muito satisfeito, voltarei a contratar com certeza.',
            'Profissional de confiança, serviço rápido e bem feito.',
        ];
        $neutros = [
            'Serviço ok, dentro do esperado.',
            'Atendeu as necessidades, sem reclamações.',
            'Razoável, mas poderia ser mais rápido.',
        ];
        $negativos = [
            'Demorou mais do que o combinado.',
            'Precisou retornar para ajustes.',
        ];

        return match (true) {
            $nota >= 4 => $positivos[array_rand($positivos)],
            $nota == 3 => $neutros[array_rand($neutros)],
            default    => $negativos[array_rand($negativos)],
        };
    }
}