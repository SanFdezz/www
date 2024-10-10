<?php
    if(!empty($_POST)){
        foreach($_POST as $key => $value){
            $_POST[$key] = trim($value);
            if($_POST[$key]==''){
                $errors[$key] = $key.' no puede estar vacio';
            }
        } 
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        if(empty($_POST) || isset($errors) ){
            if(isset($errors)){
                echo '<div>';
                foreach($errors as $key => $error){
                    echo 'Hay un error en el campo: '. $errors[$key] .' <br>';
                }  
                echo '</div>';
            }
            
    ?>

    <form action="#" method="post">
        codigo <input type="text" name="codigo" value="<?= (isset($_POST['codigo']))? $_POST['codigo'] : '' ?>"><br>
        nombre <input type="text" name="nombre" value="<?= (isset($_POST['nombre']))? $_POST['nombre'] : '' ?>"><br>
        precio <input type="text" name="precio" value="<?= (isset($_POST['precio']))? $_POST['precio'] : '' ?>"><br>
        descripción <input type="text" name="descripción" value="<?= (isset($_POST['descripción']))? $_POST['descripción'] : '' ?>"><br>
        fabricante <input type="text" name="fabricante" value="<?= (isset($_POST['fabricante']))? $_POST['fabricante'] : '' ?>"><br>
        fecha de adquisición <input type="text" name="fecha" value="<?= (isset($_POST['fecha']))? $_POST['fecha'] : '' ?>"><br>
        <input type="submit" value="registrarse">
    </form>

    <?php

        } else {
            echo '<h1>El formulario ha sido enviado correctamente.</h1>';
        }
        
    ?>

    

    
    
</body>
</html>