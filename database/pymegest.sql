-- Tabla de usuarios
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(200) NOT NULL, -- campo para hash de contraseña
    telefono VARCHAR(20) NOT NULL,
    direccion VARCHAR(150) NOT NULL
);

-- Tabla de empresas
CREATE TABLE empresas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    usuario_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabla de clientes
CREATE TABLE clientes (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    empresa_id INT NOT NULL,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id)
);


-- Tabla de solicitudes
CREATE TABLE solicitudes (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    empresa VARCHAR(150) NOT NULL,
    sector VARCHAR(100) NOT NULL,
    tamano VARCHAR(50) NOT NULL,
    mensaje TEXT,
    fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);


-- =========================================
-- DATOS DE PRUEBA - PYMEGEST
-- =========================================

-- Usuario de demostracion
-- Contrasena de prueba: Demo2026!
-- Guardada como hash bcrypt, no en texto plano.
INSERT INTO usuarios
(nombre, correo, contrasena, telefono, direccion)
VALUES
(
    'Administrador PymeGest',
    'demo@pymegest.test',
    '$2y$12$9AcnhHveiyc3XOppTXkTdu9i7wk6mIcCldbyUC/D4uvTVk7ubsNh2',
    '8095550101',
    'Santiago, Republica Dominicana'
);


-- Empresa de prueba
INSERT INTO empresas (nombre, direccion, telefono, usuario_id)
SELECT
    'Comercial PymeGest Demo',
    'Santiago, Republica Dominicana',
    '8095550102',
    id
FROM usuarios
WHERE correo = 'demo@pymegest.test';

-- Clientes de prueba
INSERT INTO clientes (nombre, correo, telefono, empresa_id)
SELECT datos.nombre, datos.correo, datos.telefono, e.id
FROM (
    VALUES
        ('Ana Martinez', 'ana@example.com', '8095550103'),
        ('Carlos Rodriguez', 'carlos@example.com', '8095550104'),
        ('Maria Perez', 'maria@example.com', '8095550105')
) AS datos(nombre, correo, telefono)
CROSS JOIN empresas e
WHERE e.nombre = 'Comercial PymeGest Demo';

-- Solicitudes de prueba
INSERT INTO solicitudes
(nombre, correo, telefono, empresa, sector, tamano, mensaje)
VALUES
(
    'Ana Martinez',
    'ana@example.com',
    '8095550103',
    'Comercial PymeGest Demo',
    'comercio',
    'micro',
    'Necesito informacion sobre el sistema.'
),
(
    'Carlos Rodriguez',
    'carlos@example.com',
    '8095550104',
    'Servicios Empresariales Demo',
    'servicios',
    'pequena',
    'Me interesa conocer las funciones de PymeGest.'
);

