<?php

include 'includes/funciones.php';
includeTemplate('header.php');

?>

    <main class="contenedor seccion">
        <h1>Guia para la decoración de tu hogar</h1>
        
        <picture>
            <source srcset="build/img/destacada2.webp" type="img/webp">
            <source srcset="build/img/destacada2.jpg" type="img/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen destacada">
        </picture>
        <p>Escrito el: <span>20/10/2024</span> por: <span>Admin</span></p>
        
        <div class="resumen-propiedad">
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