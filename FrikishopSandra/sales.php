<?php

ini_set('session.name','SessionSandra');
ini_set('session.cookie_httponly',1);
ini_set('session.cookie_lifetime',300);
session_start();



require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/env.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
try {
	if ($connection = getDBConnection(DB_NAME, DB_USERNAME, DB_PASSWORD)) {
		$query = 'SELECT * FROM products WHERE sale>0;';
		$products = $connection->query($query)->fetchAll(PDO::FETCH_OBJ);		
	} else {
		throw new Exception('Error en la conexión a la BBDD');
	}
} catch (Exception $exception) {	
	$dbError = true;
}
unset($query);
unset($connection);
?>
<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MerchaShop - Ofertas</title>
		<link rel="stylesheet" href="/css/style.css">
	</head>

	<body>
		<?php
			require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php');

			if(!isset($_SESSION['user'])){
				echo '<a href="/">Regístrate aquí</a>';
			}
					
			echo '<h1>Artículos en oferta</h1>';
			
			echo '<section class="productos">';
				foreach($products as $product) {
					echo '<article class="producto">';
						echo '<h2>'. $product->name .'</h2>';
						echo '<span>('. $product->category .')</span>';
						echo '<img src="/img/products/'. $product->image .'" alt="'. $product->name .'" class="imgProducto"><br>';
						echo '<span>'. $product->price .' €</span><br>';
						echo '<span>Stock: '. $product->stock .'</span>';
					echo '</article>';
				}
			echo '</section>';
		?>
		
	</body>
</html>