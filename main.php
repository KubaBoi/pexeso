<?php
#script po zvavolani pozmeni stav hry a vrati aktualni stav
$move1 = (int)$_REQUEST["move1"];
$move2 = (int)$_REQUEST["move2"];
$gameId = $_REQUEST["gameId"];
$playerId = $_REQUEST["playerId"];

if (file_exists("game" . $gameId)) {
    $dataFile = fopen("game" . $gameId, "r");
    $data = fread($dataFile, filesize("game" . $gameId));
    $data = explode("|", json_encode($data));

    if (count($data) >= 4) {
        $player1 = $data[0];
        $player2 = $data[1];
        $whosPlaying = $data[2];
        $pixels = explode(",", $data[3]);
        $changedPixels = explode(",", $data[4]);

        if ($move1 < 0 || $move2 < 0) {
            $jsonObj->code = 1;
            $jsonObj->comment = "Vraci stav pole";
            $jsonObj->whosPlayin = $whosPlaying;
            $jsonObj->pixels = $pixels;
            $jsonObj->change = $changedPixels;
        }
        else {
            #vytvoreni pole s pexesovyma pexesákama
            for ($i = 0; $i < 64; $i++) {
                $x = round((int)$pixels[$i] / 8, 0, PHP_ROUND_HALF_DOWN);
                $y = (int)$pixels[$i] % 8;
            }
        }
    }
}
else {
    $jsonObj->code = 0;
    $jsonObj->comment = "Hra neexistuje: " . $e;
}

echo json_encode($jsonObj);

?>