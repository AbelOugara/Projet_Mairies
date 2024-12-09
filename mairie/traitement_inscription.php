<?php
    session_start();

    include_once("BDD_connexion.php"); // connexion à la base de données

    // Initialisation d'un tableau pour stocker les messages d'erreur
    $errors = [];

    // Vérification que le bouton "S'inscrire" a été cliqué
    if (isset($_POST["ok"])) {
        // Récupération et sécurisation des données du formulaire
        // Utilisation de htmlspecialchars() pour éviter les attaques XSS
        $username = htmlspecialchars($_POST['username']);
        $mail = htmlspecialchars($_POST['mail']);
        $password = htmlspecialchars($_POST['password']);
        // 
        // Note : htmlspecialchars() ne protège pas contre les attaques SQL. 
        // Cela est géré par les requêtes préparées ci-dessous.
        //
       
    }

    //----------------------------------- Vérification de l'adresse email -----------------------------------
    // Validation du format de l'adresse email
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Ce n'est pas une adresse email valide.";
    }

    // Vérification de l'existence de l'adresse email dans la base de données
    // Requête préparée pour éviter les attaques par injection SQL
    $checkEmail = $bdd->prepare("SELECT * FROM utilisateur WHERE email = :mail");
    $checkEmail->execute(["mail" => $mail]);

    // Vérification si l'email existe déjà
    if ($checkEmail->rowCount() > 0) {
        $errors[] = "Cet email est déjà utilisé.";
    }

    //----------------------------------- Hachage du mot de passe -----------------------------------

    //La fonction empty() retourne true si le tableau est vide.
    //Donc, la condition if (empty($errors)) signifie "si aucune erreur n'a été détectée".
    if (empty($errors)) {

        // Hachage sécurisé du mot de passe avec l'algorithme Argon2i
        // Cela permet de protéger les mots de passe même si la base de données est compromise
        $password = password_hash($password, PASSWORD_ARGON2I);

        //----------------------------------- Insertion des données dans la base -----------------------------------
        // Préparation de la requête SQL pour insérer un nouvel utilisateur dans la table "utilisateur"
        $requete = $bdd->prepare("
            INSERT INTO `utilisateur` (`idUser`, `pseudo`, `password`, `email`, `image`) 
            VALUES (NULL, :username, :password, :mail, NULL)
        "); 
        // Note : j'aurais pu utilisé la variable $password au lieu de ':password' pour plus de sécurité mais comme le mdp est haché ce n'est pas trop un probleme

        // Exécution de la requête avec des paramètres sécurisés
        $requete->execute([
            "username" => $username,  // Pseudo de l'utilisateur
            "password" => $password, // Mot de passe haché
            "mail" => $mail          // Adresse email de l'utilisateur
        ]);

        // Confirmation que l'inscription a réussi
        //echo "Inscription réussie !";

        //----------------------------------- Gestion de la session utilisateur -----------------------------------
        // Récupération de l'ID du nouvel utilisateur
        // La méthode lastInsertId() retourne l'ID généré pour la dernière insertion
        $id = $bdd->lastInsertId();

        // Stockage des informations utilisateur dans la session
        // Cela permet de maintenir l'utilisateur connecté après son inscription
        $_SESSION["user"] = [
            "id" => $id,           // ID unique de l'utilisateur
            "username" => $username, // Pseudo
            "mail" => $mail        // Adresse email
            // Note : Il est déconseillé de stocker le mot de passe dans la session, même haché
        ];

        //----------------------------------- Redirection vers la page d'accueil -----------------------------------
        // Une fois l'inscription terminée, redirection vers la page d'accueil
        header("Location: index.php");
        exit(); // On s'assure que le script s'arrête après la redirection
    }else {
        // Stockage des erreurs dans la session
        $_SESSION['errors'] = $errors;
        header("Location: inscription.php");
        exit();
    }
?>