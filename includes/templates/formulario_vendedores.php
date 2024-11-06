<!-- <form> -->
<fieldset>
    <legend>Información del vendedor</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Nombre del vendedor" value="<?php echo $vendedor->nombre ?? ''; ?>">
    
    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" placeholder="Apellido del vendedor" value="<?php echo $vendedor->apellido ?? ''; ?>">
    
    <label for="telefono">Telefono:</label>
    <input type="tel" id="telefono" name="telefono" value="<?php echo $vendedor->telefono ?? '';?>">
</fieldset>
<!-- </form> -->