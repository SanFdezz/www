<?php
/**
* Script que rellene automáticamente un array con 20 números enteros aleatorios entre 1 y 100.
* Luego, encontrará el número más grande y el más pequeño sin usar las funciones max() ni min() y los mostrará.
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
    <title>ej4</title>
</head>
<body>
    <?php
    
        for($i=0; $i<20; $i++){
            $randomNumbers[] = mt_rand(1,100);
        } 

        $minNum = 100;
        $maxNum = 0;

        echo '<pre>';
        print_r($randomNumbers);
        echo '</pre>';

        foreach($randomNumbers as $number){
            if($number < $minNum){
                $minNum = $number;
            } else if ($number > $maxNum){
                $maxNum = $number;
            }
        }

        echo 'EL NÚMERO MÁS PEQUÑO ES: '.$minNum.' Y EL NÚMERO MÁS GRANDE ES: '.$maxNum.'.';

    ?>
</body>
</html>