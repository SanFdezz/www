<?php
/**
* 
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

// recuerda que no se guardan fotos en BBDD -> guardamos la ruta a la carpeta de la foto
	try{
		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		$connection = new PDO('mysql:host=localhost;dbname=discografia','vetustamorla','15151',$options);
		if(empty($_GET)){
			$query = $connection->prepare('SELECT id, name, photo FROM groups ORDER BY name;');
		} else {
			$query = $connection->prepare('SELECT id, name, photo FROM groups WHERE name LIKE ? ORDER BY name;');
			$search = '%'.$_GET['search'].'%';
			$query->bindParam(1,$search);
		}
		$query->execute();
		$groups = $query->fetchAll(PDO::FETCH_ASSOC);
		$results = $query->rowCount();
		unset($query);
		unset($connection);
	} catch(Exception $exception){
		$errors['wrongConnection']='Error en la conexión';
	}



?>

<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/styles/style.css">
	<title>Discografía</title>
</head>

<body>
	<header>
        <a href="index.php">Discografía</a>
		<a href="songs.php">Canciones</a>
    </header>

	<form action="#" method="get">
		<label for="">Búsqueda</label>
		<input type="text" name="search" id="search">
		<input type="submit" value="Buscar">
	</form>

	<h2>Grupos:</h2>

	<?php
	   if(!empty($errors)){
			foreach($errors as $error){
				echo $error;
			}
	   } else {
			if($results==0){
				echo 'No han habido resultados que coincidan con la búsqueda: '.$_GET['search'];
			} else {
				foreach($groups as $group){
					echo 'Nombre del grupo: '.$group['name'].'. Foto: <img src="grupos/'.$group['photo'].'" alt="foto del grupo" height="50px"> <br>';
				}
			}
	   }
	?>
	
	<br>
    <footer>
        Sandra Fernández Ávila 2ºDAW 2024
    </footer>
</body>
</html>