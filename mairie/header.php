<!--<!DOCTYPE html>
<html lang="fr">-->

    <head>
        <link rel="stylesheet" href="css_header.css">
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li> <a href="index.php"> <img src="image/DevisseInfo.png" alt="logo" width="150" > </a></li>
                    <li> <a href="contacts.php">CONTACTS</a> </li>
                    <?php
                        if(!isset($_SESSION["user"])):
                    ?>
                    <li> <a href="connexion.php"> <img src="image/icone-utilisateur-bleu.png" alt="user" width="35" >CONNEXION</a> </li>
                    <?php else: ?>
                    <li> <a href="deconnexion.php"> <img src="image/icone-utilisateur.png" alt="user" width="35" >DECONNEXION</a> </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
    </body>
<!--</html>
je crois qu'on peut faire sans -->