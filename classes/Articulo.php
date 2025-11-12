<?php
/**
 * Clase Modelo: Articulo
 * 
 * Archivo: /classes/Articulo.php
 * Propósito: Gestionar operaciones con artículos en la base de datos
 * 
 * Proyecto: Meridiano Blog - Sistema Dinámico de Posts
 * Fecha: 2025-11-12
 */

class Articulo {
    
    /**
     * Conexión PDO a la base de datos
     * @var PDO
     */
    private $pdo;
    
    // =====================================================
    // CONSTRUCTOR
    // =====================================================
    
    /**
     * Constructor de la clase Articulo
     * 
     * @param PDO $pdo Conexión PDO a la base de datos
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // =====================================================
    // MÉTODO: obtenerPorUrl
    // =====================================================
    
    /**
     * Obtiene un artículo completo por su URL amigable
     * 
     * Realiza un JOIN con la tabla mb_autores para obtener datos del autor
     * Solo retorna artículos con estado 'publicado'
     * 
     * @param string $url_amigable URL amigable del artículo (ej: "yadier-molina-magallanes-segunda-etapa")
     * @return array|null Array asociativo con datos del artículo o NULL si no existe
     * 
     * Campos retornados:
     * - id: ID del artículo
     * - metatitle: Título para SEO
     * - metadescription: Descripción para SEO
     * - titulo: Título del artículo
     * - contenido_html: Contenido HTML completo
     * - entradilla: Párrafo introductorio
     * - imagen_destacada: Imagen principal
     * - imagen_articulo: Imagen dentro del artículo
     * - url_amigable: URL amigable
     * - url_canonica: URL canónica (para SEO)
     * - fecha_publicacion: Fecha de publicación
     * - extracto: Resumen corto
     * - tiempo_lectura: Tiempo estimado en minutos
     * - autor_id: ID del autor
     * - autor_nombre: Nombre del autor
     * - autor_foto: Foto del autor
     * - autor_bio: Biografía del autor
     */
    public function obtenerPorUrl($url_amigable) {
        
        // Validar parámetro
        if (empty($url_amigable)) {
            return null;
        }
        
        // Consulta SQL con JOIN a tabla de autores
        $query = "
            SELECT 
                a.id,
                a.metatitle,
                a.metadescription,
                a.titulo,
                a.contenido_html,
                a.entradilla,
                a.imagen_destacada,
                a.imagen_articulo,
                a.url_amigable,
                a.url_canonica,
                a.fecha_publicacion,
                a.extracto,
                a.tiempo_lectura,
                a.autor_id,
                au.nombre AS autor_nombre,
                au.foto AS autor_foto,
                au.bio AS autor_bio
            FROM mb_articulos a
            LEFT JOIN mb_autores au ON a.autor_id = au.id
            WHERE a.url_amigable = ? AND a.estado = 'publicado'
            LIMIT 1
        ";
        
        try {
            // Preparar consulta (prepared statement)
            $stmt = $this->pdo->prepare($query);
            
            // Ejecutar con parámetro seguro
            $stmt->execute([$url_amigable]);
            
            // Retornar resultado o NULL
            return $stmt->fetch();
            
        } catch (PDOException $e) {
            error_log('Error en obtenerPorUrl: ' . $e->getMessage());
            return null;
        }
    }
    
    // =====================================================
    // MÉTODO: obtenerCategorias
    // =====================================================
    
    /**
     * Obtiene todas las categorías de un artículo
     * 
     * Consulta la tabla puente mb_articulos_categorias para obtener
     * todas las categorías asociadas a un artículo
     * 
     * @param int $articulo_id ID del artículo
     * @return array Array de categorías, vacío si no tiene ninguna
     * 
     * Campos de cada categoría:
     * - id: ID de la categoría
     * - nombre: Nombre de la categoría (ej: "LVBP", "LIDOM")
     * - slug: Slug de la categoría (ej: "lvbp", "lidom")
     */
    public function obtenerCategorias($articulo_id) {
        
        // Validar parámetro
        if (empty($articulo_id) || !is_numeric($articulo_id)) {
            return [];
        }
        
        // Consulta SQL con JOIN a tabla puente
        $query = "
            SELECT c.id, c.nombre, c.slug
            FROM mb_categorias c
            INNER JOIN mb_articulos_categorias ac ON c.id = ac.categoria_id
            WHERE ac.articulo_id = ?
            ORDER BY c.nombre ASC
        ";
        
        try {
            // Preparar y ejecutar
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$articulo_id]);
            
            // Retornar todos los resultados
            return $stmt->fetchAll();
            
        } catch (PDOException $e) {
            error_log('Error en obtenerCategorias: ' . $e->getMessage());
            return [];
        }
    }
    
    // =====================================================
    // MÉTODO: obtenerEtiquetas
    // =====================================================
    
    /**
     * Obtiene todas las etiquetas de un artículo
     * 
     * Consulta la tabla puente mb_articulos_etiquetas para obtener
     * todas las etiquetas (tags) asociadas a un artículo
     * 
     * @param int $articulo_id ID del artículo
     * @return array Array de etiquetas, vacío si no tiene ninguna
     * 
     * Campos de cada etiqueta:
     * - id: ID de la etiqueta
     * - nombre: Nombre de la etiqueta (ej: "Yadier Molina")
     * - slug: Slug de la etiqueta (ej: "yadier-molina")
     */
    public function obtenerEtiquetas($articulo_id) {
        
        // Validar parámetro
        if (empty($articulo_id) || !is_numeric($articulo_id)) {
            return [];
        }
        
        // Consulta SQL con JOIN a tabla puente
        $query = "
            SELECT e.id, e.nombre, e.slug
            FROM mb_etiquetas e
            INNER JOIN mb_articulos_etiquetas ae ON e.id = ae.etiqueta_id
            WHERE ae.articulo_id = ?
            ORDER BY e.nombre ASC
        ";
        
        try {
            // Preparar y ejecutar
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$articulo_id]);
            
            // Retornar todos los resultados
            return $stmt->fetchAll();
            
        } catch (PDOException $e) {
            error_log('Error en obtenerEtiquetas: ' . $e->getMessage());
            return [];
        }
    }
    
    // =====================================================
    // MÉTODO: obtenerTodos (futuro)
    // =====================================================
    
    /**
     * Obtiene todos los artículos publicados (para listar en home)
     * 
     * NOTA: Este método es para implementación futura en Paso 8
     * cuando se convierta index.html a index.php
     * 
     * @param int $limite Cantidad de artículos a retornar (default: 10)
     * @param int $pagina Número de página para paginación (default: 1)
     * @return array Array de artículos
     */
    public function obtenerTodos($limite = 10, $pagina = 1) {
        // TODO: Implementar en Paso 8
        return [];
    }
}

?>
