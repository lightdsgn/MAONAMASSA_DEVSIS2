<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Cria apenas o usuário administrador padrão.
     * Os demais dados são reais (inseridos pelo sistema).
     */
    public function run(): void
    {
        // Administrador padrão
        Usuario::firstOrCreate(
            ['email' => 'admin@maonamassa.com.br'],
            [
                'nome'     => 'Administrador',
                'password' => Hash::make('admin!maonamassa'),
                'tipo'     => 'adm',
                'telefone' => null,
            ]
        );

        // Usuário cliente padrão
        Usuario::firstOrCreate(
            ['email' => 'cliente@maonamassa.com.br'],
            [
                'nome'     => 'Cliente Padrão',
                'password' => Hash::make('cliente!maonamassa'),
                'tipo'     => 'cliente',
                'telefone' => null,
            ]
        );

        // Usuário prestador padrão
        Usuario::firstOrCreate(
            ['email' => 'prestador@maonamassa.com.br'],
            [
                'nome'         => 'Prestador Padrão',
                'password'     => Hash::make('prestador!maonamassa'),
                'tipo'         => 'prestador',
                'telefone'     => null,
                'especialidade'=> 'Serviços Gerais',
            ]
        );
    }
}
