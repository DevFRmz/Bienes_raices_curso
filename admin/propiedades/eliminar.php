<?php
require '../../includes/app.php';
use App\Propiedad;

if(!estaAutenticado()){
    header('Location: /'. CARPETA_PROYECTO .'/admin');
}

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

?>