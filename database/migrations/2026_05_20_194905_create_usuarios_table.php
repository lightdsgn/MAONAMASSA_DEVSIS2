<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefone')->nullable();
            $table->string('foto')->nullable();
            $table->enum('tipo', ['cliente', 'prestador', 'adm'])->default('cliente');

            // Dados extras do prestador
            $table->enum('tipo_pessoa', ['fisico', 'juridico'])->nullable();
            $table->string('cpf_cnpj')->nullable()->unique();
            $table->string('razao_social')->nullable();
            $table->string('nome_fantasia')->nullable();
            $table->string('especialidade')->nullable();
            $table->text('portfolio')->nullable();

            // Endereço
            $table->string('cep', 9)->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado', 2)->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
