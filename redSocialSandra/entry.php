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
} else {
    try {
        // para obtener la info relativa a la publicacion indicada
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
        $connection = getDBConnection('social', 'social', 'laicos');
        //obtener el post
        $query = $connection->prepare('SELECT e.text, u.user FROM entries e, users u WHERE e.user_id = u.id AND e.id = :id;');
        $query->bindParam('id',$_GET['id']);
        $query->execute();
        // aqui tenemos el post
        $post = $query->fetchObject();
        //obtener los comentarios del post
        $query = $connection->prepare('SELECT text FROM comments WHERE entry_id = :id;');
        $query->bindParam('id',$_GET['id']);
        $query->execute();
        // aqui tenemos los comentarios del post
        $comments = $query->fetchAll(PDO::FETCH_OBJ);
        unset($query);
        unset($connection);
    } catch(Exception $ex){
        $errors['wrongConnection'] = 'Ha ocurrido un problema';
        echo $errors['wrongConnection'];
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
          echo '<div class="post">';
          echo '<a href="user.php" class="user">'.$post->user.'</a><br>';
          echo '<a href="entry.php" class="postContent">'.$post->text.'</a><br>';
          echo '<div class="todo">';
          echo '<a href="" class="buttonIMG"><img class="buttonIMG" src="images/beforeLike.png" alt="like"></a>';
          echo '<a href="" class="buttonIMG"><img class="buttonIMG" src="images/beforeDislike.png" alt="dislike"></a>';
          echo'</div>';
          echo'</div> <br>';

          echo '<div class="post">';
          echo '<div class="user">COMENTARIOS:</div><br>';

          foreach($comments as $comment){
            echo '<div>'.$comment->text.'</div><br>';
          }

          
    ?>

    <form action="comment.php" method="post">
        <label>Nuevo comentario:</label><br>
        <input name="comment" type="text" placeholder="me encanta!..."><br>
        <input type="text" hidden name="entry" value="<?=$_GET['id']?>">
        <input type="submit" name="send" value="enviar">
    </form>

    <?php
        echo '</div>';
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php');
    ?>
    </div>
</body>
</html>