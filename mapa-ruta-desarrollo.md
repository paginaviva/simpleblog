# MAPA DE RUTA DE DESARROLLO - Meridiano Blog Sistema Dinámico

Documento que detalla los pasos concretos para implementar el sistema de plantillas dinámicas con PHP y BD.

---

## Pasos de Implementación

### **Paso 1: Crear `/config/database.php`**
**Propósito**: Centralizar la conexión a la base de datos

**Contenido**:
- Definir constantes de conexión (host, user, password, dbname)
- Crear conexión PDO con manejo de errores
- Retornar objeto `$pdo` para usar en toda la aplicación

**Archivo destino**: `/config/database.php`

---

### **Paso 2: Crear `/classes/Articulo.php`**
**Propósito**: Clase modelo para gestionar operaciones con artículos

**Métodos requeridos**:
1. `__construct($pdo)` - Constructor que recibe conexión PDO
2. `obtenerPorUrl($url_amigable)` - Obtiene artículo completo por URL amigable
   - Retorna array asociativo con datos del artículo
   - Incluye datos del autor (LEFT JOIN con mb_autores)
3. `obtenerCategorias($articulo_id)` - Obtiene todas las categorías del artículo
   - Consulta tabla puente mb_articulos_categorias
   - Retorna array de categorías
4. `obtenerEtiquetas($articulo_id)` - Obtiene todas las etiquetas del artículo
   - Consulta tabla puente mb_articulos_etiquetas
   - Retorna array de etiquetas

**Archivo destino**: `/classes/Articulo.php`

---

### **Paso 3: Crear `/templates/post.php`**
**Propósito**: Plantilla HTML/PHP dinámica para renderizar un artículo

**Contenido**:
- Estructura HTML basada en `yadier-molina-magallanes-segunda-etapa.html`
- Variables PHP que se reemplazan con datos de la BD:
  - `$articulo['titulo']` - Título del artículo
  - `$articulo['contenido_html']` - Contenido HTML del artículo
  - `$articulo['entradilla']` - Párrafo introductorio
  - `$articulo['imagen_articulo']` - Imagen del artículo
  - `$articulo['autor_nombre']` - Nombre del autor
  - `$articulo['fecha_publicacion']` - Fecha de publicación
  - `$categorias` - Array de categorías
  - `$etiquetas` - Array de etiquetas

**Consideraciones**:
- Usar `htmlspecialchars()` para prevenir XSS
- Mantener estilos CSS y clases de Bootstrap existentes
- No incluir etiquetas `<html>`, `<head>`, `<body>` (lo hace el controlador)

**Archivo destino**: `/templates/post.php`

---

### **Paso 4: Crear `/includes/header.php` y `/includes/footer.php`**
**Propósito**: Componentes reutilizables para evitar duplicación

**Header.php** - Incluye:
- Doctype y metadatos
- Estilos CSS (Bootstrap + personalizados)
- Título dinámico de la página
- Meta tags SEO (description, author, etc.)

**Footer.php** - Incluye:
- Pie de página con créditos
- Links a redes sociales
- Scripts JavaScript (Bootstrap, scripts.js)

**Archivos destino**: 
- `/includes/header.php`
- `/includes/footer.php`

---

### **Paso 5: Crear `/config/routes.php`** (Configuración de Rutas)
**Propósito**: Centralizar todas las rutas del proyecto en una configuración flexible

**Contenido**:
- Dos constantes base personalizables:
  - `RUTA_FISICA`: Ruta absoluta del servidor (__DIR__ . '/../')
  - `RUTA_URL`: URL base del sitio (http://localhost/simpleblog o https://www.meridiano.com)
- Constantes derivadas que se calculan automáticamente:
  - `RUTA_CONFIG`: Ruta a carpeta /config/
  - `RUTA_CLASSES`: Ruta a carpeta /classes/
  - `RUTA_TEMPLATES`: Ruta a carpeta /templates/
  - `RUTA_INCLUDES`: Ruta a carpeta /includes/
  - `RUTA_CSS`: URL a carpeta /css/
  - `RUTA_JS`: URL a carpeta /js/
  - `RUTA_IMG`: URL a carpeta /assets/img/
  - `RUTA_ASSETS`: URL a carpeta /assets/

**Ventajas**:
- Deployment flexible: cambiar solo 2 constantes para cualquier servidor
- Todos los paths se adaptan automáticamente
- Permite pasar de desarrollo a producción sin modificar código PHP

**Archivo destino**: `/config/routes.php`

**Actualización anterior**: `/config/database.php` requiere este archivo primero

---

### **Paso 5.5: Crear `/post.php`** (Controlador a nivel de raíz)
**Propósito**: Controlador/router para servir artículos dinámicos a nivel raíz (NO en /public/)

**Lógica**:
1. Incluir `/config/routes.php` para obtener todas las constantes
2. Incluir `/config/database.php` para obtener conexión PDO
3. Incluir `/classes/Articulo.php` para usar el modelo
4. Obtener parámetro URL: `$url = $_GET['url'] ?? null`
5. Validar que el parámetro existe y cumple formato (preg_match)
6. Crear instancia: `$articulo = new Articulo($pdo)`
7. Consultar BD: `$datos = $articulo->obtenerPorUrl($url)`
8. Si NO existe:
   - Enviar header 404: `http_response_code(404)`
   - Mostrar error 404
   - Exit
9. Si existe:
   - Obtener categorías: `$categorias = $articulo->obtenerCategorias($datos['id'])`
   - Obtener etiquetas: `$etiquetas = $articulo->obtenerEtiquetas($datos['id'])`
   - Incluir `/includes/header.php` (usa RUTA_CSS, RUTA_ASSETS)
   - Incluir `/templates/post.php` (variables: $articulo, $categorias, $etiquetas)
   - Incluir `/includes/footer.php` (usa RUTA_JS)

**URL de acceso**: `http://localhost/simpleblog/post.php?url=yadier-molina-magallanes-segunda-etapa`

**Archivo destino**: `/post.php` (raíz del proyecto)

**Nota IMPORTANTE**: El proyecto NO tiene directorio `/public/`. Todos los archivos .php están a nivel raíz.

---

### **Paso 5.6: Actualizar `/includes/header.php` y `/includes/footer.php` para usar constantes de rutas**
**Propósito**: Hacer que las rutas a assets sean dinámicas y flexibles

**Cambios en header.php**:
- `<link href="assets/css/styles.css">` → `<link href="<?php echo RUTA_CSS; ?>styles.css">`
- `<link rel="icon" href="assets/favicon.ico">` → `<link rel="icon" href="<?php echo RUTA_ASSETS; ?>favicon.ico">`
- Incluir `require_once __DIR__ . '/../config/routes.php'` al inicio

**Cambios en footer.php**:
- `<script src="assets/js/scripts.js">` → `<script src="<?php echo RUTA_JS; ?>scripts.js">`
- Incluir `require_once __DIR__ . '/../config/routes.php'` al inicio

**Archivos actualizados**: 
- `/includes/header.php`
- `/includes/footer.php`

---

### **Paso 5.7: Copiar/Asegurar archivos estáticos en raíz**
**Propósito**: Verificar que los directorios estáticos existen en la raíz

**Verificación**:
- Verificar que `/css/` existe en raíz
- Verificar que `/js/` existe en raíz
- Verificar que `/assets/` existe en raíz
- **IMPORTANTE**: NO existe `/public/` (fue eliminado como parte de la corrección arquitectónica)

---



### **Paso 6: Migrar contenido a la BD**
**Propósito**: Insertar el artículo Yadier Molina como primer registro

**Acciones**:
1. Extraer contenido HTML de `yadier-molina-magallanes-segunda-etapa.html`
2. Crear INSERT SQL en tabla `mb_articulos`:
   ```sql
   INSERT INTO mb_articulos (
       titulo,
       contenido_html,
       entradilla,
       url_amigable,
       imagen_articulo,
       imagen_destacada,
       autor_id,
       fecha_publicacion,
       extracto,
       tiempo_lectura,
       estado,
       metatitle,
       metadescription,
       schema_type
   ) VALUES (
       'Yadier Molina y su ruta caribeña: el regreso del Capitán al Magallanes',
       '<!-- Contenido HTML completo del artículo -->',
       'La consolidación de un dirigente nacido del juego',
       'yadier-molina-magallanes-segunda-etapa',
       'assets/img/post-sample-image.jpg',
       'assets/img/post-bg.jpg',
       1,  -- ID del autor (crear autor si no existe)
       '2025-11-08 00:00:00',
       'Yadier Molina regresa al Magallanes para su segunda etapa como dirigente',
       8,  -- Tiempo estimado de lectura
       'publicado',
       'Yadier Molina y su ruta caribeña - Meridiano Blog',
       'Yadier Molina regresa al Magallanes para dirigir su segunda etapa como técnico',
       'SportsArticle'
   );
   ```

3. **Importante**: Asegurar que el campo `contenido_html` tenga solo el contenido del `<article>`, sin `<!DOCTYPE>`, `<head>`, etc.

**Nota**: Si no existe autor, insertar primero en `mb_autores`:
```sql
INSERT INTO mb_autores (nombre, bio) 
VALUES ('Meridiano Blog', 'Blog especializado en béisbol caribeño');
```

---

### **Paso 7: Pruebas de Funcionamiento**
**Propósito**: Verificar que el sistema dinámico funciona correctamente

**Pruebas**:
1. Acceder a: `post.php?url=yadier-molina-magallanes-segunda-etapa`
   - Verificar que se carga el artículo correctamente
   - Verificar que los estilos CSS se cargan (no debería verse distinto del HTML estático)
   - Verificar que las imágenes se muestran
   - Verificar que el contenido HTML se renderiza sin problemas

2. Probar con URL inexistente: `post.php?url=articulo-inexistente`
   - Debe devolver error 404

3. Probar sin parámetro: `post.php`
   - Debe devolver error o redirigir

4. Validar seguridad:
   - Intentar SQL injection: `post.php?url='; DROP TABLE mb_articulos; --`
   - Debe fallar sin ejecutar la inyección (PDO prepared statements protege)

5. Validar XSS:
   - Verificar que `htmlspecialchars()` escapa caracteres especiales en la salida

---

### **Paso 8: (Futuro) Convertir `index.html` a `/public/index.php`**
**Propósito**: Listar artículos dinámicamente desde BD

**Acciones**:
1. Crear método `obtenerTodos()` en clase `Articulo.php`
2. En `/public/index.php`:
   - Obtener lista de artículos: `$articulos = $articulo->obtenerTodos()`
   - Generar enlaces dinámicos: `<a href="post.php?url=<?php echo $art['url_amigable']; ?>">`
   - Mostrar preview de cada artículo con título, entradilla, fecha
3. Agregar paginación si es necesario

**Este paso NO se incluye aún**, se hará cuando se apruebe la primera fase.

---

## Checklist de Implementación

- [x] BD con esquema de `estructura.sql` disponible (definida)
- [x] `/config/routes.php` creado con rutas flexibles y centralizadas
- [x] `/config/database.php` creado con PDO y error handling
- [x] `/classes/Articulo.php` creado con métodos: obtenerPorUrl, obtenerCategorias, obtenerEtiquetas
- [x] `/templates/post.php` creado con HTML dinámico
- [x] `/includes/header.php` creado y actualizado con constantes de rutas
- [x] `/includes/footer.php` creado y actualizado con constantes de rutas
- [x] `/post.php` creado en raíz como controlador principal
- [x] Archivos estáticos (/css/, /js/, /assets/) en raíz del proyecto
- [x] Proyecto sin directorio `/public/` (arquitectura raíz)
- [ ] Contenido Yadier Molina migrado a BD
- [ ] Prueba: acceso a `post.php?url=yadier-molina-magallanes-segunda-etapa` exitoso
- [ ] Prueba: error 404 funciona correctamente
- [ ] Prueba: seguridad (SQL injection, XSS) validada

---

## Notas Importantes

- **Arquitectura**: Proyecto raíz sin `/public/`. Todos los archivos .php están a nivel raíz con acceso directo a /post.php
- **Rutas centralizadas**: Todas las rutas se definen en `/config/routes.php`. Solo cambiar `RUTA_FISICA` y `RUTA_URL` para adaptar a cualquier servidor
- **Inclusión de rutas**: Todos los archivos que necesitan constantes deben hacer `require_once __DIR__ . '/../config/routes.php'` (o la ruta correcta desde su ubicación)
- **Rutas relativas**: Los `.php` a nivel raíz usan: `require_once __DIR__ . '/config/routes.php'`; Los en `/includes/` usan: `require_once __DIR__ . '/../config/routes.php'`
- **Assets**: CSS, JS e imágenes están en `/css/`, `/js/` y `/assets/` respectivamente (a nivel raíz)
- **Seguridad**: Usar siempre PDO prepared statements y `htmlspecialchars()` para output escaping
- **Errores**: En producción, configurar `error_reporting` y `display_errors` apropiadamente
- **Base de datos**: BD debe estar disponible antes de ejecutar los scripts PHP
- **Validación de URL**: Usar `preg_match('/^[a-z0-9-]+$/i', $url)` para validar URLs amigables

---

**Documento actualizado con arquitectura corregida (raíz con rutas centralizadas).**
