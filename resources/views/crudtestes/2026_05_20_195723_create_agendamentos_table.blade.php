@include('crudtestes.header')

<main class="crud-page">
    <section class="crud-card">
        <h1>Migration: create_agendamentos_table</h1>
        <p class="note">Formulário de exemplo para a tabela <strong>agendamentos</strong>, que conecta clientes e serviços.</p>
        <form class="crud-form" action="#" method="get" onsubmit="return false;">
            <div class="form-row">
                <label for="agendamento-cliente-id">Cliente ID</label>
                <input id="agendamento-cliente-id" name="cliente_id" type="number" placeholder="1" />
            </div>
            <div class="form-row">
                <label for="agendamento-servico-id">Serviço ID</label>
                <input id="agendamento-servico-id" name="servico_id" type="number" placeholder="1" />
            </div>
            <div class="form-row">
                <label for="agendamento-data">Data</label>
                <input id="agendamento-data" name="data" type="date" />
            </div>
            <div class="form-row">
                <label for="agendamento-horario">Horário</label>
                <input id="agendamento-horario" name="horario" type="time" />
            </div>
            <button type="submit">Salvar</button>
        </form>
    </section>

    <section class="crud-card crud-table">
        <h2>agendamentos</h2>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Observações</th></tr>
            <tr><td>id</td><td>bigint unsigned</td><td>PK</td></tr>
            <tr><td>cliente_id</td><td>foreignId</td><td>constrained('clientes'), restrictOnDelete, cascadeOnUpdate</td></tr>
            <tr><td>servico_id</td><td>foreignId</td><td>constrained('servicos'), restrictOnDelete, cascadeOnUpdate</td></tr>
            <tr><td>data</td><td>date</td><td></td></tr>
            <tr><td>horario</td><td>time</td><td></td></tr>
            <tr><td>status</td><td>string</td><td>default 'Pendente'</td></tr>
            <tr><td>created_at</td><td>timestamp</td><td></td></tr>
            <tr><td>updated_at</td><td>timestamp</td><td></td></tr>
        </table>
        <p class="note">Relacionamentos principais: <strong>clientes</strong> e <strong>servicos</strong>.</p>
    </section>
</main>
