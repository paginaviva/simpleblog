<?php
/**
 * Script para corregir URLs con doble slash y paréntesis extras en posts
 * Mantiene la consistencia de comillas (doble con doble)
 */

$post_dir_local = __DIR__ . '/post/';
$files = glob($post_dir_local . '*.php');
$fixed_count = 0;

echo "====================================\n";
echo "Corrigiendo URLs en posts\n";
echo "====================================\n\n";

foreach ($files as $file) {
    $filename = basename($file);
    $content = file_get_contents($file);
    
    if ($content === false) continue;
    
    $content_original = $content;
    
    // PASO 1: Remover paréntesis extras: .jpg)" → .jpg"
    $content = str_replace('.jpg)"', '.jpg"', $content);
    $content = str_replace(".jpg)'", ".jpg'", $content);
    
    // PASO 2: Reemplazar doble slash MANTENIENDO COMILLAS DOBLES
    // SITE_URL . "/post/ → rtrim(SITE_URL, '/') . "/post/
    $content = str_replace('SITE_URL . "/post/', 'rtrim(SITE_URL, \'/\') . "/post/', $content);
    $content = str_replace('SITE_URL . "/assets/', 'rtrim(SITE_URL, \'/\') . "/assets/', $content);
    
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
