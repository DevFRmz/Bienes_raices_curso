<?php
require 'includes/app.php'; 
use App\Propiedad;

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /');
}


includeTemplate('header.php');

$propiedad = Propiedad::find($id);

?>

    <main class="contenedor seccion">
        <div class="anuncio">
            <h1><?php echo $propiedad->titulo ?></h1>
            
            <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen ?>" alt="Imagen de la propiedad">
            
            <div class="resumen-propiedad">
                <p class="precio">$<?php echo $propiedad->precio ?></p>
            
                <ul class="iconos-caracteristicas">
                    <li>
                        <img src="build/img/icono_wc.svg" alt="wc" loading="lazy">
                        <p><?php echo $propiedad->wc ?></p>
                    </li>
                    <li>
                        <img src="build/img/icono_estacionamiento.svg" alt="estacionamiento" loading="lazy">
                        <p><?php echo $propiedad->estacionamiento ?></p>
                    </li>
                    <li>
                        <img src="build/img/icono_dormitorio.svg" alt="dormitorio" loading="lazy">
                        <p><?php echo $propiedad->habitaciones ?></p>
                    </li>
                </ul>
        </div>

            <div class="contenido-anuncio">
                <p><?php echo $propiedad->descripcion ?></p>
            </div>
    </main>

<?php includeTemplate('footer.php') ?>
