<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    protected $table = 'solicitacoes';

    protected $fillable = [
        'usuario_id', 'prestador_id', 'titulo', 'descricao',
        'categoria', 'foto', 'status', 'disponibilidade',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function orcamentos()
    {
        return $this->hasMany(Orcamento::class);
    }

    public function prestador()
    {
        return $this->belongsTo(Usuario::class, 'prestador_id');
    }
}
