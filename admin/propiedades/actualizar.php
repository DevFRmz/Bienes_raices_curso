<?php
declare(strict_types = 1);
//conección a la base de datos ($conn)
require '../../includes/config/database.php';
include '../../includes/funciones.php';
includeTemplate('header.php');

//obtener vendedores de la base de datos
$statement = $conn->query("SELECT * FROM vendedores");
$vendedores = $statement->fetchAll(PDO::FETCH_ASSOC);

//obtener propiedad a actualizar
$id = $_GET['id'];

if($id){
    $statement = $conn->prepare("SELECT * FROM propiedades WHERE id = :id");
    $statement->execute([
        'id' => $id
    ]);
    $propiedad = $statement->fetch(PDO::FETCH_ASSOC);
    
    $datos = [
        "id"              => $propiedad['id'],
        "titulo"          => $propiedad['titulo'],
        "precio"          => $propiedad['precio'],
        "imagen"          => $propiedad['imagen'],
        "descripcion"     => $propiedad['descripcion'],
        "habitaciones"    => $propiedad['habitaciones'],
        "wc"              => $propiedad['wc'],
        "estacionamiento" => $propiedad['estacionamiento'],
        "vendedor"        => $propiedad['vendedor_id'],
        "creado"          => $propiedad['creado']
    ];
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $datos = [
        "id"              => $id,
        "titulo"          => $_POST['titulo'],
        "precio"          => $_POST['precio'],
        "imagen"          => $_FILES['imagen'],
        "descripcion"     => $_POST['descripcion'],
        "habitaciones"    => $_POST['habitaciones'],
        "wc"              => $_POST['wc'],
        "estacionamiento" => $_POST['estacionamiento'],
        "vendedor"        => $_POST['vendedor'],
        "creado"          => date('Y/m/d')
    ];

    $errores = [];
    //validar si se mandaron todos los datos, si no mandar error
    foreach ($datos as $key => $value) {
        if(!$value){
            if($key === 'imagen') continue;
            $errores[] = "Campo $key es requerido";
        }
    }


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
        if($datos['imagen']['name']){
            //unlink elimina archivos del servidor
            //eliminamos la imagen para agregar la nueva
            unlink($carpetaImagenes . $propiedad['imagen']);
            //generamos nombre unico
            $nombreImagen = md5( uniqid() ) . ".jpg";
            $datos['imagen']['name'] = $nombreImagen;

            //subida de imagen
            move_uploaded_file($datos['imagen']['tmp_name'], $carpetaImagenes . $nombreImagen);

        } else {
            //si no agrego nueva imagen utilizar la que ya tenia
            $datos['imagen']['name'] = $propiedad['imagen'];
        }

        
        $query = "UPDATE propiedades
                SET vendedor_id = :vendedor_id,
                    titulo = :titulo,
                    precio = :precio,
                    imagen = :imagen,
                    descripcion = :descripcion,
                    habitaciones = :habitaciones,
                    wc = :wc,
                    estacionamiento = :estacionamiento,
                    creado = :creado
                WHERE id = :id";

        $statement = $conn->prepare($query);
        $succesfull = $statement->execute([
            ':vendedor_id'     => $datos['vendedor'],
            ':titulo'          => $datos['titulo'],
            ':precio'          => $datos['precio'],
            ':imagen'          => $datos['imagen']['name'],
            ':descripcion'     => $datos['descripcion'],
            ':habitaciones'    => $datos['habitaciones'],
            ':wc'              => $datos['wc'],
            ':estacionamiento' => $datos['estacionamiento'],
            ':creado'          => $datos['creado'],
            ':id'              => $datos['id']
        ]);


        if($succesfull) header('Location: /bienesraices/admin?resultado=2');
    }
}
?>

    <main class="contenedor seccion">
        <h1>Actualizar</h1>

        <a href="../index.php" class="boton-verde boton-return">Regresar</a>

        <?php foreach($errores as $error): ?>
            <p class="alerta error"><?php echo $error; ?></p>
        <?php endforeach ?>

        <form method="post" class="formulario" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo de la propiedad" value="<?php echo $datos['titulo']; ?>">
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de propiedad" value="<?php echo $datos['precio']; ?>">
                
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="img/jpeg, img/png" name="imagen">
                <img class="img-small" src="../../imagenes/<?php echo $datos['imagen'] ?>" alt="imagen propiedad">

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

                <select name="vendedor">
                    <?php foreach($vendedores as $vendedor): ?>
                    <option value="<?php echo $vendedor['id'] ?>" <?php echo ($vendedor['id'] == $datos['vendedor']) ? 'selected' : '';?> ><?php echo "{$vendedor['nombre']} {$vendedor['apellido']}" ?></option>
                    <?php endforeach ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php includeTemplate('footer.php') ?>