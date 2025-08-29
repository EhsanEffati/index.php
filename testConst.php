<?php
// Variablen
$dbName = "test";

// Wert ändern
$dbName = "user";

echo $dbName;


// Ich möchte, dass sich der Wert von einer Variable nicht ändern lässt
define('DB_NAME', 'test'); // DB_NAME lässt sich nicht ändern

// Wert ändern
//DB_NAME = "user";

echo DB_NAME;
echo '<br>';
// Konstanten und Variablen im string (Kontaninieren)

$stringMitVar = 'der Name von der Datenbank ist ' . $dbName . '!';
$stringMitConst = "Der Name von der Datenbank ist DB_NAME !";
echo $stringMitVar;
echo '<br>';
$stringMitConst2 = "Der Name von der Datenbank ist " . DB_NAME ."!";
echo $stringMitConst2;
