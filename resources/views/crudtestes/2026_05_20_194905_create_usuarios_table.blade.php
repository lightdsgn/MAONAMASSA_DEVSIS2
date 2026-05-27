@include('crudtestes.header')

<main class="crud-page">
    <section class="crud-card">
        <h1>Migration: create_usuarios_table</h1>
        <p class="note">Formulário de exemplo para a tabela <strong>usuarios</strong>, com campos principais da migration.</p>
        <form class="crud-form" action="#" method="get" onsubmit="return false;">
            <div class="form-row">
                <label for="usuario-nome">Nome</label>
                <input id="usuario-nome" name="nome" type="text" placeholder="Ex: Maria Souza" />
            </div>
            <div class="form-row">
                <label for="usuario-email">Email</label>
                <input id="usuario-email" name="email" type="email" placeholder="email@exemplo.com" />
            </div>
            <div class="form-row">
                <label for="usuario-senha">Senha</label>
                <input id="usuario-senha" name="senha" type="password" placeholder="********" />
            </div>
            <div class="form-row">
                <label for="usuario-tipo">Tipo</label>
                <select id="usuario-tipo" name="tipo">
                    <option value="Cliente">Cliente</option>
                    <option value="Prestador">Prestador</option>
                    <option value="Administrador">Administrador</option>
                </select>
            </div>
            <button type="submit">Salvar</button>
        </form>
    </section>

    <section class="crud-card crud-table">
        <h2>usuarios</h2>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Observações</th></tr>
            <tr><td>id</td><td>bigint unsigned</td><td>PK</td></tr>
            <tr><td>nome</td><td>string</td><td></td></tr>
            <tr><td>email</td><td>string</td><td>unique</td></tr>
            <tr><td>senha</td><td>string</td><td></td></tr>
            <tr><td>telefone</td><td>string</td><td>nullable</td></tr>
            <tr><td>endereco</td><td>string</td><td>nullable</td></tr>
            <tr><td>tipo</td><td>enum</td><td>Cliente, Prestador, Administrador</td></tr>
            <tr><td>created_at</td><td>timestamp</td><td></td></tr>
            <tr><td>updated_at</td><td>timestamp</td><td></td></tr>
        </table>
        <p class="note">Os relacionamentos com <strong>administradores</strong>, <strong>prestadores</strong> e <strong>clientes</strong> usam o campo <strong>usuario_id</strong>.</p>
    </section>
</main>
