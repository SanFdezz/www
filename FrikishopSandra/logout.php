<?php

ini_set('session.name','SessionSandra');
ini_set('session.cookie_httponly',1);
ini_set('session.cookie_lifetime',300);
session_start();

if(!isset($_SESSION['user'])){
    header('location:/');
}

// Se cierra la sesión
session_destroy();

// Una vez cerrada la sesión se redirige a index
header ('location: /');