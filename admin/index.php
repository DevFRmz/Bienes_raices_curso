<?php
declare(strict_types = 1);
ini_set('display_errors', 1);

use App\Propiedad;

require '../includes/app.php';

if(!estaAutenticado()) header('Location: /bienesraices/login.php');

//Metodo para obtener propiedades de la base de datos
$propiedades = Propiedad::all();

//eliminar propiedad
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //validar que sea numero entero
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    
    if($id){
        $propiedad = Propiedad::find($id);
        $succesfull = $propiedad->eliminar();
    }

    if($succesfull) header('Location: /bienesraices/admin?resultado=3');
}

includeTemplate('header.php');
//para mostrar mensaje de creacion de propiedad exitosa
$resultado = $_GET['resultado'] ?? 0;

?>

    <main class="contenedor seccion main-admin">
        <h1>Administrador de Bienes Raices</h1>

        <?php if($resultado == 1): ?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php elseif($resultado == 2): ?>
            <p class="alerta exito">Anuncio Actualizado correctamente</p>
        <?php elseif($resultado == 3): ?>
            <p class="alerta exito">Anuncio Eliminado correctamente</p>
        <?php endif ?>

        <a href="./propiedades/crear.php" class="boton-verde boton-add">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($propiedades as $propiedad): ?>                  
                    <tr>
                        <td><?php echo $propiedad->id; ?></td>
                        <td><?php echo $propiedad->titulo ?></td>
                        <td><img src="/bienesraices/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen propiedad"></td>
                        <td>$<?php echo number_format( intval($propiedad->precio), 2 ) ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                                <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                            </form>
                            <a href="./propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?php if(!$propiedades): ?>
                <h3>No hay propiedades, agrega una!!</h3>
        <?php endif ?>

    </main>

<?php includeTemplate('footer.php') ?>