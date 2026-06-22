<?php
$assetBase = $assetBase ?? '';
$activePage = $activePage ?? '';
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
<div class="container nav">
<a aria-label="Saltos del Laja Turístico" class="brand brand-official" href="<?= $assetBase ?>index.php"><img alt="Saltos del Laja Turístico" class="header-logo" decoding="async" height="260" src="<?= $assetBase ?>assets/img/logo-header-saltos-del-laja.png" width="900"/></a>
<nav aria-label="Menú principal" class="navlinks"><?php foreach ($navItems as $key => [$label, $href]): ?><a<?= $activePage === $key ? ' class="active"' : '' ?> href="<?= $assetBase . $href ?>"><?= $label ?></a><?php endforeach; ?><a class="cta" href="<?= $assetBase ?>publicar-negocio.php">Publicar negocio</a></nav>
<button aria-label="Abrir menú" class="menu" data-menu="" type="button">Menú</button>
</div>
</header>
