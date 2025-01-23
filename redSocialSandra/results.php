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

if(!empty($_GET)){
    try {
        // SI SE HA PULSADO EL BOTON DE SEGUIR, SEGUIMOS AL USUARIO DESEADO
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
        $connection = getDBConnection('social', 'social', 'laicos');
        $query = $connection->prepare('INSERT INTO follows (user_id,user_followed) VALUES (:id,:followedID);');
        $query->bindParam('id',$_SESSION['id']);
        $query->bindParam('followedID',$_GET['id']);
        $query->execute();

        unset($query);
        unset($connection);

        header('location: /index.php');
        exit;

    } catch(Exception $ex){
        $errors['wrongConnection'] = 'Ha ocurrido un problema';
        echo $errors['wrongConnection'];
    } 
} else {
    // BUSCAMOS TODOS LOS USUARIOS QUE COINCIDAN CON LO INDICADO
    $toSearch = '%'.$_POST['search'].'%';
    try {
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
        $connection = getDBConnection('social', 'social', 'laicos');
        $query = $connection->prepare('SELECT user,id FROM users WHERE user LIKE :search');
        $query->bindParam('search',$toSearch);
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_OBJ);
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
        echo '<div id="content">';
        // MOSTRAMOS RESULTADOS
        if($users){
            foreach ($users as $user) {
                echo'<div>';
                echo '<a class="user" href="/user.php?id='.$user->id.'">'.$user->user.'</a>   ';
                echo '<a class="btn" href="/results.php?id='.$user->id.'">SEGUIR</a><br>';
                echo'</div>';
            }
        } else {
            echo 'No hay resultados que coincidan con tu búsqueda.';
        }
        echo '</div><br>';
    
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php');
    ?>
    </div>
</body>
</html>