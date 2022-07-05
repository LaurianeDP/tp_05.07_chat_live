<?php
    include_once "connect.php";
    include_once "header_html.php";

    if(!isset($_SESSION["utilisateur"])) //Si l'utilisateur n'est pas connecté, renvoit à la page de connexion
    {
        header('Location: ./connexion.php');
    }
?>

<body>
    <h1>Modifie quelque chose</h1>
    <p>Une modification lauriane aussi</p>
    <p>Une modification ici aussi</p>
</body>
</html>