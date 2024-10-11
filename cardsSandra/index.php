<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/style.css">
    <title>Principal</title>
</head>
<body>
    <div class="contenedor_principal">
        <header class="header colocar">
            <h1>PÁGINA PRINCIPAL</h1>
            <div class="centrado_y_repartido">
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/nav.inc.php');
                ?>
            </div>
        </header>
        <h1 class="colocar">Sandra's Card Games</h1>
        <div class="centrado_y_repartido margen">
            <button class="special_button"><a  href="/higherSandra.php">HIGHER</a>
            </button><img src="/images/imgDeck.jpg" alt="baraja de cartas">
            <button class="special_button"><a  href="/blackjackSandra.php">BLACK JACK</a></button>
        </div>
        <footer class="centrado_y_repartido footer" >
            <?php
                require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.inc.php');
            ?>
        </footer>
    </div>
</body>
</html>