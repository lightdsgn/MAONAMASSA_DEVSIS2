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
        // 1. USUÁRIOS
        // ----------------------------------------------------------------

        $adm = Usuario::create([
            'nome'      => 'Administrador',
            'email'     => 'adm@maonamassa.com',
            'password'  => Hash::make('password'),
            'tipo'      => 'adm',
            'telefone'  => '(49) 99900-0000',
            'cidade'    => 'Chapecó',
            'estado'    => 'SC',
        ]);

        $nomesPrestadores = [
            ['Carlos Eduardo Ramos',    'carlos@email.com',   'fisico',   '11.111.111/0001-11', null,                 'Elétrica Ramos',       'elétrica'],
            ['Ana Paula Ferreira',      'ana@email.com',      'fisico',   null,                 '222.222.222-22',     null,                   'hidráulica'],
            ['Roberto Lima',            'roberto@email.com',  'fisico',   null,                 '333.333.333-33',     null,                   'marcenaria'],
            ['Fernanda Costa',          'fernanda@email.com', 'juridico', '44.444.444/0001-44', null,                 'Costa Reformas',       'pintura'],
            ['Marcos Oliveira',         'marcos@email.com',   'fisico',   null,                 '555.555.555-55',     null,                   'jardinagem'],
            ['Juliana Souza',           'juliana@email.com',  'fisico',   null,                 '666.666.666-66',     null,                   'limpeza'],
            ['Diego Alves',             'diego@email.com',    'juridico', '77.777.777/0001-77', null,                 'Alves Construções',    'construção civil'],
            ['Patricia Mendes',         'patricia@email.com', 'fisico',   null,                 '888.888.888-88',     null,                   'dedetização'],
        ];

        $prestadores = [];
        foreach ($nomesPrestadores as [$nome, $email, $tipoPessoa, $cnpj, $cpf, $razao, $esp]) {
            $prestadores[] = Usuario::create([
                'nome'          => $nome,
                'email'         => $email,
                'password'      => Hash::make('password'),
                'tipo'          => 'prestador',
                'tipo_pessoa'   => $tipoPessoa,
                'cpf_cnpj'      => $cnpj ?? $cpf,
                'razao_social'  => $razao,
                'especialidade' => $esp,
                'telefone'      => '(49) 9' . rand(8000, 9999) . '-' . rand(1000, 9999),
                'cidade'        => 'Chapecó',
                'estado'        => 'SC',
            ]);
        }

        $nomesClientes = [
            'Lucas Martins',        'Beatriz Carvalho',  'Felipe Rodrigues',
            'Camila Nascimento',    'Gabriel Pereira',   'Larissa Gomes',
            'Thiago Barbosa',       'Isabela Moreira',   'Vinícius Santos',
            'Mariana Ribeiro',      'Eduardo Lopes',     'Natália Araújo',
        ];

        $clientes = [];
        foreach ($nomesClientes as $i => $nome) {
            $clientes[] = Usuario::create([
                'nome'     => $nome,
                'email'    => strtolower(explode(' ', $nome)[0]) . ($i + 1) . '@email.com',
                'password' => Hash::make('password'),
                'tipo'     => 'cliente',
                'telefone' => '(49) 9' . rand(8000, 9999) . '-' . rand(1000, 9999),
                'cidade'   => 'Chapecó',
                'estado'   => 'SC',
            ]);
        }

        // ----------------------------------------------------------------
        // 2. SERVIÇOS (cada prestador tem 2-3 serviços)
        // ----------------------------------------------------------------

        $catalogoServicos = [
            // [prestador_index, titulo, categoria, preco, status]
            [0, 'Instalação Elétrica Residencial',      'Elétrica',         280.00, 'ativo'],
            [0, 'Troca de Disjuntores e Quadro Elétrico','Elétrica',        180.00, 'ativo'],
            [0, 'Instalação de Ar-condicionado',        'Elétrica',         350.00, 'ativo'],
            [1, 'Conserto de Vazamento',                'Hidráulica',       150.00, 'ativo'],
            [1, 'Instalação de Torneiras e Registros',  'Hidráulica',       120.00, 'ativo'],
            [1, 'Desentupimento de Esgoto',             'Hidráulica',       200.00, 'ativo'],
            [2, 'Fabricação de Móveis Planejados',      'Marcenaria',       800.00, 'ativo'],
            [2, 'Reforma de Móveis Antigos',            'Marcenaria',       300.00, 'ativo'],
            [3, 'Pintura Interna Completa',             'Pintura',          600.00, 'ativo'],
            [3, 'Pintura de Fachada',                   'Pintura',          900.00, 'ativo'],
            [3, 'Textura e Grafiato',                   'Pintura',          750.00, 'ativo'],
            [4, 'Jardinagem e Paisagismo',              'Jardinagem',       200.00, 'ativo'],
            [4, 'Poda de Árvores',                      'Jardinagem',       180.00, 'ativo'],
            [5, 'Limpeza Residencial Completa',         'Limpeza',          180.00, 'ativo'],
            [5, 'Limpeza Pós-Obra',                     'Limpeza',          400.00, 'ativo'],
            [5, 'Higienização de Sofás e Colchões',     'Limpeza',          220.00, 'ativo'],
            [6, 'Construção de Muro e Alambrado',       'Construção Civil', 1200.00,'ativo'],
            [6, 'Reforma de Banheiro Completa',         'Construção Civil', 2500.00,'ativo'],
            [7, 'Dedetização Residencial',              'Dedetização',      250.00, 'ativo'],
            [7, 'Controle de Cupins',                   'Dedetização',      380.00, 'ativo'],
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

        // ----------------------------------------------------------------
        // 3. PRODUTOS
        // ----------------------------------------------------------------

        $catalogoProdutos = [
            [0, 'Kit Tomadas e Interruptores',   'Elétrica',   89.90,  20],
            [0, 'Cabo Flexível 2,5mm 100m',       'Elétrica',   149.00, 15],
            [1, 'Registro de Pressão 1/2',        'Hidráulica', 45.00,  30],
            [2, 'Verniz para Madeira 900ml',      'Marcenaria', 38.50,  25],
            [3, 'Tinta Acrílica Premium 18L',     'Pintura',    210.00, 12],
            [3, 'Rolo de Lã 23cm Kit 5un',        'Pintura',    55.00,  40],
            [5, 'Kit Produtos de Limpeza Profissional', 'Limpeza', 120.00, 18],
            [7, 'Inseticida Profissional 5L',     'Dedetização',180.00, 8],
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

        // ----------------------------------------------------------------
        // 4. FLUXO COMPLETO: Solicitação → Orçamento → Agendamento → Pagamento → Avaliação
        // ----------------------------------------------------------------

        $categorias = ['Elétrica', 'Hidráulica', 'Marcenaria', 'Pintura', 'Jardinagem', 'Limpeza', 'Construção Civil', 'Dedetização'];

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

        // Gerar 30 fluxos completos (concluídos) — alimentam todos os painéis
        $fluxosConcluidos = 30;
        for ($i = 0; $i < $fluxosConcluidos; $i++) {
            $cliente   = $clientes[array_rand($clientes)];
            $servico   = $servicos[array_rand($servicos)];
            $prestador = Usuario::find($servico->usuario_id);
            $titulo    = $titulosSolicitacoes[$i % count($titulosSolicitacoes)];
            $diasAtras = rand(5, 120);
            $criadoEm  = Carbon::now()->subDays($diasAtras);

            $solicitacao = Solicitacao::create([
                'usuario_id'      => $cliente->id,
                'prestador_id'    => $prestador->id,
                'titulo'          => $titulo,
                'descricao'       => "Olá, {$titulo}. Preciso de atendimento o quanto antes. Tenho disponibilidade para receber visita.",
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
                'mao_de_obra'    => $servico->preco_estimado * 0.6,
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
                'horario'      => ['08:00', '09:00', '10:00', '13:00', '14:00', '15:00'][rand(0,5)],
                'status'       => 'concluido',
                'observacoes'  => 'Confirmar endereço por telefone antes da visita.',
                'created_at'   => $criadoEm->copy()->addDays(2),
                'updated_at'   => $dataAgendamento,
            ]);

            $statusPag = rand(0, 9) < 8 ? 'pago' : 'pendente'; // 80% pagos
            Pagamento::create([
                'agendamento_id' => $agendamento->id,
                'valor'          => $servico->preco_estimado,
                'metodo'         => ['pix', 'cartao_credito', 'dinheiro', 'boleto'][rand(0,3)],
                'status'         => $statusPag,
                'data_pagamento' => $statusPag === 'pago' ? $dataAgendamento->copy()->addDay()->toDateString() : null,
                'created_at'     => $dataAgendamento,
                'updated_at'     => $dataAgendamento,
            ]);

            // Avaliação (maioria positiva para os gráficos ficarem bonitos)
            $nota = rand(0, 9) < 7 ? rand(4, 5) : rand(1, 3); // 70% nota 4-5
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

        // ----------------------------------------------------------------
        // 5. SOLICITAÇÕES EM ABERTO (para o painel do prestador)
        // ----------------------------------------------------------------

        $solicitacoesAbertas = [
            'Instalação de tomadas no escritório',
            'Vazamento no teto do quarto',
            'Pintura do corredor e hall',
            'Limpeza de caixa d\'água',
            'Manutenção de jardim mensal',
            'Dedetização de apartamento',
            'Reforma do lavabo',
            'Troca de telhas quebradas',
        ];

        foreach ($solicitacoesAbertas as $titulo) {
            $cliente = $clientes[array_rand($clientes)];
            Solicitacao::create([
                'usuario_id'      => $cliente->id,
                'titulo'          => $titulo,
                'descricao'       => "{$titulo}. Preciso de orçamento com urgência.",
                'categoria'       => $categorias[array_rand($categorias)],
                'status'          => 'aberta',
                'disponibilidade' => Carbon::now()->addDays(rand(1, 7))->toDateString(),
            ]);
        }

        // ----------------------------------------------------------------
        // 6. AGENDAMENTOS PENDENTES/CONFIRMADOS (para o painel do prestador)
        // ----------------------------------------------------------------

        for ($i = 0; $i < 8; $i++) {
            $cliente  = $clientes[array_rand($clientes)];
            $servico  = $servicos[array_rand($servicos)];
            $status   = $i < 4 ? 'pendente' : 'confirmado';
            $data     = Carbon::now()->addDays(rand(1, 14))->toDateString();

            $sol = Solicitacao::create([
                'usuario_id'   => $cliente->id,
                'prestador_id' => $servico->usuario_id,
                'titulo'       => 'Solicitação de agendamento - ' . $servico->titulo,
                'descricao'    => 'Agendamento solicitado.',
                'categoria'    => $servico->categoria,
                'status'       => 'em_andamento',
                'disponibilidade' => $data,
            ]);

            $orc = Orcamento::create([
                'solicitacao_id' => $sol->id,
                'usuario_id'     => $servico->usuario_id,
                'servico_id'     => $servico->id,
                'mao_de_obra'    => $servico->preco_estimado * 0.6,
                'valor_total'    => $servico->preco_estimado,
                'prazo'          => rand(1, 5),
                'status'         => 'aceito',
            ]);

            Agendamento::create([
                'cliente_id'   => $cliente->id,
                'servico_id'   => $servico->id,
                'orcamento_id' => $orc->id,
                'data'         => $data,
                'horario'      => ['08:00', '10:00', '14:00', '16:00'][rand(0,3)],
                'status'       => $status,
            ]);
        }

        $this->command->info('✅ Seeder concluído!');
        $this->command->info('   ADM:       adm@maonamassa.com  / password');
        $this->command->info('   Prestador: carlos@email.com    / password');
        $this->command->info('   Cliente:   lucas1@email.com    / password');
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

        return match(true) {
            $nota >= 4 => $positivos[array_rand($positivos)],
            $nota == 3 => $neutros[array_rand($neutros)],
            default    => $negativos[array_rand($negativos)],
        };
    }
}