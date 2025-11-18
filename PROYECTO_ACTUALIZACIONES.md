# Registro de Actualizaciones - SimpleBlog

**Propósito:** Documentar todos los cambios, mejoras y correcciones realizadas en el proyecto SimpleBlog durante su desarrollo y mantenimiento.

---

## Actualizaciones (Orden cronológico inverso)

### v2.5 - 18 de Noviembre de 2025

#### Mejoras en UI - Formulario de creación de posts

**Archivos modificados:**
- `crear-post-admin.php`
- `PROYECTO_DESCRIPCION_COMPLETA.md`

**Cambios realizados:**

1. **crear-post-admin.php - Estilos CSS mejorados**
   - Label "Bloque [DATOS_DOCUMENTO]:" ahora utiliza `display: block;` para posicionarse arriba del textarea
   - Campo textarea con `width: 100%;` y `box-sizing: border-box;` para ocupar todo el ancho disponible
   - Altura del textarea reducida de 600px a 510px (reducción del 15%) para mejor adaptación a pantalla
   - El campo ahora está perfectamente alineado con el recuadro azul de instrucciones

**Descripción:**
Se mejoró significativamente la presentación visual del formulario de creación de posts. Ahora tiene un layout más limpio y profesional, con mejor proporción en pantalla.

**Usuario/Responsable:** Mejoras de UX

---

### v2.4 - 18 de Noviembre de 2025

#### Correcciones críticas en sistema de creación de posts

**Archivos modificados:**
- `procesar-post.php`
- `crear-post-admin.php`
- `PROYECTO_DESCRIPCION_COMPLETA.md`

**Cambios realizados:**

1. **procesar-post.php - Corrección de generación de href**
   - **Antes:** `<a href="` . rtrim(POST_DIR, '/') . "/" . htmlspecialchars($nombre_archivo_php) . `"`
   - **Después:** `<a href="<?php echo POST_DIR; ?>` . htmlspecialchars($nombre_archivo_php) . `"`
   - **Razón:** Usar la constante PHP `POST_DIR` en lugar de concatenar strings, mantiene consistencia con index.php existente

2. **procesar-post.php - Implementación de fecha dinámica**
   - **Antes:** Usaba variable `$fecha_visible` (estática)
   - **Después:** Genera fecha dinámica con `date('d \d\e F \d\e Y', strtotime('now'));`
   - **Razón:** Los nuevos posts deben mostrar la fecha actual, no una fecha fija

3. **procesar-post.php - Corrección de atribución de autor**
   - **Antes:** `htmlspecialchars($autor_visible)` (variable)
   - **Después:** Hardcoded `"Redacción Meridiano BB"`
   - **Razón:** Todos los posts deben atribuirse a "Redacción Meridiano BB" para consistencia

4. **crear-post-admin.php - Actualización de documentación de formato**
   - Se agregó nota clara en el ejemplo de formato indicando:
     - Fecha actual aplicada automáticamente por el sistema
     - Autor automáticamente establecido como "Redacción Meridiano BB"
     - Enlace generado con `<?php echo POST_DIR; ?>`

**Descripción:**
Correcciones críticas en la lógica de generación de posts para asegurar que los nuevos posts creados a través del formulario tengan el mismo formato y comportamiento que los posts existentes en index.php. Las nuevas líneas de código se validaron sin errores de sintaxis.

**Usuario/Responsable:** Correcciones de sistema

**Validación:** ✓ PHP syntax check passed

---

### v2.3 - Análisis y auditoría completa del proyecto

**Archivos modificados:**
- `PROYECTO_DESCRIPCION_COMPLETA.md` (creación/actualización)

**Cambios realizados:**

1. **Auditoría completa del workspace**
   - Lectura y análisis de todos los archivos PHP principales
   - Inventario de 30+ posts activos en `/post/`
   - Mapeo de dependencias entre archivos

2. **Actualización de documentación**
   - Versión documentada como 2.3
   - Estado actualizado a "Sistema en Producción (30+ posts activos)"
   - Descripción completa de arquitectura PHP
   - Explicación detallada del sistema de creación automática de posts

3. **Identificación de issues**
   - Rutas de imagen con paréntesis extras (`.jpg)`)
   - Rutas duplicadas en imágenes (`assets/img/assets/img/`)
   - Necesidad de mejorar parser de URLs en formato markdown

**Descripción:**
Análisis exhaustivo del proyecto para entender estado actual, arquitectura, dependencias y problemas existentes. Se documentó completamente la estructura del sistema en producción.

---

### v2.2 - Migración a PHP y ajustes de rutas

**Archivos modificados:**
- Múltiples archivos PHP
- `config.php`

**Cambios realizados:**

1. **Migración de HTML a PHP**
   - Archivos `.html` convertidos a `.php` (index.html → index.php, etc.)
   - Sistema de includes PHP implementado
   - Headers y footers modularizados

2. **Configuración de rutas de producción**
   - `SITE_DIR` configurado a `/home/udcwscico/public_html/udn_meridiano_com/`
   - `SITE_URL` configurado a `https://www.meridiano.com/`
   - `POST_DIR` configurado a `/post/`

3. **Implementación de Google Analytics**
   - Código GA (gtag.js) integrado en headers
   - ID de seguimiento: `G-Y2V5THG16Y`

**Descripción:**
Migración fundamental de arquitectura estática HTML a arquitectura dinámica PHP modular. Establecimiento de configuración de rutas para ambiente de producción.

---

### v2.1 - Sistema de generación automática de posts

**Archivos creados/modificados:**
- `crear-post-admin.php` (creación)
- `procesar-post.php` (creación)
- `generate_manifest.php` (creación)

**Cambios realizados:**

1. **crear-post-admin.php**
   - Formulario web Bootstrap para entrada de datos `[DATOS_DOCUMENTO]`
   - Interfaz clara con instrucciones

2. **procesar-post.php**
   - Parsing de bloques `[DATOS_DOCUMENTO]`
   - Validación de campos obligatorios
   - Creación automática de archivos PHP de posts
   - Actualización automática de index.php
   - Generación automática de manifiesto

3. **generate_manifest.php**
   - Genera `posts_manifest.php` escaneando todos los posts
   - Extrae metadatos de cada post
   - Crea array centralizado de referencias

**Descripción:**
Implementación del sistema automático completo de creación de posts. Permite a usuarios crear nuevos posts sin modificar código PHP directamente.

**Resultado:** 30+ posts creados exitosamente a través del sistema

---

### v2.0 - Implementación de categorización y etiquetado

**Archivos creados/modificados:**
- `category.php` (creación)
- `tag.php` (creación)
- `posts_manifest.php` (auto-generado)

**Cambios realizados:**

1. **Sistema de categorización**
   - Cada post tiene variable `$category` (string)
   - `category.php` filtra y muestra posts por categoría
   - URL: `category.php?name=LVBP`

2. **Sistema de etiquetado**
   - Cada post tiene variable `$tags` (array)
   - `tag.php` filtra y muestra posts por etiqueta
   - URL: `tag.php?name=Leones-del-Caracas`

3. **Manifiesto centralizado**
   - `posts_manifest.php` generado automáticamente
   - Contiene metadatos de todos los posts (título, subtítulo, categoría, etiquetas, fecha, autor, imagen)
   - Usado por category.php y tag.php para filtrado

**Descripción:**
Implementación de sistema completo de categorización y etiquetado para mejor organización y navegación de contenido.

---

### v1.0 - Arquitectura base PHP modular

**Archivos creados:**
- `header_index.php`
- `header_common.php`
- `footer.php`
- `menu.php`
- `config.php`
- `index.php`
- `post.php`
- `about.php`
- `contact.php`

**Cambios realizados:**

1. **Estructura modular**
   - Separación de concerns: headers, footers, menu como componentes reutilizables
   - `config.php` centraliza constantes globales

2. **Headers especializados**
   - `header_index.php`: Header HTML puro para homepage
   - `header_common.php`: Header PHP dinámico para posts y páginas

3. **Páginas principales**
   - `index.php`: Homepage con previews de posts
   - `post.php`: Plantilla de post de ejemplo
   - `about.php`, `contact.php`: Páginas estáticas

**Descripción:**
Arquitectura base completamente funcional en PHP modular. Sistema escalable listo para agregar posts dinámicamente.

---

## Resumen estadístico

| Versión | Fecha | Posts | Cambios principales |
|---------|-------|-------|----------------------|
| 1.0 | - | 0 | Arquitectura PHP base |
| 2.0 | - | 0 | Categorización + etiquetado |
| 2.1 | - | 0-30+ | Sistema de creación automática |
| 2.2 | - | 30+ | Migración rutas producción |
| 2.3 | - | 30+ | Documentación completa |
| 2.4 | 18-Nov-2025 | 30+ | Correcciones críticas sistema posts |
| 2.5 | 18-Nov-2025 | 30+ | Mejoras UI formulario |

---

## Próximas actualizaciones esperadas

- [ ] v2.6: Sección unificada de explicación de funcionamiento en PROYECTO_DESCRIPCION_COMPLETA.md
- [ ] v3.0: Corrección de rutas de imágenes duplicadas/con paréntesis
- [ ] v3.1: Implementación de sitemap.xml dinámico
- [ ] v3.2: Agregar autenticación a crear-post-admin.php
- [ ] v3.3: Panel de administración (editar, eliminar posts)
- [ ] v3.4: Sistema de búsqueda

---

**Este archivo debe actualizarse con cada cambio significativo realizado en el proyecto para mantener un registro histórico completo.**
