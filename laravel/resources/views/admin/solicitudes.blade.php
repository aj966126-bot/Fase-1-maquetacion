<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - Solicitudes PymeGest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h2>Panel de Administración - Solicitudes Recibidas</h2>
                <a href="{{ url('/solicitudes') }}" class="btn btn-outline-primary">Ir al Formulario</a>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Empresa</th>
                                <th>Sector</th>
                                <th>Tamaño</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($solicitudes as $solicitud)
                                <tr>
                                    <td>{{ $solicitud->id }}</td>
                                    <td>{{ $solicitud->nombre }}</td>
                                    <td>{{ $solicitud->correo }}</td>
                                    <td>{{ $solicitud->telefono }}</td>
                                    <td>{{ $solicitud->empresa }}</td>
                                    <td>{{ $solicitud->sector }}</td>
                                    <td>{{ $solicitud->tamano }}</td>
                                    <td>{{ $solicitud->fecha_registro ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">No hay solicitudes registradas todavía.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>