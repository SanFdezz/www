<?php
/**
* 
* CODIGO PARA PODER ADMINISTRAR COMENTARIOS Y PODER COMENTAR EN POSTS DE LA GENTE
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

ini_set('session.name','SessionClicky');
ini_set('session.cookie_httponly',1);
session_start();

if(empty($_POST)){
    header('location:index.php');
    exit;
}

if($_POST['comment']==''){
    $errors['emptyComment']='No se admiten comentarios vacios.';
}

if(!isset($errors)){
    try {
        // INSERTAMOS EL COMENTARIO UNA VEZ VEMOS QUE ES ADMISIBLE
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
        $connection = getDBConnection('social', 'social', 'laicos');
        $query = $connection->prepare('INSERT INTO comments (entry_id,user_id,text) VALUES (:eID,:userID,:text);');
        $query->bindParam('eID',$_POST['entry']);
        $query->bindParam('userID',$_SESSION['id']);
        $query->bindParam('text',$_POST['comment']);
        $query->execute();
        unset($connection);
        unset($query);
        header('location:entry.php?id='.$_POST['entry']);
        exit;
    }  catch(Exception $ex){
        $errors['wrongConnection'] = 'Ha ocurrido un problema';
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
    // SI NO ES ADMISIBLE, SE MUESTRA EL ERROR
      	require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php');
        if(isset($errors)){
            foreach($errors as $error){
                echo $error;
            }
        }
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php');
    ?>
    </div>
</body>
</html>