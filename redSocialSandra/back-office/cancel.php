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

if(!empty($_POST['delete'])){
    try{
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
        $connection = getDBConnection('social', 'social', 'laicos');
        $query = $connection->prepare('DELETE FROM comments WHERE user_id = :userID;');
        $query->bindParam('userID',$_SESSION['id']);
        $query->execute();

        $query = $connection->prepare('DELETE FROM likes WHERE user_id=:userID');
        $query->bindParam('userID',$_SESSION['id']);
        $query->execute();

        $query = $connection->prepare('DELETE FROM dislikes WHERE user_id=:userID');
        $query->bindParam('userID',$_SESSION['id']);
        $query->execute();

        $query = $connection->prepare('DELETE FROM entries WHERE user_id=:userID');
        $query->bindParam('userID',$_SESSION['id']);
        $query->execute();

        $query = $connection->prepare('DELETE FROM follows WHERE user_id=:userID');
        $query->bindParam('userID',$_SESSION['id']);
        $query->execute();

        $query = $connection->prepare('DELETE FROM users WHERE id=:userID');
        $query->bindParam('userID',$_SESSION['id']);
        $query->execute();

        unset($query);
        unset($connection);
        
        session_destroy();
        header('location: /index.php');
        exit;

    } catch(Exception $ex){
        $errors['wrongConnection'] = 'Ha ocurrido un problema';
        echo $errors['wrongConnection'];
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cancel</title>
    <link href="/style/backOffice.css" rel="stylesheet">
    <link href="/style/header.css" rel="stylesheet">
</head>
<body>
    <div class="mainContainer">
        <?php
           require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php');
           if(empty($_POST)){
            echo '<form action="/back-office/cancel.php" method="POST" class="registerBox">';
            echo '<label>Está seguro/a de que desea eliminar su cuenta de manera permanente?</label>';
            echo '<input type="checkbox" name="delete" value="delete">';
            echo '<input type="submit" value="confirmar" class="btn">';
            echo '</form>';
           }
           require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php');
        ?>
    </div>
</body>
</html>