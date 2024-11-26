<?php
/**
* Ampliacion de la actividad discografía, se le han añadido funcionalidades al programa como insertar albumes y eliminarlos.
*
* @author Sandra Fernández Ávila
* @version 2.0 
*
*/

// expresiones regulares para controlar lo que nos llega por $_POST 
$numeric = '/^\d{4}$/';
$date = '/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/';
$price = '/^\d+(\.\d+)?$/';

// si nos llegan datos por $_POST
if(!empty($_POST)){
    // hacemos la comprobación de errores:
    if($_POST['albumName']==''){
        $errors['nameNotInserted']='No se puede insertar un álbum sin título.';
    }
    if($_POST['albumYear']==''){
        $errors['yearNotInserted']='No se puede insertar un álbum sin año de salida.';
    } else  if(!preg_match($numeric,$_POST['albumYear'])){
        $errors['yearNotNumber']='El año introducido no es válido, debe ser un número de 4 cifras';
    }

    if($_POST['albumBuyDate']==''){
        $errors['buyDateNotInserted']='No se puede insertar un álbum sin fecha de compra.';
    } else if (!preg_match($date,$_POST['albumBuyDate'])){
        $errors['wrongDate']='La fecha de compra introducida no es válida.';
    }

    if($_POST['albumPrice']==''){
        $errors['priceNotInserted']='No se puede insertar un álbum sin precio.';
    } else if(!preg_match($price,$_POST['albumPrice'])){
        $errors['wrongPrice']='El precio introducido no es válido.';
    }
}

// si no ha habido ningun error anterior, seguimos.
if(!isset($errors)){
    // para ahorrarnos que el usuario intente hacer cosas raras:
    if(empty($_GET)){
        header('Location: /index.php');
        exit;
    } else {
        try{
            // si se ha confirmado un borrado realizamos este bloque
            if(isset($_GET['action']) && ($_GET['action']=='delete')){
                $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); // configuracion para la bbdd
                $connection = new PDO('mysql:host=localhost;dbname=discografia','vetustamorla','15151',$options); // conexion a la bbdd
                $query = $connection->prepare('DELETE FROM songs WHERE album_id=:id;'); // delete query
                $query->bindParam(':id',$_GET['album']); // asignamos el valor del param
                $query->execute(); // la ejecutamos
                $query = $connection->prepare('DELETE FROM albums WHERE id=:id;'); // una vez borradas las canciones, borramos el album
                $query->bindParam(':id',$_GET['album']);
                $query->execute();
                unset($query); // eliminamos query
                unset($connection); // cerramos conexion
            }

            // si nos llegan datos por post, quiere decir que tenemos que realizar un insert
            if(!empty($_POST)){
                // repetimos todo lo anterior pero con una query Insert
                $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
                $connection = new PDO('mysql:host=localhost;dbname=discografia','vetustamorla','15151',$options);
                $query = $connection->prepare('INSERT INTO albums (title, year, format, buydate, price, group_id) VALUES (:title,:year,:format,:buydate,:price,:groupID);');
                $query->bindParam(':title',$_POST['albumName']);
                $query->bindParam(':year',$_POST['albumYear']);
                $query->bindParam(':format',$_POST['albumType']);
                $query->bindParam(':buydate',$_POST['albumBuyDate']);
                $query->bindParam(':price',$_POST['albumPrice']);
                $groupID = intval($_POST['groupID']);
                $query->bindParam(':groupID',$groupID);
                $query->execute();
                unset($query);
                unset($connection);
            }  

            // realizamos otra conexion pero esta vez para comprobar que el grupo existe y se puede mostrar
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            $connection = new PDO('mysql:host=localhost;dbname=discografia','vetustamorla','15151',$options);
            $query=$connection->prepare('SELECT id, name, photo FROM groups WHERE id=:id ORDER BY name;');
            $query->bindParam(':id',$_GET['id']);
            $query->execute();
            $results = $query->fetch(PDO::FETCH_ASSOC);
            $exists=$query->rowCount();

            // si no existe enviamos al user al inicio
            if($exists==0){
                header('Location: /index.php');
                exit;
            }

            // y si existe, realizamos un select para mostrar los albumes del grupo deseado
            $query = $connection->prepare("SELECT id, title, year, format, price FROM albums WHERE group_id=:id");
            $query->bindParam(':id',$_GET['id']);
            $query->execute();
            $albumCount = $query->rowCount();
            $albums = $query->fetchAll(PDO::FETCH_ASSOC);
            unset($query);
            unset($connection);

            // este trozo es para mostrar o ocultar la ventana de confirmacion del borrado.
            if(!empty($_GET['album'])&&!empty($_GET['action'])){
                if($_GET['action']=='confirm'){
                    $delete = true;
                }
            } 

            // si ha habido error en la conexion, entrará al catch.
        } catch(Exception $exception) {
            $errors['wrongConnection']='Fallo al conectar';
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
	<link rel="stylesheet" href="/styles/style.css">
</head>
<body>
    <header>
        <a href="index.php">Discografía</a>
		<a href="songs.php">Canciones</a>
    </header>

    <?php
    // si hay errores los muestra
       if(!empty($errors)){
        foreach($errors as $error){
               echo $error.'<br>'; 
        }
       } else {
        // si el grupo existe entra aqui.
            if($exists==1){
                // si se ha solicitado un borrado mostramos esto
                if(isset($delete)){
                
    ?>                

    <div class="addConfirmation">
        <h2>¿Seguro que quieres borrar el álbum indicado?</h2>
        <a href="group.php?id=<?php echo $_GET['id']?>"><button type="submit">CANCELAR</button></a>
        <a href="group.php?id=<?php echo $_GET['id'].'&album='.$_GET['album'].'&action=delete'?>"><button type="submit" class="deleteButton">BORRAR</button></a>
    </div>


    <?php
                }
                // Mostramos la lista de álbumes que tiene asociados el grupo
                echo '<h1>Álbumes del grupo '.$results['name'].':</h1>';
                echo '<ul>';
                foreach($albums as $album){
                    echo '<li>Nombre del álbum: '.$album['title'].' | Año de salida: '.$album['year'].' | Precio: '.$album['price'].'€ <a href="group.php?id='.$_GET['id'].'&album='.$album['id'].'&action=confirm"><img class="bin" src="images/papelera.png"></a></li><br>'; 
                }
                echo '</ul>';
            }
            
    ?>

        <!--Añadimos un formulario para que se puedan añadir álbumes al grupo que se envian los datos por POST-->
    <div class="addForm">
        <form action="#" method="post">
            <label>Nombre del álbum:
                <input type="text" name="albumName">
            </label>
            <br>
            <label>Año de salida:
                <input type="text" name="albumYear">
            </label>
            <br>
            <label>Precio de venta:
                <input type="text" name="albumPrice">
            </label>
            <br>
            <label>Fecha de venta (yyyy-mm-dd):
                <input type="text" name="albumBuyDate">
            </label>
            <br>
            <label>Formato:
                <select name="albumType">
                    <option value="vinilo">Vinilo</option>
                    <option value="cd">CD</option>
                    <option value="dvd">DVD</option>
                    <option value="mp3">MP3</option>
                </select>
            </label>
            <br>
            <input type="hidden" name="groupID" value="<?php echo $_GET['id'];?>">
            <br>
            <a href="group.php?"><button type="submit">ENVIAR</button></a>
        </form>
    </div>
    
    <?php
        }
    ?>

    <footer>
        Sandra Fernández Ávila 2ºDAW 2024
    </footer>
</body>
</html>