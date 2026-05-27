@include('crudtestes.header')

<main class="crud-page">
    <section class="crud-card">
        <h1>Migration: create_administradores_table</h1>
        <p class="note">Formulário de exemplo para um administrador, usando o relacionamento com <strong>usuarios</strong>.</p>
        <form class="crud-form" action="#" method="get" onsubmit="return false;">
            <div class="form-row">
                <label for="admin-usuario-id">Usuário ID</label>
                <input id="admin-usuario-id" name="usuario_id" type="number" placeholder="1" />
            </div>
            <div class="form-row">
                <label for="admin-nivel-acesso">Nível de acesso</label>
                <input id="admin-nivel-acesso" name="nivel_acesso" type="text" placeholder="Master" />
            </div>
            <button type="submit">Salvar</button>
        </form>
    </section>

    <section class="crud-card crud-table">
        <h2>administradores</h2>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Observações</th></tr>
            <tr><td>id</td><td>bigint unsigned</td><td>PK</td></tr>
            <tr><td>usuario_id</td><td>foreignId</td><td>constrained('usuarios'), cascadeOnDelete, cascadeOnUpdate</td></tr>
            <tr><td>nivel_acesso</td><td>string</td><td></td></tr>
            <tr><td>created_at</td><td>timestamp</td><td></td></tr>
            <tr><td>updated_at</td><td>timestamp</td><td></td></tr>
        </table>
        <p class="note">Relacionamento: <strong>administradores.usuario_id</strong> → <strong>usuarios.id</strong>.</p>
    </section>
</main>
