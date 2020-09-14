<?php
#script po zvavolani pozmeni stav hry a vrati aktualni stav
$login = $_REQUEST["login"];
$password = $_REQUEST["password"];

$host = "sql4.webzdarma.cz";
$user = "kubatestbore8241";
$pass = "&mDGkh*0XIQ&-4-q-%66";
$database = "kubatestbore8241";

$conn = new mysqli($host, $user, $pass, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT password FROM users WHERE login=$login";
$result = $conn->query($sql);

if ($result->num_rows == 0) { //ucet neexistuje
    //zalozi se novy
    $sql = "INSERT INTO users (login, password) VALUES ('$login', '$password')";

    if ($conn->query($sql) === TRUE) {
        $jsonObj->code = 1;
        $jsonObj->comment = "Registrovano";
    } else {
        $json->code = 0;
        $jsonObj->comment = "Error: " . $sql . "<br>" . $conn->error;
    }
}
else { //ucet existuje
    while ($row = $result->fetch_assoc()) {
        if ($row["password"] == $password) { //heslo sedi
            $jsonObj->code = 1;
            $jsonObj->comment = "Prihlaseno";
        }
        else {
            $jsonObj->code = 0;
            $jsonObj->comment = "Heslo nesedi";
        }
    }
}

echo json_encode($jsonObj);

?>