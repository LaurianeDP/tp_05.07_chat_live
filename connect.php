<?php
session_start();

// DEFINE("BDD", "chatLT");
// DEFINE("USER", "root");
// DEFINE("HOST", "localhost");
// DEFINE("PASSW", "");
// DEFINE("CHARSET", "utf8mb4");
DEFINE("BDD", "dbs8004381");
DEFINE("USER", "dbu2336552");
DEFINE("HOST", "db5009437237.hosting-data.io");
DEFINE("PASSW", "f7dM5CE6r");
DEFINE("CHARSET", "utf8mb4");

// test BDD
try {
    $connexion= new PDO ("mysql:host=".HOST.";dbname=".BDD.";charset=utf8", USER, PASSW, array(PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION));
}
catch (PDOException $exception) {
    die('Erreur fonction connexion : ' . $exception->getMessage());
}
?>