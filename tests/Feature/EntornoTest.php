<?php

namespace Tests\Feature;

use PDO;
use Tests\TestCase;

class EntornoTest extends TestCase
{
    public function test_la_pagina_inicial_se_renderiza_sin_conectar_a_la_base_de_datos(): void
    {
        // Un puerto no disponible prueba que el arranque no depende de PostgreSQL.
        config(['database.connections.pgsql.port' => 1]);

        $this->get('/')
            ->assertOk()
            ->assertSee('PymeGest')
            ->assertSee('Laravel está ejecutándose correctamente.');
    }

    public function test_la_ruta_de_salud_responde_correctamente(): void
    {
        $this->get('/up')->assertOk();
    }

    public function test_postgresql_esta_configurado_y_su_controlador_disponible(): void
    {
        $this->assertSame('pgsql', config('database.default'));
        $this->assertContains('pgsql', PDO::getAvailableDrivers());
    }
}
