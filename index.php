<?php
    include_once "connect.php";
    include_once "header_html.php";

    $erreur="";

    if(!isset($_SESSION["utilisateur"])) //Si l'utilisateur n'est pas connecté, renvoit à la page de connexion
    {
        header('Location: ./connexion.php');
    }
    $utilisateur=$_SESSION['util_connect'];

    //SQL sélection liste d'amis
    $sql_ami="SELECT contact_lists.id_user1, contact_lists.id_user2, if(contact_lists.id_user1=$utilisateur, contact_lists.id_user2, contact_lists.id_user1) AS 'amis_$utilisateur', utilisateurs.pseudo, utilisateurs.id_user AS 'id_ami' FROM `contact_lists`, utilisateurs WHERE contact_lists.id_user1=$utilisateur OR contact_lists.id_user2=$utilisateur HAVING utilisateurs.id_user=amis_$utilisateur ORDER BY utilisateurs.pseudo;";

    // Requête pour récupérer le pseudo de l'utilisateur connecté
    $sql_pseudo= "SELECT pseudo FROM utilisateurs WHERE id_user=$utilisateur";
    $requete=$connexion->prepare($sql_pseudo);
    $requete->execute();
    $result= $requete->fetch();
    $pseudo=$result['pseudo'];
    
    //Génère la phrase du header au clic sur le nom d'un ami
    if(isset($_GET['ami'])) {
        $id_ami=$_GET['ami'];
        $sql="SELECT pseudo FROM utilisateurs WHERE id_user=$id_ami";
        $requete=$connexion->prepare($sql);
        $requete->execute();
        $result_ami= $requete->fetch();
        $ami_pseudo=$result_ami['pseudo'];
        $nom_conv="<h3>Conversations de $pseudo avec $ami_pseudo</h3>";
    }
    else {
        $nom_conv="";
    }

    //Code pour l'envoit d'un message
    if(isset($_POST['SendMessage']) && !empty($_POST['messageToSend'])) {
        $ami_id=$_POST['ami_id'];
        $id_conv=$_POST['conv_id'];
        if(empty($_POST['conv_id'])) {
            $sql_new_conv= "INSERT INTO conversations (utilisateur_1, utilisateur_2) VALUES ($utilisateur, $ami_id)";
            $requete=$connexion->prepare($sql_new_conv);
            $requete->execute();

            $sql_last_conv_select= "SELECT MAX(id_conversation) AS 'last_id' FROM conversations";
            $requete=$connexion->prepare($sql_last_conv_select);
            $requete->execute();
            $result_conv=$requete->fetch();
            $id_conv=$result_conv['last_id'];
        };
        $sql_message= "INSERT INTO `messages` (`destinataire`, `emetteur`, `contenu`, `id_conversation`) VALUES ($ami_id, $utilisateur, :contenu, $id_conv)";
        $requete_mess=$connexion->prepare($sql_message);
        $requete_mess->execute(array(
            ':contenu' => $_POST['messageToSend']
        ));
        header('location: '.$_SERVER['REQUEST_URI']);
    }
    //Code pour l'ajout d'un contact, sélectionne l'id à ajouter dans la liste à partir d'une recherche de pseudo
    if(isset($_POST['add_friend'])&& !empty($_POST['pseudo_ami'])) {
        $pseudo_ami= $_POST['pseudo_ami'];
        $sql_pseudo_ami= "SELECT id_user FROM utilisateurs WHERE pseudo=?";
        $requete_pseudo_ami=$connexion->prepare($sql_pseudo_ami);
        $requete_pseudo_ami->execute(array($pseudo_ami));
        $result_pseudo_ami=$requete_pseudo_ami->fetch();
        if(!$result_pseudo_ami) {
            $erreur="/!\ Pseudo incorrect /!\ ";
        }
        else {
            var_dump($_POST);
            $id_to_add=$result_pseudo_ami['id_user'];
            $sql_ajout_ami= "INSERT INTO contact_lists (id_user1, id_user2) VALUES ($utilisateur, $id_to_add)";
            $requete_ajout_ami=$connexion->prepare($sql_ajout_ami);
            $requete_ajout_ami->execute();
        }
    };
?>

<body>

        <div class="container">
            <!-- Le header avec le titre de la section de gauche le nom de l'utilisateur et le logo à droite -->
            <div class="row header p-3 d-flex align-items-center text-dark" style="background-color: #F2F2F2;">
                <div class="col-3 d-flex justify-content-center">
                    <h3>Récents</h3>
                </div>
                <div class="col-7 d-flex justify-content-start">
                    <?=$nom_conv?>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <img src="./Logo.svg" alt="Logo" class="img-fluid fs-6" style="height: 50px; color: white;">
                </div>
            </div>
            <!-- Le header avec le titre de la section de gauche le nom de l'utilisateur et le logo à droite -->
            <!-- Fin du header au dessus -->
            <div class="row">
                <div class="col-3 text-light border-top p-2 lef-menu d-flex flex-column h-100" id="contact-list" style="background-color: #444444;">
                    <div class="row d-flex flex-column align-content-between">
                        <!-- Ici la liste d'amis -->
                        <div class="col-12 amis overflow-auto">
                            <!-- Du PHP pour afficher la liste d'amis et ajouter les conversation liées si nécessaire -->
                            <?php
                                if(isset($_GET['ami'])) {
                                    $ami_id=$_GET['ami'];
                                    $sql_conv= "SELECT * FROM conversations WHERE (utilisateur_1=$utilisateur OR utilisateur_2=$utilisateur) AND (utilisateur_1=$ami_id OR utilisateur_2=$ami_id)";
                                    $requete_conv=$connexion->prepare($sql_conv);
                                    $requete_conv->execute();
                                    $conv_result=$requete_conv->fetch();
                                    if(!$conv_result) {
                                        $id_conv="";
                                    }
                                    else {
                                        $id_conv=$conv_result['id_conversation'];
                                    }
                                }
                                $requete=$connexion->prepare($sql_ami);
                                $requete->execute();
                                while ($ami= $requete->fetch()) {
                                    $ami_pseudo=$ami['pseudo'];
                                    $ami_id=$ami['id_ami'];
                                    $sql_conv2= "SELECT * FROM conversations WHERE (utilisateur_1=$utilisateur OR utilisateur_2=$utilisateur) AND (utilisateur_1=$ami_id OR utilisateur_2=$ami_id)";
                                    $requete_conv2=$connexion->prepare($sql_conv2);
                                    $requete_conv2->execute();
                                    $conv_result2=$requete_conv2->fetch();
                                    if(!$conv_result2) {
                                        $id_conv2="";
                                        $last_message="Pas encore de message";
                                    }
                                    else {
                                        $id_conv2=$conv_result2['id_conversation'];
                                        $sql_last_message= "SELECT contenu FROM messages WHERE id_conversation=$id_conv2 ORDER BY time_stamp DESC LIMIT 1";
                                        $requete_last_message=$connexion->prepare($sql_last_message);
                                        $requete_last_message->execute();
                                        $last_message_result=$requete_last_message->fetch();
                                        $last_message=$last_message_result['contenu'];
                                    };
                                ?>
                                <!-- Ici chaque ami à un lien vers une conversation entre lui et l'utilisateur connecté-->
                                <div class="d-grid">
                                    <a class="btn border-2 btn-outline-dark text-light border-light m-0 text-start p-1" href="index.php?ami=<?=$ami_id?>"><?=$ami_pseudo?> 
                                        <p class="text-end p-0"><?=$last_message?></p>
                                    </a>
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
                                <!-- Formulaire d'ajout d'ami -->
                                <form action="index.php" class="d-flex flex-column" method="POST">
                                    <input type="text" class="form-control" name="pseudo_ami" id="pseudo_ami" placeholder="Pseudo ami">
                                    <button type="submit" name="add_friend" class="btn btn-outline-info btn-sm mt-1 justify-self-end m-0">Ajouter</button>
                                </form>
                            </div>
                        </div>
                        <div class="accordion" id="mini-menu">
                            <div class="accordion-item bg-secondary border-4">
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="btn btn-light rounded-0 rounded-start col-4 d-flex align-items-center justify-content-center">
                                                <!-- Lien de déconnexion -->
                                                <a href="./deconnexion.php"><i class="fa-solid fa-person-through-window text-dark fs-4" style="position: relative; top: 3px;"></i></a>
                                            </div>
                                            <div class="btn rounded-0 col-4 btn-light d-flex align-items-center justify-content-center">
                                                <i class="fa-solid text-dark fa-user-ninja fs-4" style="position: relative; top: 1px;"></i>
                                            </div>
                                            <!-- Ici le bouton pour ajouter un ami, déclenche un autre accordéon qui affiche le input de l'id de l'ami à ajouter-->
                                            <div class=" btn rounded-0 rounded-end col-4 btn-light d-flex align-items-center justify-content-center">
                                                <div class="accordion" id="input_ami">
                                                    <div class="accordion-item bg-secondary border-0">
                                                        <h2 class="accordion-header p-0 bg-light border-0" id="headingTwo">
                                                        <button class="bg-light p-0 border-0 rounded-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            <i class="fa-solid text-dark fa-user-plus fs-4" style="position: relative; top: -2px;"></i>
                                                        </button>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="accordion-header" id="headingOne">
                                <button class="btn btn-sm ms-1 bg-light collapsed text-dark m-2 ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
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
                        <div class="col-10 px-1 pt-3 d-flex offset-1 flex-column overflow-auto messages">
                            <!-- Ici de l'ajax pour afficher les messages au fur et à mesure qu'ils sont envoyés -->
                            <?php
                                //Requête pour récupérer tous les messages d'une conversation
                                if(isset($_GET['ami'])) {
                                    $ami_id=$_GET['ami'];
                                    if(empty($id_conv)) {
                                        ?>
                                        <div class="text-center mt-5 pt-5">Vous n'avez pas encore démarré de conversation avec cet utilisateur</div>
                                        <?php
                                    }
                                    else {
                                        $sql_conv= "SELECT * FROM `messages` WHERE id_conversation=$id_conv ORDER BY time_stamp";
                                        $requete_conv=$connexion->prepare($sql_conv);
                                        $requete_conv->execute();
                                            while ($conv=$requete_conv->fetch()) {
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
                                                }
                                    }
                                        }
                                else {
                                    ?>
                                    <div class="text-center mt-5 pt-5">Sélectionnez ou démarrez une conversation pour voir les messages</div>
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="col-10 offset-1 align-self-end">
                            <form action="index.php" method="POST" class="d-flex">
                                <input type="text" class="form-control" name="messageToSend" id="inputMessage" placeholder="Entrez votre message ici">
                                <input type="hidden" name="ami_id" value="<?=$ami_id?>">
                                <?php
                                ?>
                                <input type="hidden" name="conv_id" value="<?=$id_conv?>">
                                <button type="submit" name="SendMessage" class="btn fs-4"><i class="fa-solid fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div><?=$erreur?></div>
        </div>
</body>
</html>