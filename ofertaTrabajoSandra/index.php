<?php
/**
*  Actividad 3 - Oferta de trabajo
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

$names = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+( [a-zA-ZáéíóúÁÉÍÓÚñÑ]+)*$/'; //expresion regular para evaluar nombres
$surname = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]*$/'; //expresion regular para evaluar apellidos
$user = '/^[a-zA-Z0-9._]{3,20}$/'; //expresion regular para evaluar usuarios
$address = '/^[a-zA-Z0-9\s,.-]{5,100}$/'; //expresion regular para evaluar direciones
$mail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'; //expresion regular para evaluar correos
$phone = '/^[0-9]{9}$/'; //expresion regular para evaluar numeros telefonicos
$birthdate = '/^([0-2][0-9]|3[01])-(0[1-9]|1[0-2])-(\d{4})$/'; //expresion regular para evaluar fechas de nacimiento
$dni = '/^\d{8}[A-Za-z]$/'; //expresion regular para evaluar el dni español

if(!empty($_POST)){
    // validaciones del formulario
    foreach($_POST as $key => $value){
        $_POST[$key] = trim($value);
    }

    if($_POST['user']==''){
        $errors['user'] = 'El campo "usuario" no puede estar vacio';
    } else if (!preg_match($user,$_POST['user'])) {
        $errors['user'] = 'El usuario introducido no es válido, ( ej: ejemplo123 )';
    }
        
    if($_POST['name']==''){
        $errors['name'] = 'El campo "nombre" no puede estar vacio';
    } else if (!preg_match($names,$_POST['name'])) {
        $errors['name'] = 'El nombre introducido no es válido, ( ej: Maria José o Lola )';
    }

    if($_POST['surname1']==''){
        $errors['surname1'] = 'El campo "apellido" no puede estar vacio';
    } else if (!preg_match($surname,$_POST['surname1'])) {
        $errors['surname1'] = 'El apellido introducido no es válido, ( ej: Hernández )';
    }

    if (!preg_match($surname,$_POST['surname2'])){
        $errors['surname2'] = 'El apellido introducido no es válido, ( ej: Hernández o nada )';
    }

    if($_POST['dni']==''){
        $errors['dni'] = 'El campo "DNI" no puede estar vacio';
    } else if (!preg_match($dni,$_POST['dni'])) {
        $errors['dni'] = 'El DNI introducido no es válido, ( ej: 12345678A )';
    }
   if($_POST['address']==''){
        $errors['address'] = 'El campo "dirección" no puede estar vacio';
    } else if (!preg_match($address,$_POST['address'])) {
        $errors['address'] = 'La dirección introducida no es válida, ( ej: Avenida Cardenal Benlloch 56 )';
    }

    if($_POST['mail']==''){
        $errors['mail'] = 'El campo "correo" no puede estar vacio';
    } else if (!preg_match($mail,$_POST['mail'])) {
        $errors['mail'] = 'El correo introducido no es válido, ( ej: sandra@gmail.com )';
    }

    if($_POST['phoneNumber']==''){
        $errors['phoneNumber'] = 'El campo "teléfono" no puede estar vacio';
    } else if (!preg_match($phone,$_POST['phoneNumber'])) {
        $errors['phoneNumber'] = 'El teléfono introducido no es válido, ( ej: 123456789 )';
    }

    if($_POST['birthdate']==''){
        $errors['birthdate'] = 'El campo "fecha de nacimiento" no puede estar vacio';
    } else if (!preg_match($birthdate,$_POST['birthdate'])) {
        $errors['birthdate'] = 'El cumpleaños introducido no es válido, ( ej: 10-10-2022 )';
    }
}

if(!empty($_FILES)){

    // comprobamos la foto
    if($_FILES['photo']['error'] != UPLOAD_ERR_OK){
        switch ($_FILES['photo']['error']){
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE: $errors['size'] = 'El archivo se excede en tamaño.';
                break;
            case UPLOAD_ERR_PARTIAL: $errors['partial'] = 'Solo se ha podido subir parte del archivo, inténtalo de nuevo';
                break;
            case UPLOAD_ERR_NO_FILE: $errors['noFile'] = 'No se ha podido subir el archivo.';
                break;
            default: $errors['undefined'] = 'Error indeterminado';
        }
    } else if($_FILES['photo']['type'] != 'image/jpeg' || $_FILES['photo']['type'] != 'image/png'){
        $errors['wrongType'] = 'El archivo no es del tipo indicado (.png/.jpg)';
    }

    if(!isset($errors)){
        if(is_uploaded_file($_FILES['photo']['tmp_name'])===true){
            $newRoute = './images/candidates/'.$_POST['dni'].'.png';

            if(is_file($newRoute) === true){
                $errors['existingRoute'] = 'Ya existe una foto con ese nombre.';
            } else if (!move_uploaded_file($_FILES['photo']['tmp_name'],$newRoute)){
                $errors['moveProblem'] = 'No se ha podido mover el fichero a su destino';
            }

        } else {
            $errors['posibleHack'] = 'No se ha podido cargar.';
        }
    }

    //comprobamos el pdf
    if($_FILES['cv']['error'] != UPLOAD_ERR_OK){
        switch ($_FILES['cv']['error']){
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE: $errors['size'] = 'El archivo se excede en tamaño.';
                break;
            case UPLOAD_ERR_PARTIAL: $errors['partial'] = 'Solo se ha podido subir parte del archivo, inténtalo de nuevo';
                break;
            case UPLOAD_ERR_NO_FILE: $errors['noFile'] = 'No se ha podido subir el archivo.';
                break;
            default: $errors['undefined'] = 'Error indeterminado';
        }
    } else if($_FILES['cv']['type'] != 'application/pdf'){
        $errors['wrongType'] = 'El archivo no es del tipo indicado (.pdf)';
    }

    if(!isset($errors)){
        if(is_uploaded_file($_FILES['cv']['tmp_name'])===true){
            $newRoutePDF = './cvs/'.$_POST['dni'].'-'.$_POST['name'].'-'.$_POST['surname1'].'.pdf';

            if(is_file($newRoutePDF) === true){
                $errors['existingRoute'] = 'Ya existe un pdf con ese nombre.';
            } else if (!move_uploaded_file($_FILES['cv']['tmp_name'],$newRoutePDF)){
                $errors['moveProblem'] = 'No se ha podido mover el fichero a su destino';
            }

        } else {
            $errors['posibleHack'] = 'No se ha podido cargar.';
        }
    }

    //comprobamos finalmente
    if(isset($errors)){
        
        if(is_file($newRoute)){
            unlink($newRoute);
        }

        if(is_file($newRoutePDF)){
            unlink($newRoutePDF);
        }
    }


}
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oferta de trabajo</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>

    <?php
    if( empty($_POST) || isset($errors) ){
        if(isset($errors)){
            echo 'El formulario tiene errores';
            foreach($errors as $error){
                echo '<div class="error">'.$error.'</div>';
            }
        }
    ?>

    <form action="#" method="post" enctype="multipart/form-data">
        Usuario: <input type="text" name="user" placeholder="user1234" value="<?= (isset($_POST['user']))? $_POST['user'] : '' ?>"><br>
        Nombre: <input type="text" name="name" placeholder="Pedro" value="<?= (isset($_POST['name']))? $_POST['name'] : '' ?>"><br>
        Apellido 1: <input type="text" name="surname1" placeholder="Palotes" value="<?= (isset($_POST['surname1']))? $_POST['surname1'] : '' ?>"><br>
        Apellido 2: <input type="text" name="surname2" value="<?= (isset($_POST['surname2']))? $_POST['surname2'] : '' ?>"><br>
        DNI: <input type="text" name="dni" placeholder="12345678A" value="<?= (isset($_POST['dni']))? $_POST['dni'] : '' ?>"><br>
        Dirección: <input type="text" name="address" placeholder="direccion" value="<?= (isset($_POST['address']))? $_POST['address'] : '' ?>"><br>
        Correo: <input type="text" name="mail" placeholder="ejemplo@gmail.com" value="<?= (isset($_POST['mail']))? $_POST['mail'] : '' ?>"><br>
        Teléfono: <input type="text" name="phoneNumber" placeholder="123 456 789" value="<?= (isset($_POST['phoneNumber']))? $_POST['phoneNumber'] : '' ?>"><br>
        Fecha de nacimiento: <input type="text" placeholder="10-10-2020" name="birthdate" value="<?= (isset($_POST['birthdate']))? $_POST['birthdate'] : '' ?>"><br>
        Foto: (.png/.jpg) <input type="file" name="photo"><br>
        Currículum: <input type="file" name="cv"><br>
        <input type="submit" value="Enviar">
    </form>

    <?php

        } else {
            echo '<h1>El formulario ha sido enviado correctamente.</h1>';
            echo '<a href="index.php">HAZ EL FORMULARIO DE NUEVO</a>';
        }
        
    ?>

    <footer>
        <div class="footer">
            <div>2ºDAW</div>
            <div>SANDRA FDEZ ÁVILA</div>
            <img src="/images/myself.jpg" alt="foto mia" height="150px">
        </div>
    </footer>

</body>
</html>