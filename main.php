<?php
$input = $_REQUEST["input"];
$gameId = $_REQUEST["gameId"];

$data = file("data" + $gameId).explode("|");
if (count($data) >= 4) {
    $player1 = data[0];
    $player2 = data[1];
    $whosPlaying = data[2];
    $pixels = data[3].explode(",");

    #vytvoreni pole s pexesovyma pexesákama
        
}

?>