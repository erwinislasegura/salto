<?php
$assetBase = $assetBase ?? '';
$activePage = $activePage ?? '';
$contactPhone = $contactPhone ?? '+56 9 0000 0000';
$contactPhoneHref = $contactPhoneHref ?? 'tel:+56900000000';
$contactEmail = $contactEmail ?? 'contacto@saltosdellajaturistico.cl';
$contactEmailHref = $contactEmailHref ?? 'mailto:contacto@saltosdellajaturistico.cl';
$contactPlace = $contactPlace ?? 'Saltos del Laja, Biobío';
$socialLinks = $socialLinks ?? [
    'Instagram' => ['https://www.instagram.com/', 'IG'],
    'Facebook' => ['https://www.facebook.com/', 'f'],
    'YouTube' => ['https://www.youtube.com/', '▶'],
    'TikTok' => ['https://www.tiktok.com/', '♪'],
];
$navItems = [
    'index' => ['Inicio', 'index.php'],
    'alojamientos' => ['Alojamientos', 'alojamientos.php'],
    'restaurantes' => ['Restaurantes', 'restaurantes.php'],
    'emprendimientos' => ['Emprendimientos', 'emprendimientos.php'],
    'experiencias' => ['Experiencias', 'experiencias.php'],
    'lugares-para-visitar' => ['Qué visitar', 'lugares-para-visitar.php'],
    'mapa-turistico' => ['Mapa', 'mapa-turistico.php'],
];
?>
<a class="skip" href="#main">Saltar al contenido</a><header class="topbar">
<div class="topline"><div class="container topline-inner"><div class="topline-left"><a href="<?= $contactPhoneHref ?>"><b>WhatsApp</b> <?= $contactPhone ?></a><a class="hide-sm" href="<?= $contactEmailHref ?>"><?= $contactEmail ?></a><span class="hide-md"><?= $contactPlace ?></span></div><div class="topline-right"><span class="hide-sm">Síguenos</span><?php foreach ($socialLinks as $name => [$href, $icon]): ?><a class="social-icon" href="<?= $href ?>" aria-label="<?= $name ?>" rel="noopener" target="_blank"><?= $icon ?></a><?php endforeach; ?></div></div></div>
<div class="container nav">
<a aria-label="Saltos del Laja Turístico" class="brand brand-official" href="<?= $assetBase ?>index.php"><img alt="Saltos del Laja Turístico" class="header-logo" decoding="async" height="260" src="<?= $assetBase ?>assets/img/logo-header-saltos-del-laja.png" width="900"/></a>
<nav aria-label="Menú principal" class="navlinks"><?php foreach ($navItems as $key => [$label, $href]): ?><a<?= $activePage === $key ? ' class="active"' : '' ?> href="<?= $assetBase . $href ?>"><?= $label ?></a><?php endforeach; ?><a class="cta" href="<?= $assetBase ?>publicar-negocio.php">Publicar negocio</a></nav>
<button aria-label="Abrir menú" class="menu" data-menu="" type="button">Menú</button>
</div>
</header>
