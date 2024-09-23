<?php

include 'includes/app.php';
includeTemplate('header.php');

?>

    <main class="contenedor seccion contenido-centrado">
        
        <div class="blog">
            <h1>Nuestro blog</h1>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="img/webp">
                        <source srcset="build/img/blog1.jpg" type="img/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p>Escrito el: <span>20/10/2024</span> por: <span>Admin</span></p>
                        <p>
                            Consejos para construir una terraza en el techo de tu casa con los mejores materiales y
                            ahorrando dinero
                        </p>
                    </a>
                </div>
            </article>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="img/webp">
                        <source srcset="build/img/blog2.jpg" type="img/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Guia para la decoracion de tu hogar</h4>
                        <p>Escrito el: <span>20/10/2024</span> por: <span>Admin</span></p>
                        <p>
                            Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles
                            y colores para darle vida a tu espacio
                        </p>
                    </a>
                </div>
            </article>
        </div>
    </main>

<?php includeTemplate('footer.php') ?>
