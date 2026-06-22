<?php
/**
 * Configuración global del sitio.
 *
 * Edita este archivo para cambiar navegación, datos de contacto,
 * redes sociales, enlaces del footer y barra móvil en todo el proyecto.
 */
$siteConfig = $siteConfig ?? [
    'brand' => [
        'name' => 'Saltos del Laja Turístico',
        'logo' => 'assets/img/logo-header-saltos-del-laja.png',
        'logo_alt' => 'Saltos del Laja Turístico',
    ],
    'contact' => [
        'phone' => '+56 9 0000 0000',
        'phone_href' => 'tel:+56900000000',
        'email' => 'contacto@saltosdellajaturistico.cl',
        'email_href' => 'mailto:contacto@saltosdellajaturistico.cl',
        'place' => 'Saltos del Laja, Biobío',
        'whatsapp_url' => 'https://wa.me/56900000000?text=Hola%2C%20necesito%20informaci%C3%B3n%20sobre%20Saltos%20del%20Laja%20Tur%C3%ADstico',
    ],
    'social' => [
        'Instagram' => ['url' => 'https://www.instagram.com/', 'icon' => 'IG'],
        'Facebook' => ['url' => 'https://www.facebook.com/', 'icon' => 'f'],
        'YouTube' => ['url' => 'https://www.youtube.com/', 'icon' => '▶'],
        'TikTok' => ['url' => 'https://www.tiktok.com/', 'icon' => '♪'],
    ],
    'nav' => [
        'index' => ['label' => 'Inicio', 'href' => 'index.php'],
        'alojamientos' => ['label' => 'Alojamientos', 'href' => 'alojamientos.php'],
        'restaurantes' => ['label' => 'Restaurantes', 'href' => 'restaurantes.php'],
        'emprendimientos' => ['label' => 'Emprendimientos', 'href' => 'emprendimientos.php'],
        'experiencias' => ['label' => 'Experiencias', 'href' => 'experiencias.php'],
        'lugares-para-visitar' => ['label' => 'Qué visitar', 'href' => 'lugares-para-visitar.php'],
        'mapa-turistico' => ['label' => 'Mapa', 'href' => 'mapa-turistico.php'],
    ],
    'primary_cta' => ['label' => 'Publicar negocio', 'href' => 'publicar-negocio.php'],
    'mobile_nav' => [
        'index' => ['label' => 'Inicio', 'href' => 'index.php', 'icon' => '⌂'],
        'alojamientos' => ['label' => 'Alojar', 'href' => 'alojamientos.php', 'icon' => '▣'],
        'restaurantes' => ['label' => 'Comer', 'href' => 'restaurantes.php', 'icon' => '☕'],
        'publicar-negocio' => ['label' => 'Publicar', 'href' => 'publicar-negocio.php', 'icon' => '+'],
    ],
    'footer_columns' => [
        'Turismo' => [
            ['label' => 'Lugares para visitar', 'href' => 'lugares-para-visitar.php'],
            ['label' => 'Alojamientos', 'href' => 'alojamientos.php'],
            ['label' => 'Restaurantes', 'href' => 'restaurantes.php'],
            ['label' => 'Mapa turístico', 'href' => 'mapa-turistico.php'],
        ],
        'Negocios locales' => [
            ['label' => 'Registrar negocio', 'href' => 'publicar-negocio.php'],
            ['label' => 'Planes comerciales', 'href' => 'planes.php'],
            ['label' => 'Ejemplo de ficha', 'href' => 'ficha-negocio.php'],
            ['label' => 'Contacto', 'href' => 'contacto.php'],
        ],
        'Información' => [
            ['label' => 'Blog turístico', 'href' => 'blog.php'],
            ['label' => 'Qué hacer', 'href' => 'blog/que-hacer-en-saltos-del-laja.php'],
            ['label' => 'Dónde alojar', 'href' => 'blog/donde-alojar-en-saltos-del-laja.php'],
            ['label' => 'Fuentes', 'href' => 'fuentes.php'],
        ],
    ],
    'footer' => [
        'description' => 'Guía turística para promover alojamientos, restaurantes, emprendimientos, experiencias y lugares para visitar en Saltos del Laja, Región del Biobío.',
        'copyright' => '© 2026 Saltos del Laja Turístico.',
        'tagline' => 'SEO local, diseño móvil y conversión por WhatsApp.',
    ],
];
