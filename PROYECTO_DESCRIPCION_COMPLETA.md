# Documentación Técnica Completa - SimpleBlog (Meridiano Blog)

**Última actualización:** 17 de Noviembre de 2025  
**Versión del Proyecto:** 2.3 - Sistema Automático de Creación de Posts  
**Rama Actual:** `mmb`  
**Rama Principal:** `main`

---

## ⚠️ Estado y transición

> **El proyecto ha migrado completamente de HTML estático y partials JS a una arquitectura PHP modular. Toda la documentación previa sobre archivos `.html`, partials, y carga dinámica por JavaScript queda obsoleta.**

---

## 🆕 Arquitectura y estructura actual

### Estructura de directorios
```
simpleblog/
├── index.php
├── about.php
├── contact.php
├── post.php
├── config.php
├── header_common.php
├── header_index.php
├── footer.php
├── menu.php
├── post/
│   ├── gleyber-torres-leones.php
│   ├── yonathan-daza-madero-ofensiva-leones.php
│   ├── magallanes-mueve-el-tablero.php
│   ├── cuarta-semana-aprieta-zulia-mete-presion-la-guaira-responde-caribes-endereza-carretera.php
│   ├── yadier-molina-magallanes-segunda-etapa.php
├── css/
│   └── styles.css
├── js/
│   └── scripts.js
├── assets/
│   ├── favicon.ico
│   └── img/
│       ├── about-bg.jpg
│       ├── contact-bg.jpg
│       ├── home-bg.jpg
│       ├── post-bg.jpg
│       └── post-sample-image.jpg
├── error_log.txt
├── README.md
└── PROYECTO_DESCRIPCION_COMPLETA.md
```

### Componentes PHP y estructura de páginas

- **header_index.php**: Header HTML puro para la home, con metadatos, GA y masthead estático.
- **header_common.php**: Header PHP para posts y páginas con variables dinámicas, metadatos, GA y masthead configurable.
- **about.php / contact.php**: Usan header HTML puro (no incluyen header_common.php), con metadatos y GA, masthead estático.
- **footer.php**: Pie de página universal con enlaces sociales y scripts.
- **menu.php**: Navegación principal con enlaces a todas las páginas PHP.
- **config.php**: Define constantes globales (SITE_URL, POST_DIR, OG_SITE_NAME, etc.) y configuración de errores/logs.
- **post/**: Cada post es un archivo PHP con metadatos y contenido, incluye header_common.php y footer.php.
- **index.php**: Incluye header_index.php y footer.php, muestra previews de posts.
- **post.php**: Plantilla de post de ejemplo, incluye header_common.php y footer.php.
- **post/post_plantilla.php**: Plantilla base para duplicar y crear nuevos posts con estructura preestablecida.
- **posts_manifest.php**: Archivo generado automáticamente con metadatos de todos los posts (título, subtítulo, categoría, etiquetas, fecha, autor, imagen, URL).
- **generate_manifest.php**: Script PHP para generar automáticamente posts_manifest.php escaneando los archivos en post/.
- **category.php**: Página para filtrar y mostrar posts por categoría (ej. category.php?name=LVBP).
- **tag.php**: Página para filtrar y mostrar posts por etiqueta (ej. tag.php?name=Leones-del-Caracas).
- **crear-post-admin.php**: Formulario web para crear nuevos posts (abierto al público). Permite pegar el bloque `[DATOS_DOCUMENTO]` completo.
- **procesar-post.php**: Script de procesamiento que recibe datos del formulario, valida campos, crea el archivo PHP del post, actualiza index.php, genera el manifiesto y redirige al post creado.

### Sistema de categorización y etiquetado

- Cada post en `post/` tiene variables `$category` y `$tags` definidas antes de incluir header_common.php.
- `$category` es un string (ej. "LVBP").
- `$tags` es un array de strings (ej. ['Leones del Caracas', 'Gleyber Torres']).
- El script `generate_manifest.php` escanea todos los posts, incluye cada archivo para capturar las variables, y genera `posts_manifest.php` con un array `$posts` que contiene todos los metadatos.
- Las páginas `category.php` y `tag.php` usan `posts_manifest.php` para filtrar y mostrar posts relevantes.

### Sistema automático de creación de posts

- **Acceso:** `crear-post-admin.php` - Formulario web donde el usuario pega el bloque `[DATOS_DOCUMENTO]` completo.
- **Validación:** El script `procesar-post.php` valida todos los campos obligatorios y muestra errores descriptivos si falta algo.
- **Parsing automático:** Extrae todas las secciones (`[HEAD]`, `[CABECERA_VISUAL]`, `[CONTENIDO]`, `[CATEGORIAS]`, `[ETIQUETAS]`) y campos individuales.
- **Creación de post:** Genera automáticamente el archivo PHP en `post/` con metadatos, variables de categoría/etiquetas e incluye header y footer.
- **Actualización de index.php:** Inserta el nuevo post **al principio de la lista** con el bloque HTML pre-diseñado y `target="_blank"`.
- **Generación de manifiesto:** Ejecuta `php generate_manifest.php` automáticamente para actualizar `posts_manifest.php`.
- **Redirección:** Redirige al usuario a la URL del post recién creado.
- **Manejo de errores:** Página HTML profesional con lista de errores descriptivos y enlace para volver al formulario.

### Manejo de errores y logging

- Configuración de errores PHP en `config.php` (`ini_set`, `error_reporting`).
- Log de errores en la raíz (`error_log.txt`).

### Mejoras visuales y rutas

- Rutas de CSS y JS corregidas para funcionar desde cualquier subdirectorio.
- Imágenes de masthead y Open Graph usan rutas absolutas basadas en `SITE_URL`.
- Todos los assets y dependencias se cargan correctamente en cualquier página.

### Google Analytics

- El código de Google Analytics (gtag.js) está incluido en el `<head>` de todas las páginas principales (`index.php`, `about.php`, `contact.php`, posts) mediante los headers correspondientes.
- El ID de seguimiento es `G-Y2V5THG16Y`.

### Estado actual

- Todos los archivos `.php` funcionan correctamente, con header, contenido y footer bien visualizados.
- No hay errores de sintaxis ni warnings de variables indefinidas.
- El sistema es modular y escalable para nuevos posts y páginas.
- Los archivos `.html` y el directorio `partials/` han sido eliminados.
- El header y footer ahora son universales y consistentes en todo el sitio.
- El formulario de contacto está presente pero requiere configuración SB Forms para funcionar.
- Sistema de categorización y etiquetado implementado: posts con categorías y etiquetas, manifiesto generado automáticamente, páginas de filtro por categoría y etiqueta.
- Sistema automático de creación de posts: formulario web, validación de campos, parsing de datos, creación de archivos PHP, actualización de index.php, generación de manifiesto automática.

---

## Cambios recientes y coherencia

- Eliminados todos los archivos `.html` y el directorio `partials/`.
- Todos los headers y footers ahora son PHP o HTML puro, no hay carga dinámica por JS.
- `about.php` y `contact.php` usan header HTML puro, no incluyen header_common.php.
- Google Analytics está presente en todas las páginas.
- Navegación y pie de página son universales y actualizados.
- Todos los posts tienen estructura y metadatos estandarizados.
- Documentación y estructura del proyecto actualizada para reflejar estos cambios.

---

## Próximos pasos recomendados

1. Completar contenido real en `about.php` y nuevos posts.
2. Configurar SB Forms para el formulario de contacto.
3. Agregar más artículos sobre béisbol usando el sistema automático en `crear-post-admin.php`.
4. Crear sitemap.xml y robots.txt.
5. Habilitar navegación global si se requiere.
6. Desplegar en servidor con dominio `meridiano.com`.
7. Integrar enlaces a categorías y etiquetas en los posts y en el index para mejorar la navegación.
8. Agregar funcionalidad de búsqueda si es necesario.
9. (Opcional) Agregar autenticación a `crear-post-admin.php` si se desea restringir el acceso.
10. (Opcional) Crear un panel de administración para listar, editar y eliminar posts.

---

**Esta documentación refleja el estado real y completo del proyecto a la fecha, y debe usarse como referencia para cualquier desarrollo, mejora o instrucción futura.**
