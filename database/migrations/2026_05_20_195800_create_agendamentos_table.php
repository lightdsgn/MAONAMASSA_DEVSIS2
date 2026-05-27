<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('usuarios')->cascadeOnDelete();
            $table->foreignId('servico_id')->constrained('servicos')->cascadeOnDelete();
            $table->date('data');
            $table->time('horario');
            $table->enum('status', ['pendente', 'confirmado', 'concluido', 'cancelado'])->default('pendente');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
