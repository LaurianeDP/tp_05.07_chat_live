<?php
    include_once "connect.php";
    include_once "header_html.php";

    $ami_id="";
    $id_conv="";
    $erreur="";

    if(!isset) //Si l'utilisateur n'est pas connecté, renvoit à la page de connexion
    {
        header('Location: ./connexion.php');
    }
    $utilisateur=$_SESSION['util_connect'];


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
                            <!-- Ajax pour afficher la liste d'amis -->
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
                                                <a href="./profil.php"><i class="fa-solid text-dark fa-user-ninja fs-4" style="position: relative; top: 1px;"></i></a>
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
                            
                        </div>
                        <div class="col-10 offset-1 align-self-end">
                            <div class="d-flex">
                                <?php
                                    if(isset($_GET['ami'])) {
                                        $ami_id=$_GET['ami'];
                                    }
                                    else {
                                        $ami_id="";
                                    }
                                ?>
                                <input type="text" class="form-control" name="messageToSend" id="messageToSend" placeholder="Entrez votre message ici">
                                <input type="hidden" name="ami_id" id="ami_id" value="<?=$ami_id?>">
                                <input type="hidden" name="conv_id" id="conv_id" value="<?=$id_conv?>">
                                <button name="SendMessage" id="sendMessage" class="btn fs-4"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div><?=$erreur?></div>
        </div>
        <script>
            refreshContacts();
            //Ajout du message en dynamique
            document.querySelector('#sendMessage').addEventListener('click', addMessage);
            document.addEventListener('keypress', (e) => {
                if(e.key === 'Enter' && document.querySelector('#messageToSend').value != "") {
                    addMessage();
                    document.querySelector('#messageToSend').value = "";
                }
            });

            function addMessage() {
                const formData = new FormData();
                
                formData.append('messageToSend', document.querySelector('#messageToSend').value);
                formData.append('conv_id', document.querySelector('#conv_id').value);
                formData.append('ami_id', document.querySelector('#ami_id').value);

                const options = {
                    method: 'POST',
                    body: formData
                }

                fetch('ajoutMessage.php', options)
                .then(response => response.json())
                .then(data => {
                    document.querySelector('#conv_id').value=data.conv_id;
                });
                refreshConv();
                refreshContacts();
            } //Fin fonction addMessage
            
            // Interval pour la MaJ de l'id conv
            setInterval(() => {
                refreshConv();
            }, 200);

            //Interval pour l'affichage de la liste de contact
            setInterval(() => {
                refreshContacts();
            }, 5000);

            //Interval pour l'affichage des messages
            setInterval(() => {
                let ami_id=document.querySelector('#ami_id').value;
                let conv_id=document.querySelector('#conv_id').value;
                fetch(`getMessages.php?ami=${ami_id}&conv=${conv_id}`)
                    .then(response => response.text())
                    .then(html => {
                        document.querySelector('.messages').innerHTML = html;
                    });
                }, 1000);
                
                console.log(document.querySelector('.messages').hasChildNodes());

            //Fonction de rafraîchissement de l'affichage de la liste de contact, en dehors de interval pour être intégrée à l'event de l'ajout de message
            function refreshContacts() {
                let ami_id=document.querySelector('#ami_id').value;
                let conv_id=document.querySelector('#conv_id').value;
                fetch(`getContacts.php?ami=${ami_id}&conv=${conv_id}`)
                    .then(response => response.text())
                    .then(html => {
                        document.querySelector('.amis').innerHTML = html;
                    })
            }

            //Fonction de rafraîchissement de l'id de conversation, en dehors de interval pour être intégrée à l'event de l'ajout de message
            function refreshConv() {
                let ami_id=document.querySelector('#ami_id').value;
                fetch(`getConv.php?ami=${ami_id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector('#conv_id').value=data.conv_id;
                    })
            }
        </script>
</body>
</html>