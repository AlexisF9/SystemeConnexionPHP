<?php

include 'config.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php

        if(isset($_GET['login_err'])) {
            $err = htmlspecialchars($_GET['login_err']); // reccupère les erreurs mis dans le Header, dans le if, dans connexion.php

            switch($err) { //le switch permet d'afficher les erreurs une par une 
                case 'password' : 
                    echo "Mot de passe incorrect";
                    break;

                case 'email' :
                    echo "eMail incorrect";
                    break;

                case 'aleady' :
                    echo "Le compte n'exsiste pas";
                    break;
            }
        }

    ?>
    
    <div id="main">
        <h1>Système de connexion en PHP</h1>
        <h3>Connectez vous :</h3>
        
        <form action="connexion.php" method="POST">
            <input class="inp" type="email" name="email" id="email" placeholder="Votre eMail">
            <input class="inp" type="password" name="password" id="password" placeholder="Votre mot de passe">
            <input class="submit" type="submit" value="Connexion">
        </form>

        <a href="inscription.php">Pas encore inscrit ?</a>
    </div>

</body>
</html>