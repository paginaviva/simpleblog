<?php

// ================= CONFIG =================
$baseUrl   = "https://www.meridiano.com";  // <-- CAMBIA ESTO a tu dominio (sin / final)
$rootDir   = __DIR__;
$indexFile = $rootDir . "/index.php";
// ==========================================


// Convierte "17 de noviembre de 2025" → "2025-11-17"
function spanishDateToISO($dateStr) {
    $dateStr = trim($dateStr);

    $months = [
        'enero'      => '01',
        'febrero'    => '02',
        'marzo'      => '03',
        'abril'      => '04',
        'mayo'       => '05',
        'junio'      => '06',
        'julio'      => '07',
        'agosto'     => '08',
        'septiembre' => '09',
        'setiembre'  => '09',
        'octubre'    => '10',
        'noviembre'  => '11',
        'diciembre'  => '12',
    ];

    if (preg_match('/(\d{1,2})\s+de\s+([a-záéíóúñ]+)\s+de\s+(\d{4})/i', $dateStr, $m)) {
        $day       = str_pad($m[1], 2, '0', STR_PAD_LEFT);
        $monthName = strtolower($m[2]);
        $year      = $m[3];

        $month = isset($months[$monthName]) ? $months[$monthName] : '01';

        return $year . '-' . $month . '-' . $day;
    }

    return null;
}


// -----------------------------------------------------------
// 1) Leer index.php y extraer href + fecha de cada post
// -----------------------------------------------------------

$datesByPath = [];

if (!file_exists($indexFile)) {
    die("No se encontró index.php en: " . $indexFile);
}

$content = file_get_contents($indexFile);

// Patrón para cosas tipo:
// <a href="/post/xxx.php">...</a>
// ...
// on 17 de noviembre de 2025
$pattern = '/href="([^"]+)"[^>]*>.*?<\/a>.*?on\s+([^<]+)/is';

if (preg_match_all($pattern, $content, $matches, PREG_SET_ORDER)) {
    foreach ($matches as $match) {
        $hrefRaw = $match[1];  // ej: /post/semana-5-resumen.php
        $dateRaw = $match[2];  // ej: 17 de noviembre de 2025

        $href     = trim($hrefRaw);
        $dateText = trim($dateRaw);

        // Normalizamos ruta relativa: "post/xxx.php"
        $relativePath = ltrim($href, "/");

        $isoDate = spanishDateToISO($dateText);

        if ($isoDate !== null) {
            $datesByPath[$relativePath] = $isoDate;
        }
    }
}


// -----------------------------------------------------------
// 2) Obtener SOLO index.php y archivos dentro de /post/
// -----------------------------------------------------------

function getTargetFiles($rootDir) {
    $files = [];

    // Incluir siempre index.php si existe
    $indexPath = $rootDir . '/index.php';
    if (file_exists($indexPath)) {
        $files[] = $indexPath;
    }

    // Incluir solo archivos dentro de /post/
    $postDir = $rootDir . '/post';
    if (is_dir($postDir)) {
        $rii = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $postDir,
                FilesystemIterator::SKIP_DOTS | FilesystemIterator::FOLLOW_SYMLINKS
            )
        );

        foreach ($rii as $file) {
            /** @var SplFileInfo $file */
            if ($file->isDir()) {
                continue;
            }

            $path = $file->getPathname();

            // Si quieres solo .php, deja así:
            if (preg_match('/\.php$/i', $path)) {
                $files[] = $path;
            }

            // Si quisieras también .html:
            // if (preg_match('/\.(php|html)$/i', $path)) { ... }
        }
    }

    return $files;
}

$files = getTargetFiles($rootDir);


// -----------------------------------------------------------
// 3) Generar sitemap.xml (solo index.php + /post/)
// -----------------------------------------------------------

$sitemap  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$sitemap .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

foreach ($files as $file) {
    // Ruta relativa respecto a la raíz
    $relative = str_replace($rootDir . DIRECTORY_SEPARATOR, '', $file);
    $relative = str_replace(DIRECTORY_SEPARATOR, '/', $relative);

    $url = rtrim($baseUrl, '/') . '/' . $relative;

    // Si hay fecha en index.php para ese post, la usamos
    if (isset($datesByPath[$relative])) {
        $lastmod = $datesByPath[$relative];
    } else {
        // Para index.php (y cualquier /post/ sin fecha en index)
        $lastmod = date("Y-m-d", filemtime($file));
    }

    $sitemap .= "  <url>\n";
    $sitemap .= "    <loc>" . htmlspecialchars($url, ENT_XML1) . "</loc>\n";
    $sitemap .= "    <lastmod>$lastmod</lastmod>\n";
    // Changefreq diferente para index.php
    if ($relative === "index.php") {
        $changefreq = "daily";
    } else {
        $changefreq = "never";
    }
    $sitemap .= "    <changefreq>$changefreq</changefreq>\n";
    $sitemap .= "    <priority>0.8</priority>\n";
    $sitemap .= "  </url>\n";
}

$sitemap .= "</urlset>\n";

file_put_contents($rootDir . "/sitemap.xml", $sitemap);

echo "Sitemap generado solo con index.php y archivos dentro de /post/ usando fechas de index.php cuando existen.";
