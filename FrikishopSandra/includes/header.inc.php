<?php
/**
* 
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/
?>

<header>
    <h1><a href="/">MerchaShop</a></h1>

    <a href="/">Principal</a>

    <div id="zonausuario">
        
    <?php
        if(!isset($_SESSION['user'])){
            echo '<span>¿Ya tienes cuenta?<a href="/login">Loguéate aquí</a>.</span>';
        } else {
            echo '<span id="usuario">'.$_SESSION['user'].'</span><br>';
            if($_SESSION['rol']=='admin'){
                echo '<a href="/users">Ver usuarios</a>';
            }
            echo '<span id="logout"><a href="/logout">Desconectar</a></span>';
        }
    ?>
    </div>
</header>