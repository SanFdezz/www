<?php
/**
* 
* Primera actividad de la unidad 6, creación de cookies para tema oscuro/claro
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/


if(isset($_GET['delete'])){
	setcookie('theme','yes',time()-1);
	setcookie('cookiesAccepted','yes',time()-1);
	header('location:act1triki.php');
	exit();
}




if(!isset($_COOKIE['theme'])){
	setcookie('theme','dark');
	header('location:act1triki.php');
	exit();
}

if(isset($_GET['accepted'])){
	setcookie('cookiesAccepted','accepted',time()+60);
	header('location:act1triki.php');
	exit();
}

if(isset($_GET['theme']) && in_array($_GET['theme'],['dark','light'])){
	var_dump($_GET);
	setcookie('theme',$_GET['theme']);
	header('location:act1triki.php');
	exit();
}

?>


<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Triki: el monstruo de las Cookies</title>
		<link rel="stylesheet" href="<?php echo 'css/'.$_COOKIE['theme']?>.css">
	</head>

	<body>
		<?php
		if(!isset($_COOKIE['cookiesAccepted'])){
			echo '<div id="cookies">';
			echo 'Este sitio web utiliza cookies propias y puede que de terceros.<br>Al utilizar nuestros servicios, aceptas el uso que hacemos de las cookies.<br>';
			echo '<div><a href="?accepted=yes">ACEPTAR</a></div>';
			echo '</div>';
		}
		?>
		
		<h1>Bienvenido a la web de Triki, el monstruo de las cookies</h1>
		
		<h2>Bienvenido a la web donde no se gestionan las cookies, se devoran.</h2>
		<img src="/img/triki.jpg" alt="Imagen de triki mirando una galleta">
		
		<div id="botones">
			<a href="?theme=light" class="styleButton">Claro</a>
			<a href="?theme=dark" class="styleButton">Oscuro</a>
		</div>
		<br>

		<div><a href="?delete=yes">Borrar cookies</a></div>
	</body>
</html>