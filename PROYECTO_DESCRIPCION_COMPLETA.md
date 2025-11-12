# Documentación Técnica Completa - SimpleBlog (Meridiano Blog)

**Fecha de Documentación:** 12 de Noviembre de 2025  
**Versión del Proyecto:** 1.2 - MeridianoBlog SEO & Open Graph Update
**Rama Actual:** `mmb`  
**Rama Principal:** `main`

---

## 📋 Tabla de Contenidos

1. [Descripción General](#descripción-general)
2. [Cambios en v1.2](#cambios-en-v12---meridianoblog-seo--open-graph-update)
3. [Estructura de Directorios](#estructura-de-directorios)
4. [Descripción de Archivos](#descripción-de-archivos)
5. [Tecnologías Empleadas](#tecnologías-empleadas)
6. [Dependencias y Librerías](#dependencias-y-librerías)
7. [Configuración y Variables](#configuración-y-variables)
8. [Estado del Desarrollo](#estado-del-desarrollo)
9. [Instrucciones de Uso](#instrucciones-de-uso)

---

## 🎯 Cambios en v1.2 - MeridianoBlog SEO & Open Graph Update

### Resumen General
La versión 1.2 implementa **metadatos SEO y Open Graph completos** en todas las páginas HTML del proyecto para mejorar:
- Posicionamiento en motores de búsqueda (SEO)
- Vistas previas correctas en redes sociales (Open Graph)
- Compatibilidad con scrapers de redes sin JavaScript

### Cambios Principales Realizados

#### 1. **Actualización de Meta Tags SEO en Todas las Páginas**

Todas las páginas HTML ahora incluyen:
- `<meta name="description">` con contenido específico por página
- Atributo `lang="es"` en la etiqueta `<html>` (cambiado de `lang="en"`)
- Meta tags Open Graph completos (og:type, og:title, og:description, og:image, og:url, og:site_name)
- Twitter Cards configuradas (twitter:card, twitter:title, twitter:description, twitter:image)

#### 2. **Metadatos Open Graph Configurados**

Cada página ahora contiene las siguientes metaetiquetas:

```html
<meta property="og:type" content="...">
<meta property="og:title" content="...">
<meta property="og:description" content="...">
<meta property="og:image" content="https://meridiano.com/assets/img/...">
<meta property="og:url" content="https://meridiano.com/...">
<meta property="og:site_name" content="Meridiano Blog">
```

#### 3. **Twitter Cards Configuradas**

Todas las páginas incluyen Twitter Cards de tipo `summary_large_image`:

```html
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="...">
<meta name="twitter:description" content="...">
<meta name="twitter:image" content="https://meridiano.com/assets/img/...">
```

#### 4. **URLs Base Configuradas**

Todos los metadatos Open Graph y Twitter Cards ahora apuntan a **`https://meridiano.com`** como dominio base.

### Cambios por Página

#### **index.html**
- **Título:** "Meridiano Blog · Análisis de béisbol del Caribe"
- **Descripción:** "Meridiano Blog es un sitio dedicado al análisis del béisbol del Caribe y de las Grandes Ligas, con énfasis en la Liga Venezolana de Béisbol Profesional y otras ligas invernales."
- **og:type:** `website` (página principal)
- **og:image:** `https://meridiano.com/assets/img/home-bg.jpg`
- **Idioma:** `lang="es"`

#### **yadier-molina-magallanes-segunda-etapa.html**
- **Título:** "Yadier Molina y su ruta caribeña: el regreso del Capitán al Magallanes"
- **Descripción:** "Análisis del regreso de Yadier Molina al Magallanes, su trayectoria reciente en ligas caribeñas y su evolución como dirigente de élite."
- **og:type:** `article` (tipo artículo)
- **og:image:** `https://meridiano.com/assets/img/post-bg.jpg`
- **Idioma:** `lang="es"`
- **Scripts incluidos:** `js/gtag.js` para Google Analytics

#### **post.html**
- **Título:** "Ejemplo de entrada · Plantilla de artículo en Meridiano Blog"
- **Descripción:** "Plantilla de artículo de Meridiano Blog que muestra el formato de lectura, las imágenes y la estructura de los textos largos."
- **og:type:** `article`
- **og:image:** `https://meridiano.com/assets/img/post-sample-image.jpg`
- **Idioma:** `lang="es"`

#### **about.html**
- **Título:** "Sobre Meridiano Blog · Acerca del proyecto y su autor"
- **Descripción:** "Información sobre Meridiano Blog, su enfoque en el béisbol del Caribe y el perfil del autor que firma los análisis y artículos de opinión."
- **og:type:** `website`
- **og:image:** `https://meridiano.com/assets/img/about-bg.jpg`
- **Idioma:** `lang="es"`

#### **contact.html**
- **Título:** "Contacto · Escribe a Meridiano Blog"
- **Descripción:** "Formulario de contacto de Meridiano Blog para consultas, comentarios y propuestas relacionadas con el béisbol del Caribe y sus contenidos."
- **og:type:** `website`
- **og:image:** `https://meridiano.com/assets/img/contact-bg.jpg`
- **Idioma:** `lang="es"`

### Archivos Modificados

- ✅ `index.html` - 18 líneas agregadas
- ✅ `yadier-molina-magallanes-segunda-etapa.html` - 18 líneas agregadas (preserva gtag.js)
- ✅ `post.html` - 18 líneas agregadas
- ✅ `about.html` - 18 líneas agregadas
- ✅ `contact.html` - 18 líneas agregadas

**Total de cambios:** 75 líneas agregadas, 15 líneas modificadas

### Impacto

#### ✅ Mejoras en SEO
- Títulos únicos y descriptivos por página
- Descripciones meta específicas para cada contenido
- Metadatos estructurados para buscadores

#### ✅ Mejoras en Redes Sociales
- Al compartir un link en X/Twitter, Facebook o WhatsApp, se muestra:
  - Título del artículo/página
  - Descripción breve relevante
  - Imagen de vista previa
- Facilita viralización y engagement

#### ✅ Compatibilidad
- Los scrapers de redes sociales leen metadatos sin depender de JavaScript
- Funciona correctamente con bots de indexación
- Compatible con todas las redes sociales principales

#### ✅ Arquitectura Preservada
- Sin cambios en `partials/header.html` ni `partials/footer.html`
- Sin cambios en la lógica JavaScript de carga dinámica
- Sistema visual de header/footer reutilizable se mantiene intacto

### Commits Generados

1. **Commit 1:** `00c619c` - MeridianoBlog v1.2: Agregar metadatos SEO y Open Graph a todas las páginas HTML
   - Agregó todos los metadatos básicos con `TU_DOMINIO` como marcador

2. **Commit 2:** `764852b` - Reemplazar TU_DOMINIO por meridiano.com en todos los metadatos Open Graph
   - Reemplazó todas las instancias de `TU_DOMINIO` por `meridiano.com`
   - 15 referencias actualizadas

---

### Propósito del Proyecto

**SimpleBlog** (denominado **Meridiano Blog** en la interfaz de usuario) es una **plataforma de blog estática enfocada en contenido deportivo relacionado con béisbol**. Específicamente, el sitio se centra en artículos analíticos y de opinión sobre la **Liga Venezolana de Béisbol Profesional (LVBP)** y otros tópicos relacionados con el deporte de las Grandes Ligas y ligas caribeñas.

### Finalidad

- Publicar análisis detallados de eventos, jugadores y equipos de béisbol
- Proporcionar información sobre ligas profesionales caribeñas (LVBP, LBPRC, LIDOM)
- Funcionar como plataforma informativa sobre dirigentes, estrategia y tendencias del deporte

### Tecnología Principal

El proyecto es un **sitio web estático de una única página (SPA)** basado en:

- **HTML5** para estructura semántica del contenido
- **CSS3** (Bootstrap v5.2.3) para estilos y diseño responsivo
- **JavaScript Vanilla** para interactividad del navegador
- **Bootstrap Framework** como sistema de diseño y componentes

### Características Principales

- Diseño limpio y moderno inspirado en el tema "Clean Blog" de Start Bootstrap
- Sitio completamente responsivo para dispositivos móviles y escritorio
- Navegación simplificada (actualmente desactivada en el código)
- Sistema de publicación de artículos con vista previa en inicio
- Página de contacto con formulario (requiere configuración SB Forms)
- Página "About" con información personal
- Página de post de ejemplo con contenido extenso
- Página dedicada a artículos específicos de béisbol

---

## 🗂️ Estructura de Directorios

```
simpleblog/
├── index.html                                    # Página de inicio del blog (usa partials)
├── about.html                                    # Página "Acerca de mí" (usa partials)
├── contact.html                                  # Página de contacto (usa partials)
├── post.html                                     # Post de ejemplo/plantilla (usa partials)
├── yadier-molina-magallanes-segunda-etapa.html   # Artículo principal sobre Yadier Molina (usa partials)
├── README.md                                     # Archivo README minimal
├── PROYECTO_DESCRIPCION_COMPLETA.md              # Este archivo (documentación completa)
│
├── partials/
│   ├── header.html                              # Encabezado reutilizable (estructura base)
│   └── footer.html                              # Pie de página reutilizable
│
├── css/
│   └── styles.css                               # Estilos CSS (Bootstrap + personalizados)
│
├── js/
│   └── scripts.js                               # Script JavaScript para interactividad
│
└── assets/
    ├── favicon.ico                              # Icono del navegador
    └── img/
        ├── home-bg.jpg                          # Imagen de fondo - Inicio
        ├── about-bg.jpg                         # Imagen de fondo - About
        ├── contact-bg.jpg                       # Imagen de fondo - Contacto
        ├── post-bg.jpg                          # Imagen de fondo - Posts
        └── post-sample-image.jpg                # Imagen de contenido para posts
```

---

## 📄 Descripción de Archivos

### Archivos HTML

#### `index.html` - Página de Inicio
**Propósito:** Página principal del blog que muestra un listado de artículos publicados

**Contenido:**
- Usa `<div id="header"></div>` y `<div id="footer"></div>` para cargar los bloques comunes desde `partials/header.html` y `partials/footer.html` mediante JavaScript.
- La imagen y el título del header se personalizan dinámicamente en cada página tras la carga del fragmento.
- Sección de contenido principal con preview de posts
- Actualmente muestra una única vista previa del artículo de Yadier Molina
- Botón "Older Posts →" (funcionalidad no implementada)
- Footer con enlaces a redes sociales (Twitter, Facebook, GitHub)
- Copyright: "Copyright © Meridiano 2025"

**Dependencias:**
- Font Awesome 6.3.0 (iconografía)
- Google Fonts (Lora, Open Sans)
- Bootstrap 5.2.3 Bundle
- CSS personalizado (`css/styles.css`)
- JavaScript (`js/scripts.js`)

---

#### `about.html` - Página "Acerca de mí"
**Propósito:** Página informativa con detalles sobre el autor/blog

**Contenido:**
- Usa `<div id="header"></div>` y `<div id="footer"></div>` para cargar los bloques comunes desde `partials/header.html` y `partials/footer.html` mediante JavaScript.
- La imagen y el título del header se personalizan dinámicamente en cada página tras la carga del fragmento.
- Tres párrafos de Lorem ipsum (contenido placeholder)

**Estado Actual:** Contiene contenido placeholder. Los párrafos son de demostración y debería ser reemplazado con contenido real sobre el autor.

---

#### `contact.html` - Página de Contacto
**Propósito:** Permitir a los visitantes ponerse en contacto con el autor

**Contenido:**
- Usa `<div id="header"></div>` y `<div id="footer"></div>` para cargar los bloques comunes desde `partials/header.html` y `partials/footer.html` mediante JavaScript.
- La imagen y el título del header se personalizan dinámicamente en cada página tras la carga del fragmento.
- Formulario de contacto con los siguientes campos:
   - **Name:** Campo de texto (requerido)
   - **Email:** Campo de correo electrónico (requerido y validación de email)
   - **Phone Number:** Campo de teléfono (requerido)
   - **Message:** Área de texto grande (requerido)
- Botones de envío
- Secciones de éxito y error (ocultas por defecto)

**Nota Importante:** El formulario está integrado con **SB Forms** de Start Bootstrap, pero **requiere un token API para funcionar**. La línea que falta es:
```html
data-sb-form-api-token="API_TOKEN"
```
Este campo debe ser reemplazado por un token válido para que el formulario sea operativo.

**Estado Actual:** Formulario visualmente completo pero **no funcional sin configuración SB Forms**.

---

#### `post.html` - Post de Ejemplo/Plantilla
**Propósito:** Página plantilla para mostrar el formato de un artículo completo

**Contenido:**
- Usa `<div id="header"></div>` y `<div id="footer"></div>` para cargar los bloques comunes desde `partials/header.html` y `partials/footer.html` mediante JavaScript.
- La imagen y el título del header se personalizan dinámicamente en cada página tras la carga del fragmento.
- Artículo completo sobre viajes espaciales y exploración
- Incluye:
   - Múltiples párrafos de texto
   - Dos secciones con encabezados (h2)
   - Cita en bloque (blockquote)
   - Imagen embebida (`post-sample-image.jpg`)
   - Pie de foto (caption)

**Origen:** Contenido de demostración basado en citas y textos sobre exploración espacial.

---

#### `yadier-molina-magallanes-segunda-etapa.html` - Artículo Principal
**Propósito:** Artículo detallado y de contenido real sobre el regreso de Yadier Molina al Magallanes

**Contenido Resumido:**
- Usa `<div id="header"></div>` y `<div id="footer"></div>` para cargar los bloques comunes desde `partials/header.html` y `partials/footer.html` mediante JavaScript.
- La imagen y el título del header se personalizan dinámicamente en cada página tras la carga del fragmento.
- **Título:** "Yadier Molina y su ruta caribeña: el regreso del Capitán al Magallanes"
- **Subtítulo:** "La consolidación de un dirigente nacido del juego"
- **Fecha:** 8 de Noviembre de 2025

**Secciones Principales:**
1. **Introducción:** Anuncio del regreso de Molina a Magallanes para completar la temporada 2025-2026
2. **El regreso del Capitán:** Primer ciclo de Molina en Magallanes (2022-2023) con récord 29-27
3. **De Valencia a Caguas:** Experiencia como dirigente de Criollos de Caguas (campeón 2023-2024)
4. **Entre Santiago y la madurez:** Paso por Águilas Cibaeñas en LIDOM, nombrado Dirigente del Año
5. **El alma de la isla:** Dirección de la selección nacional de Puerto Rico (Clásico Mundial 2023 y 2026)
6. **Un puente entre generaciones:** Rol como asesor de Cardinals de San Luis
7. **El dirigente como espejo:** Análisis de su estilo directivo
8. **De regreso al Caribe profundo:** Detalles del contrato actual
9. **Un currículo caribeño de peso:** Resumen de logros
10. **El cierre de un ciclo, el inicio de otro:** Reflexión final

**Características de Contenido:**
- Análisis profundo de carrera deportiva
- Referencias a medios de comunicación (LVBP.com, ESPN, Listín Diario, Diario Libre)
- Citas directas que capturan el pensamiento del dirigente
- Datos estadísticos y cronológicos
- Contexto de ligas latinoamericanas (LVBP, LBPRC, LIDOM)

**Longitud:** Artículo extenso con aproximadamente 3,500+ palabras

---

### Archivos CSS

#### `css/styles.css` - Hoja de Estilos Principal
**Tamaño:** ~10,798 líneas  
**Origen:** Bootstrap 5.2.3 + Custom Theme "Clean Blog"

**Contenido:**

1. **Variables CSS (Custom Properties):**
   - Colores primarios y secundarios
   - Fuentes del sistema y monoespaciadas
   - Propiedades de espaciado y bordes
   - Paleta completa de colores Bootstrap

2. **Reset CSS y Normalize:**
   - Estilos base para elementos HTML5
   - Configuración de fuentes
   - Normalización de márgenes y paddings

3. **Sistema de Grilla (Grid):**
   - Contenedor responsive (.container, .container-fluid)
   - Sistema de columnas (col-1 a col-12)
   - Breakpoints: sm (576px), md (768px), lg (992px), xl (1200px), xxl (1400px)
   - Gutters y offsets

4. **Componentes Bootstrap:**
   - Tipografía (h1-h6, .display-1 a .display-6)
   - Listas y bloques de cita
   - Tablas
   - Formularios y controles
   - Botones
   - Cards, badges, alerts
   - Navbars
   - Modales y carousels

5. **Tema Clean Blog Personalizado:**
   - Color primario: Teal (#0085A1)
   - Fuentes personalizadas para headings (Open Sans) y body (Lora)
   - Estilos de headers masthead
   - Estilos para posts y previsualizaciones
   - Estilos de footer

**Tecnologías Utilizadas:**
- CSS3 Moderno
- CSS Variables (Custom Properties)
- Media Queries para Responsive Design
- Flexbox
- Grid Layout

---

### Archivos JavaScript

#### `js/scripts.js` - Script Principal
**Tamaño:** Pequeño (~40 líneas)  
**Origen:** Start Bootstrap - Clean Blog Theme

**Funcionalidad:**

```javascript
Evento: DOMContentLoaded
Objetivo: Manejar la navegación flotante en scroll
```

**Detalle de Lógica:**

1. **Scroll Position Tracking:**
   - Detecta la posición actual del scroll
   - Compara con la posición previa

2. **Navbar Behavior:**
   - Obtiene altura del navbar (#mainNav)
   - Clasifica scroll en dos direcciones:
     - **Scrolling Up (hacia arriba):** Muestra navbar con clase `.is-visible`
     - **Scrolling Down (hacia abajo):** Oculta navbar y agrega clase `.is-fixed`

3. **Clases Aplicadas:**
   - `.is-fixed` - Fija el navbar cuando se desplaza hacia abajo
   - `.is-visible` - Muestra el navbar cuando se desplaza hacia arriba

**Estado Actual:** Contiene comentario de depuración (`console.log(123)`) que indica desarrollo incompleto

---

#### `js/gtag.js` - Google Analytics Global
**Propósito:** Rastreo de analítica global para todo el sitio. Este archivo contiene la configuración de Google Analytics y se carga automáticamente en todas las páginas a través del fragmento `partials/header.html`.

**Inclusión:**
```html
<script src="js/gtag.js"></script>
```

**Estado Actual:** Configurado para cargar el script oficial y la inicialización de Google Analytics. El ID de seguimiento debe ser personalizado según el proyecto.

---

### Archivo README

#### `README.md`
**Contenido:** Minimal, solo contiene:
```markdown
# simpleblog
```

**Estado:** Archivo básico sin información completa del proyecto

---

### Archivos de Configuración

#### `assets/favicon.ico`
**Propósito:** Icono del sitio que aparece en la pestaña del navegador  
**Formato:** ICO (estándar web)

---

### Archivos de Medios

#### Carpeta `assets/img/` - Imágenes
**Cantidad de archivos:** 5 imágenes JPG

| Archivo | Propósito | Ubicación en Uso |
|---------|-----------|------------------|
| `home-bg.jpg` | Imagen de fondo (header) | index.html |
| `about-bg.jpg` | Imagen de fondo (header) | about.html |
| `contact-bg.jpg` | Imagen de fondo (header) | contact.html |
| `post-bg.jpg` | Imagen de fondo (header) | post.html, yadier-molina-magallanes-segunda-etapa.html |
| `post-sample-image.jpg` | Imagen embebida en contenido | post.html, yadier-molina-magallanes-segunda-etapa.html |

**Tipo de Contenido:** Imágenes decorativas de fondo y contenido

---

## 🛠️ Tecnologías Empleadas

### Frontend

| Tecnología | Versión | Propósito |
|-----------|---------|----------|
| **HTML5** | - | Estructura semántica del documento |
| **CSS3** | - | Estilos y diseño responsivo |
| **JavaScript** | ES6 | Interactividad del cliente |
| **Bootstrap** | 5.2.3 | Framework CSS y componentes |
| **Font Awesome** | 6.3.0 | Librería de iconos |
| **Google Fonts** | - | Tipografía personalizada |

### Herramientas de Desarrollo

- **Git** - Control de versiones
- **GitHub** - Hosting del repositorio (usuario: `paginaviva`, repo: `simpleblog`)
- **VS Code** - Editor de código (inferido por workspace)

### Servidores/Servicios Externos (Opcionales)

- **SB Forms** (Start Bootstrap) - Procesamiento de formularios (no configurado)
- **CDN jsDelivr** - Distribución de Bootstrap y dependencias

---

## 📦 Dependencias y Librerías

### Dependencias Externas Cargadas desde CDN

#### 1. Font Awesome Icons (v6.3.0)
```html
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
```
**Propósito:** Proporcionar iconos para redes sociales (Twitter, Facebook, GitHub)

#### 2. Google Fonts
```html
<link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" />
```
**Propósito:** Tipografía personalizada
- **Lora:** Para body text (peso 400, 700)
- **Open Sans:** Para headings (múltiples pesos)

#### 3. Bootstrap 5.2.3 Bundle
```html
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
```
**Propósito:** Framework JavaScript de Bootstrap para componentes interactivos

#### 4. SB Forms (Opcional)
```html
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
```
**Nota:** Presente en `contact.html` pero requiere configuración

### Archivos Locales

- `css/styles.css` - Estilos compilados de Bootstrap + tema personalizado
- `js/scripts.js` - JavaScript personalizado para interactividad

---

## ⚙️ Configuración y Variables

### Meta Tags Configurados

Todos los archivos HTML ahora contienen:

```html
<!-- Meta Tags SEO -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="Descripción específica de cada página" />
<meta name="author" content="" />

<!-- Título Único por Página -->
<title>Título específico de la página</title>

<!-- Open Graph para Redes Sociales -->
<meta property="og:type" content="website|article">
<meta property="og:title" content="...">
<meta property="og:description" content="...">
<meta property="og:image" content="https://meridiano.com/assets/img/...">
<meta property="og:url" content="https://meridiano.com/...">
<meta property="og:site_name" content="Meridiano Blog">

<!-- Twitter Cards -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="...">
<meta name="twitter:description" content="...">
<meta name="twitter:image" content="https://meridiano.com/assets/img/...">
```

**Cambios Clave:**
- ✅ `lang="es"` en lugar de `lang="en"`
- ✅ Descripciones meta específicas (no vacías)
- ✅ Títulos únicos y descriptivos
- ✅ Metadatos Open Graph completos con URLs absolutas
- ✅ Twitter Cards configuradas
- ✅ Dominio centralizado: `meridiano.com`

### Colores Primarios (Bootstrap Variables)

- **Primary:** `#0085A1` (Teal)
- **Secondary:** `#6c757d` (Gray)
- **Success:** `#198754`
- **Danger:** `#dc3545`

### Variables de Breakpoints (Responsive)

- **SM:** 576px
- **MD:** 768px
- **LG:** 992px
- **XL:** 1200px
- **XXL:** 1400px

---

## 📊 Estado del Desarrollo

### Completitud del Proyecto

| Aspecto | Estado | Observaciones |
|--------|--------|---------------|
| Estructura Base | ✅ Completado | Todos los archivos HTML están bien formados |
| Diseño Responsivo | ✅ Completado | Bootstrap 5 implementado correctamente |
| Contenido de Inicio | ✅ Completado | Página index.html lista con preview de posts |
| Artículos | ⚠️ Parcial | Un artículo real (Yadier Molina), dos placeholders (post.html, about.html) |
| Formulario de Contacto | ⚠️ Incompleto | Forma visual presente pero no funcional (requiere token API SB Forms) |
| Navegación | ⚠️ Desactivada | Código presente pero comentado en todos los archivos |
| SEO | ✅ Completado | Meta descriptions específicas, títulos únicos, Open Graph configurado (v1.2) |
| Open Graph | ✅ Completado | Todas las páginas incluyen metadatos Open Graph y Twitter Cards (v1.2) |
| Footer | ✅ Completado | Links a redes sociales funcionales (placeholders) |
| Refactorización estructural | ✅ Completado | Header y footer extraídos a partials/header.html y partials/footer.html, cargados dinámicamente en cada página |
| Idioma | ✅ Completado | Cambiado a `lang="es"` en todas las páginas (v1.2) |

### Archivos Incompletos o con Marcadores de TODO

1. **`about.html`** - Contiene Lorem ipsum placeholder
2. **`post.html`** - Artículo de ejemplo sin contenido real
3. **`contact.html`** - Requiere configuración API de SB Forms para funcionar
4. **Navegación Global** - Código comentado en todos los archivos HTML:
   ```html
   <!-- <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
       ... código comentado ...
   </nav> -->
   ```
   **Posible razón:** Simplificación visual o desarrollo incompleto

5. **`js/scripts.js`** - Contiene `console.log(123)` indicando desarrollo incompleto
6. **Carga dinámica de partials:** Todas las páginas principales usan un script JS para cargar los fragmentos de header y footer, y personalizar el contenido visual de cada header.

---

## 📖 Instrucciones de Uso

### Visualización del Sitio

#### Opción 1: Servidor Local Simple
```bash
# Desde la raíz del proyecto
python3 -m http.server 8000
# O con Python 2
python -m SimpleHTTPServer 8000

# Luego acceder a: http://localhost:8000
```

#### Opción 2: Con Live Server (VS Code)
1. Instalar extensión "Live Server"
2. Click derecho en `index.html`
3. Seleccionar "Open with Live Server"

#### Opción 3: Servidor Apache/Nginx
- Copiar archivos a documentroot del servidor
- Acceder al dominio configurado

### Navegación del Sitio

**Páginas disponibles:**
- `/index.html` - Inicio (página principal)
- `/about.html` - Acerca de mí
- `/contact.html` - Contacto
- `/post.html` - Post de ejemplo
- `/yadier-molina-magallanes-segunda-etapa.html` - Artículo principal

### Personalización

#### Cambiar Colores Primarios
Editar variables CSS en `css/styles.css`:
```css
:root {
  --bs-primary: #0085A1;  /* Cambiar color primario */
  --bs-secondary: #6c757d; /* Cambiar color secundario */
}
```

#### Agregar Nuevos Artículos
1. Crear archivo `.html` en raíz del proyecto
2. Usar plantilla de `post.html` o `yadier-molina-magallanes-segunda-etapa.html`
3. Actualizar preview en `index.html`

#### Habilitar Navegación
Descommentar código HTML de navegación en todos los archivos:
```html
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <!-- ... contenido ... -->
</nav>
```

#### Configurar Formulario de Contacto
1. Registrarse en https://startbootstrap.com/solution/contact-forms
2. Obtener API token
3. Reemplazar en `contact.html`:
```html
data-sb-form-api-token="TU_TOKEN_AQUI"
```

---

## 📝 Información de Repositorio

### Git Information
- **Propietario:** paginaviva
- **Nombre del Repositorio:** simpleblog
- **Rama Actual:** mmb (Main branch)
- **Rama Principal:** main
- **Plataforma:** GitHub

### Historial de Commits Recientes (v1.2)

1. **764852b** - `Reemplazar TU_DOMINIO por meridiano.com en todos los metadatos Open Graph`
   - 5 archivos modificados
   - 15 referencias actualizadas a `meridiano.com`

2. **00c619c** - `MeridianoBlog v1.2: Agregar metadatos SEO y Open Graph a todas las páginas HTML`
   - 5 archivos modificados
   - 75 líneas agregadas
   - 15 líneas modificadas

3. **f5309ff** - `Actualización integral: documentación técnica, cambios en HTML y nuevos archivos`
   - Rama: `origin/mmb`

4. **dc70629** - `Eliminar post 'Man must explore' de la home page`
   - Rama: `origin/main`

---

## 🔍 Análisis Técnico Adicional

### Performance

- **Tamaño CSS:** ~10,798 líneas (Bootstrap completo)
- **Tamaño JS:** ~40 líneas (muy ligero)
- **Dependencias CDN:** 4 (Font Awesome, Google Fonts, Bootstrap, SB Forms)
- **Formato Imagen:** JPG (comprimido)

### Accesibilidad (WCAG)

- ✅ Meta viewport configurado
- ✅ Charset UTF-8 declarado
- ✅ Lenguaje HTML declarado (`lang="en"`)
- ⚠️ Atributos alt no declarados para imágenes
- ⚠️ Contrastes de color no validados

### SEO

- ✅ Meta descriptions específicas y completas por página (v1.2)
- ✅ Etiquetas h1 bien estructuradas
- ✅ Open Graph metadatos configurados (v1.2)
- ✅ Twitter Cards implementadas (v1.2)
- ✅ Idioma HTML configurado a `lang="es"` (v1.2)
- ⚠️ Sitemap.xml no presente
- ⚠️ robots.txt no presente
- ✅ Estructura HTML semántica

### Compatibilidad de Navegadores

El proyecto utiliza tecnologías modernas pero compatibles:
- Chrome/Edge: ✅ Compatible
- Firefox: ✅ Compatible
- Safari: ✅ Compatible
- IE 11: ⚠️ Parcialmente compatible (Bootstrap 5 requiere ES6)

---

## ❓ Preguntas Frecuentes y Resolución de Problemas

## ❓ Preguntas Frecuentes y Resolución de Problemas

### ¿Qué cambios se realizaron en v1.2?
Se agregaron **metadatos SEO y Open Graph completos** a todas las páginas HTML para mejorar el posicionamiento en buscadores y las vistas previas en redes sociales. Incluye:
- Títulos únicos y descriptivos
- Descripciones meta específicas
- Metadatos Open Graph (og:type, og:title, og:description, og:image, og:url, og:site_name)
- Twitter Cards (twitter:card, twitter:title, twitter:description, twitter:image)
- Idioma cambiado a `lang="es"`

### ¿Cómo se ven las vistas previas en redes sociales?
Ahora, al compartir un link en X/Twitter, Facebook o WhatsApp, se muestra automáticamente:
- **Título:** Específico de cada página (ej: "Yadier Molina y su ruta caribeña...")
- **Descripción:** Resumen breve del contenido
- **Imagen:** Imagen de vista previa relevante (ej: post-bg.jpg para artículos)
- **Dominio:** meridiano.com

### ¿Por qué el formulario de contacto no funciona?
El formulario requiere un token API de SB Forms. Sin él, solo muestra la interfaz pero no procesa datos.

### ¿Cómo agrego más artículos?
Crea nuevos archivos `.html` con la estructura de `yadier-molina-magallanes-segunda-etapa.html` y actualiza los previews en `index.html`. Asegúrate de incluir los metadatos Open Graph específicos del nuevo artículo.

### ¿Por qué la navegación está oculta?
El código de navegación está comentado en todos los archivos. Descommentalo para habilitarla.

### ¿Necesito Node.js o npm?
No. Este es un proyecto 100% estático, no requiere build tools ni dependencias de npm.

### ¿Cómo configuro el dominio final?
Si quieres cambiar de `meridiano.com` a otro dominio, busca y reemplaza en todos los archivos HTML:
- `og:url` 
- `og:image`
- `twitter:image`

---

## 📌 Notas Finales

Este proyecto es un **blog estático moderno enfocado en contenido deportivo de béisbol**, construido con tecnologías web estándar. La arquitectura es simple y directa, ideal para un blog personal o de nicho temático. 

### Estado Actual (v1.2)

El proyecto se encuentra en etapa de **desarrollo avanzado con optimización SEO completa**, incluyendo:

- ✅ Estructura HTML semántica y responsiva
- ✅ Diseño moderno con Bootstrap 5
- ✅ Metadatos SEO y Open Graph configurados
- ✅ Soporte para redes sociales (Twitter, Facebook, WhatsApp)
- ✅ Sistema de partials reutilizables (header/footer)
- ✅ Carga dinámica de componentes visuales
- ⚠️ Contenido real parcial (1 artículo completo, 2 placeholders)
- ⚠️ Formulario de contacto requiere token API

**Próximos pasos recomendados:**
1. Completar contenido de páginas (about.html, post.html)
2. Configurar SB Forms para formulario funcional
3. Agregar más artículos sobre béisbol
4. Crear sitemap.xml y robots.txt
5. Habilitar navegación global
6. Configurar Google Analytics con ID real
7. Desplegar en servidor con dominio `meridiano.com`

**Última actualización de documentación:** 12 de Noviembre de 2025 (v1.2)

---

*Documentación actualizada para reflejar cambios de MeridianoBlog v1.2 - SEO & Open Graph Update*
