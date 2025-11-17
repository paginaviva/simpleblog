<?php
include 'config.php';

// Validar que se recibió el formulario
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['datos_documento'])) {
    header('Location: crear-post-admin.php');
    exit;
}

$datos_raw = $_POST['datos_documento'];
$errores = [];

// ============ PARSEAR EL BLOQUE [DATOS_DOCUMENTO] ============

// Extractor de secciones
function extraerSeccion($bloque, $nombre) {
    $pattern = "/\[" . preg_quote($nombre) . "\](.*?)(?=\[|$)/s";
    if (preg_match($pattern, $bloque, $matches)) {
        return trim($matches[1]);
    }
    return '';
}

function extraerCampo($texto, $campo) {
    $pattern = "/" . preg_quote($campo) . ":\s*(.+?)(?=\n|$)/";
    if (preg_match($pattern, $texto, $matches)) {
        return trim($matches[1]);
    }
    return '';
}

// Extraer secciones principales
$seccion_head = extraerSeccion($datos_raw, 'HEAD');
$seccion_cabecera = extraerSeccion($datos_raw, 'CABECERA_VISUAL');
$seccion_contenido = extraerSeccion($datos_raw, 'CONTENIDO');
$seccion_categorias = extraerSeccion($datos_raw, 'CATEGORIAS');
$seccion_etiquetas = extraerSeccion($datos_raw, 'ETIQUETAS');

// ============ EXTRAER CAMPOS DE [HEAD] ============

$nombre_archivo_html = extraerCampo($datos_raw, 'NombreArchivoHTML');
$titulo_documento = extraerCampo($seccion_head, 'TituloDocumento');
$meta_description = extraerCampo($seccion_head, 'MetaDescription');
$og_image_url = extraerCampo($seccion_head, 'OgImage');
$og_url = extraerCampo($seccion_head, 'OgUrl');
$twitter_title = extraerCampo($seccion_head, 'TwitterTitle');
$twitter_description = extraerCampo($seccion_head, 'TwitterDescription');
$twitter_image_url = extraerCampo($seccion_head, 'TwitterImage');
$autor_meta = extraerCampo($seccion_head, 'AutorMeta');

// ============ EXTRAER CAMPOS DE [CABECERA_VISUAL] ============

$imagen_fondo = extraerCampo($seccion_cabecera, 'ImagenFondo');
$titulo_visible = extraerCampo($seccion_cabecera, 'TituloVisible');
$subtitulo_visible = extraerCampo($seccion_cabecera, 'SubtituloVisible');
$autor_visible = extraerCampo($seccion_cabecera, 'AutorVisible');
$fecha_visible = extraerCampo($seccion_cabecera, 'FechaVisible');

// ============ EXTRAER CATEGORIAS Y ETIQUETAS ============

$categorias_raw = trim($seccion_categorias);
$etiquetas_raw = trim($seccion_etiquetas);

// Limpiar caracteres especiales al final
$categorias_raw = rtrim($categorias_raw, ']');
$etiquetas_raw = rtrim($etiquetas_raw, ']');

$categorias_array = array_map('trim', explode(',', $categorias_raw));
$etiquetas_array = array_map('trim', explode(',', $etiquetas_raw));

$category = $categorias_array[0] ?? '';
$tags = array_filter($etiquetas_array); // Eliminar elementos vacíos

// ============ VALIDACIONES ============

if (empty($nombre_archivo_html)) {
    $errores[] = "NombreArchivoHTML es obligatorio.";
}
if (empty($titulo_documento)) {
    $errores[] = "TituloDocumento es obligatorio.";
}
if (empty($meta_description)) {
    $errores[] = "MetaDescription es obligatorio.";
}
if (empty($og_image_url)) {
    $errores[] = "OgImage es obligatorio.";
}
if (empty($autor_meta)) {
    $errores[] = "AutorMeta es obligatorio.";
}
if (empty($titulo_visible)) {
    $errores[] = "TituloVisible (en [CABECERA_VISUAL]) es obligatorio.";
}
if (empty($subtitulo_visible)) {
    $errores[] = "SubtituloVisible es obligatorio.";
}
if (empty($autor_visible)) {
    $errores[] = "AutorVisible es obligatorio.";
}
if (empty($fecha_visible)) {
    $errores[] = "FechaVisible es obligatorio.";
}
if (empty($seccion_contenido)) {
    $errores[] = "[CONTENIDO] es obligatorio.";
}
if (empty($category)) {
    $errores[] = "[CATEGORIAS] es obligatorio.";
}
if (empty($tags)) {
    $errores[] = "[ETIQUETAS] es obligatorio.";
}

if (!empty($errores)) {
    mostrarErrores($errores);
}

// ============ PROCESAR RUTAS DE IMÁGENES ============

// Extraer nombre de imagen de URL completa
function extraerNombreImagen($url) {
    return basename($url);
}

$og_image_nombre = extraerNombreImagen($og_image_url);
$twitter_image_nombre = extraerNombreImagen($twitter_image_url);

// ============ CONVERTIR NOMBRE DE ARCHIVO A PHP SI ES NECESARIO ============

if (!str_ends_with($nombre_archivo_html, '.php')) {
    $nombre_archivo_php = str_replace('.html', '.php', $nombre_archivo_html);
} else {
    $nombre_archivo_php = $nombre_archivo_html;
}

$ruta_post = POST_DIR . $nombre_archivo_php;

// Verificar que el archivo no existe
if (file_exists($ruta_post)) {
    mostrarErrores(["El archivo {$nombre_archivo_php} ya existe."]);
}

// ============ LIMPIAR CONTENIDO HTML ============

$contenido_html = trim($seccion_contenido);
// Eliminar prefijo <html> si existe
$contenido_html = preg_replace('/^<html[^>]*>/i', '', $contenido_html);
$contenido_html = preg_replace('/<\/html>$/i', '', $contenido_html);

// ============ GENERAR CONTENIDO DEL ARCHIVO PHP ============

$codigo_php = "<?php
include '../config.php';

// [HEAD] - Metadatos para SEO y redes sociales
\$page_title = " . var_export($titulo_documento, true) . ";
\$og_type = \"article\";
\$og_title = " . var_export($titulo_documento, true) . ";
\$og_description = " . var_export($meta_description, true) . ";
\$og_image = SITE_URL . \"/assets/img/" . htmlspecialchars($og_image_nombre) . "\";
\$og_url = SITE_URL . \"/post/" . htmlspecialchars($nombre_archivo_php) . "\";
\$og_site_name = OG_SITE_NAME;
\$twitter_card = \"summary_large_image\";
\$twitter_title = " . var_export($twitter_title, true) . ";
\$twitter_description = " . var_export($twitter_description, true) . ";
\$twitter_image = SITE_URL . \"/assets/img/" . htmlspecialchars($twitter_image_nombre) . "\";
\$page_description = " . var_export($meta_description, true) . ";
\$page_author = " . var_export($autor_meta, true) . ";

// [CABECERA_VISUAL] - Datos para el masthead y cabecera del post
\$post_title = " . var_export($titulo_visible, true) . ";
\$post_subtitle = " . var_export($subtitulo_visible, true) . ";
\$post_author = " . var_export($autor_visible, true) . ";
\$post_date = " . var_export($fecha_visible, true) . ";
\$masthead_bg = SITE_URL . \"/assets/img/" . htmlspecialchars($imagen_fondo) . "\";

// [CATEGORIAS] y [ETIQUETAS] - Categorización del post
\$category = " . var_export($category, true) . ";
\$tags = " . var_export($tags, true) . ";

include '../header_common.php';
?>
<!-- Post Content-->
<article class=\"mb-4\">
    <div class=\"container px-4 px-lg-5\">
        <div class=\"row gx-4 gx-lg-5 justify-content-center\">
            <div class=\"col-md-10 col-lg-8 col-xl-7\">
                " . $contenido_html . "
            </div>
        </div>
    </div>
</article>
<?php include '../footer.php'; ?>
";

// ============ CREAR ARCHIVO DE POST ============

try {
    if (file_put_contents($ruta_post, $codigo_php) === false) {
        mostrarErrores(["No se pudo crear el archivo {$nombre_archivo_php}."]);
    }
} catch (Exception $e) {
    mostrarErrores(["Error al crear el archivo: " . $e->getMessage()]);
}

// ============ ACTUALIZAR index.php ============

$ruta_index = 'index.php';
$contenido_index = file_get_contents($ruta_index);

if ($contenido_index === false) {
    mostrarErrores(["No se pudo leer index.php."]);
}

// Crear bloque HTML del nuevo post
$bloque_nuevo_post = "                    <!-- Post preview-->
                    <div class=\"post-preview\">
                        <a href=\"" . POST_DIR . htmlspecialchars($nombre_archivo_php) . "\" target=\"_blank\">
                            <h2 class=\"post-title\">" . htmlspecialchars($titulo_visible) . "</h2>
                            <h3 class=\"post-subtitle\">" . htmlspecialchars($subtitulo_visible) . "</h3>
                        </a>
                        <p class=\"post-meta\">
                            Posted by
                            <a href=\"#!\">" . htmlspecialchars($autor_visible) . "</a>
                            on " . htmlspecialchars($fecha_visible) . "
                        </p>
                    </div>";

// Buscar el primer bloque de post-preview para insertar después del </div> del col-md-10
$patron = '/(<div class="col-md-10 col-lg-8 col-xl-7">)\s*\n\s*(<!-- Post preview-->)/';
if (preg_match($patron, $contenido_index)) {
    // Insertar el nuevo post después de <div class="col-md-10...">
    $contenido_index_actualizado = preg_replace(
        $patron,
        '$1' . "\n" . $bloque_nuevo_post . "\n                    \n$2",
        $contenido_index,
        1
    );
} else {
    mostrarErrores(["No se pudo encontrar la ubicación correcta en index.php para insertar el post."]);
}

// Guardar index.php actualizado
if (file_put_contents($ruta_index, $contenido_index_actualizado) === false) {
    mostrarErrores(["No se pudo actualizar index.php."]);
}

// ============ EJECUTAR generate_manifest.php ============

$output = shell_exec('cd ' . escapeshellarg(dirname(__FILE__)) . ' && php generate_manifest.php 2>&1');
if ($output === null) {
    mostrarErrores(["No se pudo ejecutar generate_manifest.php."]);
}

// ============ REDIRIGIR AL POST CREADO ============

// Construir URL del post
$url_post = SITE_URL . "/post/" . urlencode($nombre_archivo_php);

header('Location: ' . $url_post);
exit;

// ============ FUNCIÓN PARA MOSTRAR ERRORES ============

function mostrarErrores($errores) {
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - Crear Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 40px 0;
        }
        .error-container {
            max-width: 700px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .error-header {
            color: #dc3545;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: 700;
        }
        .error-list {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .error-list ul {
            margin: 0;
            padding-left: 20px;
        }
        .error-list li {
            color: #721c24;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .btn-back {
            background-color: #0d6efd;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
        }
        .btn-back:hover {
            background-color: #0b5ed7;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-header">⚠️ Error al crear el post</div>
        <div class="error-list">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <a href="crear-post-admin.php" class="btn-back">← Volver al formulario</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    <?php
    exit;
}
?>
