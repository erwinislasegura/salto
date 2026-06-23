<?php
use CRM\Core\Auth;

$currentUser = $currentUser ?? Auth::user();
function crm_h(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title><?= crm_h($title ?? 'CRM') ?> | Saltos del Laja Turístico</title>
    <link rel="icon" type="image/png" href="../assets/img/favicon-saltos-del-laja.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">
</head>
<body class="crm-body">
    <main class="crm-shell <?= !empty($compact) ? 'crm-shell-compact' : '' ?>">
        <aside class="crm-sidebar">
            <a class="crm-logo" href="index.php">
                <img src="../assets/img/logo-header-saltos-del-laja.png" alt="Saltos del Laja Turístico">
                <span>CRM</span>
            </a>
            <?php if ($currentUser): ?>
                <nav class="crm-menu" aria-label="Menú CRM">
                    <a href="index.php">Panel</a>
                    <a href="index.php?controller=users">Usuarios</a>
                    <a href="index.php?controller=categories">Categorías</a>
                    <a href="index.php?controller=businesses">Comercios</a>
                    <a href="../index.php">Sitio web</a>
                    <a href="index.php?controller=auth&action=logout">Salir</a>
                </nav>
                <div class="crm-userbox">
                    <small>Sesión activa</small>
                    <strong><?= crm_h($currentUser['name'] ?? 'Usuario') ?></strong>
                    <span><?= crm_h($currentUser['role'] ?? 'editor') ?></span>
                </div>
            <?php endif; ?>
        </aside>
        <section class="crm-content">
            <?php if ($currentUser): ?>
                <header class="crm-topbar">
                    <div>
                        <span>Saltos del Laja Turístico</span>
                        <strong><?= crm_h($title ?? 'CRM') ?></strong>
                    </div>
                    <a class="btn btn-sm btn-outline-primary" href="../index.php">Ver sitio</a>
                </header>
            <?php endif; ?>
            <?php require __DIR__ . '/../' . $view . '.php'; ?>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        if (window.DataTable && document.querySelector('[data-crm-table]')) {
            new DataTable('[data-crm-table]', {
                pageLength: 10,
                lengthChange: false,
                language: { url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json' }
            });
        }
    </script>
</body>
</html>
