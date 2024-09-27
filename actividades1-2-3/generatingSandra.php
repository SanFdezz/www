<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>actividad2</title>
</head>
<body>
    <ul>
        <?php
            for($i=1;$i<=5;$i++){
                echo '<li><a href="#sec'. $i .'">Sección '. $i .'</a></li>';
            }
        ?>
    </ul>

    <h1 id="#sec1">Negativo - cero - positivo</h1>

    <?php
        $random_number = mt_rand(-200,200);
        if ($random_number < 0) {
            echo 'El número '.$random_number .' es negativo.';
        } else if ($random_number > 0) {
            echo 'El número '.$random_number .' es positivo.';
        } else {
            echo 'El número '.$random_number .' es cero.';
        }
    ?>

    <h1 id="#sec2">Nota</h1>

    <?php
        $random_grade = mt_rand(0,10);
        switch ($random_grade) {
            case 0: 
            case 1:
            case 2:
                echo 'Tu nota es insuficiente.';
                break;
            case 3:
            case 4:
                echo 'Necesitas mejorar.';
                break;
            case 5:
                echo 'Has aprobado justito.';
                break;
            case 6:
                echo 'Has aprobado.';
                break;
            case 7:
                echo 'Tienes un notable bajo de media.';
                break;
            case 8:
                echo 'Tienes una media de notable.';
                break;
            case 9:
            case 10:
                echo 'Tienes una nota media de sobresaliente.';
        }
    ?>

    <?php
        $random_int = mt_rand(0,100);
        echo '<h1 id="#sec3">Tabla de multiplicar del '. $random_int .'</h1>';
    ?>

    <table border="solid" class="hola">
        <?php
            echo '<tr><td>Num</td><td>'. $random_int .'</td></tr>';
            for ($i = 1; $i <= 20; $i++) {
                echo '<tr>';
                echo '<td>'. $i .'</td>';
                // Segunda columna
                echo '<td>'. $i*$random_int .'</td>';
                echo '</tr>';
            }
        ?>
    </table>

    <h1 id="#sec4">Tabla de 4 filas y 7 columnas</h1>
    <h1 id="#sec5">Cálculo del cambio</h1>

</body>
</html>