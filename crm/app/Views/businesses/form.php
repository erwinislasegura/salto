<?php $isEdit = !empty($business); $selected = array_map('intval', $business['category_ids'] ?? []); ?>
<div class="crm-page-head"><div><p class="crm-eyebrow">Comercios</p><h1><?= $isEdit ? 'Editar comercio' : 'Nuevo comercio' ?></h1><p>Asigna una o más categorías y escribe tags separados por coma para la navegación pública.</p></div></div>
<div class="crm-card">
<form method="post" action="index.php?controller=businesses&action=<?= $isEdit ? 'update' : 'store' ?>" class="row g-3">
    <?php if ($isEdit): ?><input type="hidden" name="id" value="<?= (int) $business['id'] ?>"><?php endif; ?>
    <div class="col-md-5"><label class="form-label">Nombre</label><input class="form-control" name="name" value="<?= crm_h($business['name'] ?? '') ?>" required></div>
    <div class="col-md-4"><label class="form-label">Slug</label><input class="form-control" name="slug" value="<?= crm_h($business['slug'] ?? '') ?>" required></div>
    <div class="col-md-3"><label class="form-label">Imagen</label><input class="form-control" name="image" value="<?= crm_h($business['image'] ?? 'assets/img/3.png') ?>"></div>
    <div class="col-12"><label class="form-label">Resumen para tarjeta</label><input class="form-control" name="summary" value="<?= crm_h($business['summary'] ?? '') ?>" required></div>
    <div class="col-12"><label class="form-label">Descripción</label><textarea class="form-control" name="description" rows="3"><?= crm_h($business['description'] ?? '') ?></textarea></div>
    <div class="col-md-4"><label class="form-label">WhatsApp</label><input class="form-control" name="whatsapp" value="<?= crm_h($business['whatsapp'] ?? '') ?>" placeholder="56900000000"></div>
    <div class="col-md-4"><label class="form-label">Teléfono</label><input class="form-control" name="phone" value="<?= crm_h($business['phone'] ?? '') ?>"></div>
    <div class="col-md-4"><label class="form-label">Dirección</label><input class="form-control" name="address" value="<?= crm_h($business['address'] ?? '') ?>"></div>
    <div class="col-md-7"><label class="form-label">URL mapa</label><input class="form-control" name="map_url" value="<?= crm_h($business['map_url'] ?? '') ?>"></div>
    <div class="col-md-5"><label class="form-label">Tags separados por coma</label><input class="form-control" name="tags" value="<?= crm_h($business['tags'] ?? '') ?>" placeholder="Familias, Reservas, Vista"></div>
    <div class="col-12"><label class="form-label">Categorías</label><div class="crm-check-grid"><?php foreach ($categories as $category): ?><label class="form-check"><input class="form-check-input" type="checkbox" name="category_ids[]" value="<?= (int) $category['id'] ?>" <?= in_array((int) $category['id'], $selected, true) ? 'checked' : '' ?>> <span class="form-check-label"><?= crm_h($category['menu_label']) ?></span></label><?php endforeach; ?></div></div>
    <div class="col-md-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_featured" id="featured" <?= ($business['is_featured'] ?? 0) ? 'checked' : '' ?>><label class="form-check-label" for="featured">Destacado</label></div></div>
    <div class="col-md-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" id="active" <?= ($business['is_active'] ?? 1) ? 'checked' : '' ?>><label class="form-check-label" for="active">Activo</label></div></div>
    <div class="col-12 d-flex gap-2 pt-2"><button class="btn btn-primary">Guardar</button><a class="btn btn-outline-secondary" href="index.php?controller=businesses">Cancelar</a></div>
</form>
</div>
