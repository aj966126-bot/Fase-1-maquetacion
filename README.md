# PymeGest — Fase 4: Desarrollo con Laravel 12

**Asignatura:** Desarrollo de Aplicaciones Web (ISW-306)  
**Institución:** Universidad Abierta para Adultos (UAPA)  
**Proyecto:** PymeGest  
**Tecnologías:** PHP, Laravel 12, PostgreSQL, Blade, HTML y CSS  
**Fecha de entrega:** 16 de octubre de 2026

## 1. Descripción del proyecto

PymeGest es una aplicación web académica orientada a la gestión de información de pequeñas y medianas empresas.

En la Fase 4 se integraron las funcionalidades desarrolladas anteriormente en PHP dentro del framework Laravel 12, utilizando PostgreSQL como sistema gestor de base de datos.

La aplicación permite iniciar sesión, administrar clientes asociados a empresas y registrar solicitudes empresariales mediante un formulario público.

## 2. Funcionalidades implementadas

### Autenticación

- Inicio de sesión mediante correo electrónico y contraseña.
- Validación de credenciales contra PostgreSQL.
- Contraseñas almacenadas mediante hash bcrypt.
- Gestión de sesiones.
- Protección de rutas mediante middleware `auth`.
- Cierre de sesión desde una solicitud POST.

### Gestión de clientes

- Registrar nuevos clientes.
- Consultar clientes registrados.
- Editar información de clientes.
- Eliminar clientes.
- Asociar clientes a empresas.
- Validar los datos antes de almacenarlos.

### Gestión de solicitudes

- Formulario público de solicitudes empresariales.
- Validación de campos obligatorios.
- Validación del formato de correo electrónico.
- Validación de números telefónicos dominicanos.
- Registro de solicitudes en PostgreSQL.
- Panel administrativo protegido para consultar las solicitudes recibidas.

## 3. Requisitos del sistema

Para ejecutar PymeGest se necesita:

- PHP 8.2 o superior.
- Composer 2.x.
- PostgreSQL.
- Git.
- Extensiones PHP necesarias para Laravel, especialmente `pdo_pgsql`, `mbstring`, `openssl`, `fileinfo` y `zip`.
- Un navegador web actualizado.

El entorno de desarrollo utilizado incluye Windows, XAMPP y Laravel 12.

No es necesario instalar Laravel Breeze ni ejecutar npm para utilizar las pantallas integradas en esta entrega.

## 4. Instalación del proyecto

Clonar el repositorio:

```bash
git clone https://github.com/aj966126-bot/Fase-1-maquetacion.git
```

Acceder a la carpeta:

```bash
cd Fase-1-maquetacion
```

Para trabajar con la versión integrada de la Fase 4, seleccionar la rama correspondiente mientras no se haya fusionado con `main`:

```bash
git switch fase-4-despliegue
```

Instalar las dependencias:

```bash
composer install
```

Si Composer presenta problemas de descarga en el entorno Windows/XAMPP, verificar la configuración de PHP y las extensiones habilitadas.

## 5. Configuración del entorno

Crear el archivo `.env` a partir de `.env.example`.

En PowerShell:

```powershell
Copy-Item .env.example .env
```

Generar la clave de Laravel:

```bash
php artisan key:generate
```

Configurar la conexión PostgreSQL en `.env`:

```dotenv
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=pymegest
DB_USERNAME=postgres
DB_PASSWORD=
```

La contraseña debe completarse con la correspondiente a la instalación local de PostgreSQL.

Para evitar depender de tablas adicionales de sesiones o caché, utilizar:

```dotenv
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Limpiar la configuración:

```bash
php artisan config:clear
```

El archivo `.env` contiene configuraciones privadas y no debe subirse a GitHub.

## 6. Configuración de PostgreSQL

Crear una base de datos vacía llamada:

```text
pymegest
```

El proyecto incluye dos recursos para preparar la estructura de datos:

- `database/pymegest.sql`: creación de las cuatro tablas y carga de datos de demostración.
- `database/migrations/` y `database/seeders/`: migraciones y datos iniciales desarrollados por el equipo.

### Método recomendado para reproducir la demostración

Crear una base de datos PostgreSQL vacía e importar:

```text
database/pymegest.sql
```

Este script crea las tablas:

| Tabla | Descripción |
|---|---|
| `usuarios` | Credenciales e información de los usuarios |
| `empresas` | Empresas asociadas a usuarios |
| `clientes` | Clientes asociados a empresas |
| `solicitudes` | Solicitudes empresariales recibidas |

También incorpora usuarios, empresas, clientes y solicitudes de prueba.

**Importante:** no ejecutar el script SQL y las migraciones de creación de las mismas tablas sobre una misma base de datos. Se debe elegir un único procedimiento de inicialización.

El script SQL debe importarse en una base vacía, no en una instalación que ya contenga las tablas de PymeGest.

## 7. Credenciales de demostración

Cuando se utiliza el archivo `database/pymegest.sql` en una base de datos nueva:

**Correo electrónico:** `demo@pymegest.test`  
**Contraseña:** `Demo2026!`

La contraseña fue verificada contra el hash bcrypt incluido en el script.

Estas credenciales son exclusivamente para demostración académica y deben sustituirse en cualquier entorno real.

## 8. Ejecución de la aplicación

Desde la raíz del proyecto, ejecutar:

```bash
php artisan serve
```

Abrir en el navegador:

```text
http://127.0.0.1:8000
```

Mantener abierta la terminal donde se ejecuta Laravel.

### Rutas principales

| Ruta | Función | Acceso |
|---|---|---|
| `/login` | Inicio de sesión | Público |
| `/clientes` | Listado de clientes | Autenticado |
| `/clientes/create` | Registro de clientes | Autenticado |
| `/solicitudes` | Formulario de solicitudes | Público |
| `/admin/solicitudes` | Panel de solicitudes recibidas | Autenticado |
| `/up` | Comprobación de disponibilidad de Laravel | Público |

## 9. Estructura del proyecto

| Carpeta o archivo | Función |
|---|---|
| `app/Http/Controllers/` | Controladores de clientes y solicitudes |
| `app/Http/Controllers/Auth/` | Controlador de inicio y cierre de sesión |
| `app/Models/` | Modelos Eloquent |
| `app/Http/Requests/` | Validaciones especializadas |
| `config/auth.php` | Configuración de autenticación |
| `database/migrations/` | Definición de las tablas |
| `database/seeders/` | Datos iniciales |
| `database/pymegest.sql` | Script SQL de demostración |
| `resources/views/` | Pantallas Blade |
| `public/css/` | Hojas de estilos |
| `public/img/` | Recursos gráficos |
| `routes/web.php` | Rutas web |
| `.env.example` | Plantilla de configuración |

Los archivos PHP de las fases anteriores se conservan como referencia académica. La aplicación Laravel utiliza las rutas definidas en `routes/web.php`.

## 10. Validaciones realizadas

Durante la integración de la Fase 4 se comprobaron manualmente:

- Inicio de sesión con usuario existente.
- Conexión con PostgreSQL.
- Consulta de clientes.
- Registro de un cliente.
- Actualización de los datos de un cliente.
- Eliminación del cliente de prueba.
- Registro de una solicitud empresarial.
- Consulta de solicitudes desde el panel administrativo.
- Carga del CSS y logotipo de PymeGest.

Estas comprobaciones corresponden a pruebas funcionales manuales. No deben confundirse con la ejecución de una suite automatizada.

## 11. Trabajo colaborativo y control de versiones

El proyecto se desarrolló mediante Git y GitHub, utilizando ramas para distribuir responsabilidades entre los integrantes del equipo.

Los aportes integrados incluyen:

- Configuración del entorno Laravel.
- Migraciones y datos de demostración.
- Modelos Eloquent.
- CRUD de clientes.
- Funcionalidades de edición y eliminación.
- Autenticación y sesiones.
- Formulario y administración de solicitudes.
- Integración de las vistas y estilos.

La rama de integración es:

```text
fase-4-despliegue
```

Repositorio:

https://github.com/aj966126-bot/Fase-1-maquetacion

La integración final debe realizarse mediante un Pull Request hacia `main`. La etiqueta `v4.0` se creará después de completar la integración.

## 12. Consideraciones de seguridad

- Las contraseñas se almacenan mediante hash.
- Los formularios incluyen protección CSRF.
- Las entradas se validan antes de guardar datos.
- Las rutas administrativas requieren autenticación.
- Las sesiones se regeneran después del inicio de sesión.
- El archivo `.env` no se comparte en el repositorio.

PymeGest es un proyecto académico y no debe considerarse una plataforma lista para producción sin evaluaciones adicionales de seguridad, permisos y despliegue.

## 13. Conclusión

La Fase 4 permitió integrar en Laravel 12 las funcionalidades principales de PymeGest, conectarlas con PostgreSQL y comprobar su funcionamiento mediante pruebas manuales.

El proyecto demuestra la aplicación de rutas, controladores, modelos Eloquent, vistas Blade, validación de formularios, sesiones, autenticación y operaciones CRUD.

También evidencia el trabajo colaborativo mediante ramas de GitHub y la integración de los aportes desarrollados por el equipo.