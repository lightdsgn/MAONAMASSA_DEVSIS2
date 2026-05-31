# Contexto do projeto

Tenho um sistema Laravel com dois fluxos de negócio:

**Fluxo A — Prestador → Cliente:** prestador cadastra um serviço, cliente navega, escolhe e agenda diretamente. O sistema gera Solicitacao + Orcamento automaticamente (status aceito). **Este fluxo já está funcionando.**

**Fluxo B — Cliente → Prestador:** cliente cria uma Solicitacao de serviço → prestador encontra a solicitação e envia um Orcamento → cliente aceita o orçamento → cliente cria o Agendamento vinculado ao orçamento → prestador confirma → serviço é executado → cliente avalia. **Este fluxo precisa ser implementado/corrigido.**

---

# Estrutura do banco (migrations)

### solicitacoes
```php
$table->id();
$table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete();
$table->string('titulo');
$table->text('descricao');
$table->string('categoria');
$table->string('foto')->nullable();
$table->enum('status', ['aberta', 'em_andamento', 'concluida', 'cancelada'])->default('aberta');
$table->date('disponibilidade')->nullable();
$table->timestamps();
```

### orcamentos
```php
$table->id();
$table->foreignId('solicitacao_id')->constrained('solicitacoes')->cascadeOnDelete();
$table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete(); // prestador
$table->decimal('mao_de_obra', 10, 2);
$table->decimal('valor_total', 10, 2);
$table->integer('prazo');
$table->text('observacoes')->nullable();
$table->enum('status', ['pendente', 'aceito', 'recusado'])->default('pendente');
$table->timestamps();
```

### agendamentos
```php
$table->id();
$table->foreignId('cliente_id')->constrained('usuarios')->cascadeOnDelete();
$table->foreignId('servico_id')->constrained('servicos')->cascadeOnDelete();
$table->foreignId('orcamento_id')->nullable()->constrained('orcamentos')->nullOnDelete();
$table->date('data');
$table->time('horario');
$table->enum('status', ['pendente', 'confirmado', 'concluido', 'cancelado'])->default('pendente');
$table->text('observacoes')->nullable();
$table->timestamps();
```

---

# Models relevantes

### Usuario.php
```php
class Usuario extends Authenticatable {
    protected $table = 'usuarios';
    protected $fillable = ['nome','email','password','tipo','telefone','foto',
        'tipo_pessoa','cpf_cnpj','razao_social','nome_fantasia','especialidade','portfolio',
        'cep','logradouro','numero','complemento','bairro','cidade','estado'];

    public function isAdm(): bool       { return $this->tipo === 'adm'; }
    public function isPrestador(): bool { return $this->tipo === 'prestador'; }
    public function isCliente(): bool   { return $this->tipo === 'cliente'; }

    public function servicos()    { return $this->hasMany(Servico::class); }
    public function solicitacoes(){ return $this->hasMany(Solicitacao::class); }
    public function orcamentos()  { return $this->hasMany(Orcamento::class); }
    public function agendamentosComoCliente() { return $this->hasMany(Agendamento::class, 'cliente_id'); }
    public function avaliacoes()  { return $this->hasMany(Avaliacao::class); }
}
```

### Solicitacao.php
```php
class Solicitacao extends Model {
    protected $table = 'solicitacoes';
    protected $fillable = ['usuario_id','titulo','descricao','categoria','foto','status','disponibilidade'];
    public function usuario()  { return $this->belongsTo(Usuario::class); }
    public function orcamento(){ return $this->hasOne(Orcamento::class); }
}
```

### Orcamento.php
```php
class Orcamento extends Model {
    protected $table = 'orcamentos';
    protected $fillable = ['solicitacao_id','usuario_id','mao_de_obra','valor_total','prazo','observacoes','status'];
    public function solicitacao(){ return $this->belongsTo(Solicitacao::class); }
    public function usuario()    { return $this->belongsTo(Usuario::class); }
}
```

### Agendamento.php
```php
class Agendamento extends Model {
    protected $table = 'agendamentos';
    protected $fillable = ['cliente_id','servico_id','orcamento_id','data','horario','status','observacoes'];
    public function cliente()  { return $this->belongsTo(Usuario::class, 'cliente_id'); }
    public function servico()  { return $this->belongsTo(Servico::class); }
    public function pagamento(){ return $this->hasOne(Pagamento::class); }
    public function orcamento(){ return $this->belongsTo(Orcamento::class); }
}
```

---

# Rotas (routes/web.php) — já definidas, não alterar

```php
Route::resource('solicitacoes', SolicitacaoController::class);
Route::resource('orcamentos', OrcamentoController::class);
Route::post('/orcamentos/{orcamento}/aceitar', [OrcamentoController::class, 'aceitar'])->name('orcamentos.aceitar');
Route::post('/orcamentos/{orcamento}/recusar', [OrcamentoController::class, 'recusar'])->name('orcamentos.recusar');
Route::resource('agendamentos', AgendamentoController::class);
Route::post('/agendamentos/{agendamento}/aceitar',  [AgendamentoController::class, 'aceitar'])->name('agendamentos.aceitar');
Route::post('/agendamentos/{agendamento}/recusar',  [AgendamentoController::class, 'recusar'])->name('agendamentos.recusar');
Route::post('/agendamentos/{agendamento}/concluir', [AgendamentoController::class, 'concluir'])->name('agendamentos.concluir');
Route::resource('avaliacoes', AvaliacaoController::class)->except(['edit','update']);
```

---

# Controllers atuais

### SolicitacaoController.php (já corrigido — não alterar)
```php
public function index(Request $request)
{
    $busca = $request->busca;
    $user  = Auth::user();
    $query = Solicitacao::with('usuario');

    // Prestador só vê solicitações abertas e ainda sem orçamento
    if ($user->isPrestador()) {
        $query->where('status', 'aberta')->whereDoesntHave('orcamento');
    }
    // Cliente só vê as próprias solicitações
    if ($user->isCliente()) {
        $query->where('usuario_id', $user->id);
    }

    $query->when($busca, fn($q) => $q->where('titulo','like',"%$busca%")
          ->orWhere('categoria','like',"%$busca%")
          ->orWhere('status','like',"%$busca%"));

    $solicitacoes = $query->latest()->paginate(10);
    return view('solicitacoes.index', compact('solicitacoes', 'busca'));
}
// create(), store(), show(), edit(), update(), destroy() — todos corretos, sem necessidade de alteração
```

### OrcamentoController.php (atual)
```php
// index() — exibe todos, sem filtro por tipo de usuário (precisa de ajuste)
// create() — só prestador, lista solicitações sem orçamento (correto)
// store() — cria orçamento com usuario_id = Auth::id(), status pendente (correto)
// aceitar() — cliente aceita: muda orcamento para aceito + solicitacao para em_andamento (correto)
// recusar() — cliente recusa: muda orcamento para recusado + solicitacao para cancelada (correto)
```

### AgendamentoController.php (atual — Fluxo B precisa estar integrado aqui)
```php
// store() — se vier com orcamento_id: valida que está aceito e que o serviço pertence ao prestador do orçamento (correto)
// se vier sem orcamento_id: cria Solicitacao + Orcamento automáticos (Fluxo A — correto)
// aceitar(), recusar(), concluir() — corretos
```

---

# Views atuais

### resources/views/solicitacoes/show.blade.php (já corrigida — não alterar)
Exibe detalhes da solicitação. Quando há orçamento aceito, o botão "Agendar Serviço" já passa `orcamento_id` e `servico_id` corretamente:
```blade
<a href="{{ route('agendamentos.create', ['orcamento_id' => $orc->id, 'servico_id' => $servDefault?->id]) }}">
    Agendar Serviço
</a>
```

### resources/views/agendamentos/index.blade.php (já corrigida — não alterar)
Após status `concluido`, exibe botão ⭐ Avaliar somente se o cliente ainda não avaliou.

---

# O que precisa ser implementado para o Fluxo B funcionar completamente

O Fluxo B é: **Cliente cria Solicitacao → Prestador envia Orcamento → Cliente aceita → Cliente cria Agendamento com orcamento_id → Prestador confirma → Cliente conclui → Cliente avalia.**

Implemente/ajuste os seguintes arquivos, entregando o código completo de cada um pronto para substituir diretamente no projeto:

## 1. `app/Http/Controllers/OrcamentoController.php`
- `index()`: filtrar por tipo — prestador vê só os próprios orçamentos (`usuario_id = Auth::id()`), cliente vê só orçamentos das suas solicitações, adm vê tudo.
- Demais métodos permanecem como estão.

## 2. `resources/views/orcamentos/index.blade.php`
- Para o **cliente**: listar seus orçamentos recebidos com status destacado (pendente/aceito/recusado) e link para aceitar/recusar diretamente da listagem.
- Para o **prestador**: listar os orçamentos que ele enviou com status e link para ver detalhes.
- Botão "Novo Orçamento" só aparece para prestador/adm.

## 3. `resources/views/orcamentos/create.blade.php` e `resources/views/orcamentos/_form.blade.php`
- Formulário para o prestador criar um orçamento vinculado a uma solicitação.
- Se a query string `?solicitacao_id=X` vier preenchida, pré-selecionar a solicitação e deixá-la readonly.
- Campos: solicitacao_id (select ou hidden), mao_de_obra, valor_total, prazo (dias), observacoes.

## 4. `resources/views/solicitacoes/index.blade.php`
- Para o **prestador**: exibir card ou linha com botão "Enviar Orçamento" que leva para `orcamentos.create?solicitacao_id=X`.
- Para o **cliente**: exibir suas solicitações com status e link para ver detalhes (já tem, apenas garantir que o botão "Nova Solicitação" aparece).

## 5. `resources/views/agendamentos/create.blade.php` e `resources/views/agendamentos/_form.blade.php`
- Quando vier com `?orcamento_id=X`, exibir o resumo do orçamento (valor, prestador) e o select de serviços deve estar pré-filtrado/fixado no prestador do orçamento.
- Campos: servico_id (pre-selecionado), orcamento_id (hidden), data, horario, observacoes.

---

# Regras de negócio importantes

- Usuário `tipo: cliente` cria Solicitacoes e aceita/recusa Orcamentos.
- Usuário `tipo: prestador` envia Orcamentos para Solicitacoes abertas.
- Um Solicitacao só pode ter **um** Orcamento (unique em solicitacao_id na tabela orcamentos).
- Só é possível criar Agendamento com `orcamento_id` se o Orcamento estiver com `status = aceito`.
- O serviço selecionado no Agendamento deve pertencer ao mesmo prestador do Orcamento.
- Layouts usam Bootstrap 5 com `@extends('layouts.app')` e `@section('content')`.
- Ícones: Bootstrap Icons (`bi bi-*`).

---

# Entrega esperada

Entregue o código completo e pronto para uso de **cada arquivo listado acima** (1 a 5), sem omitir partes com comentários como "// restante igual". O código deve ser compatível com Laravel 11, Blade, Bootstrap 5 e com o restante do sistema descrito.