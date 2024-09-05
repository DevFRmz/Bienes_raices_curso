<?php
declare(strict_types = 1);
//conección a la base de datos ($conn)
require '../../includes/config/database.php';
include '../../includes/funciones.php';
includeTemplate('header.php');

//obtener vendedores de la base de datos
$statement = $conn->query("SELECT * FROM vendedores");
$vendedores = $statement->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $datos = [
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
            $errores[] = "Campo $key es requerido";
        }
    }

    if(empty($datos['imagen']['name'])){
        $errores[] = "Archivo de imagen requerido";
    }

    //si no hay errores ingresar a la base de datos
    if(empty($errores)){

        /* Subida de archivos al servidor */
        //carpeta donde se almacenaran
        $carpetaImagenes = '../../imagenes/';
        $nombreImagen = md5( uniqid() ) . ".jpg";
        $datos['imagen']['name'] = $nombreImagen;

        //verificar si esta creada la carpeta, si no lo esta, la crea
        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }

        //subida de imagen
        move_uploaded_file($datos['imagen']['tmp_name'], $carpetaImagenes . $nombreImagen);

        $query = "INSERT INTO propiedades(
            vendedor_id,
            titulo,
            precio,
            imagen,
            descripcion,
            habitaciones,
            wc,
            estacionamiento,
            creado
        ) VALUES (
            :vendedor_id,
            :titulo,
            :precio,
            :imagen,
            :descripcion,
            :habitaciones,
            :wc,
            :estacionamiento,
            :creado
        )";

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
            ':creado'          => $datos['creado']
        ]);

        if($succesfull) header('Location: /bienesraices/admin?resultado=1');
    }
}
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="../index.php" class="boton-verde boton-return">Regresar</a>
        Todos los derechos reservados 2024 ©

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

                <select name="vendedor">
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