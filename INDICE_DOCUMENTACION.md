# 📚 ÍNDICE DE DOCUMENTACIÓN - Meridiano Blog

Guía completa de archivos de documentación y recursos del proyecto.

---

## 📖 Documentación Principal

### 1. **README_SISTEMA_DINAMICO.md** ⭐ START HERE
   - **Propósito**: Guía de uso general del sistema
   - **Contenido**: 
     - Objetivo del proyecto
     - Estructura de carpetas
     - Inicio rápido (5 pasos)
     - Arquitectura de rutas
     - Flujo de solicitud
     - Componentes principales
     - Base de datos
     - Testing
   - **Para quién**: Usuarios nuevos, developers, DevOps
   - **Tiempo de lectura**: 10 minutos

### 2. **ESTADO_IMPLEMENTACION.md** 📊 PROGRESS REPORT
   - **Propósito**: Estado actual detallado del proyecto
   - **Contenido**:
     - Resumen ejecutivo
     - Estructura final
     - Pasos completados (✅)
     - Pasos pendientes (⏳)
     - Verificación de rutas
     - Inclusiones de archivos
     - Medidas de seguridad
     - Comandos de testing
   - **Para quién**: Project manager, Desarrolladores
   - **Tiempo de lectura**: 15 minutos

### 3. **PROYECTO_ANDAMIO.md** 📋 TECHNICAL SPEC
   - **Propósito**: Especificación técnica completa
   - **Contenido**:
     - Requisitos funcionales
     - Requisitos técnicos
     - Estructura de BD (conceptual)
     - Patrón MVC simplificado
     - Descripción de componentes
     - Flujo de datos
     - Stack tecnológico
   - **Para quién**: Arquitectos, Desarrolladores sénior
   - **Tiempo de lectura**: 20 minutos

### 4. **mapa-ruta-desarrollo.md** 🗺️ IMPLEMENTATION ROADMAP
   - **Propósito**: Pasos de implementación paso a paso
   - **Contenido**:
     - Paso 1-8 con detalle
     - Propósito de cada paso
     - Contenido a crear
     - Métodos requeridos
     - URLs de acceso
     - Checklist de implementación
   - **Para quién**: Desarrolladores, QA
   - **Tiempo de lectura**: 25 minutos
   - **Nota**: Actualizado con arquitectura centralizada

### 5. **GUIA_PASO6_MIGRACION_BD.md** 🎯 ACTIONABLE GUIDE
   - **Propósito**: Instrucciones prácticas para migración de datos
   - **Contenido**:
     - Checklist pre-migración
     - Paso 1-8 con ejemplos SQL
     - Extracción de contenido HTML
     - Creación de autor
     - Inserción de artículo
     - Asignación de categorías/etiquetas
     - Verificación de inserción
     - Testing en navegador
     - Troubleshooting
   - **Para quién**: Desarrolladores implementando Paso 6
   - **Tiempo de lectura**: 15 minutos

---

## 📁 Archivos de Configuración

### `/config/routes.php`
   - **Propósito**: Configuración centralizada de rutas
   - **Variables clave**:
     - `RUTA_FISICA` (personalizar)
     - `RUTA_URL` (personalizar)
   - **Incluye**: 8 constantes derivadas automáticas
   - **Leer primero si**: Necesitas adaptar rutas para tu servidor

### `/config/database.php`
   - **Propósito**: Conexión PDO a MySQL/MariaDB
   - **Variables clave**:
     - DB_HOST, DB_USER, DB_PASSWORD, DB_NAME
   - **Incluye**: Try/catch error handling
   - **Leer si**: Necesitas cambiar credenciales de BD

---

## 🔧 Archivos de Código Fuente

### Modelos (`/classes/`)
- **Articulo.php** - Clase modelo con 4 métodos CRUD

### Vistas (`/templates/`)
- **post.php** - Plantilla HTML/PHP dinámica

### Componentes (`/includes/`)
- **header.php** - Encabezado con meta tags
- **footer.php** - Pie de página con scripts

### Controlador (`/`)
- **post.php** - Controlador principal (raíz)

---

## 🗄️ Base de Datos

### `/assets/estructura.sql`
   - **Propósito**: Schema MySQL/MariaDB
   - **Tablas**: mb_articulos, mb_autores, mb_categorias, mb_etiquetas, + junctions
   - **Ejecutar primero si**: Estás configurando BD nueva

### `/assets/estructura_explicada.md`
   - **Propósito**: Documentación del schema
   - **Contenido**: Descripción de tablas, campos, relaciones
   - **Leer si**: Necesitas entender la estructura de datos

---

## 🎓 Guías Temáticas

### Para COMENZAR EL PROYECTO
1. Lee: **README_SISTEMA_DINAMICO.md**
2. Personaliza: `/config/routes.php` y `/config/database.php`
3. Lee: **GUIA_PASO6_MIGRACION_BD.md**

### Para ENTENDER LA ARQUITECTURA
1. Lee: **PROYECTO_ANDAMIO.md**
2. Lee: **mapa-ruta-desarrollo.md**
3. Revisa: Archivos en `/config/`, `/classes/`, `/templates/`, `/includes/`

### Para VERIFICAR PROGRESO
1. Lee: **ESTADO_IMPLEMENTACION.md**
2. Ejecuta: Comandos de testing
3. Lee: Sección de validación

### Para MIGRAR DATOS (PASO 6)
1. Lee: **GUIA_PASO6_MIGRACION_BD.md**
2. Sigue: Pasos 1-8 con ejemplos SQL
3. Prueba: URLs en navegador

### Para RESOLVER PROBLEMAS
1. Revisa: **ESTADO_IMPLEMENTACION.md** - Sección Troubleshooting
2. Revisa: **GUIA_PASO6_MIGRACION_BD.md** - Sección Troubleshooting
3. Ejecuta: Comandos de testing

---

## 🔍 Búsqueda Rápida

### ¿Dónde está...?

**La configuración de rutas?**
→ `/config/routes.php` - Variables `RUTA_FISICA` y `RUTA_URL`

**El controlador principal?**
→ `/post.php` (en raíz)

**La clase de modelos?**
→ `/classes/Articulo.php`

**La plantilla HTML?**
→ `/templates/post.php`

**El header y footer?**
→ `/includes/header.php` y `/includes/footer.php`

**La conexión a BD?**
→ `/config/database.php`

**El schema de BD?**
→ `/assets/estructura.sql`

**Instrucciones de migración?**
→ `GUIA_PASO6_MIGRACION_BD.md`

**El estado actual del proyecto?**
→ `ESTADO_IMPLEMENTACION.md`

---

## ✅ Checklist de Lectura Recomendada

### Primer día (developers nuevos)
- [ ] README_SISTEMA_DINAMICO.md (10 min)
- [ ] ESTADO_IMPLEMENTACION.md (15 min)
- [ ] Revisar archivos en `/config/`, `/classes/`, `/templates/`

### Segundo día (implementación)
- [ ] GUIA_PASO6_MIGRACION_BD.md (15 min)
- [ ] Ejecutar Paso 6 (extraer HTML e insertar en BD)

### Tercero (profundización)
- [ ] PROYECTO_ANDAMIO.md (20 min)
- [ ] mapa-ruta-desarrollo.md (25 min)
- [ ] `/assets/estructura_explicada.md`

---

## 📞 Contacto con Documentación

| Pregunta | Archivo |
|----------|---------|
| ¿Cómo empiezo? | README_SISTEMA_DINAMICO.md |
| ¿Qué se ha completado? | ESTADO_IMPLEMENTACION.md |
| ¿Cómo funciona la arquitectura? | PROYECTO_ANDAMIO.md |
| ¿Cuáles son los pasos? | mapa-ruta-desarrollo.md |
| ¿Cómo migro datos a BD? | GUIA_PASO6_MIGRACION_BD.md |
| ¿Cuáles son las tablas de BD? | estructura_explicada.md |

---

## 🚀 Próximos Pasos

1. **Leer** documentación principal (README_SISTEMA_DINAMICO.md)
2. **Personalizar** rutas en `/config/routes.php`
3. **Configurar** BD en `/config/database.php`
4. **Ejecutar** Paso 6 (GUIA_PASO6_MIGRACION_BD.md)
5. **Probar** acceso a `/post.php?url=...`

---

**Documento índice actualizado el 12 de Noviembre, 2025**  
**Meridiano Blog - Sistema Dinámico de Posts**
