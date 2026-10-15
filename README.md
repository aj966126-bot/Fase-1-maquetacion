# PymeGest — Fase 4: Laravel

Plataforma académica para la gestión de pequeñas y medianas empresas.
Esta rama incorpora la estructura inicial de Laravel y un entorno reproducible
para integrar los aportes del equipo.

## Requisitos previos

- Git.
- PHP **8.2 o superior**, compatible con las dependencias de `composer.lock`.
- Composer **2.x**. Instalador oficial: <https://getcomposer.org/download/>.
- Extensiones PHP: Ctype, cURL, DOM, Fileinfo, Filter, Hash, Mbstring, OpenSSL,
  PCRE, PDO, **pdo_pgsql**, Session, Tokenizer y XML. Las pruebas también requieren
  XMLWriter; ZIP permite extraer las descargas de Composer.
- PostgreSQL en ejecución, una base de datos y credenciales válidas cuando se
  integren las funcionalidades que usan datos.
- Permisos de escritura en `storage/` y `bootstrap/cache/`.

Entorno verificado: Windows, PHP **8.2.12** de XAMPP, Composer **2.10.3** y
Laravel **12.70.0**. El framework y sus versiones exactas están fijados en
`composer.lock`.

La pantalla inicial utiliza Blade y CSS integrado. Esta base no necesita Node.js,
npm ni compilar recursos para arrancar; el equipo podrá incorporar Vite al
integrar el frontend.

## Instalación del proyecto

Clonar el repositorio y seleccionar la rama de este aporte:

```bash
git clone https://github.com/aj966126-bot/Fase-1-maquetacion.git pymegest
cd pymegest
git switch fase4-zaury-entorno
```

La rama debe estar publicada para poder seleccionarla desde otra computadora.
Una vez integrado el aporte, se podrá utilizar la rama principal del equipo.

Desde la raíz del proyecto, con PHP y Composer disponibles en el PATH:

```bash
php --version
composer --version
composer install
composer run setup-local
composer check-platform-reqs
```

`composer install` utiliza el archivo de bloqueo y genera `vendor/`.
`setup-local` copia `.env.example` a `.env` si no existe y genera `APP_KEY`.
Ejecutar `setup-local` durante la primera instalación: volver a ejecutarlo cambia
la clave de cifrado. En actualizaciones posteriores basta con `composer install`.

### PowerShell con XAMPP y Composer portable

En el entorno de Zaury se instaló Composer en `C:\xampp\php\composer.phar`.
Si `php` y `composer` no se reconocen como comandos, usar desde la raíz:

```powershell
& "C:\xampp\php\php.exe" "C:\xampp\php\composer.phar" install
& "C:\xampp\php\php.exe" "C:\xampp\php\composer.phar" run setup-local
& "C:\xampp\php\php.exe" "C:\xampp\php\composer.phar" check-platform-reqs
```

Quienes instalen Composer con el instalador oficial de Windows deben seleccionar
`C:\xampp\php\php.exe` y abrir una terminal nueva al terminar.

## Configuración del entorno

El archivo `.env` es local y está excluido de Git. `.env.example` se comparte
sin contraseñas ni clave de aplicación. Configuración de PostgreSQL:

```dotenv
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=pymegest
DB_USERNAME=postgres
DB_PASSWORD=
```

Completar estos valores en `.env` con los del servidor local. En PHP de XAMPP,
habilitar las siguientes líneas en `C:\xampp\php\php.ini`:

```ini
extension=pdo_pgsql
extension=pgsql
extension=zip
```

`pdo_pgsql` es el controlador utilizado por Laravel. `pgsql` se conserva del
entorno de la Fase 3. Reiniciar Apache si se usa Apache; cada ejecución de PHP
en terminal lee la configuración actualizada.

La base usa `SESSION_DRIVER=file`, `CACHE_STORE=file` y `QUEUE_CONNECTION=sync`.
Esto permite verificar Laravel antes de disponer de las tablas del proyecto.
La página inicial y `/up` no comprueban una conexión real a PostgreSQL.

Después de integrar las migraciones de Joel y configurar una base de datos
destinada al proyecto, se podrá ejecutar:

```bash
php artisan config:clear
php artisan migrate
php artisan db:seed
```

Las migraciones y el seeder de negocio aún no forman parte de esta rama.
Coordinar su integración antes de ejecutar estos comandos; no importar a la vez
`database/pymegest.sql` sobre las mismas tablas que crearán las migraciones.

## Ejecutar en desarrollo

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

También se puede usar `composer run dev`.

En PowerShell con XAMPP:

```powershell
& "C:\xampp\php\php.exe" artisan serve --host=127.0.0.1 --port=8000
```

- Página inicial de comprobación: <http://127.0.0.1:8000/>.
- Estado del framework: <http://127.0.0.1:8000/up>.
- Mantener la terminal abierta. Detener con **Ctrl+C**.
- Si el puerto está ocupado, detener el servidor anterior o usar `--port=8001`
  y abrir esa dirección.

Este servidor utiliza PHP directamente; Apache no es necesario para este comando.

### Alternativa: Apache de XAMPP

La raíz web de Laravel es **`public/`**, donde está su `index.php`.
En el equipo de Zaury, `C:\xampp\htdocs\pymegest` es un enlace de directorio
a `pymegest-git\public`, actualizado desde la configuración de la Fase 3.
Con Apache activo, la URL correspondiente es `http://localhost/pymegest/`.

Para otro equipo se puede configurar un VirtualHost con `DocumentRoot` dirigido
a `public/`, `mod_rewrite` habilitado y `AllowOverride All` para ese directorio.
El enlace local y la instalación de XAMPP no se distribuyen mediante Git.

## Estructura del framework

| Ruta | Responsabilidad |
|---|---|
| `app/` | Controladores, modelos y proveedores de la aplicación |
| `bootstrap/` | Arranque y configuración de middleware/rutas |
| `config/` | Configuración de Laravel, incluyendo PostgreSQL |
| `database/` | Migraciones, factories y seeders; conserva el material de Fase 3 |
| `public/` | Único punto de entrada web y recursos públicos |
| `resources/views/` | Plantillas Blade |
| `routes/web.php` | Rutas web; actualmente muestra la comprobación del entorno |
| `storage/` | Sesiones, caché, vistas compiladas y registros locales |
| `tests/` | Pruebas de integración del arranque |
| `vendor/` | Dependencias instaladas por Composer, excluidas de Git |
| `artisan` | Comandos de Laravel |
| `.env.example` | Plantilla compartida del entorno |

## Integración con el equipo

- **Joel:** integrar sus migraciones y `DatabaseSeeder`. La base no incorpora las
  tablas de demostración `users`, `cache` o `jobs` de la plantilla Laravel.
- **José:** integrar sus modelos, controlador, validación y vistas. Registrar sus
  rutas en `routes/web.php` según `docs/fase4-jose-crud-clientes.md` de su rama.
- **Autenticación:** `App\Models\User` y su factory son la plantilla del framework;
  adaptar la autenticación a la tabla `usuarios` definida por el equipo.
- **Frontend:** incorporar los recursos que usan `asset()` en `public/` durante
  la integración. La vista `entorno.blade.php` es una comprobación técnica,
  pendiente de sustituir por el Home integrado.

### Compatibilidad con la Fase 3

El antiguo `config/database.php` se trasladó a `legacy/database.php`, y los siete
scripts PHP que lo importaban ahora utilizan esa ruta. Mantiene la lectura de
`config/.env`, con las claves antiguas `DB_NAME` y `DB_USER`.
Laravel utiliza el `.env` de la raíz y las claves `DB_DATABASE` y `DB_USERNAME`.

Los archivos PHP/HTML anteriores permanecen como referencia del trabajo del
equipo; no se exponen desde `public/` ni constituyen rutas Laravel. La validación
actual cubre el entorno Laravel, no una nueva prueba funcional del CRUD anterior.

## Comprobaciones

```bash
composer validate --strict
composer check-platform-reqs
composer audit
php artisan --version
php artisan route:list
php artisan test
```

Las pruebas verifican el renderizado inicial sin conexión a la base de datos,
la ruta `/up` y la configuración/disponibilidad de PDO PostgreSQL.

Detalles de la entrega: [Entorno Laravel — Fase 4](docs/fase4-entorno-laravel.md).
