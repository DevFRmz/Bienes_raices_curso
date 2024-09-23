<?php

include 'includes/app.php';
includeTemplate('header.php');

?>

    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>

        <div class="nosotros">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img src="build/img/nosotros.jpg" alt="Imagen nosotros">
            </picture>

            <div class="nosotros-contenido">
                <p>25 años de experiencia</p>
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
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Mas sobre nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Non error ipsam, soluta, reiciendis
                    suscipit voluptatum quas adipisci dolore doloremque eveniet veniam voluptates officiis beatae?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Non error ipsam, soluta, reiciendis
                    suscipit voluptatum quas adipisci dolore doloremque eveniet veniam voluptates officiis beatae?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Non error ipsam, soluta, reiciendis
                    suscipit voluptatum quas adipisci dolore doloremque eveniet veniam voluptates officiis beatae?</p>
            </div>
        </div>
    </section>

<?php includeTemplate('footer.php') ?>