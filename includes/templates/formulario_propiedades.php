<!-- <form> -->
    <fieldset>
        <legend>Información General</legend>

        <label for="titulo">Titulo:</label>
        <input type="text" id="titulo" name="titulo" placeholder="Titulo de la propiedad" value="<?php echo $propiedad->titulo ?? ''; ?>">
        
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" placeholder="Precio de propiedad" value="<?php echo $propiedad->precio ?? ''; ?>">
        
        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" accept="img/jpeg, img/png" name="imagen">
        <?php if($propiedad->imagen != ''):?>
            <img src="../../imagenes/<?php echo $propiedad->imagen ?>" class="img-small" alt="imagen de casa">
        <?php endif?>

        <label for="descripcion">Descripcion:</label>
        <textarea id="descripcion" name="descripcion"><?php echo $propiedad->descripcion ?? ''; ?></textarea>
    </fieldset>

    <fieldset>
        <legend>Informacion de la propiedad</legend>

        <label for="habitaciones">Habitaciones:</label>
        <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" value="<?php echo $propiedad->habitaciones ?? ''; ?>">
        
        <label for="wc">Baños:</label>
        <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" value="<?php echo $propiedad->wc ?? ''; ?>">

        <label for="estacionamiento">Estacionamiento:</label>
        <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" value="<?php echo $propiedad->estacionamiento ?? ''; ?>">
    </fieldset>

    <fieldset>
        <legend>Vendedor</legend>

        <select name="vendedor_id">
            <option <?php echo'selected'; ?> disabled>Selecciona una opción</option>
            <?php foreach($vendedores as $vendedor): ?>
                <option value="<?php echo $vendedor['id'] ?>"><?php echo "{$vendedor['nombre']} {$vendedor['apellido']}" ?></option>
            <?php endforeach ?>
        </select>
    </fieldset>
<!-- </form> -->