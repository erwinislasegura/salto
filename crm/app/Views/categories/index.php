<div class="crm-page-head">
    <div><p class="crm-eyebrow">Contenido público</p><h1>Categorías</h1><p>Configura las secciones del menú y el contenido estático de cada página.</p></div>
    <a class="btn btn-primary" href="index.php?controller=categories&action=create">Nueva categoría</a>
</div>
<div class="crm-card crm-table-card">
    <table class="table table-sm table-hover align-middle" data-crm-table>
        <thead><tr><th>Orden</th><th>Menú</th><th>Slug</th><th>Estado</th><th class="text-end">Acciones</th></tr></thead>
        <tbody><?php foreach ($categories as $category): ?><tr>
            <td><?= (int) $category['sort_order'] ?></td><td><strong><?= crm_h($category['menu_label']) ?></strong></td><td>category.php?slug=<?= crm_h($category['slug']) ?></td>
            <td><span class="badge <?= $category['is_active'] ? 'text-bg-success' : 'text-bg-secondary' ?>"><?= $category['is_active'] ? 'Activa' : 'Inactiva' ?></span></td>
            <td><div class="d-flex justify-content-end gap-2"><a class="btn btn-sm btn-outline-primary" href="index.php?controller=categories&action=edit&id=<?= (int) $category['id'] ?>">Editar</a><form method="post" action="index.php?controller=categories&action=delete" onsubmit="return confirm('¿Eliminar categoría?')"><input type="hidden" name="id" value="<?= (int) $category['id'] ?>"><button class="btn btn-sm btn-outline-danger">Eliminar</button></form></div></td>
        </tr><?php endforeach; ?></tbody>
    </table>
</div>
