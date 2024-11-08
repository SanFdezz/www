<?php

/**
 * Código previamente proporcionado pero editado por mi para añadir funcionalidad.
 *
 * @author Sandra Fernández Ávila
 * @version 1.0 
 *
 */

// unimos el archivo USERSLIST.INC.PHP a este script.
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/usersList.inc.php');

//comprobamos si es la primera vez que se entra al formulario
if (!empty($_POST)) {
    // le quitamos los espacios de antes y despues de la palabra.
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($value);
    }

    // si el usuario esta vacio, error
    if ($_POST['user'] == '') {
        $errors['user'] = 'El campo "usuario" no puede estar vacio';
    }

    // si la contraseña esta vacia, error
    if ($_POST['password'] == '') {
        $errors['password'] = 'El campo "contraseña" no puede estar vacio';
    }

    // si no hay errores entramos aqui!
    if (!isset($errors)) {
        //comprobamos si el usuario introducido existe en la bbdd 
        $user = userExists($_POST['user'], $users);
        // si existe intentamos logear al usuario si su contraseña es correcta
        if ($user !== null) {
            $isLogged = $user->login($_POST['password']);
            // si la contraseña no es correcta nos guardamos este error:
            if (!$isLogged) {
                $errors['loginError'] = 'Ha habido un problema al loggear tu cuenta, la contraseña no es correcta o ya estas loggeado.';
            }
            // si el usuario es nulo, guardamos este error:
        } else {
            $errors['notExists'] = 'El usuario introducido no existe.';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accede a la web</title>
</head>

<body>

    <?php
    // si cumple los requisitos, mostramos los errores y/o el formulario
    if (empty($_POST) || isset($errors)) {
        if (isset($errors)) {
            echo 'El formulario tiene errores';
            foreach ($errors as $error) {
                echo '<div class="error">' . $error . '</div>';
            }
        }
    ?>

        <form action="#" method="post">
            Usuario: <input type="text" name="user" value="<?= $_POST['user'] ?? '' ?>">
            <br>
            Contraseña: <input type="text" name="password" value="<?= $_POST['password'] ?? '' ?>">
            <br>
            <input type="submit" value="Acceder">
        </form>

    <?php
    } else {
        // si no, está correcto y mostramos lo siguiente: 
        echo 'Login Correcto.';
        echo $user->__toString();
    }

    ?>




</body>

</html>