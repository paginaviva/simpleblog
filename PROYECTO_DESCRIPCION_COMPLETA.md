# Documentación Técnica Completa - SimpleBlog (Meridiano Blog)

**Última actualización:** 18 de Noviembre de 2025  
**Versión del Proyecto:** 2.5 - Sistema en Producción (30+ posts activos, UI mejorada)  
**Rama Actual:** `mmb`  
**Rama Principal:** `main`  
**Ambiente:** Producción (udn_meridiano_com)

---

## ⚠️ Estado y transición

> **El proyecto ha migrado completamente de HTML estático y partials JS a una arquitectura PHP modular. Toda la documentación previa sobre archivos `.html`, partials, y carga dinámica por JavaScript queda obsoleta.**

---

## 🎯 Explicación unificada del funcionamiento completo

### Flujo de datos y relaciones entre componentes

El proyecto SimpleBlog funciona con tres flujos principales que se integran entre sí:

#### **1. Flujo de visualización (acceso a la web)**

```
Usuario visita https://www.meridiano.com/
    ↓
index.php (cargado)
    ├─ Incluye: config.php (constantes globales)
    ├─ Incluye: header_index.php
    │   ├─ Define metadatos SEO
    │   ├─ Carga Google Analytics
    │   ├─ Define masthead estático
    │   └─ Incluye: menu.php (navegación)
    ├─ Muestra lista de posts (30+) con estructura estándar
    │   ├─ Cada preview tiene: título, subtítulo, autor, fecha
    │   └─ Cada preview es un enlace a /post/nombre-archivo.php
    ├─ Incluye: footer.php (pie de página + scripts)
    └─ Página renderizada en navegador
```

**Cuando usuario hace clic en un post:**
```
Usuario clic en post preview en index.php
    ↓
Navegador abre /post/nombre-archivo.php
    ↓
nombre-archivo.php (archivo individual del post)
    ├─ Define variables: $page_title, $og_image, $category, $tags, etc.
    ├─ Incluye: config.php
    ├─ Incluye: header_common.php
    │   ├─ Lee variables definidas anteriormente
    │   ├─ Genera metadatos dinámicos con esas variables
    │   ├─ Carga Google Analytics
    │   └─ Incluye: menu.php
    ├─ Muestra contenido HTML del post
    ├─ Incluye: footer.php
    └─ Página de post renderizada
```

#### **2. Flujo de creación de posts (admin)**

```
Admin/Usuario visita /crear-post-admin.php
    ↓
crear-post-admin.php (formulario Bootstrap)
    ├─ Muestra textarea grande
    ├─ Usuario pega bloque [DATOS_DOCUMENTO] completo
    └─ Usuario hace clic "Crear Post"
    ↓
Envío POST a procesar-post.php
    ↓
procesar-post.php (procesamiento)
    ├─ Validación: recibe datos POST
    ├─ Parsing: extrae secciones [HEAD], [CABECERA_VISUAL], [CONTENIDO], [CATEGORIAS], [ETIQUETAS]
    ├─ Limpieza: remueve caracteres especiales, procesa URLs markdown
    ├─ Validación: verifica que TODOS los campos obligatorios existan
    ├─ Si hay errores: muestra página HTML con lista de errores + botón volver
    ├─ Generación de código PHP: crea string con código PHP del nuevo post
    │   ├─ Variables: $page_title, $og_image, $category, $tags, etc.
    │   ├─ Estructura: define variables + incluye header_common.php + contenido HTML + incluye footer.php
    │   └─ Archivo guardado en: /post/nombre-archivo.php
    ├─ Actualización de index.php:
    │   ├─ Lee contenido actual de index.php
    │   ├─ Genera bloque HTML del nuevo post
    │   │   ├─ Fecha: automática con date('d \d\e F \d\e Y')
    │   │   ├─ Autor: hardcoded "Redacción Meridiano BB"
    │   │   └─ Link: usa <?php echo POST_DIR; ?> + nombre archivo
    │   ├─ Inserta el nuevo post al principio de la lista
    │   └─ Guarda index.php actualizado
    ├─ Regeneración de manifest: ejecuta generate_manifest.php
    │   ├─ Escanea todos los archivos en /post/
    │   ├─ Para cada post: incluye el archivo para leer sus variables
    │   ├─ Extrae: título, subtítulo, categoría, etiquetas, fecha, autor, imagen
    │   ├─ Genera array $posts con todos los metadatos
    │   └─ Guarda en posts_manifest.php
    └─ Redirección: envía usuario a /post/nombre-archivo.php del post recién creado
```

#### **3. Flujo de categorización y etiquetado**

```
Usuario visita /category.php?name=LVBP
    ↓
category.php (filtrado por categoría)
    ├─ Incluye: config.php
    ├─ Incluye: header_index.php
    ├─ Lee parámetro URL: name=LVBP
    ├─ Incluye: posts_manifest.php
    │   └─ Accede al array $posts con metadatos de TODOS los posts
    ├─ Filtra: busca posts donde $category === "LVBP"
    ├─ Renderiza: solo los posts que coinciden con la categoría
    ├─ Incluye: footer.php
    └─ Página con posts filtrados por categoría
```

**De forma similar:**
```
Usuario visita /tag.php?name=Leones-del-Caracas
    ↓
tag.php filtra posts
    ├─ Lee parámetro URL: name=Leones-del-Caracas
    ├─ Incluye: posts_manifest.php (obtiene array $posts)
    ├─ Filtra: busca posts donde "Leones del Caracas" esté en array $tags
    └─ Renderiza solo esos posts
```

### Relación entre componentes de estructura

```
┌─────────────────────────────────────────────────────────────┐
│                     config.php (Configuración)              │
│  Constantes globales: SITE_DIR, SITE_URL, POST_DIR, etc.   │
│  Incluido por: TODOS los archivos                           │
└─────────────────────────────────────────────────────────────┘
         ↑                    ↑                    ↑
         │                    │                    │
    ┌────────────┐      ┌──────────────┐    ┌──────────────┐
    │ index.php  │      │ /post/*.php  │    │category.php  │
    │            │      │ (posts)      │    │tag.php       │
    │ Incluye:   │      │ Incluye:     │    │ Incluye:     │
    │- config.php│      │- config.php  │    │- config.php  │
    │- header_   │      │- header_     │    │- header_     │
    │  index.php │      │  common.php  │    │  index.php   │
    │- footer.php│      │- footer.php  │    │- footer.php  │
    └────────────┘      └──────────────┘    └──────────────┘
         ↓                      ↓                    ↓
      ┌─────────────────────────────────────────────────┐
      │  menu.php (Navegación - incluido por headers)   │
      │  Presente en: index, posts, category, tag       │
      └─────────────────────────────────────────────────┘
```

### Relación entre headers y footers

```
TIPO DE PÁGINA              HEADER USADO          FOOTER USADO
├─ Homepage (index.php)   → header_index.php  →  footer.php
├─ Posts (/post/*.php)    → header_common.php →  footer.php
├─ Categoría (category)   → header_index.php  →  footer.php
├─ Tags (tag.php)         → header_index.php  →  footer.php
├─ About (about.php)      → header_index.php  →  footer.php
└─ Contact (contact.php)  → header_index.php  →  footer.php

Diferencia clave:
- header_index.php: HTML puro, masthead ESTÁTICO (mismo en todas las páginas)
- header_common.php: PHP dinámico, lee variables $post_title, $post_subtitle, $masthead_bg
                     (permite masthead DIFERENTE por página)
```

### Flujo de datos del sistema completo

```
1. CREACIÓN DE POSTS
   Usuario → crear-post-admin.php → procesar-post.php → 
   ├─ Crea /post/nuevo-post.php
   ├─ Actualiza index.php con preview
   └─ Regenera posts_manifest.php
   
2. VISUALIZACIÓN EN HOMEPAGE
   Usuario → index.php → muestra 30+ previews → user clicks → /post/archivo.php

3. NAVEGACIÓN POR CATEGORÍA
   Usuario → category.php?name=LVBP → lee posts_manifest.php → filtra → renderiza

4. NAVEGACIÓN POR ETIQUETA
   Usuario → tag.php?name=Etiqueta → lee posts_manifest.php → filtra → renderiza

5. GOOGLE ANALYTICS
   En TODOS los headers: código gtag.js (G-Y2V5THG16Y)
   Rastrea: homepage, posts, categorías, etiquetas
```

### Rol de posts_manifest.php

El archivo `posts_manifest.php` es el **corazón de la inteligencia de navegación**:

```php
// Generado automáticamente por generate_manifest.php
$posts = [
    'nombre-post-1' => [
        'titulo' => '...',
        'subtitulo' => '...',
        'categoria' => 'LVBP',
        'etiquetas' => ['Leones', 'Caracas'],
        'fecha' => '18 de Noviembre de 2025',
        'autor' => 'Redacción Meridiano BB',
        'imagen_og' => '...',
        'url' => '/post/nombre-post-1.php'
    ],
    // ... 29+ posts más
];
```

**Usado por:**
- `category.php`: Filtra por `$posts[$key]['categoria']`
- `tag.php`: Busca en `$posts[$key]['etiquetas']` array
- Potencialmente: búsqueda, sitemap.xml dinámico, RSS feeds

---

## 🆕 Arquitectura y estructura actual

### Estructura de directorios
```
simpleblog/
├── index.php
├── about.php
├── contact.php
├── post.php
├── config.php (SITE_DIR: /home/udcwscico/public_html/udn_meridiano_com/)
├── header_common.php
├── header_index.php
├── footer.php
├── menu.php
├── post/  (30+ posts activos)
│   ├── gabriel-arias-pausa-guaira-reconfigura-libreto-diciembre.php
│   ├── semana-5-resumen-analitico-lvbp-naufragio-turco-vuelo-zulia.php
│   ├── balbino-fuenmayor-semana-poder-reescribe-pulso-ofensivo-lvbp.php
│   ├── chinita-2025-aguilas-bravos-punta-maracaibo.php
│   ├── festival-batazos-puerto-la-cruz-tiburones-victoria-historica-caribes.php
│   ├── [... 25+ posts más ...]
│   └── post_plantilla.php
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
│       └── [imágenes de posts...]
├── error_log.txt
├── posts_manifest.php (generado automáticamente con 30+ posts)
├── generate_manifest.php
├── category.php
├── tag.php
├── crear-post-admin.php
├── procesar-post.php
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
- **crear-post-admin.php**: Formulario web para crear nuevos posts (abierto al público). Permite pegar el bloque `[DATOS_DOCUMENTO]` completo. UI mejorada con label arriba del textarea, campo ocupando 100% del ancho, altura optimizada (510px = 15% menos) para mejor adaptación a pantalla.
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

- **Sistema operativo en producción**: Todos los archivos `.php` funcionan correctamente en servidor live.
- **30+ posts activos creados** mediante el sistema automático `crear-post-admin.php` → `procesar-post.php`.
- **Manifiesto actualizado**: `posts_manifest.php` generado automáticamente con metadatos de todos los posts.
- **Index.php dinámico**: Muestra posts ordenados por fecha (más recientes primero).
- **Categorización funcional**: Todos los posts tienen categoría y etiquetas asignadas.
- **Config actualizado**: Rutas de producción configuradas (`SITE_DIR`, `SITE_URL`).
- **No hay errores de sintaxis** ni warnings de variables indefinidas.
- **Sistema modular y escalable**: Nuevos posts se crean sin modificación de código base.
- **Los archivos `.html` y `partials/` han sido eliminados** completamente.
- **Header y footer universales** y consistentes en todo el sitio.
- **Google Analytics activo** en todas las páginas (`G-Y2V5THG16Y`).

### Issues identificados y pendientes de corrección

- **Rutas de imagen con parentesis extras**: Algunos archivos de posts generados tienen rutas como `.jpg)` en lugar de `.jpg`
- **Rutas duplicadas en rutas de imagen**: `assets/img/assets/img/post-bg.jpg` en lugar de `assets/img/post-bg.jpg`
- **Necesita ajuste del parser en `procesar-post.php`** para manejar mejor URLs en formato markdown dentro de los datos de entrada

---

## Cambios recientes y coherencia

- **UI mejorada en crear-post-admin.php**:
  - Label "Bloque [DATOS_DOCUMENTO]:" posicionado arriba del textarea
  - Campo textarea con width 100% y box-sizing: border-box para ocupar todo el ancho disponible
  - Altura reducida de 600px a 510px (15% menos) para mejor adaptación a pantalla
  - Alineación consistente con el recuadro azul de instrucciones
- **Sistema de creación de posts operativo**: 30+ posts creados exitosamente usando `crear-post-admin.php`.
- **Manifiesto dinámico**: `posts_manifest.php` se regenera automáticamente con cada nuevo post.
- **Index.php actualizado dinámicamente**: Nueva estructura usando `POST_DIR` variable y enlaces con `target="_blank"`.
- **Configuración de producción**: `config.php` apunta a rutas reales del servidor (`SITE_DIR`, `SITE_URL`).
- **Categorización funcional**: Todos los posts tienen categorías y etiquetas asignadas.
- **Todas las páginas con metadatos SEO**: Open Graph, Twitter Cards y metadatos estándar en todos los posts.
- **Google Analytics activo**: Implementado en todas las páginas.
- **Documentación y estructura actualizada** para reflejar estado de producción.

---

## Próximos pasos recomendados

1. **Corregir rutas de imágenes** en `procesar-post.php` (remover parentesis extras y duplicaciones de path).
2. **Mejorar el parser** para URLs en formato markdown `[texto](url)`.
3. **Implementar caché de manifest** si el número de posts crece significativamente.
4. **Agregar validación de imagen** (verificar que exista en `/assets/img/`).
5. **Crear página de administración** para editar, eliminar y listar posts.
6. **Agregar autenticación** a `crear-post-admin.php` para restricción de acceso.
7. **Implementar búsqueda de posts** en el sitio.
8. **Crear sitemap.xml y robots.txt** dinámicos basados en `posts_manifest.php`.
9. **Optimizar imágenes** de posts automáticamente en `procesar-post.php`.
10. **Agregar sistema de etiquetas en index.php** para filtrado en frontend (opcional: con JavaScript o server-side).

---

---

**Esta documentación refleja el estado real y completo del proyecto a fecha 18 de Noviembre de 2025, en ambiente de producción con 30+ posts activos, sistema automático de creación operativo y UI optimizada. Debe usarse como referencia para cualquier desarrollo, mejora o instrucción futura.**

### Conocimiento del proyecto adquirido:
- ✓ Sistema PHP modular 100% operativo en producción
- ✓ Creación automática de posts funcional con parsing inteligente
- ✓ Manifiesto dinámico generado automáticamente
- ✓ Categorización y etiquetado de posts activo
- ✓ Configuración de rutas absolutas para servidor
- ✓ Google Analytics implementado
- ✓ 30+ posts en directorio /post/ con estructura estándar
- ✓ UI mejorada en formulario de creación (crear-post-admin.php)
- ⚠️ Issues menores en URLs de imagen a corregir

````
