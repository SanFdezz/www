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

if(empty($_GET['id'])){
    header('location:index.php');
    exit;
}

// OBTENEMOS TODA LA INFORMACION DEL USUARIO SELECCIONADO Y LA MOSTRAMOS
try {
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
    $connection = getDBConnection('social', 'social', 'laicos');
    $query = $connection->prepare('SELECT COUNT(*) AS followers FROM follows WHERE user_followed = :userID');
    $query->bindParam('userID',$_GET['id']);
    $query->execute();
    $followers = $query->fetchObject();

    $query = $connection->prepare('SELECT user FROM users WHERE id = :userID');
    $query->bindParam('userID',$_GET['id']);
    $query->execute();
    $username = $query->fetchObject();

    $query = $connection->prepare('SELECT e.text,e.id,
            (SELECT COUNT(l.entry_id) FROM likes l WHERE l.entry_id = e.id) AS likes,
            (SELECT count(d.entry_id) FROM dislikes d WHERE d.entry_id = e.id) AS dislikes
            FROM entries e WHERE user_id=:id ORDER BY date ASC;');
    $query->bindParam('id',$_GET['id']);
    $query->execute();
    $posts = $query->fetchAll(PDO::FETCH_OBJ);
    
    unset($query);
    unset($connection);
} catch(Exception $ex){
    $errors['wrongConnection'] = 'Ha ocurrido un problema';
    echo $errors['wrongConnection'];
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
        // AQUI MOSTRAMOS SU INFORMACION Y SUS POSTS
           require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php');
            echo '<div class="userInfo">'; 
            echo'<h1 class="user">'.$username->user.'</h1>';
            echo'<h2 class="user"> SEGUIDORES:'.$followers->followers.'</h2>';
            echo'</div>';
           if($posts){
            foreach($posts as $post){
                echo '<div class="post">';
                echo '<a href="/entry.php?id='.$post->id.'" class="postContent">'.$post->text.'</a>';
                echo '<div><img class="buttonIMG" src="images/beforeLike.png" alt="like">:'.$post->likes.'</div>';
                echo '<div><img class="buttonIMG" src="images/Beforedislike.png" alt="dislike">:'.$post->dislikes.'</div>';
                echo '</div>';
            }
           } else {
            echo '<h2>Sin posts</h2>';
           }
           require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php');
        ?>
        
    </div>
</body>
</html>