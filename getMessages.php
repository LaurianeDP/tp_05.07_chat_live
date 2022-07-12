<?php
    require_once "./connect.php";
    $utilisateur=$_SESSION['util_connect'];
    
    //Requête pour récupérer tous les messages d'une conversation
    
    if(isset($_GET['ami'])) {
        $ami_id= $_GET['ami'];
        $id_conv=$_GET['conv'];

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