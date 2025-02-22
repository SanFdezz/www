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
    
    foreach($_POST as $key => $value){
        $_POST[$key] = trim($value);
    }
    // CORRECCIONES AL FORMULARIO DE REGISTRO
    if($_POST['username']==''){
        $errors['wrongUser']='El usuario no puede estar vacío.';
    }
    if($_POST['email']==''){
        $errors['wrongEmail']='El email no puede estar vacío.';
    }
    if($_POST['password']==''){
        $errors['wrongPwd']='La contraseña no puede estar vacía.';
    }
    
    // REGISTRAMOS AL USUARIO SI NO EXISTE ANTERIORMENTE
    if(!isset($errors)){
        try{
            require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
            $connection = getDBConnection('social', 'social', 'laicos');
            $query = $connection->prepare('SELECT user, email FROM users WHERE user=:user OR email=:email;');
            $query->bindParam(':user',$_POST['username']);
            $query->bindParam(':email',$_POST['email']);
            $query->execute();
            $user = $query->fetch(PDO::FETCH_OBJ);
            if($query->rowCount()==0){
                $encryptedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $query = $connection->prepare('INSERT INTO users (user,email,password) VALUES (:user,:email,:pwd);');
                $query->bindParam(':user',$_POST['username']);
                $query->bindParam(':email',$_POST['email']);
                $query->bindParam(':pwd',$encryptedPassword);
                $query->execute();
            } else {
                if($user->email == $_POST['email']){
                    $errors['existentEmail']='Ese email ya esta registrado.';
                } else {
                    $errors['existentUsername']='Ese username ya esta registrado.';
                }
            }
            unset($query);
            unset($connection);
        } catch(Exception $ex){
            $errors['wrongConnection'] = 'Ha ocurrido un problema';
        }
    }


}
// SACAMOS TODA LA INFORMACION NECESARIA PARA MOSTRAR LOS POSTS DE NUESTROS SEGUIDOS
    try{
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
        $connection = getDBConnection('social', 'social', 'laicos');
        $query = $connection->prepare('SELECT e.id AS entry_id, e.text, user, u.id,
            (SELECT count(l.entry_id) FROM likes l WHERE l.entry_id = e.id) AS likes,
            (SELECT count(d.entry_id) FROM dislikes d WHERE d.entry_id = e.id) AS dislikes,
            (SELECT count(c.entry_id) FROM comments c WHERE c.entry_id = e.id) AS comments
            FROM users u, entries e, follows f
            WHERE e.user_id = f.user_followed AND
            :id=f.user_id AND f.user_followed = u.id
            ORDER BY e.date DESC;');
        $query->bindParam('id',$_SESSION['id']); 
        $query->execute();
        $postsInfo = $query->fetchAll(PDO::FETCH_OBJ);
        //var_dump($postsInfo);
        unset($query);
        unset($connection);

    } catch(Exception $ex){
        $errors['wrongConnection'] = 'Ha ocurrido un problema';
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
        // MOSTRAMOS FORMULARIO O ERRORES SI ES NECESARIO
        if(!isset($_SESSION['user'])){
            if(empty($_POST)||isset($errors)){
                if(isset($errors)){
                    foreach($errors as $error){
                        echo '<div class="error">'.$error.'</div><br>';
                    }
                }
            
    ?>
    <div class="registerBox">
        <div class="registerText">
            Aún no tienes cuenta?
            Regístrate: 
        </div>
        <br>
        <form action="index.php" method="post">
            <label>Usuario:</label><br>
            <input name="username" type="text" placeholder="Pepito123"><br>
            <label>Email:</label><br>
            <input name="email" type="email" placeholder="ejemplo@gmail.com"><br>
            <label>Contraseña: </label><br>
            <input name="password" type="password" placeholder="..."> <br>
            <input type="submit" name="send" value="enviar">
        </form>
    </div>
    <?php    
            }   
        } else {
            // MOSTRAMOS LOS POSTS
            foreach($postsInfo as $post){
                echo '<div class="post">';
                echo '<a href="user.php?id='.$post->id.'" class="user">'.$post->user.'</a><br>';
                echo '<a href="entry.php?id='.$post->entry_id.'" class="postContent">'.$post->text.'</a><br>';
                echo '<div class="todo">';
                echo '<button class="buttonIMG"><img class="buttonIMG" src="images/beforeLike.png" alt="like"></button>';
                echo '<button class="buttonIMG"><img class="buttonIMG" src="images/beforeDislike.png" alt="dislike"></button>';
                echo '<span>Comentarios:'.$post->comments.'</span>';
                echo'</div>';
                echo'</div> <br>';
            }
        }    
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php');
    ?>
    </div>
</body>
</html>