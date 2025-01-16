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
                <form action="index.php" method="post">
                    <label>NUEVA PUBLICACIÓN:</label>
                    <input name="publication" type="text" placeholder="Escribe aqui..."><br>
                    <input type="submit" name="send" value="enviar">
                </form>
            </div>
    <?php
        } // cierra el if
        require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php');
    ?>
    </div>
</body>
</html>