<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitacao_id')->constrained('solicitacoes')->cascadeOnDelete();
            $table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete();
            $table->decimal('mao_de_obra', 10, 2);
            $table->decimal('valor_total', 10, 2);
            $table->integer('prazo');
            $table->text('observacoes')->nullable();
            $table->enum('status', ['pendente', 'aceito', 'recusado'])->default('pendente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orcamentos');
    }
};
