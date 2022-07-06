<?php
    include_once "connect.php";
    include_once "header_html.php";

    if(!isset($_SESSION["utilisateur"])) //Si l'utilisateur n'est pas connecté, renvoit à la page de connexion
    {
        header('Location: ./connexion.php');
    }
?>

<body>

        <div class="container">
            <!-- Le header avec le titre de la section de gauche le nom de l'utilisateur et le logo à droite -->
            <div class="row bg-secondary p-3 d-flex align-items-center text-light">
                <div class="col-3 d-flex justify-content-center">
                    <h3>Récents</h3>
                </div>
                <div class="col-7 d-flex justify-content-start">
                    <h3>Nom de l'utilisateur</h3>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <p>Logo</p>
                </div>
            </div>
            <!-- Fin du header au dessus -->
            <div class="row">
                <div class="col-3 bg-secondary text-light border-top border-dark p-2" id="contact-list">
                    <div class="row">
                        <!-- Ici la liste d'amis -->
                        <div class="col-12">
                            liste d'amis
                            <!-- Du PHP pour afficher la liste d'amis et les conversation liées si nécessaire -->
                        </div>
                        <!-- Ici le mini menu de deconnexion et d'accès à la page profil -->
                        <div class="col-12">
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body col-12">
                                    <form action="index.php" method="POST">
                                        <input type="number" name="id_ami" id="id_ami" placeholder="Ami #">
                                        <button type="submit" name="add_ami" class="btn btn-primary">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                            <div class="accordion" id="mini-menu">
                                <div class="accordion-item bg-secondary">
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-4 p-1 text-break">
                                                    Bouton déconnexion
                                                </div>
                                                <div class="col-4 p-1 text-wrap">
                                                    Bouton profil
                                                </div>
                                                <!-- Ici le bouton pour ajouter un ami, déclenche un autre accordéon qui affiche le input de l'id de l'ami à ajouter-->
                                                <div class="col-4">
                                                    <div class="accordion" id="input_ami">
                                                        <div class="accordion-item bg-secondary">
                                                            <h2 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button collapsed p-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                ami button
                                                            </button>
                                                            </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        mini-menu button
                                    </button>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9" id="main">
                    <div class="row">
                        <div class="col-12">
                            messages
                        </div>
                        <div class="col-12">
                            Input text
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>