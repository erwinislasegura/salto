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
