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
    <link rel="stylesheet" href="/bienesraices/build/css/app.css" />
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <div class="barra-menu">
                    <a class="barra-logo" href="/bienesraices/index.php">
                        <img src="/bienesraices/build/img/logo.svg" alt="logo" />
                    </a>

                    <div class="mobile-menu">
                        <img src="/bienesraices/build/img/barras.svg" alt="icono menu">
                    </div>
                </div>

                <div class="barra-nav">
                    <img src="/bienesraices/build/img/dark-mode.svg" alt="icon dark mode" class="dark-mode-button">

                    <nav class="navegacion">
                        <a href="/bienesraices/nosotros.php">Nosotros</a>
                        <a href="/bienesraices/anuncios.php">Anuncios</a>
                        <a href="/bienesraices/blog.php">Blog</a>
                        <a href="/bienesraices/contacto.php">Contacto</a>
                        <?php if($auth): ?>
                            <a href="/bienesraices/logout.php">Cerrar sesión</a>
                        <?php endif ?>
                    </nav>
                </div>
            </div> <!-- barra -->

            <?php if($inicio): ?>
            <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php endif ?>
        </div>
    </header>