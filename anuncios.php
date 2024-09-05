<?php

include 'includes/funciones.php';
includeTemplate('header.php');

?>

    <main class="contenedor seccion">
        <section class="seccion contenedor">
            <h2>Casas y Depas en Venta</h2>
    
            <?php includeTemplate('anuncios.php') ?>
        </section>
    </main>

<?php includeTemplate('footer.php') ?>