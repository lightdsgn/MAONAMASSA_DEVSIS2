<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $table = 'pagamentos';

    protected $fillable = [
        'agendamento_id', 'valor', 'metodo', 'status', 'data_pagamento',
    ];

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }
}
