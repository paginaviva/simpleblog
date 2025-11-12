<?php
/**
 * Componente: header.php
 * 
 * Archivo: /includes/header.php
 * Propósito: Encabezado HTML reutilizable (Doctype, meta, estilos)
 * 
 * Proyecto: Meridiano Blog - Sistema Dinámico de Posts
 * Fecha: 2025-11-12
 * 
 * Variables disponibles:
 * - $articulo (array): Datos del artículo para meta tags
 * - $titulo (string): Título de la página (opcional)
 * - $descripcion (string): Descripción meta (opcional)
 */

// =====================================================
// INCLUIR CONFIGURACIÓN DE RUTAS
// =====================================================

require_once __DIR__ . '/../config/routes.php';

// =====================================================
// PREPARAR VARIABLES
// =====================================================

// Valores por defecto
$titulo = $titulo ?? ($articulo['metatitle'] ?? 'Meridiano Blog');
$descripcion = $descripcion ?? ($articulo['metadescription'] ?? 'Un blog de béisbol caribeño');
?><!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="<?php echo htmlspecialchars($descripcion); ?>" />
        <meta name="author" content="<?php echo htmlspecialchars($articulo['autor_nombre'] ?? 'Meridiano Blog'); ?>" />
        <title><?php echo htmlspecialchars($titulo); ?></title>
        
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="<?php echo RUTA_ASSETS; ?>favicon.ico" />
        
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?php echo RUTA_CSS; ?>styles.css" rel="stylesheet" />
        
        <!-- Open Graph Meta Tags (para redes sociales) -->
        <?php if (isset($articulo)): ?>
            <meta property="og:title" content="<?php echo htmlspecialchars($articulo['titulo'] ?? ''); ?>" />
            <meta property="og:description" content="<?php echo htmlspecialchars($articulo['entradilla'] ?? ''); ?>" />
            <?php if (!empty($articulo['imagen_destacada'])): ?>
                <meta property="og:image" content="<?php echo htmlspecialchars($articulo['imagen_destacada']); ?>" />
            <?php endif; ?>
            <meta property="og:type" content="article" />
        <?php endif; ?>
        
        <!-- Canonical URL (para SEO) -->
        <?php if (!empty($articulo['url_canonica'])): ?>
            <link rel="canonical" href="<?php echo htmlspecialchars($articulo['url_canonica']); ?>" />
        <?php endif; ?>
    </head>
    <body>
        <!-- Navigation (comentado, pero disponible para futuro uso) -->
        <!-- <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Meridiano Blog</a>
                ...
            </div>
        </nav> -->
