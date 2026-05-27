@include('crudtestes.header')

<main class="crud-page">
    <section class="crud-card">
        <h1>Migration: create_users_table</h1>
        <p class="note">Formulário de exemplo para um registro da tabela <strong>users</strong>. Abaixo há a tabela com os campos mapeados pela migration.</p>
        <form class="crud-form" action="#" method="get" onsubmit="return false;">
            <div class="form-row">
                <label for="user-name">Name</label>
                <input id="user-name" name="name" type="text" placeholder="Ex: João Silva" />
            </div>
            <div class="form-row">
                <label for="user-email">Email</label>
                <input id="user-email" name="email" type="email" placeholder="email@exemplo.com" />
            </div>
            <div class="form-row">
                <label for="user-password">Password</label>
                <input id="user-password" name="password" type="password" placeholder="********" />
            </div>
            <div class="form-row">
                <label for="user-remember-token">Remember Token</label>
                <input id="user-remember-token" name="remember_token" type="text" placeholder="Token de sessão" />
            </div>
            <button type="submit">Salvar</button>
        </form>
    </section>

    <section class="crud-card crud-table">
        <h2>users</h2>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Observações</th></tr>
            <tr><td>id</td><td>bigint unsigned</td><td>PK, autoincrement</td></tr>
            <tr><td>name</td><td>string</td><td></td></tr>
            <tr><td>email</td><td>string</td><td>unique</td></tr>
            <tr><td>email_verified_at</td><td>timestamp</td><td>nullable</td></tr>
            <tr><td>password</td><td>string</td><td></td></tr>
            <tr><td>remember_token</td><td>string</td><td>nullable</td></tr>
            <tr><td>created_at</td><td>timestamp</td><td></td></tr>
            <tr><td>updated_at</td><td>timestamp</td><td></td></tr>
        </table>
        <p class="note">Esta migration também cria as tabelas <strong>password_reset_tokens</strong> e <strong>sessions</strong>.</p>
    </section>
</main>
