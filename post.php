<?php
/**
 * Controlador: post.php
 * 
 * Archivo: /post.php (raíz del proyecto)
 * Propósito: Renderizar artículos dinámicamente desde la base de datos
 * 
 * Proyecto: Meridiano Blog - Sistema Dinámico de Posts
 * Fecha: 2025-11-12
 * 
 * Uso:
 *   - Solicitud GET: /post.php?url=yadier-molina-magallanes-segunda-etapa
 *   - Validación: Solo acepta URLs amigables con letras, números, guiones
 *   - Respuestas: 200 (éxito), 404 (artículo no encontrado), 500 (error servidor)
 * 
 * Pasos:
 *   1. Incluir configuración de rutas (routes.php)
 *   2. Incluir clase de artículos (Articulo.php)
 *   3. Validar parámetro URL con preg_match
 *   4. Consultar BD y obtener artículo, categorías, etiquetas
 *   5. Incluir header, template, footer para renderizado
 * 
 * Seguridad:
 *   - Prepared statements (PDO)
 *   - htmlspecialchars() en salidas
 *   - Validación URL con preg_match
 *   - Respuesta 404 para URLs inválidas
 */

// =====================================================
// 1. INCLUIR CONFIGURACIÓN Y CLASES
// =====================================================

require_once __DIR__ . '/config/routes.php';
require_once RUTA_CONFIG . 'database.php';
require_once RUTA_CLASSES . 'Articulo.php';

// =====================================================
// 2. VALIDAR PARÁMETRO URL
// =====================================================

// Obtener URL amigable del parámetro GET
$url_amigable = isset($_GET['url']) ? trim($_GET['url']) : '';

// Validar formato: solo letras, números, guiones (alfanumérico con guiones)
if (!preg_match('/^[a-z0-9-]+$/i', $url_amigable)) {
    // URL inválida: responder con 404
    http_response_code(404);
    $titulo = 'Artículo No Encontrado';
    $descripcion = 'El artículo que buscas no existe.';
    include RUTA_INCLUDES . 'header.php';
    ?>
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <h1>404 - Artículo No Encontrado</h1>
                    <p>Lo siento, el artículo que buscas no existe o la URL es inválida.</p>
                    <p><a href="index.php">← Volver al inicio</a></p>
                </div>
            </div>
        </div>
    </main>
    <?php
    include RUTA_INCLUDES . 'footer.php';
    exit;
}

// =====================================================
// 3. CONSULTAR ARTÍCULO DE LA BD
// =====================================================

try {
    $articulo_obj = new Articulo($db);
    $articulo = $articulo_obj->obtenerPorUrl($url_amigable);
    
    if (!$articulo) {
        // Artículo no encontrado en BD
        http_response_code(404);
        $titulo = 'Artículo No Encontrado';
        $descripcion = 'El artículo que buscas no existe.';
        include RUTA_INCLUDES . 'header.php';
        ?>
        <main class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <h1>404 - Artículo No Encontrado</h1>
                        <p>Lo siento, el artículo "<strong><?php echo htmlspecialchars($url_amigable); ?></strong>" no existe en la BD.</p>
                        <p><a href="index.php">← Volver al inicio</a></p>
                    </div>
                </div>
            </div>
        </main>
        <?php
        include RUTA_INCLUDES . 'footer.php';
        exit;
    }
    
    // =====================================================
    // 4. OBTENER CATEGORÍAS Y ETIQUETAS DEL ARTÍCULO
    // =====================================================
    
    $categorias = $articulo_obj->obtenerCategorias($articulo['id']);
    $etiquetas = $articulo_obj->obtenerEtiquetas($articulo['id']);
    
    // =====================================================
    // 5. INCLUIR HEADER, TEMPLATE, FOOTER
    // =====================================================
    
    include RUTA_INCLUDES . 'header.php';
    include RUTA_TEMPLATES . 'post.php';
    include RUTA_INCLUDES . 'footer.php';
    
} catch (PDOException $e) {
    // Error de BD
    http_response_code(500);
    $titulo = 'Error del Servidor';
    $descripcion = 'Ocurrió un error al cargar el artículo.';
    include RUTA_INCLUDES . 'header.php';
    ?>
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <h1>500 - Error del Servidor</h1>
                    <p>Disculpa, ocurrió un error al procesar tu solicitud.</p>
                    <details style="margin-top: 2rem; padding: 1rem; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 0.25rem;">
                        <summary style="cursor: pointer; font-weight: bold; color: #721c24;">Detalles del error (solo desarrollo)</summary>
                        <pre style="margin-top: 1rem; color: #721c24; overflow-x: auto;">
                            <code><?php echo htmlspecialchars($e->getMessage()); ?></code>
                        </pre>
                    </details>
                    <p><a href="index.php">← Volver al inicio</a></p>
                </div>
            </div>
        </div>
    </main>
    <?php
    include RUTA_INCLUDES . 'footer.php';
    exit;
} catch (Exception $e) {
    // Error genérico
    http_response_code(500);
    $titulo = 'Error del Servidor';
    $descripcion = 'Ocurrió un error inesperado.';
    include RUTA_INCLUDES . 'header.php';
    ?>
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <h1>500 - Error Inesperado</h1>
                    <p>Disculpa, ocurrió un error inesperado al procesar tu solicitud.</p>
                    <p><a href="index.php">← Volver al inicio</a></p>
                </div>
            </div>
        </div>
    </main>
    <?php
    include RUTA_INCLUDES . 'footer.php';
    exit;
}
?>