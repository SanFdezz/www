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

// SI NO NOS LLEGA NADA POR POST, OBTENEMOS LOS DATOS DE NUESTRO USUARIO
if(empty($_POST)){
    try{
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
        $connection = getDBConnection('social', 'social', 'laicos');
        $query = $connection->prepare('SELECT user,email FROM users WHERE id=:id;');
        $query->bindParam('id',$_SESSION['id']);
        $query->execute();
        $data = $query->fetchObject();
        unset($query);
        unset($connection);
    } catch(Exception $ex){
        $errors['wrongConnection'] = 'Ha ocurrido un problema';
    }
} else {
    // SI NO, MODIFICAMOS NUESTROS DATOS A LOS NUEVOS.
    try{
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
        $connection = getDBConnection('social', 'social', 'laicos');
        $query = $connection->prepare('UPDATE users SET user = :user, email = :email WHERE id=:id;');
        $query->bindParam('id',$_SESSION['id']);
        $query->bindParam('user',$_POST['user']);
        $query->bindParam('email',$_POST['email']);
        $query->execute();
        $data = $query->fetchObject();
        unset($query);
        unset($connection);
    } catch(Exception $ex){
        $errors['wrongConnection'] = 'Ha ocurrido un problema';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>account</title>
    <link href="/style/backOffice.css" rel="stylesheet">
    <link href="/style/header.css" rel="stylesheet">
</head>
<body>
    <div class="mainContainer">
    <?php
        //CREAMOS EL FORMULARIO PARA EDITAR LA INFORMACION DE LA CUENTA
      	require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php');
          if(empty($_POST)){
            echo '<form action="/back-office/account.php" method="post" class="registerBox">';
            echo '<label>MODIFICAR DATOS</label><br>';
            echo '<label>USUARIO:</label>';
            echo '<input type="text" value="'.$data->user.'" name="user"><br>';
            echo '<label>EMAIL:</label>';
            echo '<input type="text" value="'.$data->email.'" name="email"><br>';
            echo '<input type="submit" value="enviar">';
            echo '</form>';
          }
          // Y AÑADIMOS LOS LINKS A VER LAS PUBLICACIONES Q TENEMOS O A ELIMINAR NUESTRA CUENTA
    ?>
    <a href="/back-office/list.php">PUBLICACIONES</a>
    <a href="/back-office/cancel.php">ELIMINAR CUENTA</a>

    <?php
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php');
    ?>
    </div>
    
</body>
</html>
