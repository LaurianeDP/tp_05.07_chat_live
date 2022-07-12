<?php
    include_once "connect.php";

    if($_SERVER['REQUEST_METHOD']==='POST') {
        if(isset($_POST['connexionBtn']) && !empty($_POST['email']) && !empty($_POST['pseudo']) && !empty($_POST['nom_complet']) && !empty($_POST['mdp'])) {
            $sql="INSERT INTO utilisateurs (email, pseudo, nom_complet, mdp) VALUES (:email, :pseudo, :nom_complet, :mdp)";
            $requete=$connexion->prepare($sql);
            $requete->execute(array(
                ':email' => $_POST['email'],
                ':pseudo' => $_POST['pseudo'],
                ':nom_complet' => $_POST['nom_complet'],
                ':mdp' => $_POST['mdp'],
            ));
        }
    }

    include_once "header_html.php"
?>

<body class="m-4 p-4 hauteur">
    <div class="col-2 d-flex justify-content-end d-inline" style="position: absolute;">
        <img src="./Logo.svg" alt="Logo" class="img-fluid fs-6" style="height: 50px; color: white;">
    </div>
    <div class="h-100 row align-items-center">

        <div class="container h-100 row align-items-center m-0">

            <form action="inscription.php" method="POST" class="row d-flex justify-content-center m-0 col-12">
                <div class="col-8 col-lg-4 mx-2">
                    <div class="col-12 mx-auto my-3">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required="required" id="inputEmail1">
                    </div>
                    <div class="col-12 mx-auto my-3">
                        <label for="inputEmail4" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" name="pseudo" required="required" id="inputEmail2">
                    </div>
                    <div class="col-12 mx-auto my-3">
                        <label for="inputEmail4" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" name="nom_complet" required="required" id="inputEmail3">
                    </div>
                    <div class="col-12 mx-auto my-3">
                        <label for="inputPassword4" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdp" required="required" id="inputPassword4">
                    </div>
                    <a href="./connexion.php">Déjà un compte ?</a>
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