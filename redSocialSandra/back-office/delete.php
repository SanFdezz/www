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

try{
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
    $connection = getDBConnection('social', 'social', 'laicos');
    
    $query = $connection->prepare('DELETE FROM comments WHERE entry_id = :entryID;');
    $query->bindParam('entryID',$_GET['entry']);
    $query->execute();

    $query = $connection->prepare('DELETE FROM likes WHERE entry_id = :entryID;');
    $query->bindParam('entryID',$_GET['entry']);
    $query->execute();

    $query = $connection->prepare('DELETE FROM dislikes WHERE entry_id = :entryID;');
    $query->bindParam('entryID',$_GET['entry']);
    $query->execute();

    $query = $connection->prepare('DELETE FROM entries WHERE id = :entryID;');
    $query->bindParam('entryID',$_GET['entry']);
    $query->execute();

    unset($query);
    unset($connection);

    header('location: /back-office/list.php');
    exit;
    
} catch(Exception $ex){
    $errors['wrongConnection'] = 'Ha ocurrido un problema';
}




