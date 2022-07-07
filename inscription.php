<?php
    include_once "connect.php";
    include_once "header_html.php"
?>

<body class="m-5 p-5 hauteur ">
    <div class="h-100 row align-items-center">

        <div class="container h-100 row align-items-center m-0">

            <form action="connexion.php" method="POST" class="row d-flex justify-content-center m-0 col-12">
                <div class="col-8 col-lg-4 mx-2">
                    <div class="col-12 mx-auto my-3">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required="required" id="inputEmail4">
                    </div>
                    <div class="col-12 mx-auto my-3">
                        <label for="inputEmail4" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" name="email" required="required" id="inputEmail4">
                    </div>
                    <div class="col-12 mx-auto my-3">
                        <label for="inputEmail4" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" name="email" required="required" id="inputEmail4">
                    </div>
                    <div class="col-12 mx-auto my-3">
                        <label for="inputPassword4" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdp" required="required" id="inputPassword4">
                    </div>
                </div>

                <div class="row col-1 mx-2">
                    <div class="col-4 my-auto">
                        <button type="" id="bouton" class="btn btn-primary fa-solid fa-paper-plane fs-2" name="connexionBtn"></button>
                    </div>
                </div>

            </form>

        </div>

    </div>
</body>