# 🔧 Mão na Massa — Plataforma de Serviços

Plataforma para conectar **clientes** a **prestadores de serviço**, desenvolvida em Laravel 11.

---

## 🚀 Instalação

### Pré-requisitos
- PHP >= 8.3
- Composer
- Node.js + npm
- MySQL 8+ (ou MariaDB)

### Passos

```bash
# 1. Clonar/extrair o projeto
cd MAONAMASSA

# 2. Instalar dependências PHP
composer install

# 3. Configurar ambiente
cp .env.example .env
php artisan key:generate

# 4. Configurar o banco de dados em .env
# DB_DATABASE=maonamassa
# DB_USERNAME=seu_usuario
# DB_PASSWORD=sua_senha

# 5. Executar migrations e seed (cria admin padrão)
php artisan migrate:fresh --seed

# 6. Criar link simbólico para storage (uploads de fotos)
php artisan storage:link

# 7. Instalar dependências JS e compilar assets
npm install
npm run build

# 8. Iniciar o servidor
php artisan serve
```

Acesse: **http://localhost:8000**

### Usuário administrador padrão
| Campo | Valor |
|-------|-------|
| E-mail | admin@maonamassa.com.br |
| Senha | admin123 |

> ⚠️ Altere a senha do admin após o primeiro acesso!

---

## 🗄️ Banco de Dados

### Tabela central: `usuarios`

| Campo | Descrição |
|-------|-----------|
| `tipo` | `cliente`, `prestador` ou `adm` |
| `especialidade` | Somente prestadores |
| `tipo_pessoa` | `fisico` ou `juridico` (prestadores) |
| `cpf_cnpj` | CPF ou CNPJ (prestadores) |
| Endereço | cep, logradouro, numero, complemento, bairro, cidade, estado |

### Relacionamentos principais

```
usuarios (1) ──< servicos (N)
usuarios (1) ──< solicitacoes (N)
usuarios (1) ──< orcamentos (N)
usuarios (1) ──< produtos (N)
usuarios (1) ──< agendamentos (N)  [como cliente]
usuarios (1) ──< avaliacoes (N)

servicos (1) ──< agendamentos (N)
servicos (1) ──< avaliacoes (N)     ← avaliação ligada ao serviço

solicitacoes (1) ──── orcamento (1)
agendamentos (1) ──── pagamento (1)
```

### Alterações realizadas em relação ao projeto original

| Antes | Depois |
|-------|--------|
| 4 tabelas: `usuarios`, `administradores`, `clientes`, `prestadores` | 1 tabela: `usuarios` com campo `tipo` |
| `avaliacoes` ↔ `agendamentos` (1:1) | `avaliacoes` ↔ `servicos` (N:1) |
| Sem migrations de `solicitacoes`, `orcamentos`, `produtos` | Todas as migrations criadas e organizadas |

---

## 🔐 Autenticação e Autorização

### Tipos de usuário
| Tipo | Pode fazer |
|------|-----------|
| `cliente` | Criar solicitações, agendar serviços, avaliar, ver produtos/serviços |
| `prestador` | Cadastrar serviços e produtos, enviar orçamentos, gerenciar agendamentos |
| `adm` | Tudo + gerenciar usuários |

### Middleware
- `auth` — exige login
- `tipo:adm` — exige tipo `adm`

---

## 📁 Estrutura de Arquivos

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php          ← Login, logout, registro
│   │   ├── UsuarioController.php       ← CRUD usuários (ADM) + perfil
│   │   ├── ServicoController.php
│   │   ├── SolicitacaoController.php
│   │   ├── OrcamentoController.php
│   │   ├── ProdutoController.php
│   │   ├── AgendamentoController.php   ← NOVO
│   │   └── AvaliacaoController.php     ← NOVO
│   └── Middleware/
│       └── CheckTipo.php               ← NOVO (tipo:adm, tipo:prestador etc.)
├── Models/
│   ├── Usuario.php     ← Model de autenticação principal
│   ├── Servico.php
│   ├── Solicitacao.php
│   ├── Orcamento.php
│   ├── Produto.php
│   ├── Agendamento.php ← NOVO
│   ├── Pagamento.php   ← NOVO
│   └── Avaliacao.php   ← NOVO
resources/views/
├── layouts/app.blade.php       ← Layout principal com sidebar por tipo
├── home.blade.php              ← Landing page pública
├── dashboard.blade.php         ← Painel por tipo de usuário
├── auth/{login,registro}.blade.php
├── servicos/{index,show,create,edit,_form}.blade.php
├── solicitacoes/{index,show,create,edit,_form}.blade.php
├── orcamentos/{index,show,create,edit,_form}.blade.php
├── produtos/{index,show,create,edit,_form}.blade.php
├── agendamentos/{index,show,create,edit}.blade.php
├── avaliacoes/{index,create}.blade.php
└── usuarios/{index,show,create,edit,perfil}.blade.php
```
