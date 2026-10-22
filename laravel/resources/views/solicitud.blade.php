<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Solicitudes - PymeGest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Nueva Solicitud</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ url('/solicitudes') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo electrónico:</label>
                                <input type="email" class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo" value="{{ old('correo') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono (RD):</label>
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" placeholder="Ej: 8091234567" value="{{ old('telefono') }}" required>
                                @error('telefono')
                                    <div class="text-danger small mt-1">
                                        El teléfono debe ser un número válido de República Dominicana (809, 829, 849) de 10 dígitos en total.
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="empresa" class="form-label">Empresa:</label>
                                <input type="text" class="form-control" id="empresa" name="empresa" value="{{ old('empresa') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="sector" class="form-label">Sector:</label>
                                <input type="text" class="form-control" id="sector" name="sector" value="{{ old('sector') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="tamano" class="form-label">Tamaño de la empresa:</label>
                                <input type="text" class="form-control" id="tamano" name="tamano" value="{{ old('tamano') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="mensaje" class="form-label">Mensaje (Opcional):</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="3">{{ old('mensaje') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Guardar Solicitud</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>