@include('crudtestes.header')

<main class="crud-page">
    <section class="crud-card">
        <h1>Migration: create_servicos_table</h1>
        <p class="note">Formulário de exemplo para a tabela <strong>servicos</strong>, com dados básicos de serviço.</p>
        <form class="crud-form" action="#" method="get" onsubmit="return false;">
            <div class="form-row">
                <label for="servico-prestador-id">Prestador ID</label>
                <input id="servico-prestador-id" name="prestador_id" type="number" placeholder="1" />
            </div>
            <div class="form-row">
                <label for="servico-nome">Nome</label>
                <input id="servico-nome" name="nome" type="text" placeholder="Instalação de ar-condicionado" />
            </div>
            <div class="form-row">
                <label for="servico-descricao">Descrição</label>
                <textarea id="servico-descricao" name="descricao" placeholder="Breve descrição do serviço"></textarea>
            </div>
            <div class="form-row">
                <label for="servico-preco">Preço base</label>
                <input id="servico-preco" name="preco_base" type="number" step="0.01" placeholder="150.00" />
            </div>
            <button type="submit">Salvar</button>
        </form>
    </section>

    <section class="crud-card crud-table">
        <h2>servicos</h2>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Observações</th></tr>
            <tr><td>id</td><td>bigint unsigned</td><td>PK</td></tr>
            <tr><td>prestador_id</td><td>foreignId</td><td>constrained('prestadores'), cascadeOnDelete, cascadeOnUpdate</td></tr>
            <tr><td>nome</td><td>string</td><td></td></tr>
            <tr><td>descricao</td><td>text</td><td>nullable</td></tr>
            <tr><td>preco_base</td><td>decimal(10,2)</td><td></td></tr>
            <tr><td>categoria</td><td>string</td><td>nullable</td></tr>
            <tr><td>created_at</td><td>timestamp</td><td></td></tr>
            <tr><td>updated_at</td><td>timestamp</td><td></td></tr>
        </table>
        <p class="note">Relacionamentos com <strong>prestadores</strong>, <strong>agendamentos</strong> e <strong>avaliacoes</strong>.</p>
    </section>
</main>
