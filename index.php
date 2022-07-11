<?php
    include_once "connect.php";
    include_once "header_html.php";

    if(!isset($_SESSION["utilisateur"])) //Si l'utilisateur n'est pas connecté, renvoit à la page de connexion
    {
        header('Location: ./connexion.php');
    }
    $utilisateur=$_SESSION['util_connect'];

    //SQL sélection liste d'amis
    $sql="SELECT contact_lists.id_user1, contact_lists.id_user2, if(contact_lists.id_user1=$utilisateur, contact_lists.id_user2, contact_lists.id_user1) AS 'amis_$utilisateur', utilisateurs.pseudo, utilisateurs.id_user FROM `contact_lists`, utilisateurs WHERE contact_lists.id_user1=$utilisateur OR contact_lists.id_user2=$utilisateur HAVING utilisateurs.id_user=amis_$utilisateur ORDER BY utilisateurs.pseudo;";

    // Requête pour récupérer le pseudo de l'utilisateur connecté
    $sql_pseudo= "SELECT pseudo FROM utilisateurs WHERE id_user=$utilisateur";
    $requete=$connexion->prepare($sql_pseudo);
    $requete->execute();
    $result= $requete->fetch();
    $pseudo=$result['pseudo'];
    
    
    if(isset($_POST['SendMessage']) && !empty($_POST['messageToSend'])) {
        $sql_message= "INSERT INTO `messages` (`destinataire`, `emetteur`, `contenu`, `id_conversation`) VALUES (:ami, :utilisateur, :contenu, :conv)";
        $requete_mess=$connexion->prepare($sql_message);
        $requete_mess->execute(array(
            ':ami' => 7, 
            ':utilisateur' => $utilisateur,
            ':contenu' => $_POST['messageToSend'],
            ':conv' => 1
        ));
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
                    <h3>Conversations de <?=$pseudo?></h3>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <p>Logo</p>
                </div>
            </div>
            <!-- Fin du header au dessus -->
            <div class="row">
                <div class="col-3 bg-secondary text-light border-top border-dark p-2 lef-menu d-flex flex-column h-100" id="contact-list">
                    <div class="row d-flex flex-column align-content-between">
                        <!-- Ici la liste d'amis -->
                        <div class="col-12 amis overflow-auto">
                            <!-- Du PHP pour afficher la liste d'amis et ajouter les conversation liées si nécessaire -->
                            <?php
                                $requete=$connexion->prepare($sql);
                                $requete->execute();
                                while ($ami= $requete->fetch()) {
                                $ami_pseudo=$ami['pseudo'];
                                ?>
                                <!-- Ici chaque ami à un lien vers une conversation entre lui et l'utilisateur connecté-->
                                <div class="d-grid">
                                    <button class="btn btn-outline-light m-0 text-start p-1"><?=$ami_pseudo?> 
                                        <p class="text-end p-0">Dernier message de la conversation</p>
                                    </button>
                                </div>
                                <HR>
                            <?php
                            };
                            ?>
                        </div>
                    </div>
                    <!-- Ici le mini menu de deconnexion et d'accès à la page profil -->
                    <div class="col-12 align-self-end">
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
                                                <!-- Lien de déconnexion -->
                                                <a href="./deconnexion.php"><i class="fa-solid fa-person-through-window text-dark fs-4"></i></a>
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
                <!-- La section principale avec les messages -->
                <div class="col-9 d-flex m-0 p-0" id="main">
                    <div class="row p-0 m-0 w-100">
                        <div class="col-10 px-1 d-flex offset-1 flex-column overflow-auto messages">
                            <!-- Ici de l'ajax pour afficher les messages au fur et à mesure qu'ils sont envoyés -->
                            <?php
                                //Requête pour récupérer tous les messages d'une conversation
                                $sql_conv= "SELECT * FROM `messages` WHERE destinataire=$utilisateur OR emetteur=$utilisateur ORDER BY time_stamp";
                                $requete_conv=$connexion->prepare($sql_conv);
                                $requete_conv->execute();
                                while ($conv= $requete_conv->fetch()) {
                                    $emetteur=$conv['emetteur'];
                                    $destinataire=$conv['destinataire'];
                                    $contenu=$conv['contenu'];
                                    $datetime=$conv['time_stamp'];
                                    $class=($emetteur==$utilisateur) ? "align-self-end text-end" : "align-self-start";
                                    $contentClass=($emetteur==$utilisateur) ? "bg-success pe-4" : "bg-light ps-3";
                                ?>
                                    <div class="<?=$class?> mx-2 my-1 d-flex flex-column justify-content-center">
                                        <p class="<?=$contentClass?> p-2 border border-secondary rounded-pill mb-0 text-wrap"><?=$contenu?></p>
                                        <p class="px-2 fst-italic" id="date"><?=$datetime?></p>
                                    </div>
                                <?php
                                };
                            ?>
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