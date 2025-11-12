# ANDAMIO DEL PROYECTO MERIDIANO BLOG - Sistema Dinámico de Posts con PHP y BD

## Estructura Propuesta

```
simpleblog/
│
├── config/
│   └── database.php              # Conexión PDO a MySQL/MariaDB
│
├── classes/
│   └── Articulo.php              # Clase modelo para gestionar artículos
│
├── templates/
│   └── post.php                  # Plantilla PHP dinámica (reemplaza post.html)
│
├── includes/
│   ├── header.php                # Encabezado reutilizable
│   └── footer.php                # Pie de página reutilizable
│
├── public/
│   ├── index.php                 # Home page con listados (estará aquí después)
│   ├── post.php                  # Controlador/router de artículos dinámicos
│   └── (assets/) -->> se mantiene aquí (css/, js/, img/)
│
├── assets/
│   ├── css/styles.css            # Estilos existentes (sin cambios)
│   ├── js/scripts.js             # Scripts existentes (sin cambios)
│   ├── img/                      # Imágenes (sin cambios)
│   ├── estructura.sql            # Esquema BD (existente)
│   └── estructura_explicada.md   # Documentación BD (existente)
│
├── about.html                    # Se mantiene (página estática)
├── contact.html                  # Se mantiene (página estática)
├── index.html                    # Se mantiene por ahora (sin cambios)
├── post.html                     # Se mantiene como referencia (sin usar)
├── yadier-molina-magallanes-segunda-etapa.html # Referencia → será Artículo ID 1
├── README.md                     # Se mantiene
├── PROYECTO_ANDAMIO.md           # Este documento
└── .git/                         # Repositorio (sin cambios)
```

---

## Descripción de Carpetas y Archivos

### **1. `/config/database.php`**
- **Propósito**: Centralizar la conexión a la BD
- **Contenido**: 
  - Credenciales de BD (host, user, password, dbname)
  - Configuración PDO
  - Manejo de errores
- **Retorna**: Objeto PDO para usar en toda la aplicación

### **2. `/classes/Articulo.php`**
- **Propósito**: Clase modelo para operaciones con artículos
- **Métodos principales**:
  - `obtenerPorUrl($url_amigable)` → Obtiene un artículo por su URL amigable
  - `obtenerCategorias($articulo_id)` → Obtiene categorías del artículo
  - `obtenerEtiquetas($articulo_id)` → Obtiene etiquetas del artículo
- **Patrón**: Modelo MVC (aunque simplificado)

### **3. `/templates/post.php`**
- **Propósito**: Plantilla HTML/PHP dinámica para renderizar un artículo
- **Contenido**:
  - Estructura HTML heredada de `post.html` y `yadier-molina...html`
  - Variables PHP que se completan con datos de la BD
  - Uso de `<?php echo htmlspecialchars(...) ?>` para seguridad
- **No es un controlador**, solo la vista

### **4. `/includes/header.php` y `/includes/footer.php`**
- **Propósito**: Componentes reutilizables
- **Header**: Metadatos, estilos, título dinámico
- **Footer**: Créditos y redes sociales

### **5. `/public/post.php`**
- **Propósito**: Controlador/router que maneja las solicitudes de artículos
- **Lógica**:
  1. Recibe parámetro URL: `?url=yadier-molina-magallanes-segunda-etapa`
  2. Valida y obtiene datos de la BD usando `Articulo.php`
  3. Si no existe, devuelve 404
  4. Si existe, incluye la plantilla `/templates/post.php`
- **Conexión**: Incluye `/config/database.php` y `/classes/Articulo.php`

### **6. `/public/index.php` (futuro)**
- Será la versión PHP del home page actual
- Por ahora **NO SE TOCA** (`index.html` se mantiene estático)

### **7. `/assets/`**
- Mantiene estructura actual sin cambios
- CSS, JS e imágenes continúan igual
- `estructura.sql` y `estructura_explicada.md` permanen aquí como documentación

### **8. Archivos HTML Estáticos (sin cambios)**
- `about.html`, `contact.html`, `index.html`, `post.html` se mantienen por referencia
- El archivo `yadier-molina-magallanes-segunda-etapa.html` sirve como **fuente de contenido** para migrar a BD

---

## Flujo de Solicitud: Cómo Funcionará

```
Usuario accede a: post.php?url=yadier-molina-magallanes-segunda-etapa

(Raíz del codespace: /public/)

1. post.php (controlador)
   ├─ Incluye ../config/database.php (PDO conexión)
   ├─ Incluye ../classes/Articulo.php (modelo)
   ├─ Obtiene parámetro: $url = "yadier-molina-magallanes-segunda-etapa"
   ├─ Crea objeto: $articulo = new Articulo($pdo)
   ├─ Consulta BD: $datos = $articulo->obtenerPorUrl($url)
   ├─ Si existe:
   │  ├─ Obtiene categorías: $categorias = $articulo->obtenerCategorias($id)
   │  ├─ Obtiene etiquetas: $etiquetas = $articulo->obtenerEtiquetas($id)
   │  └─ Incluye ../templates/post.php (plantilla con $datos, $categorias, $etiquetas)
   └─ Si NO existe:
      └─ Devuelve error 404
```


---

## Consideraciones Técnicas

### **Seguridad**
- PDO con prepared statements (previene SQL injection)
- `htmlspecialchars()` en salida (previene XSS)
- Validación de parámetros URL

### **Mantenibilidad**
- Separación clara: config, clases, templates, controladores
- Fácil de extender (agregar nuevas clases, métodos)
- Reutilización de código

### **Compatibilidad**
- Mantiene estilos CSS y JS existentes
- Archivos HTML estáticos continúan disponibles
- Sin dependencias externas (solo PHP + PDO + MySQL)

### **Base de Datos**
- Usa tablas definidas en `estructura.sql`
- Primariamente tabla `mb_articulos` + relaciones N:N
- Campos aprovechados: `titulo`, `contenido_html`, `entradilla`, `url_amigable`, `imagen_articulo`, `autor_id`, etc.

---

## Notas Importantes

✓ **BD**: Asume que ya existe BD con esquema de `estructura.sql`  
✓ **Contenido Inicial**: Artículo Yadier Molina será ID 1, con URL amigable `yadier-molina-magallanes-segunda-etapa`  
✓ **Acceso**: Por URL amigable (`?url=...`)  
✓ **Estáticos**: `about.html`, `contact.html`, `index.html` permanecen sin cambios por ahora  
✓ **Raíz de Codespace**: `/public/` es la raíz de acceso público

---

**Listo para evaluación del usuario.**
