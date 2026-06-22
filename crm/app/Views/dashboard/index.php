<div class="crm-page-head">
    <div><p class="crm-eyebrow">Panel de control</p><h1>Bienvenido, <?= crm_h($currentUser['name'] ?? 'usuario') ?></h1><p>CRM MVC en PHP/MySQL preparado para crecer por módulos.</p></div>
    <a class="btn btn-success" href="index.php?controller=users&action=create">Crear usuario</a>
</div>
<div class="row g-3">
    <div class="col-md-4"><div class="crm-card"><span class="crm-metric"><?= (int) $userCount ?></span><p>Usuarios registrados</p></div></div>
    <div class="col-md-8"><div class="crm-card"><h2>Próximos módulos</h2><p class="mb-0">Contactos, negocios, oportunidades y reportes pueden agregarse usando la misma estructura MVC.</p></div></div>
</div>
