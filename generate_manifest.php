<?php
// Script para generar el manifiesto de posts
// Ejecutar desde la raíz del proyecto: php generate_manifest.php

require_once 'config.php';

$posts = [];
$files = glob('post/*.php');

foreach ($files as $file) {
    // Limpiar variables globales previas
    unset($page_title, $og_type, $og_title, $og_description, $og_image, $og_url, $og_site_name, $twitter_card, $twitter_title, $twitter_description, $twitter_image, $page_description, $page_author, $post_title, $post_subtitle, $post_author, $post_date, $masthead_bg, $category, $tags);

    // Incluir el archivo del post para capturar variables
    include $file;

    $slug = basename($file, '.php');

    $posts[$slug] = [
        'title' => $post_title ?? 'Sin título',
        'subtitle' => $post_subtitle ?? '',
        'category' => $category ?? 'Sin categoría',
        'tags' => $tags ?? [],
        'date' => $post_date ?? '',
        'author' => $post_author ?? '',
        'image' => $masthead_bg ?? '',
        'url' => SITE_URL . POST_DIR . $slug . '.php',
    ];
}

// Generar el contenido del archivo posts_manifest.php
$content = "<?php\n";
$content .= "// Manifiesto de posts - Generado automáticamente por generate_manifest.php\n";
$content .= "// Última actualización: " . date('Y-m-d H:i:s') . "\n";
$content .= "// No editar manualmente\n\n";
$content .= "\$posts = " . var_export($posts, true) . ";\n";
$content .= "?>";

// Escribir el archivo
file_put_contents('posts_manifest.php', $content);

echo "Manifiesto de posts actualizado exitosamente.\n";
echo "Posts procesados: " . count($posts) . "\n";
?>