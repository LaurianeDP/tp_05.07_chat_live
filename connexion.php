<?php
include_once "connect.php";
include_once "htmlHeader.php";

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

<div class="container">
            <form action="connexion.php" method="POST" id="connexionForm"
                class="formulaire rounded-3 mx-auto p-2 p-md-auto mb-4 py-4">
                <fieldset id="connexionFormInputs" class="mt-3 mb-4 p-2">
                    <h4 class="offset-md-2 my-0">Connexion</h4>
                    <div class="row g-3 my-1">
                        <div class="col-8 col-lg-4 offset-md-2">
                            <label for="nom" class="form-label">Email</label>
                            <input type="text" class="form-control" name="pseudo" id="Votre pseudo" placeholder="Nom" required>
                            <div class="invalid-feedback">Veuillez renseigner ce champ</div>
                        </div>
                        <div class="col-8 col-lg-3 offset-2">
                            <label for="adresse" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" name="mdp" id="mdpUtil" placeholder="Password" required>
                            <div class="invalid-feedback">Veuillez renseigner ce champ</div>
                        </div>
                    </div>
                </fieldset>
                </fieldset>
                    <button type="submit" name="connexionBtn" id="connexionBtn" class="btn btn-primary offset-md-2 mt-1 mb-2">Me connecter</button>
                </fieldset>
            </form>
            <?=$_SESSION['erreurConnexion']?>
        </div>