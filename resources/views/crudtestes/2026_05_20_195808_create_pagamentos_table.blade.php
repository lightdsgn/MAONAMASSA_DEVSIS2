@include('crudtestes.header')

<main class="crud-page">
    <section class="crud-card">
        <h1>Migration: create_pagamentos_table</h1>
        <p class="note">Formulário de exemplo para pagamentos, com valor, método e status.</p>
        <form class="crud-form" action="#" method="get" onsubmit="return false;">
            <div class="form-row">
                <label for="pagamento-agendamento-id">Agendamento ID</label>
                <input id="pagamento-agendamento-id" name="agendamento_id" type="number" placeholder="1" />
            </div>
            <div class="form-row">
                <label for="pagamento-valor">Valor</label>
                <input id="pagamento-valor" name="valor" type="number" step="0.01" placeholder="150.00" />
            </div>
            <div class="form-row">
                <label for="pagamento-metodo">Método</label>
                <input id="pagamento-metodo" name="metodo" type="text" placeholder="Cartão" />
            </div>
            <button type="submit">Salvar</button>
        </form>
    </section>

    <section class="crud-card crud-table">
        <h2>pagamentos</h2>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Observações</th></tr>
            <tr><td>id</td><td>bigint unsigned</td><td>PK</td></tr>
            <tr><td>agendamento_id</td><td>foreignId</td><td>unique, constrained('agendamentos'), restrictOnDelete, cascadeOnUpdate</td></tr>
            <tr><td>valor</td><td>decimal(10,2)</td><td></td></tr>
            <tr><td>metodo</td><td>string</td><td></td></tr>
            <tr><td>status</td><td>string</td><td>default 'Pendente'</td></tr>
            <tr><td>data_pagamento</td><td>date</td><td>nullable</td></tr>
            <tr><td>created_at</td><td>timestamp</td><td></td></tr>
            <tr><td>updated_at</td><td>timestamp</td><td></td></tr>
        </table>
        <p class="note">Relacionamento com o agendamento por <strong>agendamento_id</strong>.</p>
    </section>
</main>
