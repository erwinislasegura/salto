<?php $isEdit = !empty($user); ?>
<div class="crm-page-head"><div><p class="crm-eyebrow">Usuarios</p><h1><?= $isEdit ? 'Editar usuario' : 'Nuevo usuario' ?></h1></div></div>
<div class="crm-card">
    <form method="post" action="index.php?controller=users&action=<?= $isEdit ? 'update' : 'store' ?>" class="row g-3">
        <?php if ($isEdit): ?><input type="hidden" name="id" value="<?= (int) $user['id'] ?>"><?php endif; ?>
        <div class="col-md-6"><label class="form-label">Nombre</label><input class="form-control" name="name" value="<?= crm_h($user['name'] ?? '') ?>" required></div>
        <div class="col-md-6"><label class="form-label">Correo</label><input class="form-control" type="email" name="email" value="<?= crm_h($user['email'] ?? '') ?>" required></div>
        <div class="col-md-6"><label class="form-label">Contraseña <?= $isEdit ? '(opcional)' : '' ?></label><input class="form-control" type="password" name="password" <?= $isEdit ? '' : 'required' ?>></div>
        <div class="col-md-4"><label class="form-label">Rol</label><select class="form-select" name="role"><option value="admin" <?= ($user['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option><option value="editor" <?= ($user['role'] ?? 'editor') === 'editor' ? 'selected' : '' ?>>Editor</option></select></div>
        <div class="col-md-2 d-flex align-items-end"><div class="form-check mb-2"><input class="form-check-input" type="checkbox" name="is_active" id="active" <?= ($user['is_active'] ?? 1) ? 'checked' : '' ?>><label class="form-check-label" for="active">Activo</label></div></div>
        <div class="col-12 d-flex gap-2"><button class="btn btn-primary">Guardar</button><a class="btn btn-outline-secondary" href="index.php?controller=users">Cancelar</a></div>
    </form>
</div>
