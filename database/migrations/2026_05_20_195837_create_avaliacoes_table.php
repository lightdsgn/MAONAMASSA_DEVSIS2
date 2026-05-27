<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Avaliação relacionada ao SERVIÇO (e não ao agendamento)
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servico_id')->constrained('servicos')->cascadeOnDelete();
            $table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete(); // quem avaliou
            $table->unsignedTinyInteger('nota'); // 1 a 5
            $table->text('comentario')->nullable();
            $table->timestamps();

            $table->unique(['servico_id', 'usuario_id']); // cada usuário avalia um serviço uma vez
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};
