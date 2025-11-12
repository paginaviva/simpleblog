<?php
/**
 * Plantilla: post.php
 * 
 * Archivo: /templates/post.php
 * Propósito: Renderizar un artículo dinámico desde la base de datos
 * 
 * Proyecto: Meridiano Blog - Sistema Dinámico de Posts
 * Fecha: 2025-11-12
 * 
 * Variables disponibles (pasadas por /public/post.php):
 * - $articulo (array): Datos del artículo desde BD
 * - $categorias (array): Array de categorías del artículo
 * - $etiquetas (array): Array de etiquetas del artículo
 */

// Verificar que las variables existen
if (!isset($articulo) || !is_array($articulo)) {
    die('Error: Datos de artículo no disponibles');
}

// Valores por defecto para variables opcionales
$categorias = $categorias ?? [];
$etiquetas = $etiquetas ?? [];
?>

<!-- Page Header con imagen de fondo -->
<header class="masthead" style="background-image: url('<?php echo htmlspecialchars($articulo['imagen_destacada'] ?? 'assets/img/post-bg.jpg'); ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <!-- Título del artículo -->
                    <h1><?php echo htmlspecialchars($articulo['titulo']); ?></h1>
                    
                    <!-- Subtítulo (entradilla) -->
                    <?php if (!empty($articulo['entradilla'])): ?>
                        <h2 class="subheading"><?php echo htmlspecialchars($articulo['entradilla']); ?></h2>
                    <?php endif; ?>
                    
                    <!-- Metadatos: autor, fecha, tiempo de lectura -->
                    <span class="meta">
                        Posted by
                        <a href="#!">
                            <?php echo htmlspecialchars($articulo['autor_nombre'] ?? 'Meridiano Blog'); ?>
                        </a>
                        on 
                        <?php 
                            // Formatear fecha de publicación
                            $fecha = new DateTime($articulo['fecha_publicacion']);
                            echo $fecha->format('F j, Y');
                        ?>
                        <?php if (!empty($articulo['tiempo_lectura'])): ?>
                            | <?php echo (int)$articulo['tiempo_lectura']; ?> min read
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Contenido del artículo -->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                
                <!-- Contenido HTML principal del artículo -->
                <div class="post-content">
                    <?php 
                        // Renderizar HTML del artículo (ya viene escapado de la BD)
                        echo $articulo['contenido_html'];
                    ?>
                </div>
                
                <!-- Categorías (si existen) -->
                <?php if (!empty($categorias)): ?>
                    <div class="post-categories mt-4">
                        <strong>Categorías:</strong>
                        <?php foreach ($categorias as $categoria): ?>
                            <a href="?categoria=<?php echo htmlspecialchars($categoria['slug']); ?>" class="badge bg-primary ms-2">
                                <?php echo htmlspecialchars($categoria['nombre']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Etiquetas/Tags (si existen) -->
                <?php if (!empty($etiquetas)): ?>
                    <div class="post-tags mt-3">
                        <strong>Etiquetas:</strong>
                        <?php foreach ($etiquetas as $etiqueta): ?>
                            <a href="?tag=<?php echo htmlspecialchars($etiqueta['slug']); ?>" class="badge bg-secondary ms-2">
                                #<?php echo htmlspecialchars($etiqueta['nombre']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Información del autor (si disponible) -->
                <?php if (!empty($articulo['autor_nombre'])): ?>
                    <aside class="author-info mt-5 p-4 bg-light rounded">
                        <div class="row align-items-center">
                            <!-- Foto del autor -->
                            <?php if (!empty($articulo['autor_foto'])): ?>
                                <div class="col-md-3 text-center">
                                    <img src="<?php echo htmlspecialchars($articulo['autor_foto']); ?>" 
                                         alt="<?php echo htmlspecialchars($articulo['autor_nombre']); ?>" 
                                         class="img-fluid rounded-circle" 
                                         style="max-width: 150px;">
                                </div>
                                <div class="col-md-9">
                            <?php else: ?>
                                <div class="col-12">
                            <?php endif; ?>
                                <!-- Nombre del autor -->
                                <h3 class="mt-3 mt-md-0">
                                    <?php echo htmlspecialchars($articulo['autor_nombre']); ?>
                                </h3>
                                
                                <!-- Biografía del autor -->
                                <?php if (!empty($articulo['autor_bio'])): ?>
                                    <p class="text-muted">
                                        <?php echo htmlspecialchars($articulo['autor_bio']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </aside>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</article>
