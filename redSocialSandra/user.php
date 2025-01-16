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

try {
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
    $connection = getDBConnection('social', 'social', 'laicos');
    $query = $connection->prepare('SELECT ');


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
      	require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php');
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php');
    ?>
    </div>
</body>
</html>