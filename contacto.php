<?php

include 'includes/app.php';
includeTemplate('header.php');

?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="img/webp">
            <source srcset="build/img/destacada3.jpg" type="img/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
        </picture>

        <h2>Llena el formulario de contacto</h2>

        <form class="formulario" action="">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre">
                
                <label for="email">E-mail:</label>
                <input type="email" id="email">
                
                <label for="telefono">Telefono:</label>
                <input type="tel" id="telefono">

                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la propiedad</legend>

                <label for="opciones">Vende o compra</label>
                <select id="opciones">
                    <option value="" selected disabled>-- Selecciona --</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o presupuesto</label>
                <input id="presupuesto" type="number">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser contactado</p>
                
                <div class="forma-contacto">
                    <label>Telefono</label>
                    <input type="radio" value="telefono" name="contacto">
                    
                    <label>E-mail</label>
                    <input type="radio" value="email" name="contacto">
                </div>

                <p>Si eligio telefono, elija la fecha y la hora</p>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha">
                
                <label for="hora">hora:</label>
                <input type="time" id="hora" min="09:00" max="18:00">
            </fieldset>

            <div class="submit-button">
                <input type="submit" value="Enviar" class="boton-verde">
            </div>
        </form>
    </main>

<?php includeTemplate('footer.php') ?>
