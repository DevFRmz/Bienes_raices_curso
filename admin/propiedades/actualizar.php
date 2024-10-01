<?php
declare(strict_types = 1);
ini_set('display_errors',1);

use App\Propiedad;

require '../../includes/app.php';

if(!estaAutenticado()){
    header('Location: /bienesraices');
}

//validar la URL por id valido
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
if(!$id) header('Location: /bienesraices/admin');

//obtener datos de la propiedad
$propiedad = Propiedad::find($id);

//obtener vendedores de la base de datos
$statement = $conn->query("SELECT * FROM vendedores");
$vendedores = $statement->fetchAll(PDO::FETCH_ASSOC);

//inicializar variable errores para evitar fallos
$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $imagenActual = $propiedad->imagen;
    $propiedad = new Propiedad($_POST);
    $propiedad->setImagen($imagenActual);
    //si hay algun string que deveria ser number lo cambia
    //$propiedad->validateNumber();

    $errores = $propiedad->validar();

    //si no hay errores ingresar a la base de datos
    if(empty($errores)){
        //Subida de archivos al servidor//
        //carpeta donde se almacenaran
        $carpetaImagenes = '../../imagenes/';

        //verificar si esta creada la carpeta, si no lo esta, la crea
        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }

        //si el usuario agrego una nueva foto
        if($_FILES['imagen']['name']){
            //unlink elimina archivos del servidor
            //eliminamos la imagen para agregar la nueva
            unlink($carpetaImagenes . $propiedad['imagen']);
            //generamos nombre unico
            $nombreImagen = md5( uniqid() ) . ".jpg";
            $propiedad->setImagen($nombreImagen);

            //subida de imagen
            move_uploaded_file($_FILES['imagen']['tmp_name'], $carpetaImagenes . $nombreImagen);

        }
        $succesfull = $propiedad->actualizar($id);


        if($succesfull) header('Location: /bienesraices/admin?resultado=2');
    }
}

includeTemplate('header.php');
?>

    <main class="contenedor seccion">
        <h1>Actualizar</h1>

        <a href="../index.php" class="boton-verde boton-return">Regresar</a>

        <?php foreach($errores as $error): ?>
            <p class="alerta error"><?php echo $error; ?></p>
        <?php endforeach ?>

        <form method="post" class="formulario" enctype="multipart/form-data">
            <?php require '../../includes/templates/formulario_propiedades.php' ?>
            
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php includeTemplate('footer.php') ?>