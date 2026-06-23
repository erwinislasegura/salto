<?php $isEdit = !empty($business); $selected = array_map('intval', $business['category_ids'] ?? []); $image = $business['image'] ?? 'assets/img/3.png'; ?>
<div class="crm-page-head"><div><p class="crm-eyebrow">Comercios</p><h1><?= $isEdit ? 'Editar comercio' : 'Nuevo comercio' ?></h1><p>Registra el comercio, súbelo a una o más categorías y agrega tags para facilitar la navegación.</p></div></div>
<form method="post" action="index.php?controller=businesses&action=<?= $isEdit ? 'update' : 'store' ?>" enctype="multipart/form-data" class="crm-editor-form">
    <?php if ($isEdit): ?><input type="hidden" name="id" value="<?= (int) $business['id'] ?>"><?php endif; ?>
    <section class="crm-card crm-form-section"><div class="crm-form-title"><span>01</span><div><h2>Ficha comercial</h2><p>Datos principales que se mostrarán en la tarjeta pública.</p></div></div><div class="row g-3">
        <div class="col-md-5"><label class="form-label">Nombre</label><input class="form-control" name="name" value="<?= crm_h($business['name'] ?? '') ?>" required></div>
        <div class="col-md-4"><label class="form-label">Slug</label><input class="form-control" name="slug" value="<?= crm_h($business['slug'] ?? '') ?>" required></div>
        <div class="col-md-3"><label class="form-label">Ruta imagen actual</label><input class="form-control" name="image" value="<?= crm_h($image) ?>"></div>
        <div class="col-md-8"><label class="form-label">Subir imagen de tarjeta</label><input class="form-control" type="file" name="image_file" accept="image/*"><small class="text-muted">La imagen subida reemplaza la ruta actual.</small></div>
        <div class="col-md-4"><?php if ($image): ?><img class="crm-image-preview" src="../<?= crm_h($image) ?>" alt="Vista previa comercio"><?php endif; ?></div>
        <div class="col-12"><label class="form-label">Resumen para tarjeta</label><input class="form-control" name="summary" value="<?= crm_h($business['summary'] ?? '') ?>" required></div>
        <div class="col-12"><label class="form-label">Descripción</label><textarea class="form-control" name="description" rows="3"><?= crm_h($business['description'] ?? '') ?></textarea></div>
    </div></section>
    <section class="crm-card crm-form-section"><div class="crm-form-title"><span>02</span><div><h2>Contacto y ubicación</h2><p>Datos para botones de WhatsApp y cómo llegar.</p></div></div><div class="row g-3">
        <div class="col-md-4"><label class="form-label">WhatsApp</label><input class="form-control" name="whatsapp" value="<?= crm_h($business['whatsapp'] ?? '') ?>" placeholder="56900000000"></div>
        <div class="col-md-4"><label class="form-label">Teléfono</label><input class="form-control" name="phone" value="<?= crm_h($business['phone'] ?? '') ?>"></div>
        <div class="col-md-4"><label class="form-label">Dirección</label><input class="form-control" name="address" value="<?= crm_h($business['address'] ?? '') ?>"></div>
        <div class="col-12"><label class="form-label">URL mapa</label><input class="form-control" name="map_url" value="<?= crm_h($business['map_url'] ?? '') ?>"></div>
    </div></section>
    <section class="crm-card crm-form-section"><div class="crm-form-title"><span>03</span><div><h2>Categorías y tags</h2><p>Un comercio puede aparecer en varias páginas y filtrarse por tags.</p></div></div><div class="row g-3">
        <div class="col-12"><label class="form-label">Tags separados por coma</label><input class="form-control" name="tags" value="<?= crm_h($business['tags'] ?? '') ?>" placeholder="Familias, Reservas, Vista"></div>
        <div class="col-12"><label class="form-label">Categorías</label><div class="crm-check-grid"><?php foreach ($categories as $category): ?><label class="form-check"><input class="form-check-input" type="checkbox" name="category_ids[]" value="<?= (int) $category['id'] ?>" <?= in_array((int) $category['id'], $selected, true) ? 'checked' : '' ?>> <span class="form-check-label"><?= crm_h($category['menu_label']) ?></span></label><?php endforeach; ?></div></div>
        <div class="col-md-3"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_featured" id="featured" <?= ($business['is_featured'] ?? 0) ? 'checked' : '' ?>><label class="form-check-label" for="featured">Destacado</label></div></div>
        <div class="col-md-3"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_active" id="active" <?= ($business['is_active'] ?? 1) ? 'checked' : '' ?>><label class="form-check-label" for="active">Activo</label></div></div>
    </div></section>
    <div class="crm-sticky-actions"><button class="btn btn-primary">Guardar comercio</button><a class="btn btn-outline-secondary" href="index.php?controller=businesses">Cancelar</a></div>
</form>
