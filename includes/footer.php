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

if (!function_exists('whatsapp_icon_svg')) {
    function whatsapp_icon_svg(): string
    {
        return '<svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.95 1.17-.17.2-.35.22-.65.07-.3-.15-1.25-.46-2.39-1.47a8.9 8.9 0 0 1-1.65-2.05c-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.18.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.2 5.08 4.49.71.3 1.26.49 1.69.63.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2-1.42.25-.7.25-1.3.18-1.42-.08-.13-.27-.2-.57-.35ZM12.04 2a9.94 9.94 0 0 0-8.47 15.16L2 22l4.96-1.3A9.94 9.94 0 1 0 12.04 2Zm0 18.24a8.25 8.25 0 0 1-4.2-1.15l-.3-.18-2.94.77.78-2.86-.2-.3a8.25 8.25 0 1 1 6.86 3.72Z"/></svg>';
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
    <span class="wa-dot"><?= whatsapp_icon_svg() ?></span>
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
