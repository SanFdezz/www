<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/style.css">
    <title>blackJack</title>
</head>
<body>
    <div class="contenedor_principal">
        <header class="header colocar">
            <h1>BLACK JACK</h1>
            <div class="centrado_y_repartido">
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/nav.inc.php');
                ?>
            </div>
        </header>

        <?php

            //para obtener el mazo
            require_once($_SERVER['DOCUMENT_ROOT'].'/includes/deck.inc.php');
            shuffle($deck);

            //creamos el array de jugadores.
            $players = ['Stan Marsh','Kyle Broflovsky','Eric Cartman','Kenny Mccoormik','Wendy Testaburguer','Bebe Stevens', 'Heidi Turner', 'Craig Tucker', 'Tweek Tweak'];
            shuffle($players);

            //asignamos los jugadores
            $player1 = array_pop($players);
            $player2 = array_pop($players);
            $player3 = array_pop($players);
            $player4 = array_pop($players);
            $player5 = array_pop($players);
            $bank = 'Banca'; //y la banca

            // asignamos cartas a los mazos.
            for ($i=0; $i<2; $i++) {
                $player1_cards[] = array_pop($deck);
                $player2_cards[] = array_pop($deck);
                $player3_cards[] = array_pop($deck);
                $player4_cards[] = array_pop($deck);
                $player5_cards[] = array_pop($deck);
                $bank_cards[] = array_pop($deck);
                
            }

            //guardamos los datos de la partida:
            $game_info = [['player' => $bank, 'hand' => $bank_cards, 'points' => 0, 'state' => 'BANCA'],
            ['player' => $player1, 'hand' => $player1_cards, 'points' => 0, 'state' => 'none'],
            ['player' => $player2, 'hand' => $player2_cards, 'points' => 0, 'state' => 'none'],
            ['player' => $player3, 'hand' => $player3_cards, 'points' => 0, 'state' => 'none'],
            ['player' => $player4, 'hand' => $player4_cards, 'points' => 0, 'state' => 'none'],
            ['player' => $player5, 'hand' => $player5_cards, 'points' => 0, 'state' => 'none']];


            // calculate_points
            foreach ($game_info as $key => $player_info) {
                do{
                    $points = 0;
                    $cards = count($game_info[$key]['hand']);

                   
                    for($i=0; $i<$cards; $i++){
                        switch($game_info[$key]['hand'][$i]['value']){
                            case 'J':
                            case 'Q':
                            case 'K':
                                $points += 10;
                                break;
                            case 1:
                                if(($player_info['points']+11) > 21){
                                    $points += 1;
                                } else {
                                    $points += 11;
                                };
                                break;
                            default:
                                $points += $game_info[$key]['hand'][$i]['value'];
                        } 
                    }


                    if ($points < 14) {
                        $game_info[$key]['hand'][] = array_pop($deck);
                    }

                    $game_info[$key]['points'] = $points;

                } while ($points < 14);
            }

            foreach ($game_info as $key => $player_info) {

                if ($key == 0) {
                    continue;
                }

                if($game_info[$key]['points'] > 21) {
                    $game_info[$key]['state'] = 'Pierdes';
                } else if($game_info[$key]['points'] > $game_info[0]['points']) {
                    $game_info[$key]['state'] = 'Ganas';
                } else if($game_info[0]['points'] > 21 && $game_info[$key]['points'] < $game_info[0]['points']) {
                    $game_info[$key]['state'] = 'Ganas';
                } else if ($game_info[$key]['points'] == $game_info[0]['points']) {
                    $game_info[$key]['state'] = 'Empatas';
                } else {
                    $game_info[$key]['state'] = 'Pierdes';
                };

            };


            //lógica del juego

            //mostramos las cartas por pantalla y el nombre del jugador
            function showCards($game_info) {
                $cards = count($game_info['hand']);
                echo '<div class="addPadding">';
                echo '<div class="hands" >Jugador: '. $game_info['player']. ' Puntos: '. $game_info['points'] .' -- '. $game_info['state'] .'</div><br>';
                echo '<div class="hands" >';
                for ($i=0; $i<$cards; $i++) {
                    echo '<img src="/images/'. $game_info['hand'][$i]['image'] .'" alt="Cartas">';
                }; // cerramos el for
                echo '</div>';
                echo '</div>';
            };

            // ejecutamos la funcion con cada jugador
            showCards($game_info[0]);
            echo '<br>';
            showCards($game_info[1]);
            echo '<br>';
            showCards($game_info[2]);
            echo '<br>';
            showCards($game_info[3]);
            echo '<br>';
            showCards($game_info[4]);
            echo '<br>';
            showCards($game_info[5]);
        ?>

        <footer class="centrado_y_repartido footer">
            <?php
                require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.inc.php');
            ?>
        </footer>
    </div>
</body>
</html>