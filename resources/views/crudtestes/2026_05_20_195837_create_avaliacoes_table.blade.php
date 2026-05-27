@include('crudtestes.header')

<main class="crud-page">
    <section class="crud-card">
        <h1>Migration: create_avaliacoes_table</h1>
        <p class="note">Formulário de exemplo para avaliações de serviços, incluindo nota e comentário.</p>
        <form class="crud-form" action="#" method="get" onsubmit="return false;">
            <div class="form-row">
                <label for="avaliacao-servico-id">Serviço ID</label>
                <input id="avaliacao-servico-id" name="servico_id" type="number" placeholder="1" />
            </div>
            <div class="form-row">
                <label for="avaliacao-nota">Nota</label>
                <input id="avaliacao-nota" name="nota" type="number" min="1" max="5" placeholder="5" />
            </div>
            <div class="form-row">
                <label for="avaliacao-comentario">Comentário</label>
                <textarea id="avaliacao-comentario" name="comentario" placeholder="Opinião do cliente"></textarea>
            </div>
            <button type="submit">Salvar</button>
        </form>
    </section>

    <section class="crud-card crud-table">
        <h2>avaliacoes</h2>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Observações</th></tr>
            <tr><td>id</td><td>bigint unsigned</td><td>PK</td></tr>
            <tr><td>servico_id</td><td>foreignId</td><td>unique, constrained('servicos'), cascadeOnDelete, cascadeOnUpdate</td></tr>
            <tr><td>nota</td><td>unsignedTinyInteger</td><td></td></tr>
            <tr><td>comentario</td><td>text</td><td>nullable</td></tr>
            <tr><td>data</td><td>date</td><td></td></tr>
            <tr><td>created_at</td><td>timestamp</td><td></td></tr>
            <tr><td>updated_at</td><td>timestamp</td><td></td></tr>
        </table>
        <p class="note">Relacionamento: <strong>avaliacoes.servico_id</strong> → <strong>servicos.id</strong>.</p>
    </section>
</main>
