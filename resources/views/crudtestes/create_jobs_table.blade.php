@include('crudtestes.header')

<main class="crud-page">
    <section class="crud-card">
        <h1>Migration: create_jobs_table</h1>
        <p class="note">Formulário de exemplo para a tabela <strong>jobs</strong>. O layout reflete os campos definidos na migration.</p>
        <form class="crud-form" action="#" method="get" onsubmit="return false;">
            <div class="form-row">
                <label for="job-queue">Queue</label>
                <input id="job-queue" name="queue" type="text" placeholder="default" />
            </div>
            <div class="form-row">
                <label for="job-payload">Payload</label>
                <textarea id="job-payload" name="payload" placeholder="Dados do job"></textarea>
            </div>
            <div class="form-row">
                <label for="job-attempts">Attempts</label>
                <input id="job-attempts" name="attempts" type="number" placeholder="0" />
            </div>
            <button type="submit">Salvar</button>
        </form>
    </section>

    <section class="crud-card crud-table">
        <h2>jobs</h2>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Observações</th></tr>
            <tr><td>id</td><td>bigint unsigned</td><td>PK</td></tr>
            <tr><td>queue</td><td>string</td><td>index</td></tr>
            <tr><td>payload</td><td>longText</td><td></td></tr>
            <tr><td>attempts</td><td>unsignedSmallInteger</td><td></td></tr>
            <tr><td>reserved_at</td><td>unsignedInteger</td><td>nullable</td></tr>
            <tr><td>available_at</td><td>unsignedInteger</td><td></td></tr>
            <tr><td>created_at</td><td>unsignedInteger</td><td></td></tr>
        </table>
        <p class="note">A migration também cria <strong>job_batches</strong> e <strong>failed_jobs</strong>.</p>
    </section>
</main>
