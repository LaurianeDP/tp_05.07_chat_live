<?php
    include_once "connect.php";

    $utilisateur=$_SESSION['util_connect'];
    
    //Affichage des valeurs existantes
    $sql_info="SELECT * FROM utilisateurs WHERE id_user=$utilisateur";
    $requete=$connexion->prepare($sql_info);
    $requete->execute();
    $resultat = $requete->fetch();
    
    //Modification du nom complet
    if(isset($_POST['changeName']) && !empty($_POST['newName'])) {
        $sql_update_nom="UPDATE utilisateurs SET nom_complet=:newName WHERE id_user=:utilisateur";
        $requete=$connexion->prepare($sql_update_nom);
        $requete->execute(array(
            ':newName' => $_POST['newName'],
            ':utilisateur' => $utilisateur
        ));
        header('Location: profil.php');
    };
    //Modification du pseudo
    
    //Modification de l'adresse email
    if(isset($_POST['changeEmail']) && !empty($_POST['newEmail'])) {
        $sql_update_email="UPDATE utilisateurs SET email=:newEmail WHERE id_user=:utilisateur";
        $requete=$connexion->prepare($sql_update_email);
        $requete->execute(array(
            ':newEmail' => $_POST['newEmail'],
            ':utilisateur' => $utilisateur
        ));
        header('Location: profil.php');
    };
    
    include_once "header_html.php";
?>

<body class="m-4 p-4 hauteur">
    <div class="col-2 d-flex justify-content-end d-inline" style="position: absolute;">
        <img src="./Logo.svg" alt="Logo" class="img-fluid fs-6" style="height: 50px; color: white;">
    </div>
    <div class="h-100 row align-items-center">

        <div class="container h-100 row align-items-center m-0">

            <div class="row d-flex justify-content-center m-0 col-12">
                <div class="col-2 me-5">
                    <h3 class="my-5">Nom complet</h3>
                    <h3 class="my-5">Pseudo</h3>
                    <h3 class="my-5">Adresse e-mail</h3>
                    <!-- <h3 class="my-5">Mot de passe</h3> -->
                    <h5><a href="./index.php">Retour</a></h3>
                </div>
                <div class="col-3">
                    <h3 class="my-5"><?=$resultat['nom_complet']?></h3>
                    <h3 class="my-5"><?=$resultat['pseudo']?></h3>
                    <h3 class="my-5"><?=$resultat['email']?></h3>
                    <!-- <h3 class="my-5">**********</h3> -->
                </div>
                <!-- Inputs de modification -->
                <div class="col-3">
                    <div class="my-5 invisible" id="newName">
                        <form action="profil.php" class="d-flex" method="POST">
                            <input class="form-control" type="text" name="newName"  placeholder="Nouveau nom"> 
                            <button type="submit" name="changeName" class="btn btn-secondary h-25">Confirmer</button>
                        </form>
                    </div>
                    <div class="my-5 invisible" id="newPseudo">
                        <form action="profil.php" class="d-flex" method="POST">
                            <input class="form-control" type="text" name="newPseudo" placeholder="Nouveau pseudo">
                            <button type="submit" name="changePseudo" class="btn btn-secondary h-25">Confirmer</button>
                        </form>
                    </div>
                    <div class="my-5 invisible" id="newEmail">
                        <form action="profil.php" class="d-flex" method="POST">
                            <input class="form-control" type="text" name="newEmail" placeholder="Nouvelle adresse">
                            <button type="submit" name="changeEmail" class="btn btn-secondary h-25">Confirmer</button>
                        </form>
                    </div>
                    <!-- <div class="my-5 invisible" id="newPass">
                        <form action="profil.php" class="d-flex" method="POST">
                            <input class="form-control" type="text" name="newEmail" placeholder="Nouvelle adresse">
                            <button type="submit" name="changeEmail" class="btn btn-secondary h-25">Confirmer</button>
                        </form>
                    </div> -->
                </div>
                <!-- Boutons de modification -->
                <div class="col-1">
                    <h3 class="col-12 mx-auto my-5">
                        <button name="nomComplet" id="nomComplet" class="btn fs-4 p-0 m-0"><i class="fa-solid fa-pen"></i></button>
                    </h3>
                    <h3 class="col-12 mx-auto my-5">
                        <button name="pseudo" id="pseudo" class="btn fs-4 p-0 m-0"><i class="fa-solid fa-pen"></i></button>
                    </h3>
                    <h3 class="col-12 mx-auto my-5">
                        <button name="email" id="email" class="btn fs-4 p-0 m-0"><i class="fa-solid fa-pen"></i></button>
                    </h3>
                    <!-- <h3 class="col-12 mx-auto my-5">
                        <button name="mdp" class="btn fs-4 p-0 m-0"><i class="fa-solid fa-pen"></i></button>
                    </h3> -->
                </div>
            </div>
        </div>
        <script>
            let btnNom = document.querySelector('#nomComplet');
            let btnPseudo = document.querySelector('#pseudo');
            let btnEmail = document.querySelector('#email');

            btnNom.addEventListener('click', () =>{
                document.querySelector('#newName').classList.toggle('invisible');
            } )
            btnPseudo.addEventListener('click', () =>{
                document.querySelector('#newPseudo').classList.toggle('invisible');
            } )
            btnEmail.addEventListener('click', () =>{
                document.querySelector('#newEmail').classList.toggle('invisible');
            } )


        </script>
    </div>
</body>