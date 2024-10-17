<?php
/**
* Rellena un array con 50 números aleatorios comprendidos entre el 0 y el 99, y luego muéstralo en una lista desordenada. 
* Para crear un número aleatorio, utiliza la función rand(inicio, fin). Por ejemplo: $num = rand(0, 99)
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        for($i=0;$i<50;$i++){
            $miArray[] = mt_rand(0,99);
        }
    ?>
    <ul>
    <?php
        foreach($miArray as $key => $numero){
            echo '<li>'.$miArray[$key].'</li>';
        }
    ?>
    </ul>
    
</body>
</html>