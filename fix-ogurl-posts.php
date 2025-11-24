<?php
/**
 * Script para corregir og_url sin /post/ en los 12 posts editados manualmente
 * Añade /post/ a todas las URLs og_url hardcodeadas
 */

$post_dir_local = __DIR__ . '/post/';
$files = glob($post_dir_local . '*.php');
$fixed_count = 0;

echo "====================================\n";
echo "Corrigiendo og_url (falta /post/)\n";
echo "====================================\n\n";

foreach ($files as $file) {
    $filename = basename($file);
    $content = file_get_contents($file);
    
    if ($content === false) continue;
    
    $content_original = $content;
    
    // Buscar og_url sin /post/ y agregar /post/
    // Patrón: og_url = "https://www.meridiano.com/nombre-post
    // Reemplazar por: og_url = "https://www.meridiano.com/post/nombre-post
    $content = preg_replace(
        '/\$og_url = "https:\/\/www\.meridiano\.com\/([a-z0-9\-]+)"/',
        '$og_url = "https://www.meridiano.com/post/$1"',
        $content
    );
    
    if ($content !== $content_original) {
        file_put_contents($file, $content);
        echo "✓ {$filename}\n";
        $fixed_count++;
    }
}

echo "\n====================================\n";
echo "✓ Corregidos: {$fixed_count}\n";
echo "====================================\n";
?>
