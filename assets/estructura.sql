-- ==========================================================
-- Script SQL: Definición del esquema de base de datos
-- Proyecto: Blog de Béisbol Caribeño
-- Versión: 1.0
-- Fecha: 2025-11-07
-- Codificación: utf8mb4 (con BOM)
-- Motor: InnoDB
-- Autor: [Tu nombre / desarrollador]
-- ==========================================================

-- ===============================
-- Tabla: mb_autores
-- ===============================
CREATE TABLE mb_autores (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    bio TEXT,
    foto VARCHAR(255),
    redes JSON,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===============================
-- Tabla: mb_categorias
-- ===============================
CREATE TABLE mb_categorias (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    descripcion VARCHAR(255),
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===============================
-- Tabla: mb_etiquetas
-- ===============================
CREATE TABLE mb_etiquetas (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    frecuencia INT DEFAULT 0,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===============================
-- Tabla principal: mb_articulos
-- ===============================
CREATE TABLE mb_articulos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    metatitle VARCHAR(255),
    metadescription VARCHAR(255),
    titulo VARCHAR(255) NOT NULL,
    contenido_html LONGTEXT NOT NULL,
    entradilla TEXT,
    og_title VARCHAR(255),
    og_description VARCHAR(255),
    imagen_destacada VARCHAR(255),
    imagen_articulo VARCHAR(255),
    url_amigable VARCHAR(255) NOT NULL UNIQUE,
    url_canonica VARCHAR(255),
    autor_id INT UNSIGNED,
    fecha_publicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    extracto TEXT,
    fuentes JSON,
    idioma VARCHAR(10) DEFAULT 'es-VE',
    schema_type ENUM('Article','NewsArticle','SportsArticle') DEFAULT 'SportsArticle',
    schema_activo BOOLEAN DEFAULT TRUE,
    tiempo_lectura INT DEFAULT 0,
    twitter_card ENUM('summary','summary_large_image') DEFAULT 'summary_large_image',
    estado ENUM('borrador','pendiente','publicado','archivado') DEFAULT 'borrador',
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_autor FOREIGN KEY (autor_id) REFERENCES mb_autores(id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    INDEX idx_url_amigable (url_amigable),
    INDEX idx_estado (estado),
    INDEX idx_fecha_publicacion (fecha_publicacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===============================
-- Tabla puente: mb_articulos_categorias (N:N)
-- ===============================
CREATE TABLE mb_articulos_categorias (
    articulo_id INT UNSIGNED NOT NULL,
    categoria_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (articulo_id, categoria_id),
    CONSTRAINT fk_articulo_categoria_art FOREIGN KEY (articulo_id) REFERENCES mb_articulos(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_articulo_categoria_cat FOREIGN KEY (categoria_id) REFERENCES mb_categorias(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===============================
-- Tabla puente: mb_articulos_etiquetas (N:N)
-- ===============================
CREATE TABLE mb_articulos_etiquetas (
    articulo_id INT UNSIGNED NOT NULL,
    etiqueta_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (articulo_id, etiqueta_id),
    CONSTRAINT fk_articulo_etiqueta_art FOREIGN KEY (articulo_id) REFERENCES mb_articulos(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_articulo_etiqueta_tag FOREIGN KEY (etiqueta_id) REFERENCES mb_etiquetas(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==========================================================
-- FIN DEL SCRIPT
-- ==========================================================
