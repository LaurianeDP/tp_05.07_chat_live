<?php
    include_once "connect.php";
    include_once "header_html.php";

    // if(!isset($_SESSION["utilisateur"])) //Si l'utilisateur n'est pas connecté, renvoit à la page de connexion
    // {
    //     header('Location: ./connexion.php');
    // }
?>

<body>

        <div class="container">
            <!-- Le header avec le titre de la section de gauche le nom de l'utilisateur et le logo à droite -->
            <div class="row bg-secondary p-3 d-flex align-items-center text-light">
                <div class="col-3 d-flex justify-content-center">
                    <h3>Récents</h3>
                </div>
                <div class="col-6 d-flex justify-content-start">
                    <h3>Nom de l'utilisateur</h3>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <p>Logo</p>
                </div>
            </div>
            <!-- Fin du header au dessus -->
            <div class="row">
                <div class="col-3 bg-secondary text-light border-top border-dark p-2" id="contact-list">
                    <!-- Du PHP pour afficher la liste d'amis et les conversation liées si nécessaire -->
                </div>
            </div>
        </div>

</body>
</html>