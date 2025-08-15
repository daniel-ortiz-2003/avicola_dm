# Guía del Sistema de Gestión Avícola

Este documento proporciona una visión general de la arquitectura, seguridad, rendimiento y despliegue de la aplicación.

---

## 1. Arquitectura General

La aplicación sigue la arquitectura estándar de Laravel (Modelo-Vista-Controlador - MVC).

-   **Modelos (`app/Models`):** Representan la estructura de la base de datos y manejan la lógica de negocio a través de Eloquent ORM.
-   **Vistas (`resources/views`):** Construidas con Blade, están fragmentadas en layouts y partials para su reutilización.
-   **Controladores (`app/Http/Controllers`):** Orquestan la lógica, recibiendo peticiones, interactuando con los modelos y devolviendo las vistas.
-   **Rutas (`routes/web.php`):** Definen los endpoints de la aplicación.
-   **Validación (`app/Http/Requests`):** La validación de formularios está centralizada en clases `FormRequest` para mantener los controladores limpios.

---

## 2. Seguridad

Se han implementado varias capas de seguridad siguiendo las mejores prácticas de Laravel.

### 2.1. Gestión de Entorno (`.env`)
-   **Nunca subas el archivo `.env` a un repositorio público.** Utiliza el archivo `.env.example` como plantilla.
-   En producción, asegúrate de que `APP_DEBUG` esté en `false` y `APP_ENV` en `production`.
-   Genera siempre una nueva `APP_KEY` para cada entorno con `php artisan key:generate`.

### 2.2. Protección CSRF (Cross-Site Request Forgery)
-   Laravel proporciona protección CSRF automáticamente. Asegúrate de que cada formulario que no sea GET incluya la directiva `@csrf` de Blade.

### 2.3. Prevención de XSS (Cross-Site Scripting)
-   Blade escapa automáticamente todas las variables que se imprimen con la sintaxis `{{ $variable }}`. Para imprimir HTML sin escapar (solo si es absolutamente necesario y la fuente es segura), usa `{!! $variable !!}`.

### 2.4. Prevención de Inyección SQL
-   Eloquent ORM y el Query Builder de Laravel usan "parameter binding" para proteger contra inyecciones SQL. Evita usar consultas SQL crudas (`DB::raw()`) con datos del usuario siempre que sea posible.

### 2.5. Roles y Permisos
-   **Middleware (`CheckRole`):** Se usa para proteger rutas enteras basándose en el rol del usuario (`admin` vs `operario`).
-   **Policies (`FlockPolicy`):** Se usan para una autorización más granular, permitiendo o denegando acciones sobre registros específicos de un modelo.

---

## 3. Rendimiento

Para asegurar que la aplicación sea rápida y escalable, considera los siguientes puntos:

### 3.1. Indexación de Base de Datos
-   Añade índices en las migraciones a las columnas que se usan frecuentemente en cláusulas `WHERE`, `JOIN`, u `ORDER BY`. Por ejemplo, `customer_id` en `sales_orders` o `type` y `status` en `flocks`.
    ```php
    // En una migración
    $table->index('customer_id');
    ```

### 3.2. Caching
-   **Cache de Configuración:** En producción, ejecuta `php artisan config:cache` y `php artisan route:cache` para acelerar la carga de la configuración y las rutas.
-   **Cache de Consultas:** Para consultas pesadas o que no cambian a menudo (ej. un reporte de fin de mes), usa el sistema de Cache de Laravel:
    ```php
    $reportData = Cache::remember('monthly_sales_report', now()->addHours(24), function () {
        return SalesOrder:://... consulta pesada ...->get();
    });
    ```

### 3.3. Optimización de Assets
-   En un proyecto real con Node.js, usa Laravel Mix o Vite para compilar y minificar los archivos CSS y JavaScript. Ejecuta `npm run build` en producción.

---

## 4. Despliegue (Deployment)

Checklist básico para desplegar en un servidor VPS (Ubuntu) o un servicio como Laravel Forge:

1.  **Configurar Servidor:** Instalar Nginx, PHP (con las extensiones requeridas por Laravel), MySQL/PostgreSQL y Composer.
2.  **Clonar Repositorio:** `git clone ...`
3.  **Instalar Dependencias:** `composer install --optimize-autoloader --no-dev`
4.  **Configurar `.env`:** Copiar `.env.example` a `.env` y rellenar todas las variables (Base de datos, `APP_KEY`, URLs, configuración de correo, etc.).
5.  **Generar Clave de Aplicación:** `php artisan key:generate`
6.  **Ejecutar Migraciones y Seeders:** `php artisan migrate --seed`
7.  **Crear Enlace Simbólico de Almacenamiento:** `php artisan storage:link`
8.  **Optimizar:** `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`.
9.  **Configurar Nginx:** Apuntar la raíz del sitio al directorio `/public` de tu proyecto y configurar las reglas de reescritura de Laravel.
10. **Configurar Permisos:** Asegurarse de que los directorios `storage` y `bootstrap/cache` tengan permisos de escritura para el servidor web.
11. **Configurar Supervisor:** Para procesos en segundo plano (como colas de trabajo para notificaciones), instalar y configurar Supervisor para que mantenga el proceso `php artisan queue:work` siempre activo.
