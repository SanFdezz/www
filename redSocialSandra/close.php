<?php
/**
* 
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

ini_set('session.name','SessionClicky');
ini_set('session.cookie_httponly',1);
session_start();

if(!isset($_SESSION['user'])){
    header('location:index.php');
}

// Se cierra la sesión
session_destroy();

// Una vez cerrada la sesión se redirige a index
header ('location:index.php');