<?php
/**
 * Configuración de Rutas
 * 
 * Archivo: /config/routes.php
 * Propósito: Definir rutas físicas y URLs del proyecto de forma centralizada
 * 
 * Proyecto: Meridiano Blog - Sistema Dinámico de Posts
 * Fecha: 2025-11-12
 * 
 * INSTRUCCIONES:
 * Personaliza las 2 constantes base según tu entorno:
 * - RUTA_FISICA: Ruta absoluta del servidor de archivos
 * - RUTA_URL: URL base del sitio web
 * 
 * Todas las otras rutas se derivan automáticamente de estas 2 bases.
 */

// =====================================================
// RUTAS BASE (PERSONALIZAR SEGÚN ENTORNO)
// =====================================================

/**
 * RUTA_FISICA
 * Ruta absoluta en el servidor donde está instalado el proyecto
 * 
 * Ejemplos:
 * - Desarrollo local: /home/usuario/proyectos/simpleblog/
 * - Servidor compartido: /home/udcwscico/public_html/udn_meridiano_com/
 * - XAMPP Windows: C:/xampp/htdocs/simpleblog/
 */
define('RUTA_FISICA', __DIR__ . '/../');

/**
 * RUTA_URL
 * URL base del sitio web sin barra final
 * 
 * Ejemplos:
 * - Desarrollo local: http://localhost/simpleblog
 * - Servidor en producción: https://www.meridiano.com
 * - Subdominio: https://blog.meridiano.com
 */
define('RUTA_URL', 'http://localhost/simpleblog');

// =====================================================
// RUTAS DERIVADAS (NO MODIFICAR)
// =====================================================

/**
 * Rutas de directorios físicos (para includes y acceso de archivos)
 */
define('RUTA_CONFIG', RUTA_FISICA . 'config/');
define('RUTA_CLASSES', RUTA_FISICA . 'classes/');
define('RUTA_TEMPLATES', RUTA_FISICA . 'templates/');
define('RUTA_INCLUDES', RUTA_FISICA . 'includes/');

/**
 * Rutas físicas para verificar existencia de directorios
 */
define('RUTA_CSS_FISICA', RUTA_FISICA . 'css/');
define('RUTA_JS_FISICA', RUTA_FISICA . 'js/');
define('RUTA_ASSETS_FISICA', RUTA_FISICA . 'assets/');
define('RUTA_IMG_FISICA', RUTA_ASSETS_FISICA . 'img/');

/**
 * Rutas URL para CSS, JS, imágenes (relativas al dominio)
 */
define('RUTA_CSS', RUTA_URL . '/css/');
define('RUTA_JS', RUTA_URL . '/js/');
define('RUTA_ASSETS', RUTA_URL . '/assets/');
define('RUTA_IMG', RUTA_URL . '/assets/img/');

// =====================================================
// VALIDACIÓN: Verificar que directorios existen
// =====================================================

$rutas_requeridas = [
    'config' => RUTA_CONFIG,
    'classes' => RUTA_CLASSES,
    'templates' => RUTA_TEMPLATES,
    'includes' => RUTA_INCLUDES,
    'css' => RUTA_CSS_FISICA,
    'js' => RUTA_JS_FISICA,
    'assets' => RUTA_ASSETS_FISICA,
];

foreach ($rutas_requeridas as $nombre => $ruta) {
    if (!is_dir($ruta)) {
        trigger_error("Directorio no encontrado: $nombre ($ruta)", E_USER_WARNING);
    }
}

// =====================================================
// INFORMACIÓN DE DEPURACIÓN (comentado)
// =====================================================

/*
// Descomentar para ver información de rutas en desarrollo
if (php_sapi_name() === 'cli') {
    echo "=== CONFIGURACIÓN DE RUTAS ===" . PHP_EOL;
    echo "RUTA_FISICA: " . RUTA_FISICA . PHP_EOL;
    echo "RUTA_URL: " . RUTA_URL . PHP_EOL;
    echo "RUTA_CONFIG: " . RUTA_CONFIG . PHP_EOL;
    echo "RUTA_CLASSES: " . RUTA_CLASSES . PHP_EOL;
    echo "RUTA_TEMPLATES: " . RUTA_TEMPLATES . PHP_EOL;
    echo "RUTA_INCLUDES: " . RUTA_INCLUDES . PHP_EOL;
    echo "RUTA_CSS: " . RUTA_CSS . PHP_EOL;
    echo "RUTA_JS: " . RUTA_JS . PHP_EOL;
    echo "RUTA_IMG: " . RUTA_IMG . PHP_EOL;
}
*/
?>
