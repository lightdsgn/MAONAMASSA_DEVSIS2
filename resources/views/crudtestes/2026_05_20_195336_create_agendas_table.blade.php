@include('crudtestes.header')

<main class="crud-page">
    <section class="crud-card">
        <h1>Migration: create_agendas_table</h1>
        <p class="note">Formulário de exemplo para a tabela <strong>agendas</strong>, exibindo os campos de disponibilidade.</p>
        <form class="crud-form" action="#" method="get" onsubmit="return false;">
            <div class="form-row">
                <label for="agenda-dias-disponiveis">Dias disponíveis</label>
                <input id="agenda-dias-disponiveis" name="dias_disponiveis" type="text" placeholder='["Segunda", "Terça"]' />
            </div>
            <div class="form-row">
                <label for="agenda-horarios-disponiveis">Horários disponíveis</label>
                <input id="agenda-horarios-disponiveis" name="horarios_disponiveis" type="text" placeholder='["09:00", "14:00"]' />
            </div>
            <button type="submit">Salvar</button>
        </form>
    </section>

    <section class="crud-card crud-table">
        <h2>agendas</h2>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Observações</th></tr>
            <tr><td>id</td><td>bigint unsigned</td><td>PK</td></tr>
            <tr><td>dias_disponiveis</td><td>json</td><td></td></tr>
            <tr><td>horarios_disponiveis</td><td>json</td><td></td></tr>
            <tr><td>created_at</td><td>timestamp</td><td></td></tr>
            <tr><td>updated_at</td><td>timestamp</td><td></td></tr>
        </table>
        <p class="note">Relacionamento com <strong>prestadores</strong> via <strong>agenda_id</strong>.</p>
    </section>
</main>
