<?php
include_once "connect.php";

$_SESSION['erreurConnexion'] ="";

if(isset($_SESSION["utilisateur"]) && $_SESSION['utilisateur']="connected") //Si l'utilisateur est connecté, renvoit à la page principale
{
    header('Location: ./index.php');
}

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
    include_once "header_html.php"
?>

<body class="m-5 p-5 hauteur">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <form action="connexion.php" method="POST" class="row g-3 mb-5">
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
                        <button type="submit" class="btn btn-primary" name="connexionBtn">Connexion</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?=$_SESSION['erreurConnexion']?>
</body>