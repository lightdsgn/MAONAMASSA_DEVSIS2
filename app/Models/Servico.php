<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $table = 'servicos';

    protected $fillable = [
        'usuario_id', 'titulo', 'descricao',
        'categoria', 'preco_estimado', 'foto', 'status',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }

    public function notaMedia(): float
    {
        return round($this->avaliacoes()->avg('nota') ?? 0, 1);
    }
}
