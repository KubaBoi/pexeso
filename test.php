<?php
#hra bude 8x8 zapsana v poli int o velikosti 64 
#takze bude 32 dvojic znacene od 0 do 31
$ip = 4;#$_REQUEST["ip"];
$gameId = 0;

#zjisteni jestli gameId jiz neexistuje
while (file_exists("data" + strval($gameId))) {
    $gameId++;
}

#vytvoreni souboru s novou hrou
#$dataFile = fopen("data" + strval($gameId), "w");
$player1 = $ip;
$player2 = "";
$whosPlaying = 1;

$data = array_fill(0, 64, -1);
$cardTypes = array_fill(0, 32, 0); #uchova pocet polozenych karticek pro kazdou dvojici

for ($x = 0; $x < 8; $x++) {
    for ($y = 0; $y < 8; $y++) {
        $cardNumber = rand(0, 32);

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
for ($i = 0; $i < 32; $i++) {
	$st .= strval($cardTypes[$i]);
}
echo $st;

?>