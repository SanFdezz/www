<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/style.css">
    <title>Mayor</title>
</head>
<body>
    <div class="contenedor_principal">
        <header class="header colocar">
            <h1>HIGHER</h1>
            <div class="centrado_y_repartido">
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/nav.inc.php');
                ?>
            </div>
        </header>
        <?php
        /*
            Explicación:
            Se define un array $suits que contiene los nombres de los cuatro palos.
            Se inicializa un array vacío $deck para almacenar las cartas.
            Un primer bucle for recorre los palos. Dentro de este bucle, se añaden las cartas numeradas del 1 al 10.
            Luego, se utiliza un foreach para agregar las figuras (J, Q, K).
            Cada carta se añade al array $deck con su palo, valor e imagen correspondiente.
            El resultado es un array que contiene todas las cartas de la baraja francesa, donde el As tiene un valor de 1

        */
            $suits = ["corazones", "rombos", "treboles", "picas"];
            $deck = [];

            for ($suitIndex = 0; $suitIndex < count($suits); $suitIndex++) {
                $suit = $suits[$suitIndex];
                
                // Añadir los números del 1 al 10
                for ($value = 1; $value <= 10; $value++) {
                    $deck[] = [
                        "suit" => $suit,
                        "value" => (string)$value,
                        "image" => "{$suit[0]}{$suit[1]}{$suit[2]}_{$value}.png"
                    ];
                }
                
                // Añadir las figuras: J, Q, K
                $figures = ["J" => "j", "Q" => "q", "K" => "k"];
                foreach ($figures as $figure => $short) {
                    $deck[] = [
                        "suit" => $suit,
                        "value" => $figure,
                        "image" => "{$suit[0]}{$suit[1]}{$suit[2]}_{$short}.png"
                    ];
                }
            }
        ?>

        <?php
            //vamos a desordenar el array, es decir, vamos a barajar la baraja.
            $try = shuffle($deck);

            //creamos los jugadores.
            $players = ['Stan Marsh','Kyle Broflovsky','Eric Cartman','Kenny Mccoormik','Wendy Testaburguer'];
            shuffle($players);
            //obtener 2 jugadores al azar

            $player1 = array_pop($players);
            $player2 = array_pop($players);

            //echo 'El jugador 1 es: '. $player1 .' y el jugador 2 es: '.$player2; // mostrar los jugadores

            // creamos los arrays de cartas y asignamos las cartas a los jugadores
            for ($i=0; $i<10; $i++) {
                
                $player1_cards[] = array_pop($deck);
                $player2_cards[] = array_pop($deck);
                
                
            }

            // creamos la funcion que muestra las cartas por pantalla

            function showCards($hand) {
                echo '<div class="hand">';
                for ($i=0; $i<10; $i++) {
                    echo '<img src="/images/'. $hand[$i]['image'] .'" alt="Cartas" height="100px">';
                }; // cerramos el for
                echo '</div>';
            }; // cerramos la funcion!!!!!

            // llamamos a la funcion con cada 1 de los jugadores
            showCards($player1_cards);
            echo '<br>';
            showCards($player2_cards);


        ?>

        <footer class="centrado_y_repartido footer">
            <?php
                require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.inc.php');
            ?>
        </footer>
        
    </div>
</body>
</html>