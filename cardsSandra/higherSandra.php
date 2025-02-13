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
            require_once($_SERVER['DOCUMENT_ROOT'].'/includes/deck.inc.php');
        ?>

        <?php
            //vamos a desordenar el array, es decir, vamos a barajar la baraja.
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
                echo '<div class="addPadding">';
                echo '<div class="hands" >Jugador: '. $game_info['player']. '</div><br>';
                echo '<div class="hands" >';
                for ($i=0; $i<10; $i++) {
                    echo '<img src="/images/'. $game_info['hand'][$i]['image'] .'" alt="Cartas">';
                }; // cerramos el for
                echo '</div>';
                echo '</div>';
            };



            // llamamos a la funcion con cada 1 de los jugadores
            showCards($game_info[0]);
            echo '<br>';
            showCards($game_info[1]);


        ?>

        <?php

            // creamos la lógica del juego.
            for ($i=0; $i<10; $i++) {
                $value1 = $game_info[0]['hand'][$i]['value'];
                $value2 = $game_info[1]['hand'][$i]['value'];
                
                if ($value1 > $value2) {
                    $game_info[0]['points'] += 2;
                } else if ($value2 > $value1){
                    $game_info[1]['points'] += 2;
                } else {
                    $game_info[0]['points'] += 1;
                    $game_info[1]['points'] += 1;
                }

             };

             echo '<div class="msj" >'. $player1 .' tiene un total de: '. $game_info[0]['points'] .' puntos. </div> <br>';
             echo '<div class="msj">'. $player2 .' tiene un total de: '. $game_info[1]['points'] .' puntos </div> <br>';


             if ($game_info[0]['points'] > $game_info[1]['points']) {
                echo '<h2 class="msj">EL GANADOR/A ES: '. $game_info[0]['player'] .'</h2>';
             } else if ($game_info[0]['points'] < $game_info[1]['points']){
                echo '<h2 class="msj">EL GANADOR/A ES: '. $game_info[1]['player'] .'</h2>';
             } else {
                echo '<h2 class="msj">HA HABIDO UN EMPATE</h2>';
             };


        ?>

        <footer class="centrado_y_repartido footer">
            <?php
                require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.inc.php');
            ?>
        </footer>
        
    </div>
</body>
</html>