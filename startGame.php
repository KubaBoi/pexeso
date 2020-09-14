<?php
#script zaklada novou hru a vrati stav a ID hry
#hra bude 8x8 zapsana v poli int o velikosti 64 
#takze bude 32 dvojic znacene od 0 do 31
$playerId = $_REQUEST["playerId"];
$gameId = 0;

#zjisteni jestli gameId jiz neexistuje
while (file_exists("game" . strval($gameId))) {
    $gameId++;
}

#vytvoreni souboru s novou hrou
$dataFile = fopen("game" . strval($gameId), "w") or die("? :(");
$player1 = $playerId;
$player2 = "-1";
$whosPlaying = $player1;

$data = array_fill(0, 64, -1);
$cardTypes = array_fill(0, 32, 0); #uchova pocet polozenych karticek pro kazdou dvojici

for ($x = 0; $x < 8; $x++) {
    for ($y = 0; $y < 8; $y++) {
        $cardNumber = rand(0, 31);

        $cardCount = $cardTypes[$cardNumber];
        if ($cardCount >= 2) { #pokud jiz ma karta dve zastoupeni, tak se zkusi nova
        	$y--;
            continue;
        }
        
        #pokud jeste karta nema dve zastoupeni muze se zapsat na pozici
        #a pricist zaznam do cardTypes
        $cardCount++;
        $cardTypes[$cardNumber] = $cardCount;
        $data[$x * 8 + $y] = $cardNumber;
    }
}
$st = ""; 
$stDone = "";
for ($i = 0; $i < 64; $i++) {
    $st .= strval($data[$i]);
    $stDone .= "0";
    if ($i < 63) {
        $st .= ",";
        $stDone .= ",";
    }
}

fwrite($dataFile, $player1 . "|" . $player2 . "|" . $whosPlaying . "|" . $st . "|" . $stDone);
fclose($dataFile);
$jsonObj->code = 1;
$jsonObj->gameId = $gameId;
echo json_encode($jsonObj);

?>