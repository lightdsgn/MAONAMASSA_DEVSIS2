@include('crudtestes.header')

<main class="crud-page">
    <section class="crud-card">
        <h1>Migration: create_cache_table</h1>
        <p class="note">Formulário de exemplo para a tabela <strong>cache</strong>. Abaixo há a visualização dos campos.</p>
        <form class="crud-form" action="#" method="get" onsubmit="return false;">
            <div class="form-row">
                <label for="cache-key">Key</label>
                <input id="cache-key" name="key" type="text" placeholder="cache_key" />
            </div>
            <div class="form-row">
                <label for="cache-value">Value</label>
                <textarea id="cache-value" name="value" placeholder="Conteúdo armazenado"></textarea>
            </div>
            <div class="form-row">
                <label for="cache-expiration">Expiration</label>
                <input id="cache-expiration" name="expiration" type="number" placeholder="Timestamp" />
            </div>
            <button type="submit">Salvar</button>
        </form>
    </section>

    <section class="crud-card crud-table">
        <h2>cache</h2>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Observações</th></tr>
            <tr><td>key</td><td>string</td><td>PK</td></tr>
            <tr><td>value</td><td>mediumText</td><td></td></tr>
            <tr><td>expiration</td><td>bigInteger</td><td>index</td></tr>
        </table>
        <p class="note">A migration também cria a tabela <strong>cache_locks</strong>, mas o formulário mostra o primeiro recurso.</p>
    </section>
</main>
