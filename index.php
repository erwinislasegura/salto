<?php
function home_h(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function home_business_whatsapp_url(array $business): string
{
    $whatsapp = preg_replace('/\D+/', '', $business['whatsapp'] ?? '');
    if ($whatsapp === '') {
        return 'contacto.php';
    }

    $message = rawurlencode('Hola, necesito información sobre ' . ($business['name'] ?? 'este comercio') . ' en Saltos del Laja.');
    return 'https://wa.me/' . $whatsapp . '?text=' . $message;
}

function home_registered_business_categories(): array
{
    $config = require __DIR__ . '/crm/config/database.php';
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $config['host'], $config['database'], $config['charset']);
    $connection = new PDO($dsn, $config['username'], $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    $groups = [];
    $categories = $connection->query('SELECT * FROM crm_categories WHERE is_active = 1 ORDER BY sort_order, name')->fetchAll();
    $businessStatement = $connection->prepare("SELECT b.* FROM crm_businesses b INNER JOIN crm_business_category bc ON bc.business_id = b.id WHERE bc.category_id = ? AND b.is_active = 1 AND b.status = 'aceptado' ORDER BY b.is_featured DESC, b.name");

    foreach ($categories as $category) {
        $businessStatement->execute([(int) $category['id']]);
        $businesses = $businessStatement->fetchAll();
        if ($businesses) {
            $groups[] = [
                'category' => $category,
                'businesses' => $businesses,
            ];
        }
    }

    return $groups;
}

try {
    $homeBusinessCategories = home_registered_business_categories();
} catch (Throwable $exception) {
    $homeBusinessCategories = [];
}
?>
<!DOCTYPE html>

<html lang="es"><head>
<meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Saltos del Laja Turístico | Comer, alojar, visitar y experiencias</title>
<meta content="Guía turística de Saltos del Laja con categorías para comer, alojar, artesanías y experiencias; fichas con contacto directo, mapa y registro de negocios para verano 2026-2027." name="description"/>
<meta content="Saltos del Laja, Salto del Laja, turismo Biobío, cabañas Salto del Laja, restaurantes Salto del Laja, camping Salto del Laja, qué hacer en Saltos del Laja, Los Ángeles Chile, Cabrero, Yumbel, Región del Biobío" name="keywords"/>
<meta content="Saltos del Laja Turístico | Comer, alojar, visitar y experiencias" property="og:title"/><meta content="Guía turística de Saltos del Laja con categorías para comer, alojar, artesanías y experiencias; fichas con contacto directo, mapa y registro de negocios para verano 2026-2027." property="og:description"/><meta content="website" property="og:type"/><meta content="https://saltosdellajaturistico.cl/assets/img/logo-header-saltos-del-laja.png" property="og:image"/>
<meta content="#004AAD" name="theme-color"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/><link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="assets/css/styles.css" rel="stylesheet"/>
<script type="application/ld+json">{"@context":"https://schema.org","@type":"TouristDestination","name":"Saltos del Laja","description":"Guía turística de Saltos del Laja con alojamientos, restaurantes, emprendimientos, lugares para visitar, mapa y preguntas frecuentes.","address":{"@type":"PostalAddress","addressRegion":"Región del Biobío","addressCountry":"CL"},"touristType":["Familias","Parejas","Viajeros de ruta","Turismo naturaleza"]}</script>
<meta content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" name="robots"/><meta content="Saltos del Laja Turístico" name="author"/><meta content="Saltos del Laja Turístico" name="publisher"/><meta content="CL-BI" name="geo.region"/><meta content="Saltos del Laja, Región del Biobío, Chile" name="geo.placename"/><meta content="-37.216;-72.383" name="geo.position"/><meta content="-37.216, -72.383" name="ICBM"/><meta content="summary_large_image" name="twitter:card"/><meta content="Saltos del Laja Turístico | Comer, alojar, visitar y experiencias" name="twitter:title"/><meta content="https://saltosdellajaturistico.cl/assets/img/logo-header-saltos-del-laja.png" name="twitter:image"/><link href="assets/img/favicon-saltos-del-laja.png" rel="icon" type="image/png"/><meta content="es_CL" property="og:locale"/><link href="https://saltosdellajaturistico.cl/" rel="canonical"/><meta content="telephone=yes" name="format-detection"/><meta content="Saltos del Laja" name="apple-mobile-web-app-title"/><meta content="Saltos del Laja Turístico" property="og:site_name"/><meta content="https://saltosdellajaturistico.cl/" property="og:url"/><meta content="Guía turística de Saltos del Laja con categorías para comer, alojar, artesanías y experiencias; fichas con contacto directo, mapa y registro de negocios para verano 2026-2027." name="twitter:description"/><link as="image" href="assets/img/logo-header-saltos-del-laja.png" imagesrcset="assets/img/logo-header-saltos-del-laja.webp" rel="preload"/><script id="seo-extra-schema" type="application/ld+json">{"@context": "https://schema.org", "@graph": [{"@type": "WebSite", "@id": "https://saltosdellajaturistico.cl/#website", "name": "Saltos del Laja Turístico", "url": "https://saltosdellajaturistico.cl/", "inLanguage": "es-CL", "potentialAction": {"@type": "SearchAction", "target": "https://saltosdellajaturistico.cl/?s={search_term_string}", "query-input": "required name=search_term_string"}}, {"@type": "Organization", "@id": "https://saltosdellajaturistico.cl/#organization", "name": "Saltos del Laja Turístico", "url": "https://saltosdellajaturistico.cl/", "logo": {"@type": "ImageObject", "url": "https://saltosdellajaturistico.cl/assets/img/logo-header-saltos-del-laja.png"}, "contactPoint": {"@type": "ContactPoint", "telephone": "+56-9-0000-0000", "contactType": "customer service", "areaServed": "CL", "availableLanguage": "Spanish"}}, {"@type": "TouristDestination", "@id": "https://saltosdellajaturistico.cl/#destination", "name": "Saltos del Laja", "alternateName": ["Salto del Laja", "Saltos del Laja Biobío"], "description": "Destino turístico de naturaleza en la Región del Biobío formado por cascadas del río Laja, con miradores, alojamientos, restaurantes, campings, actividades y emprendimientos locales.", "url": "https://saltosdellajaturistico.cl/", "geo": {"@type": "GeoCoordinates", "latitude": -37.216, "longitude": -72.383}, "containedInPlace": {"@type": "AdministrativeArea", "name": "Región del Biobío, Chile"}, "touristType": ["Familias", "Parejas", "Viajeros de ruta", "Turismo naturaleza", "Turismo local"]}, {"@type": "WebPage", "@id": "https://saltosdellajaturistico.cl/#webpage", "url": "https://saltosdellajaturistico.cl/", "name": "Saltos del Laja Turístico | Verano 2026-2027, alojamientos, restaurantes y guía turística", "description": "Descubre Saltos del Laja y registra tu negocio para la temporada verano 2026-2027. Guía turística con alojamientos, restaurantes, emprendimientos, lugares para visitar, mapa y contacto directo.", "inLanguage": "es-CL", "isPartOf": {"@id": "https://saltosdellajaturistico.cl/#website"}, "about": {"@id": "https://saltosdellajaturistico.cl/#destination"}}, {"@type": "FAQPage", "@id": "https://saltosdellajaturistico.cl/#faq", "mainEntity": [{"@type": "Question", "name": "¿Cuántas cascadas tienen los Saltos del Laja?", "acceptedAnswer": {"@type": "Answer", "text": "El destino se compone de cuatro caídas de agua del río Laja; la principal alcanza aproximadamente 35 metros de altura."}}, {"@type": "Question", "name": "¿Dónde queda Saltos del Laja?", "acceptedAnswer": {"@type": "Answer", "text": "Está en la Región del Biobío, cerca de la Ruta 5 Sur, aproximadamente en el kilómetro 480, al norte de Los Ángeles."}}, {"@type": "Question", "name": "¿Qué servicios turísticos hay en el sector?", "acceptedAnswer": {"@type": "Answer", "text": "Hay alojamientos, cabañas, hoteles, campings, restaurantes, cafeterías, miradores, actividades de temporada y emprendimientos locales."}}]}]}</script></head><body>
<?php $assetBase = ''; $activePage = 'index'; include __DIR__ . '/includes/header.php'; ?>
<section aria-label="Portada turística Saltos del Laja" class="hero-slider hero-home agency-hero" id="inicio">
<div class="hero-slide active" style="--slide:url('../img/2.png')">
<div class="container hero-slide-grid agency-hero-grid">
<div class="hero-copy agency-copy">
<div class="eyebrow">Temporada verano 2026–2027</div>
<h1 class="h1">La guía turística para preparar tu negocio antes del verano</h1>
<p class="lead">Alojamientos, restaurantes, cafeterías, campings y emprendimientos pueden postular su ficha comercial para aparecer en una vitrina turística clara, visual y fácil de contactar.</p>
<div class="actions"><a class="btn white" href="publicar-negocio.php">Registrar negocio</a><a class="btn ghost" href="planes.php">Ver planes comerciales</a></div>
</div>
<aside class="agency-panel">
<span class="panel-label">Apertura comercial</span>
<h3>Publicaciones para negocios locales</h3>
<p>Ficha profesional con fotos, servicios, mapa, WhatsApp y presencia en categorías turísticas.</p>
<div class="panel-checks"><span>✓ Alojamientos</span><span>✓ Restaurantes</span><span>✓ Emprendimientos</span></div>
</aside>
</div>
</div>
<div class="hero-slide" style="--slide:url('../img/3.png')">
<div class="container hero-slide-grid agency-hero-grid">
<div class="hero-copy agency-copy">
<div class="eyebrow">Naturaleza del Biobío</div>
<h1 class="h1">Una experiencia natural para recorrer con calma</h1>
<p class="lead">El río Laja, sus caídas de agua y miradores ofrecen una visita ideal para familias, parejas, viajeros de ruta y amantes de la fotografía.</p>
<div class="actions"><a class="btn white" href="lugares-para-visitar.php">Qué visitar</a><a class="btn ghost" href="mapa-turistico.php">Ver mapa turístico</a></div>
</div>
<aside class="agency-panel transparent-panel">
<span class="panel-label">Planifica tu visita</span>
<h3>Cascadas, río y miradores</h3>
<p>Una parada icónica del sur de Chile con servicios turísticos, gastronomía local y rutas simples para visitantes.</p>
</aside>
</div>
</div>
<div class="hero-slide" style="--slide:url('../img/4.png')">
<div class="container hero-slide-grid agency-hero-grid">
<div class="hero-copy agency-copy">
<div class="eyebrow">Alojar · comer · visitar</div>
<h1 class="h1">Todo lo necesario para vivir Saltos del Laja</h1>
<p class="lead">Encuentra opciones para dormir, comer, recorrer y descubrir productos locales en una guía pensada para usarse rápido desde el celular.</p>
<div class="actions"><a class="btn white" href="alojamientos.php">Ver alojamientos</a><a class="btn ghost" href="restaurantes.php">Dónde comer</a></div>
</div>
<aside class="agency-panel transparent-panel">
<span class="panel-label">Guía turística local</span>
<h3>Información útil y contacto directo</h3>
<p>Categorías ordenadas, fichas visuales y botones de WhatsApp para consultar sin fricción.</p>
</aside>
</div>
</div>
<div aria-label="Control del slider" class="hero-controls"><button aria-label="Slide 1" class="hero-dot active" data-slide="0" type="button"></button><button aria-label="Slide 2" class="hero-dot" data-slide="1" type="button"></button><button aria-label="Slide 3" class="hero-dot" data-slide="2" type="button"></button></div>
</section>
<div class="search-strip refined-search agency-search">
<div class="container">
<div class="search agency-search-box">
<div class="fieldbox"><label>Explorar</label><strong>Saltos del Laja</strong></div>
<div class="fieldbox"><label>Categoría</label><select id="quickFilter"><option value="all">Todas las opciones</option><option value="alojamiento">Alojamientos</option><option value="restaurante">Dónde comer</option><option value="visitar">Qué visitar</option><option value="emprendimiento">Emprendimientos</option></select></div>
<div class="fieldbox"><label>Ideal para</label><select><option>Familias y parejas</option><option>Viajeros de ruta</option><option>Fin de semana</option><option>Verano 2026–2027</option></select></div>
<a class="btn primary" href="#destacados">Buscar destacados</a>
</div>
</div>
</div>
<section class="section agency-intro">
<div class="container intro-grid">
<div class="intro-copy">
<div class="eyebrow dark">Guía turística local</div>
<h2>Un inicio pensado para convertir visitantes en consultas reales</h2>
<p>La home se organiza por intención: alojar, comer y visitar. Cada bloque lleva al usuario a tomar una acción concreta, revisar una categoría o contactar un negocio.</p>
</div>
<div class="useful-grid agency-useful">
<div class="info-card"><div class="info-icon">≈</div><strong>4 caídas de agua</strong><span>Conjunto natural formado por caídas del río Laja.</span></div>
<div class="info-card green"><div class="info-icon">↧</div><strong>35 m aprox.</strong><span>Altura referencial de la cascada principal.</span></div>
<div class="info-card"><div class="info-icon">⌖</div><strong>Ruta 5 Sur</strong><span>Acceso estratégico para viajeros del Biobío y sur de Chile.</span></div>
<div class="info-card green"><div class="info-icon">☏</div><strong>Contacto directo</strong><span>Fichas con WhatsApp, mapa, fotos y servicios.</span></div>
</div>
</div>
</section>
<section class="home-category-section alt registered-businesses" id="destacados">
<div class="container">
<div class="section-head compact-home-head"><div><div class="eyebrow dark">Comercios registrados</div><h2>Fichas comerciales por categoría</h2></div><p>Negocios aprobados en el CRM y ordenados según su categoría turística para que el visitante pueda contactar por WhatsApp y abrir la ubicación en mapa.</p></div>
<?php if ($homeBusinessCategories): ?>
<?php foreach ($homeBusinessCategories as $homeGroup): ?>
<?php $homeCategory = $homeGroup['category']; $homeBusinesses = $homeGroup['businesses']; ?>
<div class="home-registered-group" data-category="<?= home_h($homeCategory['slug']) ?>">
<div class="section-head compact-home-head mini-head"><div><div class="eyebrow dark"><?= home_h($homeCategory['menu_label'] ?: $homeCategory['name']) ?></div><h3><?= home_h($homeCategory['directory_title'] ?: $homeCategory['name']) ?> <small class="section-count"><?= count($homeBusinesses) ?> opciones</small></h3></div><a class="mini" href="category.php?slug=<?= home_h($homeCategory['slug']) ?>">Ver categoría</a></div>
<div class="home-category-grid">
<?php foreach ($homeBusinesses as $business): ?>
<?php $businessTags = array_values(array_filter(array_map('trim', explode(',', $business['tags'] ?? '')))); ?>
<article class="home-directory-card" data-category="<?= home_h($homeCategory['slug']) ?>">
<div class="thumb"><span class="tag"><?= home_h($businessTags[0] ?? 'Registrado') ?></span><img alt="<?= home_h($business['name']) ?>" loading="lazy" src="<?= home_h($business['image'] ?: 'assets/img/3.png') ?>"/></div>
<div class="content"><h3><?= home_h($business['name']) ?></h3><p><?= home_h($business['summary']) ?></p><div class="data"><?php foreach (array_slice($businessTags, 0, 4) as $tag): ?><span><?= home_h($tag) ?></span><?php endforeach; ?></div><div class="card-actions"><a href="<?= home_h(home_business_whatsapp_url($business)) ?>" <?= !empty($business['whatsapp']) ? 'target="_blank" rel="noopener"' : '' ?>>Contacto</a><a href="<?= home_h($business['map_url'] ?: 'https://www.google.com/maps/search/?api=1&query=Saltos+del+Laja+Chile') ?>" rel="noopener" target="_blank">Cómo llegar</a></div></div>
</article>
<?php endforeach; ?>
</div>
</div>
<?php endforeach; ?>
<?php else: ?>
<div class="home-empty-directory"><h3>Pronto publicaremos comercios registrados.</h3><p>Cuando un negocio sea aprobado en el CRM, su ficha aparecerá automáticamente en esta página según su categoría.</p><a class="btn primary" href="publicar-negocio.php">Registrar negocio</a></div>
<?php endif; ?>
</div>
</section>
<section aria-label="Temporada turística Saltos del Laja" class="parallax-section parallax-refined agency-parallax" style="--parallax-img:url('../img/2.png')">
<div class="parallax-inner">
<div class="parallax-copy">
<div class="eyebrow">Verano 2026–2027</div>
<h2>Prepara tu ficha antes de la temporada alta</h2>
<p>Una presencia turística clara permite que los visitantes encuentren tu negocio, revisen tus servicios y contacten directamente desde el celular.</p>
<div class="parallax-actions"><a class="btn white" href="publicar-negocio.php">Publicar negocio</a><a class="btn ghost" href="planes.php">Ver planes</a></div>
</div>
<div class="parallax-stats refined"><div class="parallax-stat"><strong>SEO local</strong><span>Categorías y páginas orientadas a búsqueda turística.</span></div><div class="parallax-stat"><strong>WhatsApp</strong><span>Contacto directo para reservas y consultas.</span></div></div>
</div>
</section>
<section class="section alt agency-map-block">
<div class="container split">
<div class="seo-block refined-text agency-text-card"><div class="eyebrow dark">Planificación turística</div><h2>Todo el destino en una navegación simple</h2><p>El visitante puede revisar alojamientos, restaurantes, lugares para visitar, mapa turístico y opciones de contacto sin recorrer una página extensa o confusa.</p><div class="agency-list"><span>✓ Categorías claras</span><span>✓ Fichas con fotos</span><span>✓ Mapa y ubicación</span><span>✓ Contacto por WhatsApp</span></div><div class="actions"><a class="btn primary" href="mapa-turistico.php">Ver mapa turístico</a><a class="btn green" href="contacto.php">Contactar</a></div></div>
<div class="map refined-map agency-map" style="--mapimg:url('../img/3.png')"><div class="map-box"><h3>Mapa turístico</h3><p>Alojamientos, restaurantes, miradores, rutas, campings, emprendimientos y servicios en un solo lugar.</p><a class="btn primary" href="mapa-turistico.php">Abrir mapa</a></div></div>
</div>
</section>
<section class="section agency-business-cta">
<div class="container home-contact-band refined-cta agency-cta-card"><div><span class="cta-kicker">Negocios locales</span><h2>¿Quieres aparecer en la guía turística?</h2><p>Postula tu alojamiento, restaurante, cafetería, tour, camping o emprendimiento para recibir visitantes durante la temporada verano 2026–2027.</p></div><div class="actions"><a class="btn primary" href="publicar-negocio.php">Registrar negocio</a><a class="btn green" href="planes.php">Conocer planes</a></div></div>
</section>
<?php $assetBase = ''; include __DIR__ . '/includes/footer.php'; ?>
