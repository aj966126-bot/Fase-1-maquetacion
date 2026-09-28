# Configuracion del servidor local

## Objetivo

Preparar el entorno local de PymeGest para ejecutar PHP con Apache y dejar PHP listo para conectarse a PostgreSQL mediante PDO.

## Software utilizado

- XAMPP 8.2.12 para Windows.
- Apache incluido en XAMPP, ejecutado en los puertos 80 y 443.
- PHP 8.2.12.
- Extensiones `pdo_pgsql` y `pgsql` de PHP.

## Configuracion aplicada

1. XAMPP se instalo en `C:\xampp`.
2. Apache se inicio desde XAMPP Control Panel.
3. Se editaron las extensiones de `C:\xampp\php\php.ini`:

```ini
extension=pdo_pgsql
extension=pgsql
```

4. Apache se reinicio para aplicar la nueva configuracion de PHP.

## Acceso local al proyecto

Para evitar mantener una copia adicional del proyecto, se creo un enlace local:

```text
C:\xampp\htdocs\pymegest
```

Este enlace apunta a la carpeta colaborativa del proyecto. Las URLs de comprobacion son:

- `http://localhost/pymegest/index.html`
- `http://localhost/pymegest/pruebas/verificar_entorno.php`

## Comprobaciones realizadas

La pagina `pruebas/verificar_entorno.php` valida desde Apache que:

- PHP se ejecuta mediante `apache2handler`.
- La extension `pdo_pgsql` esta habilitada.
- La extension `pgsql` esta habilitada.
- `pgsql` aparece entre los controladores disponibles de PDO.

Resultado esperado:

```text
Entorno preparado para usar PostgreSQL mediante PDO.
```

La comprobacion no crea una base de datos ni realiza una conexion real. Confirma que el servidor PHP esta preparado para conectarse cuando se definan las credenciales y la base de datos PostgreSQL en la siguiente fase.

## Evidencias para el informe

1. XAMPP Control Panel con Apache en estado activo y los puertos 80, 443 visibles.
2. Navegador mostrando `verificar_entorno.php` con PDO PostgreSQL habilitado.
3. Navegador mostrando `index.html` mediante `http://localhost/pymegest/`.

## Solucion de problemas

- Si Apache no inicia, revisar si otro programa ya utiliza los puertos 80 o 443.
- Si `pdo_pgsql` no aparece, confirmar que ambas extensiones estan sin punto y coma en `C:\xampp\php\php.ini` y reiniciar Apache.
