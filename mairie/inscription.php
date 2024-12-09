<?php
    session_start();
    // permet que si l'utilisateur va dans inscription.php dans l'url alors qu'il est connecté, de l'envoyé à l'acueil
    if(isset($_SESSION["user"])){
        header("Location: index.php");
        exit;
    }

    include_once("head.php"); // c'est les métadonnées du document
    include_once("header.php"); // c'est la barre de navigation

    // Récupération des erreurs
    $errors = $_SESSION["errors"] ?? []; // Récupérer les erreurs depuis la session
    unset($_SESSION["errors"]); // Nettoyer les erreurs après affichage
?>
<head>
        <link rel="stylesheet" href="css_inscription.css"> <!-- Inclusion de la feuille de style pour la page -->
</head>

<body>
    <main>
        <div class="formulaire">
            <h4>Inscription</h4>
            <hr>

            <form method="POST" action="traitement_inscription.php"><!-- 
                Utilisation de la méthode POST : 
                Les données seront envoyées de manière sécurisée (non visibles dans l'URL).
                L'action redirige vers 'traitement.php' pour gérer les données du formulaire.
                -->

                <!-- Entrez le nom d'utilisateur -->
                <div class="champ">
                    <img src="image/user.png" alt="user-icon" width="20" >
                    <input type="text" name="username" placeholder="username" required>
                </div>
                <!-- 'required' : Rend le champ obligatoire pour la validation du formulaire. -->
                
                <!-- Entrez le mail -->
                <div class="champ">
                    <img src="image/mail-icon.webp" alt="mail-icon" width="20" >
                    <input type="mail" name="mail" placeholder="mail" required>
                </div> 
                <!-- 'pattern' : Vérifie que le format de l'email est correct. pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$", CA NE MARCHE PAS -->

                <!-- Entrez le mot de passe -->
                <div class="champ">
                    <img src="image/password-icon.png" alt="password-icon" width="20" >
                    <input type="password" name="password" placeholder="password" required>
                </div> 
                <!-- 'type="password"' : Cache le texte saisi par l'utilisateur. -->


                <?php 
                    // Vérification si le tableau $errors contient des erreurs
                    // La fonction empty() retourne true si le tableau est vide.
                    // Ici, on vérifie donc si $errors n'est pas vide.
                    if (!empty($errors)) { 
                        // Si des erreurs existent, on commence par ouvrir une <div> avec une classe CSS "error".
                        // Cela permet de styliser cette section (par exemple, pour afficher le texte en rouge dans le CSS).
                        echo '<div class="error">';

                        // Parcourir toutes les erreurs contenues dans le tableau $errors
                        // La boucle foreach permet de récupérer chaque message d'erreur du tableau.
                        foreach ($errors as $error) {
                            // Chaque erreur est affichée dans une balise <p> (paragraphe HTML).
                            // Cela rend chaque message d'erreur visible sur une nouvelle ligne.
                            echo '<img src="image/attention.png" alt="Erreur">'; //l'icône avant le message
                            echo "<p>$error</p>";
                        }

                        // On ferme la <div> après avoir affiché toutes les erreurs.
                        echo '</div>';
                    }
                ?>


                <!-- Bouton pour soumettre le formulaire -->
                <div class="champ_envoi">
                <button type="submit" name="ok">
                    <img src="image/sent-icon.png" alt="Envoyer" width="20">
                    S'inscrire
                </button>
                </div>

            </form>

        </div>
    </main>
</body>

<?php
    include_once("footer.php"); // c'est ma barre tout en bas de ma page
?>