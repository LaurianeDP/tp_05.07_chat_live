<?php
session_start();

DEFINE("BDD", "dw_chat");
DEFINE("USER", "root");
DEFINE("HOST", "localhost");
DEFINE("PASSW", "");
DEFINE("CHARSET", "utf8mb4");

// test BDD
try {
    $connexion= new PDO ("mysql:host=".HOST.";dbname=".BDD.";charset=utf8", USER, PASSW, array(PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION));
}
catch (PDOException $exception) {
    die('Erreur fonction connexion : ' . $exception->getMessage());
}
?>