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

try{
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
    $connection = getDBConnection('social', 'social', 'laicos');
    $query = $connection->prepare('SELECT text,id FROM entries WHERE user_id=:id ORDER BY date ASC;');
    $query->bindParam('id',$_SESSION['id']);
    $query->execute();
    $posts = $query->fetchAll(PDO::FETCH_OBJ);
    unset($query);
    unset($connection);
} catch(Exception $ex){
    $errors['wrongConnection'] = 'Ha ocurrido un problema';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list</title>
    <link href="/style/backOffice.css" rel="stylesheet">
    <link href="/style/header.css" rel="stylesheet">
</head>
<body>
    <div class="mainContainer">
        <?php
           require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php');
           if($posts){
            foreach($posts as $post){
                echo '<div class="post">';
                echo '<a href="/entry.php?id='.$post->id.'">'.$post->text.'</a>';
                echo '<button class="btn"><a href="/back-office/delete.php?entry='.$post->id.'">ELIMINAR</a></button>';
                echo '</div>';
            }
           } else {
            echo '<h2>No has posteado nada todavia</h2>';
           }
           require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php');
        ?>
        
    </div>
</body>
</html>
