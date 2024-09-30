<?php
ini_set('display_errors', 1);
require '../../includes/app.php';
use App\Propiedad;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;


if(!estaAutenticado()) header('Location: /bienesraices');


//conección a la base de datos ($conn)
includeTemplate('header.php');

//obtener vendedores de la base de datos
$statement = $conn->query("SELECT * FROM vendedores");
$vendedores = $statement->fetchAll(PDO::FETCH_ASSOC);

$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
    $propiedad = new Propiedad($_POST);

    if($_FILES['imagen']['tmp_name']){
        $nombreImagen = md5( uniqid() ) . ".jpg";
        $propiedad->setImagen($nombreImagen);

        //Realiza un resize
        // create new image instance (800 x 600)
        $manager = new ImageManager(new Driver());
        $image = $manager->read($_FILES['imagen']['tmp_name']);
        // crop the best fitting (600x360) ratio and resize to 800x600 pixel
        $image->cover(800, 600);
        $imageEncoded = $image->toJpeg(); 
    }
    //obtener datos de los atributos para mostrarlos en el formulario
    $datos = $propiedad->atributos();
    
    //verificar si estan todos los datos completos
    $errores = $propiedad->validar();

    //si no hay errores, guardar en la base de datos
    if(empty($errores)){
        //verificar si esta creada la carpeta de imagenes, si no lo esta, la crea
        //(la constante CARPETA_IMAGENES viene de funciones.php)
        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        } 

        //guardar imagen en el servidor
        $imageEncoded->save(CARPETA_IMAGENES . $nombreImagen);

        $succesfull = $propiedad->guardar();

        if($succesfull) header('Location: /bienesraices/admin?resultado=1');
    }
}
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="../index.php" class="boton-verde boton-return">Regresar</a>

        <?php foreach($errores as $error): ?>
            <p class="alerta error"><?php echo $error; ?></p>
        <?php endforeach ?>

        <form action="crear.php" method="post" class="formulario" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo de la propiedad" value="<?php echo $datos['titulo']; ?>">
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de propiedad" value="<?php echo $datos['precio']; ?>">
                
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="img/jpeg, img/png" name="imagen">

                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $datos['descripcion']; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion de la propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" value="<?php echo $datos['habitaciones']; ?>">
                
                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" value="<?php echo $datos['wc']; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" value="<?php echo $datos['estacionamiento']; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor_id">
                    <option selected disabled>Selecciona una opción</option>
                    <?php foreach($vendedores as $vendedor): ?>
                    <option value="<?php echo $vendedor['id'] ?>"><?php echo "{$vendedor['nombre']} {$vendedor['apellido']}" ?></option>
                    <?php endforeach ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php includeTemplate('footer.php') ?>