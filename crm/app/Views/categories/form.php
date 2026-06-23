<?php $isEdit = !empty($category); ?>
<div class="crm-page-head"><div><p class="crm-eyebrow">Categorías</p><h1><?= $isEdit ? 'Editar categoría' : 'Nueva categoría' ?></h1><p>Define textos SEO, hero, directorio y secciones estáticas de la página pública.</p></div></div>
<div class="crm-card">
<form method="post" action="index.php?controller=categories&action=<?= $isEdit ? 'update' : 'store' ?>" class="row g-3">
    <?php if ($isEdit): ?><input type="hidden" name="id" value="<?= (int) $category['id'] ?>"><?php endif; ?>
    <div class="col-md-4"><label class="form-label">Nombre</label><input class="form-control" name="name" value="<?= crm_h($category['name'] ?? '') ?>" required></div>
    <div class="col-md-4"><label class="form-label">Slug</label><input class="form-control" name="slug" value="<?= crm_h($category['slug'] ?? '') ?>" placeholder="alojamientos" required></div>
    <div class="col-md-3"><label class="form-label">Etiqueta menú</label><input class="form-control" name="menu_label" value="<?= crm_h($category['menu_label'] ?? '') ?>" required></div>
    <div class="col-md-1"><label class="form-label">Orden</label><input class="form-control" type="number" name="sort_order" value="<?= (int) ($category['sort_order'] ?? 0) ?>"></div>
    <div class="col-md-6"><label class="form-label">Meta title</label><input class="form-control" name="meta_title" value="<?= crm_h($category['meta_title'] ?? '') ?>"></div>
    <div class="col-md-6"><label class="form-label">Meta description</label><input class="form-control" name="meta_description" value="<?= crm_h($category['meta_description'] ?? '') ?>"></div>
    <div class="col-md-6"><label class="form-label">Título hero</label><input class="form-control" name="hero_title" value="<?= crm_h($category['hero_title'] ?? '') ?>" required></div>
    <div class="col-md-6"><label class="form-label">Imagen hero</label><input class="form-control" name="hero_image" value="<?= crm_h($category['hero_image'] ?? 'assets/img/2.png') ?>"></div>
    <div class="col-12"><label class="form-label">Bajada hero</label><textarea class="form-control" name="hero_subtitle" rows="2"><?= crm_h($category['hero_subtitle'] ?? '') ?></textarea></div>
    <div class="col-md-5"><label class="form-label">Título sección tarjetas</label><input class="form-control" name="directory_title" value="<?= crm_h($category['directory_title'] ?? '') ?>"></div>
    <div class="col-md-7"><label class="form-label">Intro sección tarjetas</label><input class="form-control" name="directory_intro" value="<?= crm_h($category['directory_intro'] ?? '') ?>"></div>
    <div class="col-md-5"><label class="form-label">Título sección estática</label><input class="form-control" name="static_section_title" value="<?= crm_h($category['static_section_title'] ?? '') ?>"></div>
    <div class="col-md-7"><label class="form-label">Contenido sección estática</label><textarea class="form-control" name="static_section_content" rows="2"><?= crm_h($category['static_section_content'] ?? '') ?></textarea></div>
    <div class="col-md-5"><label class="form-label">Título CTA</label><input class="form-control" name="cta_title" value="<?= crm_h($category['cta_title'] ?? '') ?>"></div>
    <div class="col-md-5"><label class="form-label">Texto CTA</label><input class="form-control" name="cta_text" value="<?= crm_h($category['cta_text'] ?? '') ?>"></div>
    <div class="col-md-2 d-flex align-items-end"><div class="form-check mb-2"><input class="form-check-input" type="checkbox" name="is_active" id="active" <?= ($category['is_active'] ?? 1) ? 'checked' : '' ?>><label class="form-check-label" for="active">Activa</label></div></div>
    <div class="col-12 d-flex gap-2 pt-2"><button class="btn btn-primary">Guardar</button><a class="btn btn-outline-secondary" href="index.php?controller=categories">Cancelar</a></div>
</form>
</div>
