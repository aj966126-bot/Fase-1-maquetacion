# Fase 4 — Estructura Laravel y entorno

**Responsable:** Zaury Díaz.

**Rama:** `fase4-zaury-entorno`.

**Base:** `main`, commit `33ba734` (integración de Fase 3).

## Preparación realizada

1. Verificación de PHP 8.2.12 de XAMPP y sus extensiones.
2. Instalación de Composer 2.10.3 desde el instalador oficial, comprobando su SHA384.
3. Activación de ZIP en `php.ini`; PDO PostgreSQL ya estaba habilitado.
4. Obtención de la plantilla oficial con:

   ```bash
   composer create-project laravel/laravel pymegest-laravel12-base "12.*" --no-install --no-scripts --prefer-dist
   ```

   Este comando se utilizó en una carpeta temporal vacía. La plantilla fue
   adaptada a la raíz existente del repositorio. Para instalar la entrega, los
   colaboradores deben usar `composer install`, no volver a crear el proyecto.

5. Incorporación de la estructura del framework y configuración para PostgreSQL.
6. Instalación de dependencias: Laravel 12.70.0, con versiones reproducibles en
   `composer.lock`.
7. Creación local de `.env` y `APP_KEY`; ambos valores locales quedan fuera del commit.
8. Incorporación de una vista Blade de comprobación y de pruebas de arranque.
9. Preparación del enlace de Apache hacia `public/`. La ejecución de esta entrega
   se verificó con el servidor de desarrollo de Artisan.

## Decisiones de integración

- Conservada la conexión PHP anterior en `legacy/database.php`; actualizadas
  sus referencias sin cambiar la lógica del CRUD.
- Sesiones y caché en archivos; cola síncrona para arrancar antes de integrar
  la base de datos.
- Las tablas y seeders de negocio corresponden al aporte de Joel.
- Los controladores y vistas del CRUD corresponden al aporte de José.
- La vista técnica no requiere Node.js/Vite. El README explica los puntos de
  integración pendientes, incluida la autenticación sobre `usuarios`.

## Resultados verificados

| Comprobación | Resultado |
|---|---|
| `composer validate --strict` | Configuración válida |
| `composer check-platform-reqs` | Requisitos instalados compatibles |
| `composer audit` | Sin avisos de vulnerabilidades en la consulta realizada |
| `php artisan --version` | Laravel Framework 12.70.0 |
| `php artisan test` | 3 pruebas aprobadas, 6 aserciones |
| `http://127.0.0.1:8000/` | HTTP 200 y vista PymeGest renderizada |
| `http://127.0.0.1:8000/up` | HTTP 200 |

La conexión real a PostgreSQL y las migraciones de negocio quedan pendientes de
las credenciales e integración de los aportes correspondientes. No se modificó
ni se creó una base de datos durante esta preparación.

## Información para el informe

Se pueden adjuntar capturas de:

1. Versiones de PHP, Composer y Laravel.
2. `composer check-platform-reqs` y las pruebas aprobadas.
3. Vista local de PymeGest con la URL `http://127.0.0.1:8000/` visible.

Los requisitos, comandos de instalación y de ejecución están disponibles en el
[README principal](../README.md).
