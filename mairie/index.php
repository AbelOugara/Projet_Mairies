<?php
session_start();

// include_once() permet d'éviter que le fichier soit inclus plusieurs fois, (évite les conflits si ce fichier est inclus plusieurs fois.).
    include_once("head.php"); // c'est les métadonnées du document
    include_once("header.php"); // c'est la barre de navigation
?>

<head>
        <link rel="stylesheet" href="css_index.css">
</head>
<body>
    <main>
        

        <section>

            <?php if(isset($_SESSION["user"])): ?>
            <h1> Bienvenue <span style="color: darkblue"> <?php echo $_SESSION["user"]["mail"] ?> </span> </h2>
            <?php else: ?>
                <h1>Bienvenue chez DevisseInformatique !  </h1>
            <?php endif; ?>
            
            <p>Cet outil vous permettra d'accéder à toutes les informations concernant vos <strong>contacts</strong> en temps 
            réel.</p>
        </section>

        <section>
            <h3>- Comment faire ?</h3>
            <p>C'est très simple, veuillez d'abord vous <strong>connecter</strong> (cliquer en haut à droite), pour ensuite accéder 
            à vos <strong>contacts</strong> (au milieu en haut de la barre de navigation).</p>
            <p>Vous pourrez alors rechercher vos mairies et connaître toutes les informations les concernant.</p>
        </section>
    </main>
</body>

<?php
    include_once("footer.php"); // c'est ma barre tout en bas de ma page
?>