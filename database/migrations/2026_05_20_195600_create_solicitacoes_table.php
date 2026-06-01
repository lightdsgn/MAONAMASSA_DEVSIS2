<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete(); 
            $table->foreignId('prestador_id')->nullable()->constrained('usuarios')->nullOnDelete();
            
            $table->string('titulo');
            $table->text('descricao');
            $table->string('categoria');
            $table->string('foto')->nullable();
            $table->enum('status', ['aberta', 'em_andamento', 'concluida', 'cancelada'])->default('aberta');
            $table->date('disponibilidade')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitacoes');
    }
};
