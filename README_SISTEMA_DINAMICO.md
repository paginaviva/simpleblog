# Meridiano Blog - Sistema Dinámico de Posts

Blog especializado en béisbol caribeño, desarrollado con PHP puro (sin CMS) y MySQL/MariaDB.

## 🎯 Objetivo

Convertir la plantilla HTML estática `post.html` en un sistema dinámico donde:
- Artículos se almacenan en BD MySQL/MariaDB
- Cada artículo se renderiza dinámicamente con PHP
- URLs amigables: `/post.php?url=yadier-molina-magallanes-segunda-etapa`
- Separación clara entre lógica, datos y presentación (patrón MVC simplificado)

## 📁 Estructura del Proyecto

```
/workspaces/simpleblog/
├── config/              # Configuración centralizada
│   ├── routes.php      # Rutas físicas y URLs (PERSONALIZAR AQUÍ)
│   └── database.php    # Conexión PDO a MySQL/MariaDB
├── classes/            # Modelos de datos
│   └── Articulo.php    # Clase para operaciones de artículos
├── templates/          # Plantillas HTML/PHP
│   └── post.php        # Renderizado dinámico de artículos
├── includes/           # Componentes reutilizables
│   ├── header.php      # Encabezado (meta, estilos)
│   └── footer.php      # Pie de página (scripts)
├── css/                # Estilos (Bootstrap 5.2.3)
├── js/                 # Scripts de interacción
├── assets/             # Recursos (imágenes, SQL, etc.)
└── post.php            # Controlador principal
```

## 🚀 Inicio Rápido

### 1. Configurar rutas (`/config/routes.php`)

**IMPORTANTE**: Personaliza estas 2 constantes según tu entorno:

```php
// Ruta absoluta del proyecto en el servidor
define('RUTA_FISICA', __DIR__ . '/../');

// URL base del sitio web
define('RUTA_URL', 'http://localhost/simpleblog');
```

**Ejemplos**:
- **Desarrollo local**: `http://localhost/simpleblog`
- **Servidor compartido**: `https://www.meridiano.com`
- **Subdominio**: `https://blog.meridiano.com`

### 2. Configurar BD (`/config/database.php`)

Edita las constantes de conexión:

```php
define('DB_HOST', 'localhost');        // Servidor
define('DB_USER', 'root');             // Usuario
define('DB_PASSWORD', '');             // Contraseña
define('DB_NAME', 'meridiano_blog');   // Nombre BD
```

### 3. Crear schema de BD

Ejecuta `/assets/estructura.sql` en tu BD MySQL/MariaDB

### 4. Migrar contenido a BD

Inserta el artículo Yadier Molina desde `yadier-molina-magallanes-segunda-etapa.html`

### 5. Probar acceso

```
http://localhost/simpleblog/post.php?url=yadier-molina-magallanes-segunda-etapa
```

## 🔧 Arquitectura

### Sistema de Rutas Centralizado

Todos los paths se derivan automáticamente de 2 constantes base en `routes.php`:

```php
RUTA_FISICA  → /home/usuario/proyectos/simpleblog/
RUTA_URL     → http://localhost/simpleblog

// Se generan automáticamente:
RUTA_CONFIG  → RUTA_FISICA/config/
RUTA_CLASSES → RUTA_FISICA/classes/
RUTA_CSS     → RUTA_URL/css/
RUTA_JS      → RUTA_URL/js/
// ... y más
```

**Ventaja**: Cambiar solo 2 constantes permite deployment en cualquier servidor sin modificar código PHP.

### Flujo de Solicitud

```
1. Usuario accede a: /post.php?url=yadier-molina...

2. /post.php (controlador):
   - Valida URL con preg_match()
   - Incluye config/routes.php, config/database.php
   - Instancia clase Articulo
   - Consulta BD por URL amigable

3. Si artículo existe:
   - Obtiene categorías y etiquetas
   - Incluye includes/header.php
   - Incluye templates/post.php con datos
   - Incluye includes/footer.php

4. Si artículo NO existe:
   - Responde HTTP 404
   - Muestra página de error

5. Si hay error de BD:
   - Responde HTTP 500
   - Muestra detalles en desarrollo
```

## 📚 Componentes Principales

### `classes/Articulo.php`

Modelo de datos con métodos:

```php
$articulo = new Articulo($pdo);

// Obtener artículo por URL amigable
$datos = $articulo->obtenerPorUrl('yadier-molina-...');

// Obtener categorías del artículo
$categorias = $articulo->obtenerCategorias($articulo_id);

// Obtener etiquetas del artículo
$etiquetas = $articulo->obtenerEtiquetas($articulo_id);
```

### `/templates/post.php`

Plantilla que renderiza artículo con variables:

- `$articulo` - Array con datos del artículo
- `$categorias` - Array de categorías
- `$etiquetas` - Array de etiquetas

Usa `htmlspecialchars()` para prevenir XSS.

### `/includes/header.php` y `/includes/footer.php`

Componentes reutilizables que incluyen:
- Meta tags dinámicos para SEO
- Estilos CSS (Bootstrap)
- Scripts JavaScript
- Open Graph tags para redes sociales

## 🔐 Seguridad

### ✅ SQL Injection Prevention
- PDO prepared statements en todas las consultas
- Parámetros vinculados

### ✅ XSS Prevention
- `htmlspecialchars()` en salidas
- Content en BD se escapa al renderizar

### ✅ URL Validation
- `preg_match('/^[a-z0-9-]+$/i', $url)` valida formato
- Solo acepta alfanuméricos y guiones

### ✅ Error Handling
- try/catch PDOException
- HTTP 404 para artículos no encontrados
- HTTP 500 para errores de BD

## 📖 Base de Datos

Schema en `/assets/estructura.sql`:

```sql
-- Tabla principal
CREATE TABLE mb_articulos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255),
    contenido_html LONGTEXT,
    url_amigable VARCHAR(255) UNIQUE,
    autor_id INT,
    fecha_publicacion TIMESTAMP,
    estado ENUM('publicado', 'borrador'),
    -- ...más campos
);

-- Tabla de autores
CREATE TABLE mb_autores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    bio TEXT,
    -- ...
);

-- Tablas de relación N:N
CREATE TABLE mb_articulos_categorias (
    articulo_id INT,
    categoria_id INT,
    PRIMARY KEY (articulo_id, categoria_id)
);

CREATE TABLE mb_articulos_etiquetas (
    articulo_id INT,
    etiqueta_id INT,
    PRIMARY KEY (articulo_id, etiqueta_id)
);
```

## 📝 Documentación

- **`PROYECTO_ANDAMIO.md`** - Especificación técnica completa
- **`mapa-ruta-desarrollo.md`** - Pasos de implementación (actualizado)
- **`ESTADO_IMPLEMENTACION.md`** - Estado actual del proyecto
- **`/assets/estructura_explicada.md`** - Detalles del schema de BD

## 🧪 Testing

### Verificar rutas:
```bash
cd /workspaces/simpleblog
php -r "require_once 'config/routes.php'; echo RUTA_FISICA . PHP_EOL;"
```

### Verificar sintaxis PHP:
```bash
php -l post.php
php -l config/database.php
php -l classes/Articulo.php
```

### Verificar estructura:
```bash
tree -L 3 --dirsfirst
```

## 🎓 Pasos Siguientes

### Paso 6: Migrar contenido a BD
1. Extraer HTML de `yadier-molina-magallanes-segunda-etapa.html`
2. Insertar en `mb_articulos` con:
   - `url_amigable`: 'yadier-molina-magallanes-segunda-etapa'
   - `estado`: 'publicado'
   - `autor_id`: 1

### Paso 7: Pruebas
- Acceder a `/post.php?url=...`
- Validar renderizado correcto
- Probar error 404
- Validar seguridad

### Paso 8: Futuro - Índice dinámico
- Convertir `index.html` a `index.php`
- Listar todos los artículos
- Agregar paginación

## 💡 Tips de Desarrollo

- **Accede a constantes**: `echo RUTA_CSS;` en cualquier archivo que incluya `routes.php`
- **Debugging**: Descomenta sección de depuración en `config/routes.php`
- **Errores**: Revisa logs del servidor (Apache/Nginx) y PHP error log
- **BD**: Usa herramientas como phpMyAdmin o MySQL Workbench para inspeccionar datos

## 📄 Licencia

Proyecto educativo - Meridiano Blog

---

**Última actualización**: 12 de Noviembre, 2025  
**Versión**: 2.0 (Arquitectura con rutas centralizadas)
