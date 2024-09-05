<?php

require 'includes/config/database.php';
include 'includes/funciones.php';
includeTemplate('header.php');

$id = $_GET['id'];
$query = "SELECT * from propiedades WHERE id = :id";
$statement = $conn->prepare($query);
$statement->execute([':id' => $id]);
$propiedad = $statement->fetch(PDO::FETCH_ASSOC);

?>

    <main class="contenedor seccion">
        <h1>Casa en venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="img/webp">
            <source srcset="build/img/destacada.jpg" type="img/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen destacada">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img src="build/img/icono_wc.svg" alt="wc" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img src="build/img/icono_estacionamiento.svg" alt="estacionamiento" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img src="build/img/icono_dormitorio.svg" alt="wc" loading="lazy">
                    <p>3</p>
                </li>
            </ul>

            <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quam itaque cupiditate voluptate
                laboriosam explicabo dignissimos molestias dolores et at quasi blanditiis, earum perspiciatis.
                Incidunt iure magnam cupiditate laudantium eius eligendi?Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Facere nisi, delectus harum quidem distinctio aliquid numquam quo est, quaerat
                iste, ipsam consequuntur quasi officiis qui at nesciunt molestias. A, quam?
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quam itaque cupiditate voluptate
                laboriosam explicabo dignissimos molestias dolores et at quasi blanditiis, earum perspiciatis.
                Incidunt iure magnam cupiditate laudantium eius eligendi?
            </p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Et totam illum incidunt iure sint quasi
                laboriosam culpa unde, quidem ratione reprehenderit! Architecto accusantium quis laborum, quod et
                quia saepe iste!
            </p>
        </div>
    </main>

<?php includeTemplate('footer.php') ?>
