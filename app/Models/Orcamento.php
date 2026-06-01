<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    protected $table = 'orcamentos';

    protected $fillable = [
        'solicitacao_id', 'usuario_id', 'servico_id', 'mao_de_obra',
        'valor_total', 'prazo', 'observacoes', 'status',
    ];

    public function solicitacao()
    {
        return $this->belongsTo(Solicitacao::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
    
    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }

    public function agendamento()
    {
        return $this->hasOne(Agendamento::class);
    }
}
