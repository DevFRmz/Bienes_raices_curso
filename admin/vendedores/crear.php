<?php
ini_set('display_errors', 1);
require '../../includes/app.php';

use App\Vendedor;

if(!estaAutenticado()){
    header('Location: /'. CARPETA_PROYECTO .'/admin');
}

$errores = [];
$vendedor = new Vendedor();

if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
    $vendedor->sincronizar($_POST);

    //verificar si estan todos los datos completos
    $errores = $vendedor->validar();

    //si no hay errores, guardar en la base de datos
    if(empty($errores)){
        $succesfull = $vendedor->guardar();

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
            
            <?php require '../../includes/templates/formulario_vendedores.php' ?>

            <input type="submit" value="Crear Vendedor" class="boton boton-verde">
        </form>
    </main>

<?php includeTemplate('footer.php') ?>