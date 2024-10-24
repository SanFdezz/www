<?php
/**
* 
* PARTE 4 DE LA APP DE CANDIDATOS
*
* @author Sandra Fernández Ávila
* @version 4.0
*
*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fotos candidatos</title>
</head>
<body>
    <?php
        //contamos cuantos archivos hay dentro de candidatos
        
        foreach(scandir('./images/candidates/thumbnails') as $file){
            if($file != '.' && $file != '..'){
                echo '<img src="createImagesWatermark.php?image='.$file.'" alt="imagen">';
            }
        }
    ?>
</body>
</html>