<?php
#script po zvavolani pozmeni stav hry a vrati aktualni stav
$move1 = $_REQUEST["move1"];
$move2 = $_REQUEST["move2"];
$gameId = $_REQUEST["gameId"];
$playerId = $_REQUEST["playerId"];

$dataFile = fopen("game" . $gameId, "r");
$data = fread($dataFile, filesize("game" . $gameId));
$data = explode("|", json_encode($data));

if (count($data) >= 4) {
    $player1 = $data[0];
    $player2 = $data[1];
    $whosPlaying = $data[2];
    $pixels = explode(",", $data[3]);
    $changedPixels = explode(",", $data[4]);
    
    #vytvoreni pole s pexesovyma pexesákama
    for ($i = 0; $i < 64; $i++) {
        $x = round((int)$pixels[$i] / 8, 0, PHP_ROUND_HALF_DOWN);
        $y = (int)$pixels[$i] % 8;
    }
}

?>