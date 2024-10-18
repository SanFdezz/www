<?php
/**
* Script que simule el lanzamiento de un dado de 20 caras 100 veces. 
* El programa almacenará el número de veces que ha salido cada cara (del 1 al 20) en un array asociativo. 
* Al final, mostrará cuántas veces ha salido cada cara.
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
    <title>ej3</title>
</head>
<body>
    <?php
 
        // Inicializar cada cara del dado (del 1 al 20) en el array con valor 0
        $faces = [ "cara 1" => 0,
                "cara 2" => 0,
                "cara 3" => 0,
                "cara 4" => 0,
                "cara 5" => 0,
                "cara 6" => 0,
                "cara 7" => 0,
                "cara 8" => 0,
                "cara 9" => 0,
                "cara 10" => 0,
                "cara 11" => 0,
                "cara 12" => 0,
                "cara 13" => 0,
                "cara 14" => 0,
                "cara 15" => 0,
                "cara 16" => 0,
                "cara 17" => 0,
                "cara 18" => 0,
                "cara 19" => 0,
                "cara 20" => 0,
        ];

        // Simular el lanzamiento del dado 100 veces
        for ($i = 0; $i < 100; $i++) {
            $throw = mt_rand(1, 20); // Generar un número aleatorio entre 1 y 20
            $key = 'cara '. $throw;
            $faces[$key]++; // Incrementar el contador de la cara correspondiente
        }

        // Mostrar los resultados
        foreach ($faces as $key => $times) {
            echo "La $key ha salido $times veces.<br>";
        }

    ?>
</body>
</html>