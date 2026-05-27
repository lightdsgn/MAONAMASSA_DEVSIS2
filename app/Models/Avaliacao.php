<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';

    protected $fillable = [
        'servico_id', 'usuario_id', 'nota', 'comentario',
    ];

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
