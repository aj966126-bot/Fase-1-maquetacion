<?php

namespace Tests\Feature;

use Tests\TestCase;

class SolicitudRoutesTest extends TestCase
{
    public function test_solicitud_form_is_public(): void
    {
        $this->get('/solicitudes')->assertOk();
    }

    public function test_solicitud_submission_is_public(): void
    {
        $this->from('/solicitudes')
            ->post('/solicitudes', [])
            ->assertRedirect('/solicitudes')
            ->assertSessionHasErrors(['nombre', 'correo', 'telefono', 'empresa', 'sector', 'tamano']);
    }

    public function test_admin_solicitudes_requires_authentication(): void
    {
        $this->get('/admin/solicitudes')->assertRedirect('/login');
    }
}
