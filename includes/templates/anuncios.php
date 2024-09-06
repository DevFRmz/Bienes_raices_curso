<?php
require __DIR__ . "/../config/database.php";

$query = "SELECT * from propiedades " . ($inicio == true ? 'LIMIT 3' : '');
$statement = $conn->query($query);//$limit viene del archivo donde se llama
$propiedades = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="contenedor-anuncios">
            
    <?php foreach($propiedades as $propiedad): ?>
        <div class="anuncio">
            <img src="imagenes/<?php echo $propiedad['imagen'] ?>" alt="anuncio">

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad['titulo'] ?></h3>
                <p><?php echo $propiedad['descripcion'] ?></p>
                <p class="precio">$<?php echo $propiedad['precio'] ?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img src="build/img/icono_wc.svg" alt="wc" loading="lazy">
                        <p><?php echo $propiedad['wc'] ?></p>
                    </li>
                    <li>
                        <img src="build/img/icono_estacionamiento.svg" alt="estacionamiento" loading="lazy">
                        <p><?php echo $propiedad['estacionamiento'] ?></p>
                    </li>
                    <li>
                        <img src="build/img/icono_dormitorio.svg" alt="wc" loading="lazy">
                        <p><?php echo $propiedad['habitaciones'] ?></p>
                    </li>
                </ul>

                <a href="anuncio.php?id=<?php echo $propiedad['id'] ?>" class="boton-amarillo-block">
                    Ver propiedad
                </a>
            </div><!-- contenido anuncio -->
        </div><!-- anuncio -->
    <?php endforeach ?>

</div><!-- contenedor anuncios -->