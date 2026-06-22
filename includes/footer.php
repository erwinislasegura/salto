<?php
require_once __DIR__ . '/config.php';

$assetBase = $assetBase ?? '';
$activePage = $activePage ?? ($mobileActive ?? 'index');
$brand = $siteConfig['brand'];
$contact = $siteConfig['contact'];
$mobileNav = $siteConfig['mobile_nav'];
$footerColumns = $siteConfig['footer_columns'];
$footer = $siteConfig['footer'];

if (!function_exists('asset_url')) {
    function asset_url(string $assetBase, string $path): string
    {
        return htmlspecialchars($assetBase . $path, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('h')) {
    function h(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
?>
<nav class="mobilebar" aria-label="Menú móvil">
    <?php foreach ($mobileNav as $key => $item): ?>
        <a<?= $activePage === $key ? ' class="active"' : '' ?> href="<?= asset_url($assetBase, $item['href']) ?>">
            <span><?= h($item['icon']) ?></span><?= h($item['label']) ?>
        </a>
    <?php endforeach; ?>
</nav>
<a aria-label="Contactar por WhatsApp" class="whatsapp-float" href="<?= h($contact['whatsapp_url']) ?>" rel="noopener" target="_blank">
    <span class="wa-dot">☏</span>
    <span><small>Consulta directa</small><strong>WhatsApp</strong></span>
</a>
<footer class="footer">
    <div class="container footer-grid">
        <div>
            <a class="brand brand-official" href="<?= asset_url($assetBase, 'index.php') ?>">
                <img alt="<?= h($brand['logo_alt']) ?>" decoding="async" height="260" loading="lazy" src="<?= asset_url($assetBase, $brand['logo']) ?>" width="900" />
            </a>
            <p><?= h($footer['description']) ?></p>
        </div>
        <?php foreach ($footerColumns as $title => $links): ?>
            <div>
                <h4><?= h($title) ?></h4>
                <?php foreach ($links as $link): ?>
                    <a<?= isset($link['class']) ? ' class="' . h($link['class']) . '"' : '' ?> href="<?= asset_url($assetBase, $link['href']) ?>"><?= h($link['label']) ?></a>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="container bottom">
        <span><?= h($footer['copyright']) ?></span>
        <span><?= h($footer['tagline']) ?></span>
    </div>
</footer>
<script src="<?= asset_url($assetBase, 'assets/js/main.js') ?>"></script>
</body>
</html>
