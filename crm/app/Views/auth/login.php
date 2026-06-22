<div class="crm-card crm-login-card">
    <p class="crm-eyebrow">Acceso privado</p>
    <h1>CRM Saltos del Laja</h1>
    <p class="text-muted">Ingresa para administrar usuarios y preparar la futura gestión comercial del portal.</p>
    <?php if (!empty($error)): ?><div class="alert alert-danger"><?= crm_h($error) ?></div><?php endif; ?>
    <form method="post" action="index.php?controller=auth&action=authenticate" class="vstack gap-3">
        <div><label class="form-label">Correo</label><input class="form-control" type="email" name="email" required></div>
        <div><label class="form-label">Contraseña</label><input class="form-control" type="password" name="password" required></div>
        <button class="btn btn-primary" type="submit">Entrar al CRM</button>
    </form>
</div>
