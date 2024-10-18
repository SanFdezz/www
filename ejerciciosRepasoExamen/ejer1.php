<?php
/**
*  Script que rellene automáticamente un array con 10 números enteros aleatorios entre 0 y 100.
*  A continuación, mostrará el array por pantalla, luego lo ordenará mediante el método de la burbuja 
*  y finalmente volverá a mostrar el array por pantalla. No debes usar funciones para la ordenación.
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ej1</title>
</head>
<body>
    
    <?php
        for($i=0;$i<10;$i++){
            $randomNumbers[]= mt_rand(0,100); //para añadir valores a un array dentro de un FOR se hace asi!!!!!
        } 
        //print_r($randomNumbers);

        // recorremos el array asi, ya que no necesitamos las claves (number = valor que hay, es decir el numero random)
        echo 'ARRAY DE NÚMEROS SIN ORDENAR';
        foreach($randomNumbers as $number){
            echo '<div>';
            echo $number;
            echo '</div>';
        }

        $isOrdered = false;

        /*
        EXPLICACIÓN DE XQ FUNCIONA Y COMO:
        Basicamente, creamos un bucle while que comienza cambiando el valor de si el array esta ordenado a verdadero,
        para que si lo esta, salga del bucle.
        Si no, y entra dentro de el IF, significa que ese número ha tenido que ser ordenado, es decir, el número de atrás
        era MENOR que el número de delante, por lo que nos guardamos el número GRANDE, cambiamos, la posición del número GRANDE
        para darsela al MENOR y despues lo mismo pero usando esa variable auxiliar que hemos creado. Y como efecticamente nuestro array
        está desordenado todavia, cambiamos el boolean a FALSE y comprobaremos de nuevo el array en la siguiente iteración del while
        hasta que no llegue a entrar dento del IF y el valor del boolean sea TRUE para salir del WHILE.
        */

        while(!$isOrdered){
            $isOrdered = true;
            for($i=1; $i<count($randomNumbers); $i++){
                if($randomNumbers[$i] < $randomNumbers[$i - 1]){
                    $thisNumber = $randomNumbers[$i];
                    $randomNumbers[$i] = $randomNumbers[$i-1];
                    $randomNumbers[$i-1] = $thisNumber;
                    $isOrdered = false;
                }
            }
        }

        echo 'ARRAY DE NÚMEROS ORDENADO';
        foreach($randomNumbers as $number){
            echo '<div>';
            echo $number;
            echo '</div>';
        }

    ?>

</body>
</html>