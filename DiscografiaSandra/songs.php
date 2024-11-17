<?php
/**
* Apartado songs del ejercicio DISCOGRAFIA de la unidad 5 DWES.
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

	//creamos un array con los campos FIELD válidos y otro con los campos ORDER válidos.
	$validFields = array('s.title', 's.length', 'a.title', 'g.name');
	$validOrder = array('asc','desc');

	//try catch para la conexión
	try{
		// añadimos que acepte los carácteres especiales y creamos la conexión.
		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		$connection = new PDO('mysql:host=localhost;dbname=discografia','vetustamorla','15151',$options);
		//si es la primera vez:
		if(empty($_GET)){
			// utilizamos esta query, que por defecto ordena por titulo de manera ascendente
			$query = $connection->prepare("SELECT s.id, s.title, length, a.title AS album, g.name AS 'group' 
			FROM songs s, albums a, groups g WHERE album_id=a.id AND group_id=g.id ORDER BY s.title ASC;");
		// si ha pulsado alguna flecha:
		} else {
			// buscamos cual ha sido y la guardamos en una variable, tanto field como order.
			if (in_array($_GET['field'], $validFields)) {
				$field = $_GET['field'];
			}
			if (in_array($_GET['order'], $validOrder)) {
				$order = strtoupper($_GET['order']); //con strtoupper pasamos el texto a mayusculas y nos ahorramos algun posible error en sql.
			}
			// creamos la query
			$query = $connection->prepare("SELECT s.id, s.title, length, a.title AS album, g.name AS 'group' 
			FROM songs s, albums a, groups g WHERE album_id=a.id AND group_id=g.id ORDER BY $field $order;");
		}
		// ejecutamos la consulta y nos guardamos tanto la cantidad de filas devueltas como el mapa con los resultados.
		$query->execute();
		$songs = $query->rowCount();
		$songsInfos = $query->fetchAll(PDO::FETCH_ASSOC);
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
	
	<h2>Canciones:</h2>
	<table>
		<th>
			<tr>
				Título
				<a href="songs.php?field=s.title&order=asc"><img src="images/sort-asc.png" alt="ascendiente"></a>
				<a href="songs.php?field=s.title&order=desc"><img src="images/sort-desc.png" alt="descendiente"></a>
			</tr>
			<tr>
				Duración
				<a href="songs.php?field=s.length&order=asc"><img src="images/sort-asc.png" alt="ascendiente"></a>
				<a href="songs.php?field=s.length&order=desc"><img src="images/sort-desc.png" alt="descendiente"></a>
			</tr>
			<tr>
				Álbum
				<a href="songs.php?field=a.title&order=asc"><img src="images/sort-asc.png" alt="ascendiente"></a>
				<a href="songs.php?field=a.title&order=desc"><img src="images/sort-desc.png" alt="descendiente"></a>
			</tr>
			<tr>
				Grupo
				<a href="songs.php?field=g.name&order=asc"><img src="images/sort-asc.png" alt="ascendiente"></a>
				<a href="songs.php?field=g.name&order=desc"><img src="images/sort-desc.png" alt="descendiente"></a>
			</tr>
		</th>
	</table>
	
	<?php
		// comprobamos si hay algún error, y si lo hay lo mostramos por pantalla.
	   if(!empty($errors)){
			foreach($errors as $error){
				echo $error;
			}
		// si no ha habido ningun error, dependiendo de la cantidad de resultados mostraremos las canciones en los diversos ordenes especificados o un mensaje de no haber obtenido ninguno.
	   } else {
			if($songs==0){
				echo 'No han habido resultados que coincidan con la búsqueda: '.$_GET['search'];
			} else {
				foreach($songsInfos as $song){
					$song['length'] = gmdate("i:s", $song['length']); // esto es para mostrar la duración de la canción en formato mm:ss.
					echo 'Título de la canción: '.$song['title'].'. Duración: '.$song['length'].'. Nombre del álbum: '.$song['album'].'. Nombre del grupo: .'.$song['group'].'<br><br>';
				}
			}
	   }
	?>
    <footer>
		Sandra Fernández Ávila 2ºDAW 2024
    </footer>
</body>
</html>