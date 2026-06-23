<?php
function publish_h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}


function publish_slug(string $value): string
{
    $slug = strtolower(trim($value));
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug) ?: $slug;
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    return trim($slug, '-') ?: 'solicitud-' . date('YmdHis');
}

function save_publish_request(array $post): string
{
    $databaseConfig = __DIR__ . '/crm/config/database.php';
    if (!is_file($databaseConfig)) {
        return 'No pudimos conectar el formulario con el CRM. Escríbenos por WhatsApp para completar la solicitud.';
    }

    try {
        $config = require $databaseConfig;
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $config['host'], $config['database'], $config['charset']);
        $pdo = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        $name = trim($post['business_name'] ?? '');
        if ($name === '') {
            return 'Ingresa el nombre del negocio para enviar la solicitud.';
        }
        $baseSlug = publish_slug($name);
        $slug = $baseSlug . '-' . substr(bin2hex(random_bytes(3)), 0, 6);
        $summary = trim($post['description'] ?? 'Solicitud recibida desde formulario público.');
        $description = trim(($post['description'] ?? '') . "\n\nServicios: " . ($post['services'] ?? '') . "\nFotos: " . ($post['photos_ready'] ?? ''));
        $statement = $pdo->prepare("INSERT INTO crm_businesses (name, slug, summary, description, image, phone, whatsapp, address, map_url, tags, contact_name, contact_email, instagram, plan_interest, status, is_featured, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'nueva_solicitud', 0, 0)");
        $statement->execute([
            $name,
            $slug,
            mb_substr($summary, 0, 250),
            $description,
            'assets/img/3.png',
            trim($post['whatsapp'] ?? ''),
            preg_replace('/[^0-9]/', '', $post['whatsapp'] ?? ''),
            trim($post['address'] ?? ''),
            '',
            trim($post['tags'] ?? ''),
            trim($post['contact_name'] ?? ''),
            trim($post['contact_email'] ?? ''),
            trim($post['instagram'] ?? ''),
            trim($post['plan_interest'] ?? ''),
        ]);
        $businessId = (int) $pdo->lastInsertId();
        $selectedSlugs = array_filter((array) ($post['categories'] ?? []));
        if ($selectedSlugs) {
            $categoryQuery = $pdo->prepare('SELECT id FROM crm_categories WHERE slug = ? AND is_active = 1 LIMIT 1');
            $pivot = $pdo->prepare('INSERT IGNORE INTO crm_business_category (business_id, category_id) VALUES (?, ?)');
            foreach ($selectedSlugs as $categorySlug) {
                $categoryQuery->execute([$categorySlug]);
                $categoryId = (int) $categoryQuery->fetchColumn();
                if ($categoryId > 0) {
                    $pivot->execute([$businessId, $categoryId]);
                }
            }
        }

        return 'Solicitud recibida. Quedó registrada como Nueva solicitud; revisaremos disponibilidad (máximo 10 comercios por categoría) y te notificaremos si es aceptada.';
    } catch (Throwable $exception) {
        return 'No pudimos guardar la solicitud en el CRM. Revisa la conexión de base de datos o contáctanos por WhatsApp.';
    }
}

function publish_categories(): array
{
    $fallback = [
        ['slug' => 'alojamientos', 'menu_label' => 'Alojamientos'],
        ['slug' => 'restaurantes', 'menu_label' => 'Restaurantes'],
        ['slug' => 'emprendimientos', 'menu_label' => 'Emprendimientos'],
        ['slug' => 'experiencias', 'menu_label' => 'Experiencias'],
        ['slug' => 'que-visitar', 'menu_label' => 'Qué visitar'],
    ];
    $databaseConfig = __DIR__ . '/crm/config/database.php';
    if (!is_file($databaseConfig)) {
        return $fallback;
    }

    try {
        $config = require $databaseConfig;
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $config['host'], $config['database'], $config['charset']);
        $pdo = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        $categories = $pdo->query('SELECT slug, menu_label FROM crm_categories WHERE is_active = 1 ORDER BY sort_order, name')->fetchAll();
        return $categories ?: $fallback;
    } catch (Throwable $exception) {
        return $fallback;
    }
}

$publishMessage = $_SERVER['REQUEST_METHOD'] === 'POST' ? save_publish_request($_POST) : '';
$publishCategories = publish_categories();
?>
<!DOCTYPE html>
<html lang="es"><head>
<meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Publicar negocio en Saltos del Laja | Registra tu alojamiento, restaurante o emprendimiento</title>
<meta content="Registra tu alojamiento, restaurante, cafetería, camping, emprendimiento o experiencia turística en la guía Saltos del Laja Turístico." name="description"/>
<meta content="Saltos del Laja, Salto del Laja, turismo Biobío, cabañas Salto del Laja, restaurantes Salto del Laja, camping Salto del Laja, qué hacer en Saltos del Laja, Los Ángeles Chile, Cabrero, Yumbel, Región del Biobío" name="keywords"/>
<meta content="Publicar negocio en Saltos del Laja | Registra tu alojamiento, restaurante o emprendimiento" property="og:title"/><meta content="Registra tu alojamiento, restaurante, cafetería, camping, emprendimiento o experiencia turística en la guía Saltos del Laja Turístico." property="og:description"/><meta content="website" property="og:type"/><meta content="https://saltosdellajaturistico.cl/assets/img/logo-header-saltos-del-laja.png" property="og:image"/>
<meta content="#004AAD" name="theme-color"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/><link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="assets/css/styles.css" rel="stylesheet"/>
<script type="application/ld+json">{"@context":"https://schema.org","@type":"TouristDestination","name":"Saltos del Laja","description":"Guía turística de Saltos del Laja con alojamientos, restaurantes, emprendimientos, lugares para visitar, mapa y preguntas frecuentes.","address":{"@type":"PostalAddress","addressRegion":"Región del Biobío","addressCountry":"CL"},"touristType":["Familias","Parejas","Viajeros de ruta","Turismo naturaleza"]}</script>
<meta content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" name="robots"/><meta content="Saltos del Laja Turístico" name="author"/><meta content="Saltos del Laja Turístico" name="publisher"/><meta content="CL-BI" name="geo.region"/><meta content="Saltos del Laja, Región del Biobío, Chile" name="geo.placename"/><meta content="-37.216;-72.383" name="geo.position"/><meta content="-37.216, -72.383" name="ICBM"/><meta content="summary_large_image" name="twitter:card"/><meta content="Publicar negocio en Saltos del Laja | Registra tu alojamiento, restaurante o emprendimiento" name="twitter:title"/><meta content="https://saltosdellajaturistico.cl/assets/img/logo-header-saltos-del-laja.png" name="twitter:image"/><link href="assets/img/favicon-saltos-del-laja.png" rel="icon" type="image/png"/><meta content="es_CL" property="og:locale"/><link href="https://saltosdellajaturistico.cl/publicar-negocio.php" rel="canonical"/><meta content="telephone=yes" name="format-detection"/><meta content="Saltos del Laja" name="apple-mobile-web-app-title"/><meta content="Saltos del Laja Turístico" property="og:site_name"/><meta content="https://saltosdellajaturistico.cl/publicar-negocio.php" property="og:url"/><meta content="Registra tu alojamiento, restaurante, cafetería, camping, emprendimiento o experiencia turística en la guía Saltos del Laja Turístico." name="twitter:description"/><link as="image" href="assets/img/logo-header-saltos-del-laja.png" imagesrcset="assets/img/logo-header-saltos-del-laja.webp" rel="preload"/>
</head><body>
<?php $assetBase = ''; $activePage = 'publicar-negocio'; include __DIR__ . '/includes/header.php'; ?>
<section class="hero sub publish-hero" id="main" style="--hero:url('assets/img/2.png')"><div class="container hero-grid"><div><div class="breadcrumbs"><a href="index.php">Inicio</a> / Publicar negocio</div><div class="eyebrow">Directorio comercial turístico</div><h1 class="h1">Publica tu negocio en Saltos del Laja Turístico</h1><p class="lead">Una vitrina profesional para alojamientos, restaurantes, comercios, emprendimientos y experiencias, con tarjetas por categoría, tags y contacto directo por WhatsApp.</p><div class="actions"><a class="btn white" href="#solicitud">Enviar solicitud</a><a class="btn ghost" href="#planes">Ver opciones</a></div></div></div></section>
<section class="publish-section" id="planes"><div class="container"><div class="pro-head"><div><div class="eyebrow dark">Visibilidad eficiente</div><h2>Publicar te da presencia comercial con cupos limitados por categoría</h2></div><p>Para mantener calidad y eficiencia, solo aceptamos hasta 10 comercios por categoría. Revisaremos cada solicitud y notificaremos si fue aceptada, queda en revisión o es rechazada.</p></div><div class="publish-plan-grid"><article><span>Básico anual</span><h3>Ficha esencial</h3><p>Nombre, descripción, categoría, tags, WhatsApp, ubicación e imagen principal.</p></article><article class="featured"><span>Destacado anual</span><h3>Más visibilidad</h3><p>Prioridad visual en categoría, ficha completa, más fotos y etiqueta destacado.</p></article><article><span>Premium anual</span><h3>Contenido + SEO</h3><p>Ficha, artículo SEO, presencia en categoría, mapa y apoyo en difusión.</p></article><article><span>Auspicio</span><h3>Campaña mensual</h3><p>Banner o presencia especial para marcas, eventos y servicios turísticos.</p></article></div></div></section>
<section class="publish-section soft" id="solicitud"><div class="container publish-form-layout"><aside class="publish-form-aside"><div class="eyebrow dark">Solicitud de publicación</div><h2>Cuéntanos de tu negocio</h2><p>Completa el formulario y quedará como Nueva solicitud en el CRM. Luego te notificaremos el resultado de la revisión.</p><div class="publish-aside-list"><span>✓ Máximo 10 comercios por categoría</span><span>✓ Estado inicial: Nueva solicitud</span><span>✓ Notificación al ser aceptada o rechazada</span></div></aside><form class="publish-form-card" method="post"><?php if ($publishMessage): ?><div class="publish-form-alert"><?= publish_h($publishMessage) ?></div><?php endif; ?><div class="publish-form-section"><h3>Datos principales</h3><div class="form-grid"><div class="form-field"><label>Nombre del negocio</label><input name="business_name" placeholder="Ej: Cabañas Río Laja" required=""/></div><div class="form-field"><label>Nombre del encargado</label><input name="contact_name" placeholder="Nombre y apellido"/></div><div class="form-field"><label>WhatsApp</label><input name="whatsapp" placeholder="+56 9 1234 5678" required=""/></div><div class="form-field"><label>Correo</label><input name="contact_email" placeholder="contacto@negocio.cl" type="email"/></div></div></div><div class="publish-form-section"><h3>Categoría y tags</h3><label class="publish-label">Categorías disponibles</label><div class="publish-category-grid"><?php foreach ($publishCategories as $category): ?><label><input type="checkbox" name="categories[]" value="<?= publish_h($category['slug']) ?>"> <span><?= publish_h($category['menu_label']) ?></span></label><?php endforeach; ?></div><div class="form-field"><label>Tags sugeridos para tu tarjeta</label><input name="tags" placeholder="Ej: Pet friendly, Reservas, Vista, Familias, Cafetería"/></div></div><div class="publish-form-section"><h3>Publicación</h3><div class="form-grid"><div class="form-field"><label>Ubicación / sector</label><input name="address" placeholder="Km 480, Saltos del Laja, Cabrero..." required=""/></div><div class="form-field"><label>Instagram</label><input name="instagram" placeholder="@usuario"/></div><div class="form-field"><label>Plan de interés</label><select name="plan_interest"><option>Básico anual</option><option>Destacado anual</option><option>Premium anual</option><option>Banner / auspicio</option></select></div><div class="form-field"><label>¿Tienes fotos listas?</label><select name="photos_ready"><option>Sí, tengo fotos</option><option>Necesito ayuda con fotos</option><option>Quiero publicar y completar después</option></select></div><div class="form-field full"><label>Descripción del negocio</label><textarea name="description" placeholder="Describe servicios, capacidad, horarios, especialidades, valores referenciales o beneficios para turistas."></textarea></div><div class="form-field full"><label>Servicios principales</label><textarea name="services" placeholder="Ej: piscina, tinaja, estacionamiento, comida chilena, menú, pet friendly, reservas, delivery, souvenirs, tours."></textarea></div><div class="form-field full"><button class="btn primary" type="submit">Enviar solicitud para revisión</button></div></div></div></form></div></section>
<section aria-label="Prepara tu negocio para el verano 2026–2027" class="parallax-section parallax-refined" style="--parallax-img:url('assets/img/3.png')"><div class="parallax-inner"><div class="parallax-copy"><div class="eyebrow">Saltos del Laja</div><h2>Prepara tu negocio para el verano 2026–2027</h2><p>Publica tu alojamiento, restaurante, camping, cafetería, emprendimiento o experiencia con una ficha clara, visual y orientada a reservas.</p><div class="parallax-actions"><a class="btn white" href="planes.php">Ver planes</a><a class="btn ghost" href="contacto.php">Contactar</a></div></div><div class="parallax-stats refined"><div class="parallax-stat"><strong><?= count($publishCategories) ?></strong><span>categorías activas para postular</span></div><div class="parallax-stat"><strong>CRM</strong><span>gestión de tarjetas y tags</span></div></div></div></section>
<?php $assetBase = ''; include __DIR__ . '/includes/footer.php'; ?>
