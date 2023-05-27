<?php

require "includes/config/database.php";

$db = conectarDB();

$errores = [];

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es obligatorio o no es valido";
    }
    if (!$password) {
        $errores[] = "La contraseña es obligatoria";
    }

    if (empty($errores)) {
        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($db, $query);

        if ($resultado->num_rows) {
            $usuario = mysqli_fetch_assoc($resultado);

            $auth = password_verify($password, $usuario['password']);
            if ($auth) {
                session_start();
                $_SESSION["usuario"] = $usuario['email'];
                $_SESSION["login"] = true;
            } else {
                $errores[] = "Email o password incorrecto";
            }
        } else {
            $errores[] = "Email o password incorrecto";
        }
    }
}




require 'includes/funciones.php';
añadirPlantilla('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error"><?php echo $error; ?></div>
    <?php endforeach; ?>
    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Tu email">

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Tu contraseña">

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </fieldset>
    </form>

</main>

<?php añadirPlantilla('footer'); ?>