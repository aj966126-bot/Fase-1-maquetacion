<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Ejecutar los datos de prueba de PymeGest.
     */
    public function run(): void
    {
        $this->call([
            PymeGestSeeder::class,
        ]);
    }
}
