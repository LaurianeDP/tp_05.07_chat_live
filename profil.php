<?php
    include_once "connect.php";

    include_once "header_html.php";
?>

<body class="m-4 p-4 hauteur">
    <div class="col-2 d-flex justify-content-end d-inline" style="position: absolute;">
        <img src="./Logo.svg" alt="Logo" class="img-fluid fs-6" style="height: 50px; color: white;">
    </div>
    <div class="h-100 row align-items-center">

        <div class="container h-100 row align-items-center m-0">

            <div class="row d-flex justify-content-center m-0 col-12">
                <div class="col-3">
                    <h3 class="col-12 mx-auto my-5">Nom complet</h3>
                    <h3 class="col-12 mx-auto my-5">Pseudo</h3>
                    <h3 class="col-12 mx-auto my-5">Adresse e-mail</h3>
                    <h3 class="col-12 mx-auto my-5">Mot de passe</h3>
                </div>
                <div class="col-5">
                    <h3 class="col-12 mx-auto my-5">Votre nom</h3>
                    <h3 class="col-12 mx-auto my-5">Votre pseudo</h3>
                    <h3 class="col-12 mx-auto my-5">Votre adresse e-mail</h3>
                    <h3 class="col-12 mx-auto my-5">Votre mot de passe</h3>
                </div>
                <div class="col-1">
                    <h3 class="col-12 mx-auto my-5">
                        <button type="submit" name="SendMessage" class="btn fs-4 p-0 m-0"><i class="fa-solid fa-paper-plane"></i></button>
                    </h3>
                    <h3 class="col-12 mx-auto my-5">
                        <button type="submit" name="SendMessage" class="btn fs-4 p-0 m-0"><i class="fa-solid fa-paper-plane"></i></button>
                    </h3>
                    <h3 class="col-12 mx-auto my-5">
                        <button type="submit" name="SendMessage" class="btn fs-4 p-0 m-0"><i class="fa-solid fa-paper-plane"></i></button>
                    </h3>
                    <h3 class="col-12 mx-auto my-5">
                        <button type="submit" name="SendMessage" class="btn fs-4 p-0 m-0"><i class="fa-solid fa-paper-plane"></i></button>
                    </h3>
                </div>
            </div>
        </div>
        
    </div>
</body>