<?php
require __DIR__ . '/config.php';

$assetBase = $assetBase ?? '';
$activePage = $activePage ?? '';
$brand = $siteConfig['brand'];
$contact = $siteConfig['contact'];
$navItems = $siteConfig['nav'];
$primaryCta = $siteConfig['primary_cta'];
$socialLinks = $siteConfig['social'];

if (!function_exists('load_dynamic_nav_items')) {
    function load_dynamic_nav_items(array $fallbackNav): array
    {
        $databaseConfig = __DIR__ . '/../crm/config/database.php';
        if (!is_file($databaseConfig)) {
            return $fallbackNav;
        }

        try {
            $config = require $databaseConfig;
            $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $config['host'], $config['database'], $config['charset']);
            $pdo = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            $categories = $pdo->query('SELECT slug, menu_label FROM crm_categories WHERE is_active = 1 ORDER BY sort_order, name')->fetchAll();
        } catch (Throwable $exception) {
            return $fallbackNav;
        }

        if (!$categories) {
            return $fallbackNav;
        }

        $nav = ['index' => $fallbackNav['index'] ?? ['label' => 'Inicio', 'href' => 'index.php']];
        foreach ($categories as $category) {
            $nav[$category['slug']] = [
                'label' => $category['menu_label'],
                'href' => 'category.php?slug=' . rawurlencode($category['slug']),
            ];
        }
        if (isset($fallbackNav['mapa-turistico'])) {
            $nav['mapa-turistico'] = $fallbackNav['mapa-turistico'];
        }

        return $nav;
    }
}

$navItems = load_dynamic_nav_items($siteConfig['nav']);

function asset_url(string $assetBase, string $path): string
{
    return htmlspecialchars($assetBase . $path, ENT_QUOTES, 'UTF-8');
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function social_icon_svg(string $name, string $fallback): string
{
    $icons = [
        'Instagram' => '<svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><path d="M7.75 2h8.5A5.76 5.76 0 0 1 22 7.75v8.5A5.76 5.76 0 0 1 16.25 22h-8.5A5.76 5.76 0 0 1 2 16.25v-8.5A5.76 5.76 0 0 1 7.75 2Zm0 2A3.75 3.75 0 0 0 4 7.75v8.5A3.75 3.75 0 0 0 7.75 20h8.5A3.75 3.75 0 0 0 20 16.25v-8.5A3.75 3.75 0 0 0 16.25 4h-8.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm5.25-2.15a1.15 1.15 0 1 1 0 2.3 1.15 1.15 0 0 1 0-2.3Z"/></svg>',
        'Facebook' => '<svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><path d="M15.12 8.1h2.2V4.28A28.5 28.5 0 0 0 14.1 4c-3.18 0-5.36 2-5.36 5.66V13H5.22v4.27h3.52V24h4.32v-6.73h3.38L16.98 13h-3.92V10.1c0-1.24.33-2 2.06-2Z"/></svg>',
        'YouTube' => '<svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.12C19.54 3.58 12 3.58 12 3.58s-7.54 0-9.4.5A3 3 0 0 0 .5 6.2 31.2 31.2 0 0 0 0 12a31.2 31.2 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.12c1.86.5 9.4.5 9.4.5s7.54 0 9.4-.5a3 3 0 0 0 2.1-2.12A31.2 31.2 0 0 0 24 12a31.2 31.2 0 0 0-.5-5.8ZM9.55 15.55v-7.1L15.82 12l-6.27 3.55Z"/></svg>',
        'TikTok' => '<svg aria-hidden="true" viewBox="0 0 24 24" focusable="false"><path d="M16.6 5.82a5.65 5.65 0 0 0 3.32 1.06v3.35a8.86 8.86 0 0 1-3.3-.65v6.3A6.12 6.12 0 1 1 10.5 9.76c.36 0 .72.03 1.06.1v3.5a2.72 2.72 0 1 0 1.78 2.55V2h3.26v3.82Z"/></svg>',
    ];

    return $icons[$name] ?? h($fallback);
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
                    <a class="social-icon" href="<?= h($social['url']) ?>" aria-label="<?= h($name) ?>" rel="noopener" target="_blank"><?= social_icon_svg($name, $social['icon']) ?></a>
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
