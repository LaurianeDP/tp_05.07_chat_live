<?php
    require_once "./connect.php";
    $utilisateur=$_SESSION['util_connect'];

    //Code pour l'envoi d'un message
    if(!empty($_POST['messageToSend'])) {
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
    }
    $statut=array("resultat" => "true", "conv_id" => $id_conv);
    echo json_encode($statut);
    ?>