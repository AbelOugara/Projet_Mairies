<?php
    // Démarre une nouvelle session ou reprend une session existante
    session_start();

    // permet que si l'utilisateur va dans connexion.php dans l'url alors qu'il est connecté, de l'envoyé à l'acueil
    // Vérifie si l'utilisateur est déjà connecté
    // Si c'est le cas, on le redirige vers la page d'accueil
    if(isset($_SESSION["user"])){
        header("Location: index.php");
        exit;
    }

    include_once("head.php"); // c'est les métadonnées du document
    include_once("header.php"); // c'est la barre de navigation
?>
<head>
        <link rel="stylesheet" href="#.css"> <!-- Inclusion de la feuille de style pour la page -->
</head>

<?php

    // Vérification que le formulaire à bien été envoyé
    if (!empty($_POST)) {
        //le formulaire à bien été envoyé
        if (isset($_POST["mail"], $_POST["password"]))
        {
            /*$mail = htmlspecialchars($_POST['mail']);
            $password = htmlspecialchars($_POST['password']);*/ /* pas besoin car on n'utilise pas ces variables */

            // Vérifie que ça correspond bien à un mail
            if(!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)){
                die("l'adresse email est incorrect");
            }

            include_once("BDD_connexion.php"); // connexion à la base de données

            // Préparation de la requête SQL pour récupérer les informations de l'utilisateur via son email
            $sql = "SELECT * FROM `utilisateur` WHERE `email` = :mail";

            $query = $bdd->prepare($sql);

            $query->bindValue(":mail", $_POST["mail"], PDO::PARAM_STR);

            $query->execute();

            // Récupère les données de l'utilisateur
            $user = $query->fetch();

            // vérifie que l'utilisateur existe
            if(!$user){
                die("L'utilisateur et/ou le mot de passe n'existe pas");
            }

            // Donc si on est ici, c'est que l'utilisateur existe

            // fonction qui vérifie si le mot de passe hashé correspond à l'utilisateur
            if(!password_verify($_POST["password"], $user["password"])){
                die("L'utilisateur et/ou le mot de passe n'existe pas");
            }

            // Donc si on est ici c'est que l'utilisateur et le mdp sont correcte
            // on va pouvoir 'connecter' l'utilisateur

            // '$_SESSION' super global qui n'existe que si on a écrit session_start();

            // On stocke dans $_SESSION les informations de l'utilisateur
            $_SESSION["user"] = [
                "id" => $user["idUser"], // récupère l'id de l'utilisateur DANS LA BASE DE DONNEE
                "username" => $user["pseudo"], // récupère le pseudo de l'utilisateur DANS LA BASE DE DONNEE
                "mail" => $user["email"], // récupère le mail de l'utilisateur DANS LA BASE DE DONNEE
                //"password" => $user["password"] déconseillé // récupère le mot de passe de l'utilisateur DANS LA BASE DE DONNEE
            ];

            // affiche les informations de l'utilisateur
            //var_dump($_SESSION);//

            // On redire vers l'aacuiel
            header("Location: index.php");
        }
    }

?>

<body>
    <main>
        <h4>Connexion</h4>
        <form method="POST" action=""><!-- cette fois ci je fais mon php connexion dans la même page au lieu de le faire dans 'traitement_connexion.php'
            Utilisation de la méthode POST : 
            Les données seront envoyées de manière sécurisée (non visibles dans l'URL).
            -->            

            <!-- Entrez le mail -->
            <input type="mail" name="mail" placeholder="mail" required>
            <!--'required' : Rend le champ obligatoire pour la validation du formulaire. --> 

            <!-- Entrez le mot de passe -->
            <input type="password" name="password" placeholder="password" required> <!-- 
            'type="password"' : Cache le texte saisi par l'utilisateur. -->

            <!-- Bouton pour soumettre le formulaire -->
            <input type="submit" name="ok" value="Se connecter">

            <!-- Bouton pour s'inscrire -->
            <a href="inscription.php" >S'inscrire ?</a>
        </form>
    </main>
</body>

<?php
    include_once("footer.php"); // c'est ma barre tout en bas de ma page
?>