<?php
$playerId = $_REQUEST["playerId"];
$gameId = $_REQUEST["gameId"];

if (file_exists("game" . strval($gameId))) {
    $dataFile = fopen("game" . $gameId, "r");
    $data = fread($dataFile, filesize("game" . $gameId));
    $data = explode("|", $data);

    $player2 = $data[1];
    if ($player2 == "-1") {
        $player2 = $playerId;
        $dataFile = fopen("game" . $gameId, "w");
        fwrite($dataFile, $data[0] . "|" . $player2 . "|" . $data[2] . "|" . $data[3] . "|" . $data[4]);
        fclose($dataFile);

        $jsonObj->code = 1; #OK
        $jsonObj->comment = "Prihlaseno";
    }
    else {
        $jsonObj->code = 0; #NOT OK
        $jsonObj->comment = "Hra je jiz plna";
    }
} 
else {
    $jsonObj->code = 0; #NOT OK
    $jsonObj->comment = "Hra neni zalozena";
}

echo json_encode($jsonObj);
?>