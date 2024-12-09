<?php
    session_start();

    // permet que si l'utilisateur va dans deconnexion.php dans l'url alors qu'il n'est pas connecté, de l'envoyé à l'acueil
    if(!isset($_SESSION["user"])){ 
        header("Location: connexion.php");
        exit;
    }

    //supprime une variable
    unset($_SESSION["user"]); // on supprime que la session user au lieu d'utiliser destroy car supprime toutttt
    
    header("Location: index.php");
?>