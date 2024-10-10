<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario recursivo</title>
</head>
<body>
    <?php
        header('Location: /index.php');
        exit;
        if(!empty($_POST)){
           foreach($_POST as $key => $value){
                $_POST[$key] = trim($value);
           }
        }
    ?>
    <form action="#" method="post">
        usuario <input type="text" name="user" value="<?= (isset($_POST['user']))? $_POST['user'] : '' ?>"><br>
        email <input type="text" name="email" value="<?= (isset($_POST['email']))? $_POST['email'] : '' ?>"><br>
        <input type="submit" value="registrarse">
    </form>
</body>
</html>