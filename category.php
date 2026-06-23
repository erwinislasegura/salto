<?php
spl_autoload_register(function (string $class): void {
    $prefix = 'CRM\\';
    if (strpos($class, $prefix) !== 0) {
        return;
    }
    $file = __DIR__ . '/crm/app/' . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
    if (is_file($file)) {
        require $file;
    }
});

use CRM\Models\Business;
use CRM\Models\Category;

function public_h(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }

$slug = preg_replace('/[^a-z0-9-]/', '', strtolower($_GET['slug'] ?? 'alojamientos'));
$category = Category::findBySlug($slug);
if (!$category) {
    http_response_code(404);
    exit('Categoría no encontrada.');
}

$activeTag = trim($_GET['tag'] ?? '');
$businesses = Business::byCategory((int) $category['id'], $activeTag ?: null);
$tags = Business::tagsByCategory((int) $category['id']);
$assetBase = '';
$activePage = $slug;
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= public_h($category['meta_title'] ?: $category['hero_title']) ?> | Saltos del Laja Turístico</title>
<meta name="description" content="<?= public_h($category['meta_description'] ?: $category['hero_subtitle']) ?>">
<link href="https://fonts.googleapis.com" rel="preconnect"><link href="https://fonts.gstatic.com" rel="preconnect" crossorigin><link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="assets/css/styles.css" rel="stylesheet">
<link href="assets/img/favicon-saltos-del-laja.png" rel="icon" type="image/png">
</head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<section class="hero sub pro-hero" id="main" style="--hero:url('<?= public_h($category['hero_image']) ?>')"><div class="container hero-grid"><div><div class="breadcrumbs"><a href="index.php">Inicio</a> / <?= public_h($category['menu_label']) ?></div><div class="eyebrow">Guía turística profesional</div><h1 class="h1"><?= public_h($category['hero_title']) ?></h1><p class="lead"><?= public_h($category['hero_subtitle']) ?></p></div></div></section>
<section class="home-category-section alt"><div class="container"><div class="section-head compact-home-head"><div><div class="eyebrow dark">Directorio turístico</div><h2><?= public_h($category['directory_title']) ?> <small class="section-count"><?= count($businesses) ?> opciones</small></h2></div><p><?= public_h($category['directory_intro']) ?></p></div>
<?php if ($tags): ?><nav class="tag-filter" aria-label="Filtrar por tag"><a class="<?= $activeTag === '' ? 'active' : '' ?>" href="category.php?slug=<?= public_h($category['slug']) ?>">Todos</a><?php foreach ($tags as $tag): ?><a class="<?= $activeTag === $tag ? 'active' : '' ?>" href="category.php?slug=<?= public_h($category['slug']) ?>&tag=<?= urlencode($tag) ?>"><?= public_h($tag) ?></a><?php endforeach; ?></nav><?php endif; ?>
<div class="home-category-grid"><?php foreach ($businesses as $business): ?>
<article class="home-directory-card"><div class="thumb"><span class="tag"><?= public_h(strtok($business['tags'] ?: 'Destacado', ',')) ?></span><img alt="<?= public_h($business['name']) ?>" loading="lazy" src="<?= public_h($business['image']) ?>"></div><div class="content"><h3><?= public_h($business['name']) ?></h3><p><?= public_h($business['summary']) ?></p><div class="data"><?php foreach (array_slice(array_filter(array_map('trim', explode(',', $business['tags']))), 0, 4) as $tag): ?><span><?= public_h($tag) ?></span><?php endforeach; ?></div><div class="card-actions"><a href="<?= $business['whatsapp'] ? 'https://wa.me/' . public_h($business['whatsapp']) : 'contacto.php' ?>" target="_blank" rel="noopener">Contacto</a><a href="<?= public_h($business['map_url'] ?: 'https://www.google.com/maps/search/?api=1&query=Saltos+del+Laja+Chile') ?>" target="_blank" rel="noopener">Cómo llegar</a></div></div></article>
<?php endforeach; ?></div></div></section>
<section class="pro-section"><div class="container pro-intro"><div class="pro-copy"><div class="eyebrow dark"><?= public_h($category['menu_label']) ?></div><h2><?= public_h($category['static_section_title']) ?></h2><p><?= nl2br(public_h($category['static_section_content'])) ?></p></div><div class="pro-panel"><h3><?= public_h($category['cta_title']) ?></h3><p><?= public_h($category['cta_text']) ?></p><div class="actions"><a class="btn primary" href="publicar-negocio.php">Publicar negocio</a><a class="btn green" href="contacto.php">Contactar</a></div></div></div></section>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body></html>
