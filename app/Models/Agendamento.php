<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $table = 'agendamentos';

    protected $fillable = [
        'cliente_id', 'servico_id', 'data', 'horario', 'status', 'observacoes',
    ];

    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'cliente_id');
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }

    public function pagamento()
    {
        return $this->hasOne(Pagamento::class);
    }
}
