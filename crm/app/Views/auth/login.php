<div class="crm-login-wrap">
    <section class="crm-login-hero">
        <img src="../assets/img/logo-header-saltos-del-laja.png" alt="Saltos del Laja Turístico">
        <span>CRM interno</span>
        <h1>Gestión simple para el equipo turístico.</h1>
        <p>Usuarios, permisos y base preparada para nuevos módulos comerciales.</p>
    </section>
    <section class="crm-card crm-login-card">
        <p class="crm-eyebrow">Acceso privado</p>
        <h2>Entrar al CRM</h2>
        <p class="text-muted">Usa tus credenciales internas para continuar.</p>
        <?php if (!empty($error)): ?><div class="alert alert-danger py-2"><?= crm_h($error) ?></div><?php endif; ?>
        <form method="post" action="index.php?controller=auth&action=authenticate" class="vstack gap-3">
            <div><label class="form-label">Correo</label><input class="form-control" type="email" name="email" autocomplete="email" required></div>
            <div><label class="form-label">Contraseña</label><input class="form-control" type="password" name="password" autocomplete="current-password" required></div>
            <button class="btn btn-primary w-100" type="submit">Entrar</button>
        </form>
    </section>
</div>
