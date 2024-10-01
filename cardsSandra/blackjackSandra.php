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


            function calculate_points(&$game_info){
                $points = 0;
                $cards = count($game_info['hand']);
                
                for($i=0; $i<$cards; $i++){
                    $actual_points_plus_11 = $game_info['points']+11;
                    switch($game_info['hand'][$i]['value']){
                        case 'J':
                        case 'Q':
                        case 'K':
                            $points += 10;
                            break;
                        case 1:
                            if($actual_points_plus_11 > 21){
                                $points += 1;
                            }else if ($game_info['points'] < 14){
                                $points += 11;
                            } else {
                                $points = 1;
                            };
                            break;
                        default:
                            $points += $game_info['hand'][$i]['value'];
                    } 
                }

                $game_info['points'] = $points;

            };

            calculate_points($game_info[0]);
            calculate_points($game_info[1]);
            calculate_points($game_info[2]);
            calculate_points($game_info[3]);
            calculate_points($game_info[4]);
            calculate_points($game_info[5]);

            function add_card(&$game_info, &$deck){
                while($game_info['points'] < 14){
                    $game_info['hand'][] = array_pop($deck);
                    calculate_points($game_info);
                }
            };

            add_card($game_info[0],$deck);
            add_card($game_info[1],$deck);
            add_card($game_info[2],$deck);
            add_card($game_info[3],$deck);
            add_card($game_info[4],$deck);
            add_card($game_info[5],$deck);




            //lógica del juego

            function check_winner($bank, &$game_info){
                if($game_info['points'] > 21) {
                    $game_info['state'] = 'Pierdes';
                } else if($game_info['points'] > $bank['points']) {
                    $game_info['state'] = 'Ganas';
                } else if($bank['points'] > 21 && $game_info['points'] < $bank['points']) {
                    $game_info['state'] = 'Ganas';
                } else if ($game_info['points'] == $bank['points']) {
                    $game_info['state'] = 'Empatas';
                } else {
                    $game_info['state'] = 'Pierdes';
                };
            };
            
            check_winner($game_info[0],$game_info[1]);
            check_winner($game_info[0],$game_info[2]);
            check_winner($game_info[0],$game_info[3]);
            check_winner($game_info[0],$game_info[4]);
            check_winner($game_info[0],$game_info[5]);

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