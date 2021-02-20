<?php

    session_start();
    require_once 'config.php';

    if(isset($_POST['email']) && isset($_POST['password'])) { //verif si les champs existe

        $email = htmlspecialchars($_POST['email']); // htmlspecialchars est une sécurité 
        $password = htmlspecialchars($_POST['password']);

        $check = $bdd->prepare('SELECT pseudo, email, password FROM utilisateur WHERE email = ?'); //verif qu'il est bien inscrit dans la table
        $check -> execute(array($email));

        $data = $check->fetch(); //on stock les données dans data et on cherches les données avec fetch
        $row = $check->rowCount(); //verif si il existe avec rowCount (=1 exsiste sinon exsiste pas)

        if($row === 1){ // si la personne existe alors...

            if(filter_var($email, FILTER_VALIDATE_EMAIL)) { // regarde si l'email est valide

                $password = hash('sha256', $password); // on hash le mdp pour la sécurité
                if($data['password'] == $password) { //on verif si c'est le bon mdp
                    

                    $_SESSION['user'] = $data['pseudo']; //connexion à la session et redirection vers landing
                    Header ('location:landing.php');


                }else {
                    Header ('location:index.php?login_err=password'); // renvoi à l'index avec une erreur de connexion dans l'url
                }
            }else {
                Header ('location:index.php?login_err=email');
            }
        }else {
            Header ('location:index.php?login_err=already');
        }
    }else {
        Header ('location:index.php');
    }