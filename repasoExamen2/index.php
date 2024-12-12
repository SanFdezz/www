<?php
/**
* prueba examen
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

$nombre = '/^[a-zA-ZÁÉÍÓÚáéíóúÑñüÜ\s]+$/';
$edad = '/^\d{1,2}$/';
$cumpleanyos = '/^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-(\d{4})$/';

if(!empty($_POST)){
    if($_POST['nombre']==''){
        $errors['noNombre'] = 'El campo no puede estar vacío';
    } else if(!preg_match($nombre,$_POST['nombre'])) {
        $errors['malNombre'] = 'El nombre no es aceptable.';
    }

    if($_POST['edad']==''){
        $errors['noEdad'] = 'El campo no puede estar vacío';
    } else if(!preg_match($edad,$_POST['edad'])) {
        $errors['malEdad'] = 'La edad no es aceptable.';
    }

    if($_POST['cumple']==''){
        $errors['noCumple'] = 'El campo no puede estar vacío';
    } else if(!preg_match($cumpleanyos,$_POST['cumple'])) {
        $errors['malCumple'] = 'El cumple no es aceptable.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    if(empty($_POST) || isset($errors)){
        if(isset($errors)){
            echo '<div class="error">';
                foreach($errors as $error){
                    echo $error.'<br>';
                }
            echo '</div>';
        }
    ?>
   <form method="post" action="index.php">
        <label>Nombre:</label>
        <input name="nombre" placeholder="Ej: antonio">
        <label>Edad:</label>
        <input name="edad" placeholder="Ej: 19">
        <label>Cumpleaños:</label>
        <input name="cumple" placeholder="Ej:04-10-2005">
        <input type="submit" name="enviar">
    </form>
    <?php

    } else {
        echo '<h1 class="fine">Todo correcto!</h1>';
    }
    
    
    ?>
</body>
</html>