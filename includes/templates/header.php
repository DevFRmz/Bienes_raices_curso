<?php
    if(!isset($_SESSION)){
        session_start();
    }

    //si login no es true auth toma null
    $auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bienes Raicez</title>
    <link rel="stylesheet" href="/<?php echo CARPETA_PROYECTO ?>/build/css/app.css" />
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <div class="barra-menu">
                    <a class="barra-logo" href="/<?php echo CARPETA_PROYECTO ?>/index.php">
                        <img src="/<?php echo CARPETA_PROYECTO ?>/build/img/logo.svg" alt="logo" />
                    </a>

                    <div class="mobile-menu">
                        <img src="/<?php echo CARPETA_PROYECTO ?>/build/img/barras.svg" alt="icono menu">
                    </div>
                </div>

                <div class="barra-nav">
                    <img src="/<?php echo CARPETA_PROYECTO ?>/build/img/dark-mode.svg" alt="icon dark mode" class="dark-mode-button">

                    <nav class="navegacion">
                        <a href="/<?php echo CARPETA_PROYECTO ?>/nosotros.php">Nosotros</a>
                        <a href="/<?php echo CARPETA_PROYECTO ?>/anuncios.php">Anuncios</a>
                        <a href="/<?php echo CARPETA_PROYECTO ?>/blog.php">Blog</a>
                        <a href="/<?php echo CARPETA_PROYECTO ?>/contacto.php">Contacto</a>
                        <?php if($auth): ?>
                            <a href="/<?php echo CARPETA_PROYECTO ?>/logout.php">Cerrar sesión</a>
                        <?php endif ?>
                    </nav>
                </div>
            </div> <!-- barra -->

            <?php if($inicio): ?>
            <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php endif ?>
        </div>
    </header>