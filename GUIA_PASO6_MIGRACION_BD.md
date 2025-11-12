# PASO 6: MIGRACIÓN DE CONTENIDO A BD - Guía Rápida

**Objetivo**: Insertar el artículo Yadier Molina en `mb_articulos` para que sea servido dinámicamente.

---

## 📋 Checklist Pre-Migración

Antes de comenzar, asegúrate de:

- [ ] BD `meridiano_blog` creada (o la que especifiques en `/config/database.php`)
- [ ] Schema de `/assets/estructura.sql` ejecutado en la BD
- [ ] Credenciales en `/config/database.php` son correctas
- [ ] Archivo HTML `/yadier-molina-magallanes-segunda-etapa.html` disponible

---

## 📄 Paso 1: Extraer Contenido HTML

1. **Abre** `/yadier-molina-magallanes-segunda-etapa.html` en editor de texto
2. **Busca** la etiqueta `<article>` (contiene todo el contenido del artículo)
3. **Copia** TODO lo que está dentro de `<article>...</article>` (incluyendo la etiqueta de apertura)
4. **Nota**: Excluye `<!DOCTYPE>`, `<html>`, `<head>`, `<body>`, `<header>`, `<footer>`

### Estructura esperada:
```html
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <!-- TODO el contenido aquí -->
        </div>
    </div>
</article>
```

---

## 👤 Paso 2: Crear Autor (si no existe)

Si el autor NO existe en la BD, crea uno:

```sql
INSERT INTO mb_autores (nombre, bio, correo, sitio_web)
VALUES (
    'Meridiano Blog',
    'Blog especializado en béisbol caribeño',
    'info@meridiano.com',
    'https://www.meridiano.com'
);
```

**Nota**: Toma nota del `id` que se genera (probablemente `1`).

---

## 🔤 Paso 3: Preparar Contenido HTML

**IMPORTANTE**: Escapa comillas en el HTML para SQL:

```sql
-- Incorrecto (causa error):
INSERT INTO ... contenido_html = '<p class="title">Yadier</p>' ...

-- Correcto (escapa comillas):
INSERT INTO ... contenido_html = '<p class=\"title\">Yadier</p>' ...
```

**O usa comillas simples en SQL**:

```sql
INSERT INTO ... contenido_html = '<p class="title">Yadier</p>' ...
```

---

## 🎯 Paso 4: Insertar Artículo

Ejecuta este SQL en tu BD (reemplaza valores según corresponda):

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
    schema_type,
    vistas
) VALUES (
    'Yadier Molina y su ruta caribeña: el regreso del Capitán al Magallanes',
    '<article class="mb-4">... [TODO EL HTML COPIADO AQUÍ] ...</article>',
    'La consolidación de un dirigente nacido del juego',
    'yadier-molina-magallanes-segunda-etapa',
    'assets/img/post-sample-image.jpg',
    'assets/img/post-bg.jpg',
    1,
    '2025-11-08 12:00:00',
    'Yadier Molina regresa al Magallanes para su segunda etapa como dirigente del equipo caribeño',
    8,
    'publicado',
    'Yadier Molina y su ruta caribeña - Meridiano Blog',
    'Yadier Molina regresa al Magallanes para dirigir su segunda etapa como técnico del béisbol caribeño',
    'SportsArticle',
    0
);
```

### Campos a ajustar:
- **titulo**: Título del artículo
- **contenido_html**: TODO el HTML copiado de `<article>`
- **entradilla**: Párrafo introductorio (primera línea/resumen)
- **url_amigable**: URL amigable (CUIDADO: debe ser único)
- **autor_id**: ID del autor (probablemente `1`)
- **fecha_publicacion**: Fecha de publicación
- **estado**: 'publicado' o 'borrador'

---

## 🏷️ Paso 5: Asignar Categorías (Opcional)

Si quieres asociar categorías al artículo:

```sql
-- Primero, obtén los IDs de categorías (o crea una):
INSERT INTO mb_categorias (nombre, slug) 
VALUES ('Béisbol Caribeño', 'beisbol-caribeno');

-- Luego, asocia al artículo:
INSERT INTO mb_articulos_categorias (articulo_id, categoria_id)
VALUES (1, 1);  -- Asume ID artículo 1, categoría 1
```

---

## 🏷️ Paso 6: Asignar Etiquetas (Opcional)

Similarmente con etiquetas:

```sql
-- Crear etiquetas:
INSERT INTO mb_etiquetas (nombre, slug)
VALUES 
    ('Yadier Molina', 'yadier-molina'),
    ('Magallanes', 'magallanes'),
    ('Béisbol', 'beisbol');

-- Asociar al artículo:
INSERT INTO mb_articulos_etiquetas (articulo_id, etiqueta_id)
VALUES 
    (1, 1),
    (1, 2),
    (1, 3);
```

---

## 🧪 Paso 7: Verificar Inserción

Ejecuta estas consultas para verificar:

```sql
-- Ver el artículo insertado:
SELECT id, titulo, url_amigable, estado, fecha_publicacion 
FROM mb_articulos 
WHERE url_amigable = 'yadier-molina-magallanes-segunda-etapa';

-- Ver contenido del artículo:
SELECT id, titulo, contenido_html 
FROM mb_articulos 
WHERE id = 1;

-- Ver categorías asociadas:
SELECT a.titulo, c.nombre 
FROM mb_articulos a
JOIN mb_articulos_categorias ac ON a.id = ac.articulo_id
JOIN mb_categorias c ON ac.categoria_id = c.id
WHERE a.id = 1;

-- Ver etiquetas asociadas:
SELECT a.titulo, e.nombre 
FROM mb_articulos a
JOIN mb_articulos_etiquetas ae ON a.id = ae.articulo_id
JOIN mb_etiquetas e ON ae.etiqueta_id = e.id
WHERE a.id = 1;
```

---

## 🌐 Paso 8: Probar en el Navegador

1. **Asegúrate** de que PHP/Apache está ejecutando
2. **Accede** a: `http://localhost/simpleblog/post.php?url=yadier-molina-magallanes-segunda-etapa`
3. **Verifica**:
   - ✅ El artículo se carga correctamente
   - ✅ El contenido HTML se renderiza bien
   - ✅ Los estilos CSS se aplican
   - ✅ Las imágenes se muestran
   - ✅ El autor, fecha y categorías aparecen

---

## ❌ Troubleshooting

### Error: "Artículo No Encontrado (404)"
- Verifica que `url_amigable` en BD coincide exactamente: `yadier-molina-magallanes-segunda-etapa`
- Verifica que el artículo tiene `estado = 'publicado'`
- Revisa la URL en el navegador: debe ser exacta

### Error: "Error del Servidor (500)"
- Revisa `/config/database.php`: credenciales correctas
- Revisa el error log de PHP (típicamente: `/var/log/apache2/error.log`)
- Verifica que el schema de BD está completo

### Error: "Contenido HTML sin renderizar"
- Verifica que el HTML es válido
- Revisa si hay etiquetas sin cerrar
- Verifica que no hay caracteres especiales mal escapados

### Estilo CSS no se aplica
- Accede a `http://localhost/simpleblog/css/styles.css` en navegador
- Si da 404, revisa `/config/routes.php`
- Verifica que `RUTA_CSS` es correcto

---

## 📝 Notas Importantes

- **URL Amigable**: Debe ser única, solo letras/números/guiones, minúsculas
- **Contenido HTML**: NO incluir `<html>`, `<head>`, `<body>`, debe ser solo el `<article>`
- **Fechas**: Usar formato `YYYY-MM-DD HH:MM:SS` (e.g., `2025-11-08 12:00:00`)
- **Estado**: Solo 'publicado' o 'borrador'
- **Autor**: Asegurar que el ID existe en `mb_autores`

---

## ✨ Siguiente: Paso 7 - Pruebas

Una vez que el artículo esté en BD:

1. Prueba acceso a `/post.php?url=...`
2. Prueba error 404 con URL inexistente
3. Valida seguridad contra SQL injection y XSS
4. Verifica que imágenes y CSS se cargan

---

**Documento de guía para Paso 6 de implementación**  
**Meridiano Blog - Sistema Dinámico de Posts**
