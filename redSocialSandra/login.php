<?php
/**
* 
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

ini_set('session.name','SessionClicky');
ini_set('session.cookie_httponly',1);
session_start();


    if(isset($_SESSION['user'])){
        header('location:/');
        exit;
    }
    // CORRECCIONES DE EL INICIO DE SESION
    if(!empty($_POST)){
        foreach($_POST as $key => $value){
            $_POST[$key] = trim($value);
        }

        if (empty($_POST['user'])){
            $errors['user'] = 'El usuario no puede estar en blanco.';
        }

        if (empty($_POST['password'])){
            $errors['password'] = 'La contraseña no puede estar en blanco.';
        }

        if(!isset($errors)){
            // COMPROBAMOS SI EXISTE, Y SI ES ASI, CREAMOS LA SESION
            try{
                require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
                $connection = getDBConnection('social', 'social', 'laicos');
                $query = $connection->prepare('SELECT user,password,id FROM users WHERE (user=:user OR email=:mail);');
                $query->bindParam(':user', $_POST['user']);
                $query->bindParam(':mail', $_POST['user']);
                $query->execute();
                if ($query->rowCount()!=1) {
                    $errors['login'] = 'Error en el acceso';
                } else {
                    $user = $query->fetchObject();
                    if(password_verify($_POST['password'],$user->password)){
                        session_regenerate_id();
                        $_SESSION['user']=$user->user;
                        $_SESSION['id']=$user->id;
                        unset($query);
                        unset($connection);
                        header ('location: index.php');
                        exit;
                    }
                }
            }catch(Exception $ex){
                $errors['wrongConnection'] = 'Ha habido un error.';
            }
        }

    }


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <link href="style/header.css" rel="stylesheet">
    <link href="style/body.css" rel="stylesheet">
</head>
<body>
    <div class="mainContainer">
    <?php
      	require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php');
        echo isset($errors) ? '<h3>Error en el acceso, inténtelo más tarde.</h3>' : '';
    ?>
        <form action="#" method="post" class="registerBox">
        <label for="user">Usuario o mail: </label><br>
        <input type="text" name="user" id="user" placeholder="usuario o mail" value="<?=$_POST['user']??""?>"><br>
        <label for="password">Contraseña: </label><br>
        <input type="password" name="password" id="password" value="<?=$_POST['password']??""?>"><br>
        <input type="submit" value="Accede">
        </form>
    </div>
    <?php
       require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php');
    ?>
    
</body>
</html>