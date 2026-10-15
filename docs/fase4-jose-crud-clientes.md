# CRUD de clientes (crear y consultar)

Aporte de José Tavárez a la Fase 4. Rama: `fase4-jose-crud-create-read`.

Para integrarlo:

1. Agregar en `routes/web.php` (dentro del middleware `auth` cuando esté lista la autenticación):

```php
   Route::resource('clientes', App\Http\Controllers\ClienteController::class)
       ->only(['index', 'create', 'store']);
```

2. Copiar `css/style.css` e `img/logo-pymegest.jpeg` a `public/`, porque las vistas usan `asset()`.
3. Requiere las migraciones de Joel. Los modelos usan `$timestamps = false` porque las tablas no tienen `created_at` ni `updated_at`.
