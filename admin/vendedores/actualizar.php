<?php
declare(strict_types = 1);
require '../../includes/app.php';

use App\Vendedor;

if(!estaAutenticado())
    header('Location: /'. CARPETA_PROYECTO .'/admin');


$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
if(!$id)
    header('Location: /'. CARPETA_PROYECTO .'/admin');

$vendedor = Vendedor::find($id);

$errores = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $vendedor->sincronizar($_POST);

    $errores = $vendedor->validar();

    if(empty($errores)){
        $succesfull = $vendedor->actualizar();

        if($succesfull) header('Location: /'. CARPETA_PROYECTO .'/admin?resultado=2');

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
            <?php require '../../includes/templates/formulario_vendedores.php'; ?>
            
            <input type="submit" value="Actualizar Vendedor" class="boton boton-verde">
        </form>
    </main>

<?php includeTemplate('footer.php') ?>