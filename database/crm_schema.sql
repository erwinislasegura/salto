CREATE TABLE IF NOT EXISTS crm_users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor') NOT NULL DEFAULT 'editor',
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO crm_users (name, email, password_hash, role, is_active)
VALUES ('Administrador', 'admin@saltosdellajaturistico.cl', '$2y$12$HDGJrNkl0aSZ2MG7HLwBZ.uXf1NNkI/fRuKKmtwVyHVoYhCsD3IsG', 'admin', 1)
ON DUPLICATE KEY UPDATE email = email;
-- Contraseña inicial: Admin123*Cambiar
