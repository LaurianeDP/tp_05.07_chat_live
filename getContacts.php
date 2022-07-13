<?php

require_once "./connect.php";

$utilisateur=$_SESSION['util_connect'];
$ami_id= $_GET['ami'];
$id_conv=$_GET['conv'];

    //SQL sélection liste d'amis
    $sql_ami="SELECT contact_lists.id_user1, contact_lists.id_user2, if(contact_lists.id_user1=$utilisateur, contact_lists.id_user2, contact_lists.id_user1) AS 'amis_$utilisateur', utilisateurs.pseudo, utilisateurs.id_user AS 'id_ami' FROM `contact_lists`, utilisateurs WHERE contact_lists.id_user1=$utilisateur OR contact_lists.id_user2=$utilisateur HAVING utilisateurs.id_user=amis_$utilisateur ORDER BY utilisateurs.pseudo;";
    
    $requete=$connexion->prepare($sql_ami);
    $requete->execute();
    while ($ami= $requete->fetch()) {
        $ami_pseudo=$ami['pseudo'];
        $ami_id=$ami['id_ami'];
        $sql_conv2= "SELECT * FROM conversations WHERE (utilisateur_1=:utilisateur OR utilisateur_2=:utilisateur) AND (utilisateur_1=:ami_id OR utilisateur_2=:ami_id)";
        $requete_conv2=$connexion->prepare($sql_conv2);
        $requete_conv2->execute(array(
            ':utilisateur' => $utilisateur,
            ':ami_id'=>$ami_id
    ));
        $conv_result2=$requete_conv2->fetch();
        if(!$conv_result2) {
            $id_conv2="";
            $last_message="Pas encore de message";
        }
        else {
            $id_conv2=$conv_result2['id_conversation'];
            $sql_last_message= "SELECT contenu FROM messages WHERE id_conversation=:id_conv2 ORDER BY time_stamp DESC LIMIT 1";
            $requete_last_message=$connexion->prepare($sql_last_message);
            $requete_last_message->execute(array(':id_conv2' => $id_conv2));
            $last_message_result=$requete_last_message->fetch();
            $last_message=$last_message_result['contenu'];
        };
    //Ici chaque ami à un lien vers une conversation entre lui et l'utilisateur connecté
    ?>
    <div class="d-grid">
        <a class="btn border-2 btn-outline-dark text-light border-light m-0 text-start p-1 ami-btn" href="index.php?ami=<?=$ami_id?>"><?=$ami_pseudo?> 
            <p class="text-end ps-4 lastMess"><?=$last_message?></p>
        </a>
    </div>
    <HR>
<?php
};
?>