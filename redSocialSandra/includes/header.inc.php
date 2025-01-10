<?php
/**
* 
* Include de la cabecera de la red social 'Clicky', que debe aparecer en todas las páginas de la web.
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/
?>

<header>
    <div class="logo">
        <a href="index.php"><img src="/images/clicky.png" alt="logoClicky"></a>
        <h1><a href="index.php">Clicky</a></h1>
    </div>
    <?php
    if(!isset($_SESSION['user'])){
        echo '<h3>Parece que no estás logueado,<a href="login.php"> ¡Inicia sesión aquí!</a></h3>';
    } else {
    
    echo '<h2><a href="back-office/account.php">Hola '.$_SESSION['user'].'!</a></h2>'
    ?>
    <h3><a href="new.php">Postear</a></h3>
    <h3><a href="close.php">Cerrar sesión</a></h3>
    <form action="results.php" method="post">
        <label>Búsqueda: <input placeholder="..." name="search"></label>
        <input type="submit" name="send">
    </form>
    <?php
    }
    ?>
</header>
