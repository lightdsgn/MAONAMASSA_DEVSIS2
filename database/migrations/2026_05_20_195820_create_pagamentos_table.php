<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agendamento_id')->unique()->constrained('agendamentos')->cascadeOnDelete();
            $table->decimal('valor', 10, 2);
            $table->string('metodo');
            $table->enum('status', ['pendente', 'pago', 'cancelado', 'estornado'])->default('pendente');
            $table->date('data_pagamento')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
