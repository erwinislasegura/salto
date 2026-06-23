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

CREATE TABLE IF NOT EXISTS crm_categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    slug VARCHAR(140) NOT NULL UNIQUE,
    menu_label VARCHAR(80) NOT NULL,
    meta_title VARCHAR(180) NULL,
    meta_description VARCHAR(255) NULL,
    hero_title VARCHAR(180) NOT NULL,
    hero_subtitle TEXT NULL,
    hero_image VARCHAR(255) NULL,
    directory_title VARCHAR(180) NULL,
    directory_intro TEXT NULL,
    static_section_title VARCHAR(180) NULL,
    static_section_content TEXT NULL,
    cta_title VARCHAR(180) NULL,
    cta_text TEXT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS crm_businesses (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(160) NOT NULL,
    slug VARCHAR(180) NOT NULL UNIQUE,
    summary VARCHAR(255) NOT NULL,
    description TEXT NULL,
    image VARCHAR(255) NULL,
    phone VARCHAR(60) NULL,
    whatsapp VARCHAR(40) NULL,
    address VARCHAR(255) NULL,
    map_url VARCHAR(500) NULL,
    tags VARCHAR(255) NULL,
    is_featured TINYINT(1) NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS crm_business_category (
    business_id INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (business_id, category_id),
    CONSTRAINT fk_crm_business_category_business FOREIGN KEY (business_id) REFERENCES crm_businesses(id) ON DELETE CASCADE,
    CONSTRAINT fk_crm_business_category_category FOREIGN KEY (category_id) REFERENCES crm_categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO crm_categories (name, slug, menu_label, meta_title, meta_description, hero_title, hero_subtitle, hero_image, directory_title, directory_intro, static_section_title, static_section_content, cta_title, cta_text, sort_order, is_active) VALUES
('Alojamientos', 'alojamientos', 'Alojamientos', 'Alojamientos en Saltos del Laja', 'Cabañas, hoteles, campings y hospedajes cerca de Saltos del Laja.', 'Alojamientos en Saltos del Laja', 'Cabañas, hoteles, campings y hospedajes para descansar cerca de las cascadas.', 'assets/img/2.png', 'Dónde alojar', 'Compara alojamientos por tags, servicios y contacto directo.', 'Configura el contenido turístico de alojamientos', 'Desde el CRM puedes editar esta sección estática, cambiar textos, imágenes y publicar tarjetas reales asociadas a esta categoría.', '¿Quieres aparecer en Alojamientos?', 'Publica tu negocio y recibe consultas desde tu ficha.', 10, 1),
('Restaurantes', 'restaurantes', 'Restaurantes', 'Restaurantes en Saltos del Laja', 'Restaurantes, cafeterías y picadas para comer en Saltos del Laja.', 'Restaurantes y lugares para comer', 'Guía gastronómica para encontrar restaurantes, cafeterías, picadas y productos locales.', 'assets/img/3.png', 'Dónde comer', 'Encuentra opciones por tipo de comida, atención, reservas y tags.', 'Configura el contenido gastronómico', 'Esta sección permite destacar recomendaciones, horarios, consejos de reserva o información comercial fija.', '¿Tienes un restaurante?', 'Suma tu local al directorio turístico.', 20, 1),
('Emprendimientos', 'emprendimientos', 'Emprendimientos', 'Emprendimientos en Saltos del Laja', 'Artesanía, souvenirs y productos locales de Saltos del Laja.', 'Emprendimientos locales', 'Productos locales, recuerdos, artesanía y servicios turísticos del territorio.', 'assets/img/4.png', 'Compra local', 'Explora emprendimientos por rubro, productos y tags de navegación.', 'Impulsa la economía local', 'Edita este bloque para contar la propuesta de valor de los emprendimientos y productos del destino.', '¿Tienes un emprendimiento?', 'Regístralo para que aparezca en las tarjetas.', 30, 1),
('Experiencias', 'experiencias', 'Experiencias', 'Experiencias en Saltos del Laja', 'Actividades y experiencias turísticas en Saltos del Laja.', 'Experiencias turísticas', 'Actividades, paseos, rutas suaves, fotografía y panoramas para visitantes.', 'assets/img/5.png', 'Qué hacer', 'Filtra experiencias por tipo de actividad, temporada y público.', 'Diseña rutas y experiencias', 'Este contenido estático puede explicar temporadas, recomendaciones y formatos de reserva.', '¿Ofreces una experiencia?', 'Publícala para aparecer en el directorio.', 40, 1),
('Qué visitar', 'que-visitar', 'Qué visitar', 'Qué visitar en Saltos del Laja', 'Miradores, cascadas y lugares para visitar en Saltos del Laja.', 'Qué visitar en Saltos del Laja', 'Miradores, río, cascadas y puntos de interés para planificar el recorrido.', 'assets/img/6.png', 'Lugares destacados', 'Ordena lugares y atractivos por tags para una navegación simple.', 'Organiza la visita al destino', 'Configura aquí recomendaciones, seguridad, accesos y tiempos estimados para visitar los atractivos.', '¿Conoces un lugar relevante?', 'Sugiere o registra un punto de interés.', 50, 1)
ON DUPLICATE KEY UPDATE menu_label = VALUES(menu_label), sort_order = VALUES(sort_order), is_active = VALUES(is_active);

INSERT INTO crm_businesses (name, slug, summary, description, image, whatsapp, address, map_url, tags, is_featured, is_active) VALUES
('Hotel Salto del Laja', 'hotel-salto-del-laja', 'Hotel emblemático con ubicación cercana a las cascadas y servicios para visitantes.', 'Ficha inicial demostrativa para alojamientos.', 'assets/img/2.png', '56900000000', 'Saltos del Laja', 'https://www.google.com/maps/search/?api=1&query=Hotel+Salto+del+Laja', 'Hotel,Vista,Familias,Reservas', 1, 1),
('Restaurante Saltos del Laja', 'restaurante-saltos-del-laja', 'Comida chilena, almuerzos y atención para familias durante la visita.', 'Ficha inicial demostrativa para restaurantes.', 'assets/img/3.png', '56900000000', 'Saltos del Laja', 'https://www.google.com/maps/search/?api=1&query=Restaurante+Saltos+del+Laja', 'Comida chilena,Almuerzo,Familias,Reservas', 1, 1),
('Artesanía y Souvenirs del Laja', 'artesania-souvenirs-del-laja', 'Artesanía, recuerdos y productos locales para turistas.', 'Ficha inicial demostrativa para emprendimientos.', 'assets/img/4.png', '56900000000', 'Saltos del Laja', 'https://www.google.com/maps/search/?api=1&query=Artesania+Saltos+del+Laja', 'Artesanía,Souvenirs,Productos locales,Regalos', 1, 1),
('Experiencias Río Laja', 'experiencias-rio-laja', 'Paseos, caminatas y experiencias familiares junto al río.', 'Ficha inicial demostrativa para experiencias.', 'assets/img/5.png', '56900000000', 'Saltos del Laja', 'https://www.google.com/maps/search/?api=1&query=Experiencias+Rio+Laja', 'Caminatas,Fotografía,Familias,Temporada', 1, 1),
('Miradores Saltos del Laja', 'miradores-saltos-del-laja', 'Puntos de observación para disfrutar las cascadas y el entorno natural.', 'Ficha inicial demostrativa para lugares que visitar.', 'assets/img/6.png', '56900000000', 'Saltos del Laja', 'https://www.google.com/maps/search/?api=1&query=Miradores+Saltos+del+Laja', 'Miradores,Cascadas,Fotografía,Familias', 1, 1)
ON DUPLICATE KEY UPDATE name = VALUES(name);

INSERT IGNORE INTO crm_business_category (business_id, category_id)
SELECT b.id, c.id FROM crm_businesses b JOIN crm_categories c ON c.slug = 'alojamientos' WHERE b.slug = 'hotel-salto-del-laja';
INSERT IGNORE INTO crm_business_category (business_id, category_id)
SELECT b.id, c.id FROM crm_businesses b JOIN crm_categories c ON c.slug = 'restaurantes' WHERE b.slug = 'restaurante-saltos-del-laja';
INSERT IGNORE INTO crm_business_category (business_id, category_id)
SELECT b.id, c.id FROM crm_businesses b JOIN crm_categories c ON c.slug = 'emprendimientos' WHERE b.slug = 'artesania-souvenirs-del-laja';
INSERT IGNORE INTO crm_business_category (business_id, category_id)
SELECT b.id, c.id FROM crm_businesses b JOIN crm_categories c ON c.slug = 'experiencias' WHERE b.slug = 'experiencias-rio-laja';
INSERT IGNORE INTO crm_business_category (business_id, category_id)
SELECT b.id, c.id FROM crm_businesses b JOIN crm_categories c ON c.slug = 'que-visitar' WHERE b.slug = 'miradores-saltos-del-laja';
