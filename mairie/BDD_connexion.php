<?php
    // **Connexion au serveur et à la base de données**
    // Déclaration des variables de connexion :
    // - '$servername' : Nom de l'hôte (serveur). Ici 'localhost' car on travaille en local.
    //   Si la base de données est hébergée sur un serveur distant, on devra mettre l'adresse IP ou le nom de domaine.
    // - '$username' : Nom d'utilisateur pour se connecter à la base de données.
    //   Par défaut, 'root' est l'utilisateur principal pour un environnement local.
    // - '$password' : Mot de passe associé à l'utilisateur.
    //   Sur Mac, c'est généralement 'root', alors que sur Windows, il est souvent vide ('') sauf configuration particulière.
    $servername = "localhost";
    $db_username = "root";
    $db_password = "root";

    // **Bloc Try-Catch pour gérer la connexion à la base de données**
    try {
        // Création d'une instance de connexion à la base de données avec PDO :
        // - 'mysql:host=$servername;dbname=maires_db' : chaîne de connexion qui définit le type de base (MySQL),
        //   le serveur hôte, et le nom de la base de données (ici 'maires_db').
        //   Note : Surtout faire attention à ce qu'il n'y ait pas d'erreur de syntaxe!
        $dbname = "mairies_db";
        $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);

        // Configuration du mode d'erreur de PDO :
        // - PDO::ATTR_ERRMODE : Définit comment les erreurs seront signalées.
        // - PDO::ERRMODE_EXCEPTION : Lance une exception en cas d'erreur (meilleur pour le débogage).
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Message à afficher en cas de succès
        echo "Connexion réussie à la base de données.";
    } 
    catch (PDOException $e) { // Capture les erreurs de connexion via une exception PDO
        // Affiche un message d'erreur suivi du détail technique de l'erreur (via $e->getMessage()).
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
?>
