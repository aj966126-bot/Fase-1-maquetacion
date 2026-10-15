<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PymeGestSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear usuario de demostración
        $usuarioId = DB::table('usuarios')->insertGetId([
            'nombre' => 'Administrador PymeGest',
            'correo' => 'demo@pymegest.test',
            'contrasena' => Hash::make('Demo2026!'),
            'telefono' => '8095550101',
            'direccion' => 'Santiago, República Dominicana',
        ]);

        // 2. Crear empresa vinculada al usuario
        $empresaId = DB::table('empresas')->insertGetId([
            'nombre' => 'Comercial PymeGest Demo',
            'direccion' => 'Santiago, República Dominicana',
            'telefono' => '8095550102',
            'usuario_id' => $usuarioId,
        ]);

        // 3. Crear clientes vinculados a la empresa
        DB::table('clientes')->insert([
            [
                'nombre' => 'Ana Martínez',
                'correo' => 'ana@example.com',
                'telefono' => '8095550103',
                'empresa_id' => $empresaId,
            ],
            [
                'nombre' => 'Carlos Rodríguez',
                'correo' => 'carlos@example.com',
                'telefono' => '8095550104',
                'empresa_id' => $empresaId,
            ],
            [
                'nombre' => 'María Pérez',
                'correo' => 'maria@example.com',
                'telefono' => '8095550105',
                'empresa_id' => $empresaId,
            ],
        ]);

        // 4. Crear solicitudes de demostración
        DB::table('solicitudes')->insert([
            [
                'nombre' => 'Ana Martínez',
                'correo' => 'ana@example.com',
                'telefono' => '(809) 555-0103',
                'empresa' => 'Comercial PymeGest Demo',
                'sector' => 'comercio',
                'tamano' => 'micro',
                'mensaje' => 'Necesito información sobre el sistema.',
                'fecha_registro' => now(),
            ],
            [
                'nombre' => 'Carlos Rodríguez',
                'correo' => 'carlos@example.com',
                'telefono' => '(829) 555-0104',
                'empresa' => 'Servicios Empresariales Demo',
                'sector' => 'servicios',
                'tamano' => 'pequena',
                'mensaje' => 'Me interesa conocer las funciones de PymeGest.',
                'fecha_registro' => now(),
            ],
        ]);
    }
}
