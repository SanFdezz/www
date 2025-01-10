<?php
/**
* 
* Página principal de la web donde se añaden, borran o eliminan los productos y se muestra el total de ellos.
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

ini_set('session.name','SessionSandra');
ini_set('session.cookie_httponly',1);
ini_set('session.cookie_lifetime',300);
session_start();

/*
require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/env.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/connection.inc.php');
try {
	if ($connection = getDBConnection(DB_NAME, DB_USERNAME, DB_PASSWORD)) {
		$query = 'SELECT * FROM products;';
		$products = $connection->query($query)->fetchAll(PDO::FETCH_OBJ);
	} else {
		throw new Exception('Error en la conexión a la BBDD');
	}
	unset($query);
	unset($connection);
} catch (Exception $exception) {
	$dbError = true;
	unset($query);
	unset($connection);
}
*/

if(!empty($_GET['add'])){
	if(!isset($_SESSION['basket'])){
		$_SESSION['basket'][$_GET['add']]=1;
		header('location: /index');
		exit;
	} else {
		$_SESSION['basket'][$_GET['add']] += 1;
		header('location: /index');
		exit;
	}
}

if(!empty($_GET['subtract'])){
	if(isset($_SESSION['basket'][$_GET['subtract']])){
		if($_SESSION['basket'][$_GET['subtract']]-1 == 0){
			unset($_SESSION['basket'][$_GET['subtract']]);
			header('location: /index');
			exit;
		} else {
			$_SESSION['basket'][$_GET['subtract']] -= 1;
			header('location: /index');
			exit;
		}
	}
}

if(!empty($_GET['remove'])){
	if(isset($_SESSION['basket'][$_GET['remove']])){
		unset($_SESSION['basket'][$_GET['remove']]);
		header('location: /index');
		exit;
	}
}

?>







<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MerchaShop</title>
		<link rel="stylesheet" href="/css/style.css">
	</head>

	<body>

		<?php
			require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.inc.php');
		?>

	<?php
	   if(!isset($_SESSION['user'])){ // inicio del if
	?>
	
		<h2>Regístrate para poder comprar en la tienda</h2>

		<form action="signup" method="post">
			<label for="user">Usuario</label>
			<input type="text" name="user" id="user">
			<br>
			<label for="email">Email</label>
			<input type="email" name="email" id="email">
			<br>
			<label for="password">Contraseña</label>
			<input type="password" name="password" id="password">
			<br>
			<label></label>
			<input type="submit" value="Registrarse">
		</form>

		<span>¿Ya tienes cuenta? <a href="/login">Loguéate aquí</a>.</span>

		<div id="ofertas">
			<a href="/sales"><img src="/img/ofertas.png" alt="Imagen acceso ofertas"></a>
		</div>
		<?php
		   } else { //inicio del else y fin del if
		$total = 0; 
		foreach($_SESSION['basket']??[] as $elemento){
			$total += $elemento;
		}
		?>
		<div id="ofertas">
			<a href="/sales"><img src="/img/ofertas.png" alt="Imagen acceso ofertas"></a>
		</div>
		<div id="carrito">
			<?=$total?>
			productos en el carrito.
			<a href="/basket" class="boton">Ver carrito</a>
		</div>

		<section class="productos">
			<?php
			if (count($products)>0) {
				foreach($products as $product) {
					echo '<article class="producto">';
					echo '<h2>'. $product->name .'</h2>';
					echo '<span>('. $product->category .')</span>';
					echo '<img src="/img/products/'. $product->image .'" alt="'. $product->name .'" class="imgProducto"><br>';
					echo '<span>'. $product->price .' €</span><br>';
					if ($product->stock>0) {
						echo '<span class="botonesCarrito">';
							echo '<a href="/add/'.$product->id.'" class="productos"><img src="/img/mas.png" alt="añadir 1"></a>';
							echo '<a href="/subtract/'.$product->id.'" class="productos"><img src="/img/menos.png" alt="quitar 1"></a>';
							echo '<a href="/remove/'.$product->id.'" class="productos"><img src="/img/papelera.png" alt="quitar todos"></a>';
						echo '</span>';
						echo '<span>Stock: '. $product->stock .'</span>';
					} else {
						echo "Sin stock";
					}
					echo '</article>';
				}
			} else {
				echo '<h2>Vendemos mucho y ahora mismo no hay productos, visítanos más tarde.</h2>';
			}
			?>
		</section>
		<?php
			} // fin del else
		?>
			

	</body>
</html>