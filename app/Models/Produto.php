<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = [
        'usuario_id', 'nome', 'descricao',
        'categoria', 'preco', 'quantidade', 'foto', 'status',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
