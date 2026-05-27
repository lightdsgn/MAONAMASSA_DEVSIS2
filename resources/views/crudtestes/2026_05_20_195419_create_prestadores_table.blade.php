@include('crudtestes.header')

<main class="crud-page">
    <section class="crud-card">
        <h1>Migration: create_prestadores_table</h1>
        <p class="note">Formulário de exemplo para prestadores, com relacionamento a usuários e agendas.</p>
        <form class="crud-form" action="#" method="get" onsubmit="return false;">
            <div class="form-row">
                <label for="prestador-usuario-id">Usuário ID</label>
                <input id="prestador-usuario-id" name="usuario_id" type="number" placeholder="1" />
            </div>
            <div class="form-row">
                <label for="prestador-agenda-id">Agenda ID</label>
                <input id="prestador-agenda-id" name="agenda_id" type="number" placeholder="1" />
            </div>
            <div class="form-row">
                <label for="prestador-especialidade">Especialidade</label>
                <input id="prestador-especialidade" name="especialidade" type="text" placeholder="Eletricista" />
            </div>
            <div class="form-row">
                <label for="prestador-portfolio">Portfolio</label>
                <textarea id="prestador-portfolio" name="portfolio" placeholder="Descrição do portfolio"></textarea>
            </div>
            <button type="submit">Salvar</button>
        </form>
    </section>

    <section class="crud-card crud-table">
        <h2>prestadores</h2>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Observações</th></tr>
            <tr><td>id</td><td>bigint unsigned</td><td>PK</td></tr>
            <tr><td>usuario_id</td><td>foreignId</td><td>unique, constrained('usuarios'), cascadeOnDelete, cascadeOnUpdate</td></tr>
            <tr><td>agenda_id</td><td>foreignId</td><td>unique, constrained('agendas'), restrictOnDelete, cascadeOnUpdate</td></tr>
            <tr><td>especialidade</td><td>string</td><td></td></tr>
            <tr><td>portfolio</td><td>text</td><td>nullable</td></tr>
            <tr><td>created_at</td><td>timestamp</td><td></td></tr>
            <tr><td>updated_at</td><td>timestamp</td><td></td></tr>
        </table>
        <p class="note">A tabela conecta <strong>usuarios</strong> e <strong>agendas</strong> com chaves estrangeiras.</p>
    </section>
</main>
