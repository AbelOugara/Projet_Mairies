<?php
    // Démarre ou reprend une session PHP pour conserver les données de l'utilisateur
    session_start();

    // Vérifie si une session utilisateur est active
    if (isset($_SESSION["user"])) {
        // Si l'utilisateur est connecté, affiche les informations stockées dans la variable de session

        // Balise <pre> pour formater l'affichage des données (plus lisible dans le navigateur)
        echo "<pre>";

        // Affiche le contenu de $_SESSION, qui contient les données utilisateur
        var_dump($_SESSION);

        // Ferme la balise <pre> pour terminer le formatage
        echo "</pre>";
    }
?>

<head>
    <link rel="stylesheet" href="css_inscriptionTEST.css"> <!-- Inclusion de la feuille de style pour la page -->
</head>

<body>
    <main>
        <!-- Entrez le nom d'utilisateur -->
        <div class="form"> 
            <input type="text" name="email" class="form_input" placeholder="" required>
            <label for="email" class="form_label">email</label>
        </div>
    </main>
</body>