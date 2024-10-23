<?php
declare(strict_types = 1);
ini_set('display_errors', 1);

use App\Propiedad;
use App\Vendedor;

require '../includes/app.php';

if(!estaAutenticado()) header('Location: /' .CARPETA_PROYECTO . '/login.php');

//Metodo para obtener propiedades de la base de datos
$propiedades = Propiedad::all();
$vendedores = Vendedor::all();

//eliminar propiedad
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //validar que sea numero entero
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    
    if($id){
        $propiedad = Propiedad::find($id);
        $succesfull = $propiedad->eliminar();
    }

    if($succesfull) header('Location: /' . CARPETA_PROYECTO . '/admin?resultado=3');
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
        
        <div class="administrar-filters">
            <p>Selecciona un filtro</p>
            <div>
                <button class="propiedades-filter-btn boton-verde">Propiedades</button>
                <button class="vendedores-filter-btn boton-verde">Vendedores</button>
            </div>
        </div>
        
        <!-- Propiedades -->
        <div class="administrar-propiedades hidden">
            <a href="./propiedades/crear.php" class="boton-verde boton-add">Añadir Propiedad</a>
            
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
                            <td><img class="admin-img" src="/<?php echo CARPETA_PROYECTO?>/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen propiedad"></td>
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
        </div>
        
        <!-- Vendedores -->
        <div class="administrar-vendedores hidden">
            <a href="./vendedores/crear.php" class="boton-verde boton-add">Añadir Vendedor</a>
            
            <table class="vendedores">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Telefono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($vendedores as $vendedor): ?>                  
                        <tr>
                            <td><?php echo $vendedor->id; ?></td>
                            <td><?php echo $vendedor->nombre ?></td>
                            <td><?php echo $vendedor->apellido ?></td>
                            <td><?php echo $vendedor->telefono ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?php echo $vendedor->id ?>">
                                    <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                                </form>
                                <a href="./propiedades/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            
            <?php if(!$vendedores): ?>
                    <h3>No hay vendedores, agrega uno!!</h3>
            <?php endif ?>
        </div>

    </main>

<?php includeTemplate('footer.php') ?>