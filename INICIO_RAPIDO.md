# ⚡ INICIO RÁPIDO - Meridiano Blog

**Tiempo estimado**: 5 minutos para setup básico

---

## 🎯 En 3 Pasos

### PASO 1: Personaliza Rutas
**Archivo**: `/config/routes.php`

Modifica estas 2 líneas:
```php
define('RUTA_FISICA', __DIR__ . '/../');        // ← Déjalo así para desarrollo local
define('RUTA_URL', 'http://localhost/simpleblog'); // ← Cambia si necesario
```

### PASO 2: Configura BD
**Archivo**: `/config/database.php`

Modifica estas constantes:
```php
define('DB_HOST', 'localhost');         // Tu servidor MySQL
define('DB_USER', 'root');              // Tu usuario
define('DB_PASSWORD', '');              // Tu contraseña
define('DB_NAME', 'meridiano_blog');    // Nombre BD
```

### PASO 3: Crea Schema BD
Ejecuta `/assets/estructura.sql` en tu BD MySQL/MariaDB

---

## 🌐 Test Básico

```bash
# Verificar rutas
php -r "require_once 'config/routes.php'; echo 'OK: ' . RUTA_URL;"

# Verificar sintaxis PHP
php -l post.php
php -l config/database.php
php -l classes/Articulo.php
```

---

## 📝 Insertar Primer Artículo

```sql
-- 1. Crear autor (si no existe)
INSERT INTO mb_autores (nombre, bio) 
VALUES ('Meridiano Blog', 'Blog especializado en béisbol caribeño');

-- 2. Copiar HTML de yadier-molina-magallanes-segunda-etapa.html
--    y pegar en contenido_html abajo:

INSERT INTO mb_articulos (
    titulo,
    contenido_html,
    url_amigable,
    autor_id,
    estado
) VALUES (
    'Yadier Molina y su ruta caribeña: el regreso del Capitán al Magallanes',
    '<article class="mb-4">... [PEGAR HTML AQUÍ] ...</article>',
    'yadier-molina-magallanes-segunda-etapa',
    1,
    'publicado'
);
```

---

## 🌍 Acceder a Artículo

```
http://localhost/simpleblog/post.php?url=yadier-molina-magallanes-segunda-etapa
```

---

## 📚 Documentación Completa

| Necesito... | Leer... |
|------------|---------|
| Entender todo | README_SISTEMA_DINAMICO.md |
| Ver progreso | ESTADO_IMPLEMENTACION.md |
| Pasos detallados | mapa-ruta-desarrollo.md |
| Migrar datos | GUIA_PASO6_MIGRACION_BD.md |
| Índice | INDICE_DOCUMENTACION.md |

---

## 🆘 Troubleshooting Rápido

**Error "Artículo No Encontrado"**
- Verifica URL amigable en BD
- Asegúrate que `estado = 'publicado'`

**Error "Error del Servidor"**
- Revisa credenciales en `/config/database.php`
- Verifica que schema de BD existe

**CSS no carga**
- Accede a `http://localhost/simpleblog/css/styles.css`
- Si da 404, revisa `/config/routes.php`

---

**Meridiano Blog - Sistema Dinámico de Posts**  
Última actualización: 12 de Noviembre, 2025
