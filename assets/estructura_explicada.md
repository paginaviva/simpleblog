### Documentación técnica del desarrollo de la base de datos

**Proyecto:** Blog de Béisbol Caribeño
**Fecha:** 07/11/2025
**Versión:** 1.0
**Motor de base de datos:** MySQL/MariaDB
**Codificación:** `utf8mb4` con BOM
**Autor:** Equipo de desarrollo técnico

---

#### Contexto del desarrollo

La base de datos `mb_articulos` fue diseñada para soportar un sistema editorial propio enfocado en contenidos de béisbol caribeño, sin depender de un CMS preexistente.
Su propósito es ofrecer una arquitectura relacional robusta, optimizada para gestión de artículos periodísticos, con soporte integral para metadatos SEO, integración con redes sociales (Open Graph y Twitter Cards) y compatibilidad con datos estructurados Schema.org (JSON-LD).

El modelo se concibió como base para un portal de noticias especializado, priorizando la legibilidad, el rendimiento en consultas frecuentes (por fecha, categoría y estado) y la trazabilidad de autores, etiquetas y categorías.

---

#### Estructura general y convenciones

El desarrollo adoptó **MySQL/MariaDB** como motor principal por su estabilidad, soporte extendido y facilidad de despliegue.
A nivel técnico se establecieron las siguientes normas:

* Uso de **`InnoDB`** como *storage engine* para permitir integridad referencial y transacciones.
* Codificación **`utf8mb4`** con collation `utf8mb4_unicode_ci` para soporte total de caracteres latinos, acentos y emojis.
* Todos los campos y tablas utilizan **`snake_case`** por consistencia semántica.
* Claves primarias con **`AUTO_INCREMENT`** y tipo `INT UNSIGNED` en todas las tablas principales.
* Creación de índices en campos de búsqueda y clasificación (`url_amigable`, `estado`, `fecha_publicacion`).
* Relaciones N:N implementadas mediante tablas puente con *foreign keys* explícitas.

Durante el diseño, se decidió mantener independencia total de CMS (WordPress, Ghost, etc.), de modo que el modelo pudiera integrarse en un backend personalizado.

---

#### Tablas principales y relaciones

El esquema consta de cuatro tablas principales y dos tablas intermedias:

1. **`mb_articulos`** – núcleo del sistema editorial.
2. **`mb_autores`** – define información personal y profesional del autor o redactor.
3. **`mb_categorias`** – agrupa artículos por temas o ligas (ej. LVBP, LIDOM, Béisbol del Caribe).
4. **`mb_etiquetas`** – define palabras clave o tags para filtrado avanzado.
5. **`mb_articulos_categorias`** – relación N:N entre artículos y categorías.
6. **`mb_articulos_etiquetas`** – relación N:N entre artículos y etiquetas.

Cada artículo pertenece a un autor (N:1) y puede asociarse a múltiples categorías y etiquetas (N:N).
Las relaciones se implementan con claves foráneas que usan la política `ON DELETE CASCADE` para evitar registros huérfanos.

---

#### Campos y estructura de `mb_articulos`

La tabla `mb_articulos` concentra la información editorial, los metadatos SEO y la configuración de integración web.
Los campos clave incluyen:

* **metatitle / metadescription:** definen el título y descripción para motores de búsqueda, optimizados para límites de 60 y 155 caracteres.
* **titulo:** encabezado principal del artículo (renderizado como `<h1>` en frontend).
* **contenido_html:** cuerpo del texto en formato HTML, permitiendo etiquetas semánticas y multimedia.
* **entradilla:** párrafo de introducción o lead periodístico.
* **imagen_destacada / imagen_articulo:** imágenes principales del artículo, usadas tanto en portada como dentro del cuerpo.
* **url_amigable y url_canonica:** elementos críticos para SEO. `url_amigable` es única e indexada; `url_canonica` previene contenido duplicado.
* **autor_id:** clave foránea que enlaza con `mb_autores`.
* **extracto:** resumen corto utilizado en listados o newsletters.
* **fuentes:** campo tipo JSON que almacena medios citados (ej. `["MLB.com", "LVBP.com"]`).
* **idioma:** código ISO, por defecto `es-VE`.
* **schema_type:** tipo de estructura JSON-LD (`Article`, `NewsArticle`, `SportsArticle`).
* **schema_activo:** booleano que controla la generación automática del bloque de datos estructurados.
* **tiempo_lectura:** valor numérico estimado en minutos, calculado a partir del número de palabras.
* **twitter_card:** define el formato de vista previa en X (Twitter), con valor por defecto `summary_large_image`.
* **estado:** control editorial del flujo de publicación (`borrador`, `pendiente`, `publicado`, `archivado`).

El diseño contempla un flujo editorial clásico, donde los artículos pasan por estados definidos antes de publicarse, con registro automático de fecha de creación y actualización.

---

#### Tablas relacionales complementarias

* **`mb_autores`:** contiene nombre, biografía, foto y redes sociales (JSON). Facilita la visualización de perfiles de colaboradores y la atribución de contenido.
* **`mb_categorias`:** permite agrupar artículos temáticamente; los slugs (`lvbp`, `lidom`) se usan en URLs y filtros.
* **`mb_etiquetas`:** gestionan palabras clave o tópicos frecuentes. Incluye un campo `frecuencia` para análisis de popularidad.
* **Tablas puente:**

  * `mb_articulos_categorias`
  * `mb_articulos_etiquetas`
    Ambas implementan relaciones N:N con claves compuestas y cascada activa.

---

#### Soporte SEO, Open Graph y Schema

Uno de los objetivos del modelo es ofrecer soporte nativo para optimización SEO y metadatos sociales.
Las decisiones clave documentadas fueron las siguientes:

* **Metacampos SEO:** `metatitle`, `metadescription`, `url_amigable`, `url_canonica` y `extracto` alimentan tanto etiquetas `<meta>` como vistas previas de redes sociales.
* **Open Graph:** `og_title`, `og_description` e `imagen_destacada` permiten generar las etiquetas `og:` utilizadas por Facebook, LinkedIn y WhatsApp.
* **Twitter Card:** el campo `twitter_card` define el tipo de tarjeta visual (`summary` o `summary_large_image`), optimizando la vista en X (Twitter).
* **Schema.org / JSON-LD:**

  * `schema_type` permite definir si el artículo se representa como `Article`, `NewsArticle` o `SportsArticle`.
  * `schema_activo` (BOOLEAN) habilita la generación automática del bloque JSON-LD con propiedades como `author`, `headline`, `datePublished`, `image` y `url`.
  * Se recomienda `SportsArticle` como tipo por defecto, ya que hereda las propiedades de `NewsArticle` y se adapta a contenido deportivo.

Estas configuraciones garantizan compatibilidad con los motores de búsqueda modernos y optimización de *rich results* en Google.

---

#### Preguntas y decisiones documentadas

Durante el diseño se tomaron decisiones basadas en un intercambio de requerimientos específicos:

* **Motor de BD:** se eligió *MySQL/MariaDB* por ser estándar en entornos LAMP y ofrecer soporte estable a largo plazo.
* **Motor de almacenamiento:** se acordó utilizar *InnoDB* para soportar integridad referencial mediante *FOREIGN KEYS*.
* **Codificación:** se estableció `utf8mb4` con BOM para admitir caracteres multilingües y emojis, especialmente relevantes para contenido latinoamericano.
* **Convenciones:** se definió `snake_case` como formato uniforme de nombres de campos.
* **Integridad y relaciones:** se implementaron *FOREIGN KEYS* con `ON DELETE CASCADE` y `ON UPDATE CASCADE`.
* **Campos extra:** se añadieron `schema_activo`, `tiempo_lectura` y `twitter_card` según recomendaciones SEO modernas.
* **Índices SEO:** se creó indexación en `url_amigable`, `estado` y `fecha_publicacion` para acelerar consultas y listados.
* **Sin CMS:** el sistema se diseñó desde cero, sin dependencias, para máxima flexibilidad.

Este registro de preguntas y respuestas deja evidencia de la racionalidad del diseño y asegura coherencia en futuras iteraciones.

---

#### Consideraciones técnicas y extensibilidad

El modelo puede escalar mediante la adición de nuevas tablas, como `mb_comentarios`, `mb_galerias` o `mb_eventos`, sin romper compatibilidad.
El uso de campos JSON permite extender metadatos sin alterar la estructura relacional principal.
La codificación `utf8mb4` garantiza compatibilidad con sistemas multilingües y API REST.

Los índices creados facilitan la paginación de artículos, la ordenación por fecha y el filtrado por estado o categoría, mejorando rendimiento de búsqueda en entornos de alto tráfico.

---

#### Conclusión

La base de datos `mb_articulos` representa un modelo relacional sólido y extensible diseñado específicamente para un portal de béisbol caribeño.
Integra metadatos SEO, estructuras JSON-LD, soporte multilingüe y control editorial en una misma arquitectura, optimizada para integrarse con backend propio y API modernas.

La combinación de **estructura clara, documentación detallada y decisiones justificadas** convierte este diseño en una base sostenible para desarrollo futuro, garantizando consistencia, rendimiento y visibilidad en la web.

---