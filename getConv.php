<?php
    require_once "./connect.php";
    $utilisateur=$_SESSION['util_connect'];
    $ami_id= $_GET['ami'];

    // Du PHP pour afficher la liste d'amis et ajouter les conversation liées si nécessaire
    $sql_conv= "SELECT * FROM conversations WHERE (utilisateur_1=:utilisateur OR utilisateur_2=:utilisateur) AND (utilisateur_1=:ami_id OR utilisateur_2=:ami_id)";
    $requete_conv=$connexion->prepare($sql_conv);
    $requete_conv->execute(array(
        ':utilisateur' => $utilisateur,
        ':ami_id'=>$ami_id
    ));
    $conv_result=$requete_conv->fetch();
    if(!$conv_result) {
        $id_conv="";
    }
    else {
        $id_conv=$conv_result['id_conversation'];
    }
    $statut=array("resultat" => "true", "conv_id" => $id_conv);
    echo json_encode($statut);
?>