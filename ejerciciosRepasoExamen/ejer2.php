<?php
/**
* 
*  Script que rellene automáticamente un array con 3 números aleatorios entre 1 y 5, 
*  también rellenará automáticamente una matriz de 10x3 con números aleatorios entre 1 y 5. 
*  Por último, mostrará si alguna fila es igual al array.
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
    <title>ej2</title>
</head>
<body>
    <?php
        // rellenamos el array
        for($i=0; $i<3; $i++){
            $randomNumbers[] = mt_rand(1,5);
        } 
        echo '<pre>';
        print_r($randomNumbers);
        echo '</pre>';

        //rellenamos la matriz

        for($i=0; $i<10; $i++){
            for($j=0; $j<3; $j++){
                $randomNumbersMatriz[$i][$j] = mt_rand(1,5);
            }
        }

        $counter=0;

        foreach($randomNumbersMatriz as $numbers){
            if($numbers == $randomNumbers){
                $counter += 1;
            }
        }

        if($counter > 0){
            echo 'HAY AL MENOS UNA FILA IGUAL AL ARRAY DE NÚMEROS <br>';
        }

        echo '<pre>';
        print_r($randomNumbersMatriz);
        echo '</pre>';



    ?>
</body>
</html>