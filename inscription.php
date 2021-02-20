<?php

include 'config.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

        if(isset($_GET['reg_err'])) {
            $err = htmlspecialchars($_GET['reg_err']); // reccupère les erreurs mis dans le Header, dans le if, dans inscription_traitement.php

            switch($err) { //le switch permet d'afficher les erreurs une par une 
                case 'success' : 
                    echo "Inscription réussi";
                    break;

                case 'password' :
                    echo "Le mot de passe ne peux pas être différent";
                    break;

                case 'email' :
                    echo "eMail non valide";
                    break;

                case 'email_length' :
                    echo "eMail trop long";
                    break;

                case 'pseudo_length' :
                    echo "Pseudo trop long";
                    break;

                case 'already' :
                    echo "Ce compte existe déja";
                    break;
            }
        }

    ?>

    <div id="main">
        <h3>Inscrivez vous :</h3>

        <form action="inscription_traitement.php" method="POST">
            <input class="inp" type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo">
            <input class="inp" type="email" name="email" id="email" placeholder="Votre eMail">
            <input class="inp" type="password" name="password" id="password" placeholder="Votre mot de passe">
            <input class="inp" type="password" name="password_retype" id="password_retype" placeholder="Encore le mot de passe">
            <input class="submit" type="submit" value="Inscription">
        </form>

        <a href="index.php">Retour</a>
    </div>


</body>
</html>