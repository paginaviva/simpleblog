<?php
/**
 * Configuración de Conexión a Base de Datos
 * 
 * Archivo: /config/database.php
 * Propósito: Centralizar la conexión PDO a MySQL/MariaDB
 * 
 * Proyecto: Meridiano Blog - Sistema Dinámico de Posts
 * Fecha: 2025-11-12
 */

// =====================================================
// INCLUIR CONFIGURACIÓN DE RUTAS
// =====================================================

require_once __DIR__ . '/routes.php';

// =====================================================
// CONSTANTES DE CONEXIÓN
// =====================================================

/**
 * Host del servidor de BD
 * Típicamente: localhost, 127.0.0.1, o nombre de host remoto
 */
define('DB_HOST', 'localhost');

/**
 * Usuario de BD
 * Por defecto en desarrollo local: root
 */
define('DB_USER', 'root');

/**
 * Contraseña de BD
 * En desarrollo local puede estar vacía
 * En producción: usar variable de entorno o archivo .env
 */
define('DB_PASS', '');

/**
 * Nombre de la base de datos
 * Debe coincidir con el nombre usado en estructura.sql
 */
define('DB_NAME', 'meridiano_blog');

/**
 * Codificación de caracteres
 * UTF-8 con soporte para emojis y caracteres latinos
 */
define('DB_CHARSET', 'utf8mb4');

// =====================================================
// CONEXIÓN PDO
// =====================================================

try {
    /**
     * Crear conexión PDO
     * 
     * Parámetros:
     * - DSN (Data Source Name): Especifica el tipo de BD y detalles de conexión
     * - Usuario: DB_USER
     * - Contraseña: DB_PASS
     * - Opciones: Configuración del comportamiento de PDO
     */
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            /**
             * ATTR_ERRMODE: Modo de manejo de errores
             * ERRMODE_EXCEPTION: Lanza excepciones en caso de error (recomendado)
             */
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            
            /**
             * ATTR_DEFAULT_FETCH_MODE: Modo de retorno de datos
             * FETCH_ASSOC: Retorna arrays asociativos (keys = nombres de columnas)
             */
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            
            /**
             * ATTR_EMULATE_PREPARES: Emulación de prepared statements
             * false: Usa prepared statements nativos del driver (más seguro)
             */
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
    
    /**
     * Conexión exitosa
     * $pdo está disponible para usar en toda la aplicación
     */
    
} catch (PDOException $e) {
    /**
     * Captura de excepciones de conexión
     * 
     * Errores comunes:
     * - Host incorrecto
     * - Usuario/contraseña inválidos
     * - BD no existe
     * - Servidor BD no accesible
     */
    
    // En desarrollo: mostrar error completo
    die('❌ Error de conexión a la Base de Datos: ' . $e->getMessage());
    
    // En producción (comentado): usar logging sin exponer detalles
    // error_log('Database connection failed: ' . $e->getMessage());
    // die('Error al conectar con la base de datos. Por favor intenta más tarde.');
}

?>
