<?php
include_once "connect.php";

$_SESSION['erreurConnexion'] ="";

if(isset($_SESSION["utilisateur"]) && $_SESSION['utilisateur']="connected" && !empty($_SESSION['util_connect'])) //Si l'utilisateur est connecté, renvoit à la page principale
{
    header('Location: ./index.php');
}

if(isset($_POST["connexionBtn"])) 
    {
        $sql = "SELECT email, mdp, id_user FROM `utilisateurs` WHERE email=:email";
        $requete = $connexion->prepare($sql);
        $requete->execute(array(
            ':email' => $_POST['email']
        ));
        $resultat = $requete->fetch();
        if(!$resultat) //Vérifie si l'adresse email existe
        {
            $_SESSION['erreurConnexion'] = '<p class="text-danger fs-5">Identifiants erronés<p>';
            $_SESSION['utilisateur'] = "disconnected"; //set connexion de l'utilisateur fausse
        }
        else if(!password_verify($_POST['mdp'], $resultat['mdp'])) //Vérifie si le mot de passe correspond au hash de la bdd
        {
            $_SESSION['erreurConnexion'] = '<p class="text-danger fs-5">Identifiants erronés<p>';
            $_SESSION['utilisateur'] = "disconnected"; //set connexion de l'utilisateur fausse
        }
        else {
            $_SESSION['utilisateur'] = "connected"; //set connexion de l'utilisateur vraie
            $_SESSION['util_connect'] = $resultat['id_user']; //set connexion de l'utilisateur à son id
            header('Location: ./index.php');
            exit;
        };
    }

    include_once "header_html.php"
?>

<body class="m-4 p-4 hauteur">
    <div class="col-2 d-flex justify-content-end d-inline" style="position: absolute;">
        <img src="./Logo.svg" alt="Logo" class="img-fluid fs-6" style="height: 50px; color: white;">
    </div>
    <div class="h-100 row align-items-center">

        <div class="container h-100 row align-items-center m-0">

            <form action="connexion.php" method="POST" class="row d-flex justify-content-center m-0 col-12">
                <div class="col-8 col-lg-4 mx-2">
                    <?=$_SESSION['erreurConnexion']?>
                    <div class="col-12 mx-auto my-3">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required placeholder="Adresse e-mail" id="inputEmail4">
                    </div>
                    <div class="col-12 mx-auto my-3">
                        <label for="inputPassword4" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdp" required placeholder="Mot de passe" id="inputPassword4">
                    </div>
                    <a href="./inscription.php">Pas encore de compte ?</a>
                </div>

                <div class="row col-1 mx-2">
                    <div class="col-4 my-auto">
                        <button type="submit" id="bouton" class="btn btn-primary d-flex align-items-center justify-content-center min-width" name="connexionBtn">
                            <i class="fa-solid fa-paper-plane fs-2"></i>
                        </button>
                    </div>
                </div>
            </form>

        </div>
        
    </div>
</body>