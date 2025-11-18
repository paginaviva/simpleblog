<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Meridiano Blog es un sitio dedicado al análisis del béisbol del Caribe y de las Grandes Ligas, con énfasis en la Liga Venezolana de Béisbol Profesional y otras ligas invernales." />
        <meta name="author" content="" />
        <title>Meridiano Blog · Análisis de béisbol de Venezuela y el Caribe</title>
        <!-- Open Graph -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="Meridiano Blog · Análisis de béisbol de Venezuela y el Caribe">
        <meta property="og:description" content="Meridiano Blog ofrece artículos de opinión y análisis sobre béisbol del Caribe y Grandes Ligas, con especial atención a la Liga Venezolana de Béisbol Profesional.">
        <meta property="og:image" content="<?php echo SITE_URL; ?>assets/img/home-bg.jpg">
        <meta property="og:url" content="<?php echo SITE_URL; ?>index.php">
        <meta property="og:site_name" content="<?php echo OG_SITE_NAME; ?>">
        <!-- Twitter Cards -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Meridiano Blog · Análisis de béisbol del Caribe">
        <meta name="twitter:description" content="Artículos y análisis sobre béisbol del Caribe y Grandes Ligas, centrados en la Liga Venezolana de Béisbol Profesional y otras ligas invernales.">
        <meta name="twitter:image" content="<?php echo SITE_URL; ?>assets/img/home-bg.jpg">
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y2V5THG16Y"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-Y2V5THG16Y');
        </script>
    </head>
    <body>
        <!-- Navigation-->
        <?php include 'menu.php'; ?>
        <!-- Header base para Meridiano Blog. Personaliza imagen/título en cada página principal -->
        <header class="masthead" style="background-image: url('assets/img/home-bg.jpg');">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Meridiano Blog</h1>
                            <span class="subheading">Un blog de béisbol criollo</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>