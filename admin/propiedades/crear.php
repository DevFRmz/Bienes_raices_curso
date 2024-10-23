<?php
ini_set('display_errors', 1);
require '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;


if(!estaAutenticado()) header('Location: /bienesraices');

//obtener vendedores de la base de datos
$vendedores = Vendedor::all();


$errores = [];
$propiedad = new Propiedad;

if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
    $propiedad->sincronizar($_POST);

    if($_FILES['imagen']['tmp_name']){
        $nombreImagen = md5( uniqid() ) . ".jpg";
        $propiedad->setImagen($nombreImagen);
        var_dump($propiedad->imagen);
        var_dump($nombreImagen);


        //Realiza un resize
        // create new image instance
        $manager = new ImageManager(new Driver());
        $image = $manager->read($_FILES['imagen']['tmp_name']);
        // crop the best fitting (600x360) ratio and resize to 800x600 pixel
        $image->cover(800, 600);
        $imageEncoded = $image->toJpeg(); 
    }
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

        if($succesfull) header('Location: /' . CARPETA_PROYECTO . '/admin?resultado=1');
    }
}

    includeTemplate('header.php');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="../index.php" class="boton-verde boton-return">Regresar</a>

        <?php foreach($errores as $error): ?>
            <p class="alerta error"><?php echo $error; ?></p>
        <?php endforeach ?>

        <form action="crear.php" method="post" class="formulario" enctype="multipart/form-data">
            
            <?php require '../../includes/templates/formulario_propiedades.php' ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php includeTemplate('footer.php') ?>