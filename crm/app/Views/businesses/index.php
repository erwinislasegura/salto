<div class="crm-page-head">
    <div><p class="crm-eyebrow">Directorio</p><h1>Comercios</h1><p>Registra comercios, asigna categorías y agrega tags para filtrar tarjetas.</p></div>
    <a class="btn btn-primary" href="index.php?controller=businesses&action=create">Nuevo comercio</a>
</div>
<div class="crm-card crm-table-card">
    <table class="table table-sm table-hover align-middle" data-crm-table>
        <thead><tr><th>Nombre</th><th>Tags</th><th>Destacado</th><th>Estado</th><th class="text-end">Acciones</th></tr></thead>
        <tbody><?php foreach ($businesses as $business): ?><tr>
            <td><strong><?= crm_h($business['name']) ?></strong><br><small><?= crm_h($business['slug']) ?></small></td><td><?= crm_h($business['tags']) ?></td>
            <td><?= $business['is_featured'] ? 'Sí' : 'No' ?></td><td><span class="badge <?= $business['is_active'] ? 'text-bg-success' : 'text-bg-secondary' ?>"><?= $business['is_active'] ? 'Activo' : 'Inactivo' ?></span></td>
            <td><div class="d-flex justify-content-end gap-2"><a class="btn btn-sm btn-outline-primary" href="index.php?controller=businesses&action=edit&id=<?= (int) $business['id'] ?>">Editar</a><form method="post" action="index.php?controller=businesses&action=delete" onsubmit="return confirm('¿Eliminar comercio?')"><input type="hidden" name="id" value="<?= (int) $business['id'] ?>"><button class="btn btn-sm btn-outline-danger">Eliminar</button></form></div></td>
        </tr><?php endforeach; ?></tbody>
    </table>
</div>
