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
        // Administrador padrão — altere a senha após o primeiro login!
        Usuario::firstOrCreate(
            ['email' => 'admin@maonamassa.com.br'],
            [
                'nome'     => 'Administrador',
                'password' => Hash::make('admin123'),
                'tipo'     => 'adm',
                'telefone' => null,
            ]
        );
    }
}
