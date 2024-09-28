<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

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

        shuffle($deck);

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


            // creamos un mapa que nos sirva para almacenar la info del juego
            $game_info = [['player' => $player1, 'hand' => $player1_cards, 'points' => 0],
            ['player' => $player2, 'hand' => $player2_cards, 'points' => 0]];


            // creamos la funcion que muestra las cartas por pantalla
            function showCards($game_info) {
                echo '<div class="colocar addPadding" >';
                echo 'Jugador: '. $game_info['player']. '<br>';
                for ($i=0; $i<10; $i++) {
                    echo '<img src="/images/'. $game_info['hand'][$i]['image'] .'" alt="Cartas" height="100px">';
                }; // cerramos el for
                echo '</div>';
            };



            // llamamos a la funcion con cada 1 de los jugadores
            showCards($game_info[0]);
            echo '<br>';
            showCards($game_info[1]);






    ?>
</body>
</html>

