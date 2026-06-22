<div class="crm-page-head">
    <div><p class="crm-eyebrow">Control de usuarios</p><h1>Usuarios</h1><p>Administra accesos del equipo interno.</p></div>
    <a class="btn btn-primary" href="index.php?controller=users&action=create">Nuevo usuario</a>
</div>
<div class="crm-card">
    <table class="table table-striped align-middle" data-crm-table>
        <thead><tr><th>Nombre</th><th>Correo</th><th>Rol</th><th>Estado</th><th>Creado</th><th>Acciones</th></tr></thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= crm_h($user['name']) ?></td><td><?= crm_h($user['email']) ?></td><td><?= crm_h($user['role']) ?></td>
                <td><span class="badge <?= $user['is_active'] ? 'text-bg-success' : 'text-bg-secondary' ?>"><?= $user['is_active'] ? 'Activo' : 'Inactivo' ?></span></td>
                <td><?= crm_h($user['created_at']) ?></td>
                <td class="d-flex gap-2"><a class="btn btn-sm btn-outline-primary" href="index.php?controller=users&action=edit&id=<?= (int) $user['id'] ?>">Editar</a><form method="post" action="index.php?controller=users&action=delete" onsubmit="return confirm('¿Eliminar usuario?')"><input type="hidden" name="id" value="<?= (int) $user['id'] ?>"><button class="btn btn-sm btn-outline-danger">Eliminar</button></form></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
