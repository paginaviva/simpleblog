# Documentación Técnica Completa - SimpleBlog (Meridiano Blog)

**Fecha de Documentación:** 12 de Noviembre de 2025  
**Versión del Proyecto:** 1.2  
**Rama Actual:** `mmb`  
**Rama Principal:** `main`

---

## 📋 Tabla de Contenidos

1. [Descripción General](#descripción-general)
2. [Estructura de Directorios](#estructura-de-directorios)
3. [Descripción de Archivos](#descripción-de-archivos)
4. [Tecnologías Empleadas](#tecnologías-empleadas)
5. [Dependencias y Librerías](#dependencias-y-librerías)
6. [Configuración y Variables](#configuración-y-variables)
7. [Estado del Desarrollo](#estado-del-desarrollo)
8. [Instrucciones de Uso](#instrucciones-de-uso)

---

## 📖 Descripción General

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

Todos los archivos HTML contienen:

```html
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
```

**Estado:** Los campos `description` y `author` están vacíos en la mayoría de archivos, excepción en `yadier-molina-magallanes-segunda-etapa.html`:
```html
<meta name="description" content="Yadier Molina regresa al Magallanes para su segunda etapa como dirigente" />
```

### Títulos de Página

Todos los archivos usan:
```html
<title>Meridiano Blog</title>
```

**Nota:** No personalizado por página individual

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
| SEO | ⚠️ Mínimo | Meta descriptions vacías excepto un archivo |
| Footer | ✅ Completado | Links a redes sociales funcionales (placeholders) |
| Refactorización estructural | ✅ Completado | Header y footer extraídos a partials/header.html y partials/footer.html, cargados dinámicamente en cada página |

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

### Historial de Commits
No se encontró información válida o pública al respecto sobre el historial de commits específico, ya que solo se proporcionó acceso al código actual.

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

- ⚠️ Meta descriptions incompletas
- ⚠️ Etiquetas h1 bien estructuradas
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

### ¿Por qué el formulario de contacto no funciona?
El formulario requiere un token API de SB Forms. Sin él, solo muestra la interfaz pero no procesa datos.

### ¿Cómo agrego más artículos?
Crea nuevos archivos `.html` con la estructura de `yadier-molina-magallanes-segunda-etapa.html` y actualiza los previews en `index.html`.

### ¿Por qué la navegación está oculta?
El código de navegación está comentado en todos los archivos. Descommentalo para habilitarla.

### ¿Necesito Node.js o npm?
No. Este es un proyecto 100% estático, no requiere build tools ni dependencias de npm.

---

## 📌 Notas Finales

Este proyecto es un **blog estático moderno enfocado en contenido deportivo de béisbol**, construido con tecnologías web estándar. La arquitectura es simple y directa, ideal para un blog personal o de nicho temático. 

El proyecto se encuentra en etapa de **desarrollo y personalización**, con elementos de plantilla todavía presentes. Una vez completada la configuración (tokens de API, contenido real, navegación habilitada), será un sitio completamente funcional y profesional.

**Última actualización de documentación:** 12 de Noviembre de 2025

---

*Documentación generada por análisis integral de archivos del proyecto SimpleBlog*
