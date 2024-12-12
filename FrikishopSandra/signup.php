<?php

ini_set('session.name','SessionSandra');
ini_set('session.cookie_httponly',1);
ini_set('session.cookie_lifetime',300);
session_start();

if(!empty($_POST)) {
    // Se eliminan los espacios delante y detrás de los campos recibidos
    foreach($_POST as $key => $value)
        $_POST[$key] = trim($value);

    // Si el campo está vacío se añade un elemento al array $errors[]
    if (empty($_POST['user']))
        $errors['user'] = 'El usuario no puede estar en blanco.';   
    if (empty($_POST['email']))
        $errors['email'] = 'El email no puede estar en blanco.';
    if (empty($_POST['password']))
        $errors['password'] = 'La contraseña no puede estar en blanco.';

    // Si no existe el array $errors[] es que todos los campos recibidos están bien
    if (!isset($errors)) {
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/env.inc.php');
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
        try {
            if ($connection = getDBConnection(DB_NAME, DB_USERNAME, DB_PASSWORD)) {
                $query = $connection->prepare("SELECT user,email FROM users WHERE user=:user;");
                $query->bindParam(':user',$_POST['user']);
                $query->execute();
                $results = $query->rowCount();
                var_dump($query);
                if($results == 1){
                    $errors['foundUser']= 'El usuario ya existe';
                } else {
                    $encryptedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $query = $connection->prepare("INSERT INTO users (user,email,password) VALUES (:user,:email,:pwd);");
                    $query->bindParam(':user',$_POST['user']);
                    $query->bindParam(':email',$_POST['email']);
                    $query->bindParam(':pwd',$encryptedPassword);
                    $query->execute();
                    header('location: /login/signup/1');
                    exit;
                }
                // Se comprueba que no exista ya en la BBDD un usuario con el username o el mail recibido
                // Si no existen hay que guardar los datos del nuevo usuario encriptando la contraseña
                //  y posteriormente se redirige a la página para que el usuario haga login

                // Si sí que existen se guarda un error para luego mostrarlo en el body

            } else {
                throw new Exception('Error en la conexión a la BBDD');
            }
        } catch (Exception $exception) {
            var_dump($exception);
            $dbError = true;
        } 
        unset($query);
        unset($connection);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MerchaShop - Error en el registro</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <?php
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php');
    ?>
    <div>
        <h2>Existen errores en el formulario:</h2>
        <?php            
            if(isset($errors)){
                foreach ($errors as $value) {
                    echo $value .'<br>';
                }
            }
        ?>
    </div>
<br>
    <a href="/">Vuelve a intentar el registro</a>
    
</body>
</html>
