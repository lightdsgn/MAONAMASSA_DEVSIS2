@include('crudtestes.header')

<main class="crud-page">
    <section class="crud-card">
        <h1>Migration: create_clientes_table</h1>
        <p class="note">Formulário de exemplo para a tabela <strong>clientes</strong>, que se relaciona com usuários.</p>
        <form class="crud-form" action="#" method="get" onsubmit="return false;">
            <div class="form-row">
                <label for="cliente-usuario-id">Usuário ID</label>
                <input id="cliente-usuario-id" name="usuario_id" type="number" placeholder="1" />
            </div>
            <button type="submit">Salvar</button>
        </form>
    </section>

    <section class="crud-card crud-table">
        <h2>clientes</h2>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Observações</th></tr>
            <tr><td>id</td><td>bigint unsigned</td><td>PK</td></tr>
            <tr><td>usuario_id</td><td>foreignId</td><td>unique, constrained('usuarios'), cascadeOnDelete, cascadeOnUpdate</td></tr>
            <tr><td>created_at</td><td>timestamp</td><td></td></tr>
            <tr><td>updated_at</td><td>timestamp</td><td></td></tr>
        </table>
        <p class="note">Relacionamento com <strong>usuarios</strong> e <strong>agendamentos</strong> através de <strong>cliente_id</strong>.</p>
    </section>
</main>
