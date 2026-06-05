<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nome', 'email', 'password', 'tipo', 'telefone', 'foto',
        'tipo_pessoa', 'cpf_cnpj', 'razao_social', 'nome_fantasia',
        'especialidade', 'portfolio',
        'cep', 'logradouro', 'numero', 'complemento',
        'bairro', 'cidade', 'estado',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    // ---------- helpers de tipo ----------
    public function isAdm(): bool      { return $this->tipo === 'adm'; }
    public function isPrestador(): bool { return $this->tipo === 'prestador'; }
    public function isCliente(): bool  { return $this->tipo === 'cliente'; }

    // ---------- relacionamentos ----------
    public function agendamentosComoPrestador()
    {
        return $this->hasManyThrough(
            \App\Models\Agendamento::class,
            \App\Models\Servico::class,
            'usuario_id',   // FK em servicos
            'servico_id',   // FK em agendamentos
        );
    }

    public function pagamentos()
    {
        return $this->hasManyThrough(
            \App\Models\Pagamento::class,
            \App\Models\Agendamento::class,
            'cliente_id',      // FK em agendamentos
            'agendamento_id',  // FK em pagamentos
        );
    }

    public function servicos()
    {
        return $this->hasMany(Servico::class);
    }

    public function solicitacoes()
    {
        return $this->hasMany(Solicitacao::class);
    }

    public function orcamentos()
    {
        return $this->hasMany(Orcamento::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function agendamentosComoCliente()
    {
        return $this->hasMany(Agendamento::class, 'cliente_id');
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }

    public function solicitacoesAceitas()
    {
        return $this->hasMany(Solicitacao::class, 'prestador_id');
    }
}
