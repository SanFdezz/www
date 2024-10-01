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