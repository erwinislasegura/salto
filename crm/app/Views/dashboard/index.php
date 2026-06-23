<div class="crm-page-head">
    <div>
        <p class="crm-eyebrow">Panel de control</p>
        <h1>Hola, <?= crm_h($currentUser['name'] ?? 'usuario') ?></h1>
        <p>Resumen operativo del CRM y accesos rápidos.</p>
    </div>
    <div class="d-flex gap-2"><a class="btn btn-primary" href="index.php?controller=categories&action=create">Crear categoría</a><a class="btn btn-success" href="index.php?controller=businesses&action=create">Crear comercio</a></div>
</div>
<div class="row g-3">
    <div class="col-md-4">
        <div class="crm-card crm-stat-card">
            <span class="crm-metric"><?= (int) $userCount ?></span>
            <p>Usuarios registrados</p>
        </div>
    </div>
    <div class="col-md-8">
        <div class="crm-card crm-module-card">
            <p class="crm-eyebrow">Escalable</p>
            <h2>Base lista para crecer</h2>
            <p class="mb-0">Ahora puedes configurar categorías del menú, editar secciones estáticas de sus páginas y publicar comercios con tags para las tarjetas del directorio.</p>
        </div>
    </div>
</div>
