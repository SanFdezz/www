<?php
/**
* 
* Estudio del examen viernes 18/10/2024 
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
        // un codigo que permita llevar el registro de los vecinos de un piso y poder dar de alta y baja a los mismos. 

    $info_vecinos = [['nombre'=>'Pedro Perez', 'puerta'=>6, 'piso'=>3, 'compañeros'=>['Pepa','Loles']],
    ['nombre'=>'Mario Lopez', 'puerta'=>7, 'piso'=>3, 'compañeros'=>['Maria','Niki']],
    ['nombre'=>'Lola Lolita', 'puerta'=>8, 'piso'=>3, 'compañeros'=>['Ibelky']]
    ];

    function mostrarVecinos(array $info_vecinos){
        $cantidad_vecinos = count($info_vecinos);
        echo 'Los vecinos titulares del piso 3 son: <br>';
        for($i=0;$i<$cantidad_vecinos;$i++){
            echo $info_vecinos[$i]['nombre']. ' viviendo en la puerta '. $info_vecinos[$i]['puerta'] . '<br>';
        };
    };
    mostrarVecinos($info_vecinos);

    echo'<br>Mario Lopez se va xD <br><br>';

    unset($info_vecinos[1]); // borramos mario
    $info_vecinos = array_values($info_vecinos); //para reordenar el array y que no hayan huecos en blanco (solo numericos)
    mostrarVecinos($info_vecinos);


    ?>
</body>
</html>
