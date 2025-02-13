<?php
/**
 * CÓDIGO DE LA ACTIVIDAD 2 DE Actividad 2 – Validando la información
 * 
 * @author Sandra Fernández Ávila
 * @version 1.0
 * 
 */

        if(!empty($_POST)){
            foreach($_POST as $key => $value){
                $_POST[$key] = trim($value);
            }

            if($_POST['codigo']==''){
                $errors['codigo'] = 'El campo codigo no puede estar vacio';
            } else if (!preg_match('/\w-[0-9]{5}/',$_POST['codigo'])) {
                $errors['codigo'] = 'El código no es válido, ( ej: a-12345 )';
            }

            if($_POST['nombre']==''){
                $errors['nombre'] = 'El campo nombre no puede estar vacio';
            } else if (!preg_match('/^[a-zA-Z]{3,20}$/',$_POST['nombre'])) {
                $errors['nombre'] = 'El nombre introducido no es válido, ( min 3, max 20 )';
            }

            if($_POST['descripcion']==''){
                $errors['descripcion'] = 'El campo descripción no puede estar vacio';
            }  else if (!preg_match('/^[a-zA-Z0-9]{50,}$/',$_POST['descripcion'])) {
                $errors['descripcion'] = 'La descripcion introducida no es válida, ( min 50 caracteres )';
            }

            if($_POST['fabricante']==''){
                $errors['fabricante'] = 'El campo fabricante no puede estar vacio';
            }  else if (!preg_match('/^[a-zA-Z0-9]{10,20}$/',$_POST['fabricante'])) {
                $errors['fabricante'] = 'El fabricante introducido no es válido. ( min 10 max 20 )';
            }

            if($_POST['fecha']==''){
                $errors['fecha'] = 'El campo fecha no puede estar vacio';
            } else if (!preg_match('/^(0[1-9]|[12]\d|3[01])-(0[1-9]|1[0-2])-(19|20)\d{2}$/',$_POST['fecha'])) {
                $errors['fecha'] = 'La fecha introducida no es válida.';
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
                echo 'El formulario tiene errores';
                foreach($errors as $error){
                    echo '<div class="error">'.$error.'</div>';
                }
            }
            
    ?>

    <form action="#" method="post">
        codigo <input type="text" name="codigo" value="<?= (isset($_POST['codigo']))? $_POST['codigo'] : '' ?>"><br>
        nombre <input type="text" name="nombre" value="<?= (isset($_POST['nombre']))? $_POST['nombre'] : '' ?>"><br>
        precio <input type="text" name="precio" value="<?= (isset($_POST['precio']))? $_POST['precio'] : '' ?>"><br>
        descripción <input type="text" name="descripcion" value="<?= (isset($_POST['descripcion']))? $_POST['descripcion'] : '' ?>"><br>
        fabricante <input type="text" name="fabricante" value="<?= (isset($_POST['fabricante']))? $_POST['fabricante'] : '' ?>"><br>
        fecha de adquisición <input type="text" name="fecha" value="<?= (isset($_POST['fecha']))? $_POST['fecha'] : '' ?>"><br>
        <input type="submit" value="registrarse">
    </form>

    <?php

        } else {
            echo '<h1>El formulario ha sido enviado correctamente.</h1>';
            echo '<a href="productSandra.php">HAZ EL FORMULARIO DE NUEVO</a>';
        }
        
    ?>
    
</body>
</html>