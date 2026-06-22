<?php
require __DIR__ . '/config.php';

$assetBase = $assetBase ?? '';
$activePage = $activePage ?? '';
$brand = $siteConfig['brand'];
$contact = $siteConfig['contact'];
$navItems = $siteConfig['nav'];
$primaryCta = $siteConfig['primary_cta'];
$socialLinks = $siteConfig['social'];

function asset_url(string $assetBase, string $path): string
{
    return htmlspecialchars($assetBase . $path, ENT_QUOTES, 'UTF-8');
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<a class="skip" href="#main">Saltar al contenido</a>
<header class="topbar">
    <div class="topline">
        <div class="container topline-inner">
            <div class="topline-left">
                <a href="<?= h($contact['phone_href']) ?>"><b>WhatsApp</b> <?= h($contact['phone']) ?></a>
                <a class="hide-sm" href="<?= h($contact['email_href']) ?>"><?= h($contact['email']) ?></a>
                <span class="hide-md"><?= h($contact['place']) ?></span>
            </div>
            <div class="topline-right">
                <span class="hide-sm">Síguenos</span>
                <?php foreach ($socialLinks as $name => $social): ?>
                    <a class="social-icon" href="<?= h($social['url']) ?>" aria-label="<?= h($name) ?>" rel="noopener" target="_blank"><?= h($social['icon']) ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="container nav">
        <a aria-label="<?= h($brand['name']) ?>" class="brand brand-official" href="<?= asset_url($assetBase, 'index.php') ?>">
            <img alt="<?= h($brand['logo_alt']) ?>" class="header-logo" decoding="async" height="260" src="<?= asset_url($assetBase, $brand['logo']) ?>" width="900" />
        </a>
        <nav aria-label="Menú principal" class="navlinks">
            <?php foreach ($navItems as $key => $item): ?>
                <a<?= $activePage === $key ? ' class="active"' : '' ?> href="<?= asset_url($assetBase, $item['href']) ?>"><?= h($item['label']) ?></a>
            <?php endforeach; ?>
            <a class="cta" href="<?= asset_url($assetBase, $primaryCta['href']) ?>"><?= h($primaryCta['label']) ?></a>
        </nav>
        <button aria-label="Abrir menú" class="menu" data-menu type="button">Menú</button>
    </div>
</header>
