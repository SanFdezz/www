<?php
    /**
    * 
    *
    *@author Celia López
    *@version 
    *
    */
    
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MESES</title>
</head>

<body>
    <?php
        $date = [
                'Enero' => [
                    'Days' => 31, 
                    'Month' => 1
                ],
                'Febrero' => [
                    'Days' => 28, 
                    'Month' => 2
                ],
                'Marzo' => [
                    'Days' => 31, 
                    'Month' => 3
                ],
                'Abril' => [
                    'Days' => 30, 
                    'Month' => 4
                ],
                'Mayo' => [
                    'Days' => 31, 
                    'Month' => 5
                ],
                'Junio' => [
                    'Days' => 30, 
                    'Month' => 6
                ],
                'Julio' => [
                    'Days' => 31, 
                    'Month' => 7
                ],
                'Agosto' => [
                    'Days' => 31, 
                    'Month' => 8
                ],
                'Septiembre' => [
                    'Days' => 30, 
                    'Month' => 9
                ],
                'Octubre' => [
                    'Days' => 31, 
                    'Month' => 10
                ],
                'Noviembre' => [
                    'Days' => 30, 
                    'Month' => 11
                ],
                'Diciembre' => [
                    'Days' => 31, 
                    'Month' => 12
                ]          
        ] ;
        
        echo '<pre>';
        print_r($date['Febrero']['Days']);
        echo '</pre>';
        
        function checkMonth(array $date): array{
            $monthShow= [];

            foreach ($date as $key => $value) {
                switch($date[$key]['Days']){
                    case 30:
                        $monthShow[30][] = $key ;
                        break;
                    case 28:
                        $monthShow[28][] = $key;
                        break;
                    default: 
                        $monthShow[31][] = $key;
                        break;
                }
            }
            return $monthShow;
        }
        
       $show = checkMonth($date);

       echo '<pre>';
       print_r($show);
       echo '</pre>';
       
          foreach ($show as $key => $inside) {
            echo "<br>Meses con $key días: <br><br>";
            foreach ($inside as $month) {
                echo $month . '<br>';
            }
        }
       
    ?>

</body>

</html>