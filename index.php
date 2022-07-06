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
                            <div id="collapseTwo" class="accordion-collapse collapse m-0" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body border-0 col-12 p-0">
                                    <form action="index.php" class="d-flex flex-column" method="POST">
                                        <input type="number" class="form-control" name="id_ami" id="id_ami" placeholder="Ami #">
                                        <button type="submit" name="add_ami" class="btn btn-outline-info btn-sm mt-1 justify-self-end m-0">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                            <div class="accordion border-0" id="mini-menu">
                                <div class="accordion-item bg-secondary border-0">
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="btn btn-light rounded-0 col-4 d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid fa-person-through-window text-dark fs-4"></i>
                                                </div>
                                                <div class="btn rounded-0 col-4 btn-light d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid text-dark fa-user-ninja fs-4"></i>
                                                </div>
                                                <!-- Ici le bouton pour ajouter un ami, déclenche un autre accordéon qui affiche le input de l'id de l'ami à ajouter-->
                                                <div class=" btn rounded-0 col-4 btn-light d-flex align-items-center justify-content-center">
                                                    <div class="accordion" id="input_ami">
                                                        <div class="accordion-item bg-secondary border-0">
                                                            <h2 class="accordion-header p-0 bg-light border-0" id="headingTwo">
                                                            <button class="bg-light p-0 border-0 rounded-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                <i class="fa-solid text-dark fa-user-plus fs-4"></i>
                                                            </button>
                                                            </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="accordion-header" id="headingOne">
                                    <button class="btn btn-sm ms-1 bg-light collapsed text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <i class="fa-solid fa-burger fs-4"></i>
                                    </button>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- La section principale avec les messages -->
                <div class="col-9 d-flex m-0 p-0" id="main">
                    <div class="row p-0 m-0 w-100">
                        <div class="col-12 align-self-center px-4">
                            <!-- Ici de l'ajax pour afficher les messages au fur et à mesure qu'ils sont envoyés -->
                            messages
                        </div>
                        <div class="col-10 offset-1 align-self-end">
                            <form action="index.php" method="POST" class="d-flex">
                                <input type="text" class="form-control" name="messageToSend" id="inputMessage" placeholder="Entrez votre message ici">
                                <button type="submit" name="SendMessage" class="btn fs-4"><i class="fa-solid fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>