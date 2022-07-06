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

$_SESSION['erreurConnexion'] ="";

if(isset($_POST["connexionBtn"])) 
    {
        $sql = "SELECT * FROM `utilisateurs` WHERE email=:email AND mdp=:pass";
        $requete = $connexion->prepare($sql);
        $requete->execute(array(
            ':email' => $_POST['email'],
            ':pass' => $_POST['mdp']
        ));
        $resultat = $requete->fetchAll();
        if(!$resultat)
        {
            $_SESSION['erreurConnexion'] = '<p class="text-warning mx-5 fs-3 text-center">Identifiants erronés<p>';
            $_SESSION['utilisateur'] = "disconnected"; //set connexion de l'utilisateur fausse
        }
        else {
            $_SESSION['utilisateur'] = "connected"; //set connexion de l'utilisateur vraie
            header('Location: ./index.php');
            exit;
        };
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat en ligne</title>
    <link rel="stylesheet" href="./bootstrap.css">
</head>

<body class="m-5 p-5">
    <div class="hauteur">
        </div class="d-flex justify-content-center">
    <form action="index.php" method="POST" class="row g-3">
        <div class="col-md-12 p-0">
            <div class="col-md-4 mx-auto">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required="required" id="inputEmail4">
            </div>
        </div>
        <div class="col-md-12 p-0">
            <div class="col-md-4 mx-auto">
                <label for="inputPassword4" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="mdp" required="required" id="inputPassword4">
            </div>
        </div>
        <div class="col-md-4 mx-auto p-0 mt-4">
            <div class="">
                <button type="submit" class="btn btn-primary">Connexion</button>
            </div>
        </div>
    </form>
</div>
    </div>

    <?=$_SESSION['erreurConnexion']?>
    </div>