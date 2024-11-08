<?php
   require_once($_SERVER['DOCUMENT_ROOT'].'/hero.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prueba heroe</title>
</head>
<body>
    
<?php
   
    $heroe1 = new Hero('Eren', 'titan', 'Bárbaro');
    $heroe2 = new Hero('Mikasa', 'Dunmer', 'sadas');

    $info1 = $heroe1->__toString(); 
    $info2 = $heroe2->__toString(); 

    echo $info1;
    echo '<br>';
    echo $info2;
    echo '<br>';

    $arma1 = new weapon('daga',50);
    $arma2 = new weapon('espada',20);

    $result = $heroe2->addWeapon($arma1);
    $result = $heroe2->addWeapon($arma2);

    $daño = $heroe2->attack();

    echo 'El daño realizado es de: '.$daño.' puntos. <br>' ;

    $heroe2->addPotion(new potion(20));
    $heroe2->addPotion(new potion(100));

    $heroe2->usePotion();

    $info2 = $heroe2->__toString();
    echo $info2;
    echo '<br>';

?>

</body>
</html>