<?php $isEdit = !empty($category); $heroImage = $category['hero_image'] ?? 'assets/img/2.png'; ?>
<div class="crm-page-head"><div><p class="crm-eyebrow">Categorías</p><h1><?= $isEdit ? 'Editar categoría' : 'Nueva categoría' ?></h1><p>Al guardar una categoría activa, se integra automáticamente al menú público desde la base de datos.</p></div></div>
<form method="post" action="index.php?controller=categories&action=<?= $isEdit ? 'update' : 'store' ?>" enctype="multipart/form-data" class="crm-editor-form">
    <?php if ($isEdit): ?><input type="hidden" name="id" value="<?= (int) $category['id'] ?>"><?php endif; ?>
    <section class="crm-card crm-form-section"><div class="crm-form-title"><span>01</span><div><h2>Datos de menú</h2><p>Nombre, slug y visibilidad de la categoría.</p></div></div><div class="row g-3">
        <div class="col-md-4"><label class="form-label">Nombre</label><input class="form-control" name="name" value="<?= crm_h($category['name'] ?? '') ?>" required></div>
        <div class="col-md-4"><label class="form-label">Slug</label><input class="form-control" name="slug" value="<?= crm_h($category['slug'] ?? '') ?>" placeholder="alojamientos" required></div>
        <div class="col-md-3"><label class="form-label">Etiqueta menú</label><input class="form-control" name="menu_label" value="<?= crm_h($category['menu_label'] ?? '') ?>" required></div>
        <div class="col-md-1"><label class="form-label">Orden</label><input class="form-control" type="number" name="sort_order" value="<?= (int) ($category['sort_order'] ?? 0) ?>"></div>
        <div class="col-12"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_active" id="active" <?= ($category['is_active'] ?? 1) ? 'checked' : '' ?>><label class="form-check-label" for="active">Categoría activa y visible en el menú</label></div></div>
    </div></section>
    <section class="crm-card crm-form-section"><div class="crm-form-title"><span>02</span><div><h2>SEO y portada</h2><p>Textos principales e imagen hero de la página pública.</p></div></div><div class="row g-3">
        <div class="col-md-6"><label class="form-label">Meta title</label><input class="form-control" name="meta_title" value="<?= crm_h($category['meta_title'] ?? '') ?>"></div>
        <div class="col-md-6"><label class="form-label">Meta description</label><input class="form-control" name="meta_description" value="<?= crm_h($category['meta_description'] ?? '') ?>"></div>
        <div class="col-md-6"><label class="form-label">Título hero</label><input class="form-control" name="hero_title" value="<?= crm_h($category['hero_title'] ?? '') ?>" required></div>
        <div class="col-md-6"><label class="form-label">Ruta imagen actual</label><input class="form-control" name="hero_image" value="<?= crm_h($heroImage) ?>"></div>
        <div class="col-md-8"><label class="form-label">Subir nueva imagen hero</label><input class="form-control" type="file" name="hero_image_file" accept="image/*"><small class="text-muted">Formatos permitidos: JPG, PNG, WEBP o GIF.</small></div>
        <div class="col-md-4"><?php if ($heroImage): ?><img class="crm-image-preview" src="../<?= crm_h($heroImage) ?>" alt="Vista previa hero"><?php endif; ?></div>
        <div class="col-12"><label class="form-label">Bajada hero</label><textarea class="form-control" name="hero_subtitle" rows="2"><?= crm_h($category['hero_subtitle'] ?? '') ?></textarea></div>
    </div></section>
    <section class="crm-card crm-form-section"><div class="crm-form-title"><span>03</span><div><h2>Contenido configurable</h2><p>Sección de tarjetas, bloque estático y llamado a la acción.</p></div></div><div class="row g-3">
        <div class="col-md-5"><label class="form-label">Título sección tarjetas</label><input class="form-control" name="directory_title" value="<?= crm_h($category['directory_title'] ?? '') ?>"></div>
        <div class="col-md-7"><label class="form-label">Intro sección tarjetas</label><input class="form-control" name="directory_intro" value="<?= crm_h($category['directory_intro'] ?? '') ?>"></div>
        <div class="col-md-5"><label class="form-label">Título sección estática</label><input class="form-control" name="static_section_title" value="<?= crm_h($category['static_section_title'] ?? '') ?>"></div>
        <div class="col-md-7"><label class="form-label">Contenido sección estática</label><textarea class="form-control" name="static_section_content" rows="2"><?= crm_h($category['static_section_content'] ?? '') ?></textarea></div>
        <div class="col-md-5"><label class="form-label">Título CTA</label><input class="form-control" name="cta_title" value="<?= crm_h($category['cta_title'] ?? '') ?>"></div>
        <div class="col-md-7"><label class="form-label">Texto CTA</label><input class="form-control" name="cta_text" value="<?= crm_h($category['cta_text'] ?? '') ?>"></div>
    </div></section>
    <div class="crm-sticky-actions"><button class="btn btn-primary">Guardar categoría</button><a class="btn btn-outline-secondary" href="index.php?controller=categories">Cancelar</a></div>
</form>
