# SimpleBlog - Meridiano Blog

Un blog simple y estático sobre béisbol venezolano (LVBP), construido con PHP puro sin necesidad de base de datos.

## Características

- **Posts en PHP**: Cada artículo es un archivo PHP con metadatos (título, subtítulo, categoría, etiquetas, fecha, autor).
- **Sistema de categorización**: Filtra posts por categorías (ej. LVBP) y etiquetas (ej. Leones del Caracas).
- **Manifiesto automático**: Script que genera un archivo con todos los metadatos de los posts para navegación eficiente.
- **Responsive**: Usa Bootstrap para diseño adaptable.
- **SEO optimizado**: Metadatos Open Graph y Twitter Cards incluidos.

## Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/paginaviva/simpleblog.git
   cd simpleblog
   ```

2. Asegúrate de tener PHP instalado (versión 7.4 o superior).

## Uso

1. Ejecuta el servidor local:
   ```bash
   php -S localhost:8000
   ```

2. Abre tu navegador en `http://localhost:8000`.

3. Para agregar un nuevo post:
   - Crea un archivo en `post/` (ej. `nuevo-post.php`).
   - Define las variables `$title`, `$subtitle`, `$category`, `$tags`, `$date`, `$author`, `$image`.
   - Escribe el contenido HTML.
   - Ejecuta `php generate_manifest.php` para actualizar el manifiesto.

4. Navega por categorías: `category.php?name=LVBP`
5. Navega por etiquetas: `tag.php?name=Leones-del-Caracas`

## Estructura del proyecto

- `index.php`: Página principal con previews de posts.
- `post/`: Directorio con archivos de posts.
- `category.php` / `tag.php`: Páginas de filtro.
- `posts_manifest.php`: Archivo generado con metadatos de posts.
- `generate_manifest.php`: Script para generar el manifiesto.
- `config.php`: Configuraciones globales.
- `assets/`: CSS, JS e imágenes.

## Contribución

Si quieres contribuir, abre un issue o pull request en el repositorio.

## Licencia

Este proyecto es de código abierto bajo la licencia MIT.