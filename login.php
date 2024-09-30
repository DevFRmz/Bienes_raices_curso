<?php
declare(strict_types = 1);
include 'includes/app.php';

if(estaAutenticado()) header('Location: ./admin');
    
$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if(!$email){
        $errores[] = 'Email faltante o no valido';
    }
    
    if(!$password){
        $errores[] = 'Contraseña es obligatoria';
    }

    if(empty($errores)){
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $statement = $conn->prepare($query);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user){

            $auth = password_verify($password, $user['password']);

            if($auth){
                session_start();

                $_SESSION["usuario"] = $user['email'];
                $_SESSION["login"] = true;

                header('Location: ./admin');
            } else {
                $errores[] = "Credenciales no validas";
            }

        } else {
            $errores[] = "Credenciales no validas";
        }
    }

}

includeTemplate('header.php');

?>

    <main class="contenedor seccion login">
        <h1>Iniciar sesión</h1>
        
        <?php foreach($errores as $error): ?>
            <p class="alerta error"><?php echo $error; ?></p>
        <?php endforeach ?>

        <form class="formulario" method="post">
        <fieldset>
                <legend>Email y Password</legend>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" >
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton-verde-block contenido-centrado">
        </form>
    </main>

<?php includeTemplate('footer.php') ?>