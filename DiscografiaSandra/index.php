<?php
/**
*
* Apartado index del ejercicio DISCOGRAFIA de la unidad 5 DWES. 
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

	//try catch para la conexión
	try{
		// añadimos que acepte los carácteres especiales y creamos la conexión.
		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		$connection = new PDO('mysql:host=localhost;dbname=discografia','vetustamorla','15151',$options);
		//si es la primera vez:
		if(empty($_GET)){
			// utilizamos esta query, que por defecto muestra todos los campos indicados.
			$query = $connection->prepare('SELECT id, name, photo FROM groups ORDER BY name;');
		// si se ha indicado algo en el formulário se realiza la siguiente query:
		} else {
			$query = $connection->prepare('SELECT id, name, photo FROM groups WHERE name LIKE ? ORDER BY name;');
			$search = '%'.$_GET['search'].'%';
			$query->bindParam(1,$search);
		}
		// ejecutamos la consulta y nos guardamos tanto la cantidad de filas devueltas como el mapa con los resultados.
		$query->execute();
		$groups = $query->fetchAll(PDO::FETCH_ASSOC);
		$results = $query->rowCount();
		// una vez acabado, eliminamos la consulta y la conexión.
		unset($query);
		unset($connection);
	// si algo ha salido mal, muestra este mensaje.
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
		// comprobamos si hay algún error, y si lo hay lo mostramos por pantalla.
	   if(!empty($errors)){
			foreach($errors as $error){
				echo $error;
			}
		// si no ha habido ningun error, dependiendo de la cantidad de resultados mostraremos los grupos que concuerden con las busquedas, o un mensaje de no haber obtenido ninguno.
	   } else {
			if($results==0){
				echo 'No han habido resultados que coincidan con la búsqueda: '.$_GET['search'];
			} else {
				foreach($groups as $group){
					echo 'Nombre del grupo: <a href="group.php?id='.$group['id'].'">'.$group['name'].'</a>. Foto: <a href="group.php?id='.$group['id'].'"><img src="grupos/'.$group['photo'].'" alt="foto del grupo"></a><br>';
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