# Saltos del Laja Turístico

Sitio PHP estático/dinámico para la guía turística de Saltos del Laja.

## Estructura principal

- `includes/config.php`: configuración global del sitio. Desde aquí se administran marca, navegación, datos de contacto, WhatsApp, redes sociales, barra móvil y columnas del footer.
- `includes/header.php`: renderiza el encabezado compartido usando la configuración global.
- `includes/footer.php`: renderiza footer, barra móvil, botón flotante de WhatsApp y carga de JavaScript usando la configuración global.
- `assets/css/styles.css`: estilos globales y tokens visuales (`:root`) para colores, sombras, radios y layout.
- `assets/js/main.js`: interacciones globales del sitio.
- `assets/img/`: imágenes, logos y favicon.
- `blog/`: artículos SEO.
- `admin/`: vistas administrativas.
- `data/`: datos JSON del directorio.

## Cambios globales rápidos

1. Para cambiar enlaces del menú principal, footer o barra móvil, edita `includes/config.php`.
2. Para actualizar teléfono, correo, WhatsApp o redes sociales, edita `includes/config.php`.
3. Para cambiar colores, anchos, radios o sombras de todo el sitio, edita las variables en `:root` dentro de `assets/css/styles.css`.
4. Para marcar una sección activa en una página, define `$activePage` antes de incluir `includes/header.php`.

Ejemplo:

```php
<?php $assetBase = ''; $activePage = 'alojamientos'; include __DIR__ . '/includes/header.php'; ?>
```

En páginas dentro de subdirectorios usa `$assetBase = '../';` para mantener rutas correctas.


## CRM PHP/MySQL MVC

- `crm/index.php`: front controller del CRM; enruta controladores y acciones por query string.
- `crm/app/Core/`: conexión PDO, autenticación por sesión y controlador base.
- `crm/app/Controllers/`: controladores MVC para login, dashboard y usuarios.
- `crm/app/Models/User.php`: modelo de usuarios con CRUD sobre MySQL.
- `crm/app/Views/`: vistas Bootstrap del CRM y tabla DataTables para usuarios.
- `crm/config/database.php`: credenciales MySQL configurables por variables de entorno `CRM_DB_HOST`, `CRM_DB_NAME`, `CRM_DB_USER`, `CRM_DB_PASS` y `CRM_DB_CHARSET`.
- `database/crm_schema.sql`: tabla `crm_users` y usuario administrador inicial.

Para instalar: importa `database/crm_schema.sql`, ajusta las credenciales de base de datos y entra desde el enlace **Acceso CRM** del footer. Cambia la contraseña inicial después del primer ingreso.
