<?php $statusLabels = ['nueva_solicitud' => 'Nueva solicitud', 'en_revision' => 'En revisión', 'aceptado' => 'Aceptado', 'rechazado' => 'Rechazado']; ?>
<div class="crm-page-head">
    <div><p class="crm-eyebrow">Directorio</p><h1>Comercios</h1><p>Gestiona solicitudes, cambia su estado y publica solo comercios aceptados.</p></div>
    <a class="btn btn-primary" href="index.php?controller=businesses&action=create">Nuevo comercio</a>
</div>
<div class="crm-card crm-table-card">
    <table class="table table-sm table-hover align-middle" data-crm-table>
        <thead><tr><th>Nombre</th><th>Contacto</th><th>Tags</th><th>Solicitud</th><th>Publicado</th><th class="text-end">Acciones</th></tr></thead>
        <tbody><?php foreach ($businesses as $business): ?><tr>
            <td><strong><?= crm_h($business['name']) ?></strong><br><small><?= crm_h($business['slug']) ?></small></td>
            <td><small><?= crm_h($business['contact_name'] ?? '') ?></small><br><small><?= crm_h($business['contact_email'] ?? '') ?></small></td>
            <td><?= crm_h($business['tags']) ?></td>
            <td><form method="post" action="index.php?controller=businesses&action=status" class="d-flex gap-2"><input type="hidden" name="id" value="<?= (int) $business['id'] ?>"><select class="form-select form-select-sm" name="status"><?php foreach ($statusLabels as $value => $label): ?><option value="<?= crm_h($value) ?>" <?= ($business['status'] ?? 'nueva_solicitud') === $value ? 'selected' : '' ?>><?= crm_h($label) ?></option><?php endforeach; ?></select><button class="btn btn-sm btn-outline-primary">OK</button></form></td>
            <td><span class="badge <?= $business['is_active'] ? 'text-bg-success' : 'text-bg-secondary' ?>"><?= $business['is_active'] ? 'Activo' : 'Inactivo' ?></span></td>
            <td><div class="d-flex justify-content-end gap-2"><a class="btn btn-sm btn-outline-primary" href="index.php?controller=businesses&action=edit&id=<?= (int) $business['id'] ?>">Editar</a><form method="post" action="index.php?controller=businesses&action=delete" onsubmit="return confirm('¿Eliminar comercio?')"><input type="hidden" name="id" value="<?= (int) $business['id'] ?>"><button class="btn btn-sm btn-outline-danger">Eliminar</button></form></div></td>
        </tr><?php endforeach; ?></tbody>
    </table>
</div>
