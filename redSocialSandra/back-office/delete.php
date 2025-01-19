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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete</title>
    <link href="/style/backOffice.css" rel="stylesheet">
    <link href="/style/header.css" rel="stylesheet">
</head>
<body>
<div class="mainContainer">
        <?php
           require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php');
           require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.inc.php');
        ?>
        
    </div>
</body>
</html>
