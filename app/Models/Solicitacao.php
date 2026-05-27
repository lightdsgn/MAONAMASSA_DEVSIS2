<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    protected $table = 'solicitacoes';

    protected $fillable = [
        'usuario_id', 'titulo', 'descricao',
        'categoria', 'foto', 'status', 'disponibilidade',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function orcamento()
    {
        return $this->hasOne(Orcamento::class);
    }
}
