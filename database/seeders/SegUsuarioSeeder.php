<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SegUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('seg_usuario')->insert([
            [
                'usuarioAlias' => 'admin',
                'usuarioPassword' => Hash::make('admin123'), // encripta la contraseña
                'usuarioNombre' => 'Administrador General',
                'usuarioEmail' => 'admin@example.com',
                'usuarioEstado' => 'Activo',
                'usuarioConectado' => 'N',
                'usuarioUltimaConexion' => Carbon::now(),
            ],
            [
                'usuarioAlias' => 'jdoe',
                'usuarioPassword' => Hash::make('secret123'),
                'usuarioNombre' => 'John Doe',
                'usuarioEmail' => 'jdoe@example.com',
                'usuarioEstado' => 'Activo',
                'usuarioConectado' => 'S',
                'usuarioUltimaConexion' => Carbon::now()->subDay(),
            ],
        ]);
    }
}
