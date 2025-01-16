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

if(!empty($_POST)){
    if($_POST['publication'] == ""){
        $errors['emptyEntry']="Por favor, rellene el campo.";
    }

    if(!isset($errors)){
        try{
            require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
            $connection = getDBConnection('social', 'social', 'laicos');
            $query = $connection->prepare('INSERT INTO entries (text,user_id) VALUES (:text,:userID);');
            $query->bindParam(':text',$_POST['publication']);
            $query->bindParam(':userID',$_SESSION['id']);
            $query->execute();
            // hacemos una select para obtener el id de la entry y poder llevar al usuario a la pestaña del post.
            $query = $connection->prepare('SELECT id FROM entries WHERE user_id = :id;');
            $query->bindParam('id',$_SESSION['id']);
            $query->execute();
            $entryID = $query->fetchObject();
            var_dump($entryID);
            unset($query);
            unset($connection);
            header('location:entry.php?'.$entryID->id);
            exit;
        } catch(Exception $ex){
            $errors['wrongConnection'] = 'Ha ocurrido un problema';
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

        if(empty($_POST)||isset($errors)){
            if(isset($errors)){
                foreach($errors as $error){
                    echo '<div class="error">'.$error.'</div><br>';
                }
            }
    ?>
            <div class="registerBox">
                <form action="new.php" method="post">
                    <label>NUEVA PUBLICACIÓN:</label>
                    <input name="publication" type="text" placeholder="Escribe aqui..."><br>
                    <input type="submit" name="send" value="enviar">
                </form>
            </div>
    <?php
        }
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php');
    ?>
    </div>
</body>
</html>