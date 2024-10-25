<?php

/**
 * Código previamente proporcionado pero editado por mi para añadir funcionalidad.
 *
 * @author Sandra Fernández Ávila
 * @version 1.0 
 *
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/usersList.inc.php');

if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($value);
    }

    if ($_POST['user'] == '') {
        $errors['user'] = 'El campo "usuario" no puede estar vacio';
    }

    if ($_POST['user'] == '') {
        $errors['password'] = 'El campo "usuario" no puede estar vacio';
    }

    if (!isset($errors)) {
        $user = userExists($_POST['user'], $users);
        
        if ($user !== null) {
            $isLogged = $user->login($_POST['password']);

            if (!$isLogged) {
                $errors['loginError'] = 'Ha habido un problema al loggear tu cuenta, la contraseña no es correcta o ya estas loggeado.';
            }
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
        echo 'Login Correcto.';
        echo $user->__toString();
    }

    ?>




</body>

</html>