<?php

require_once 'config.php';

if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_retype'])) { // verifie que les champs exsistes
    
    
    $pseudo = htmlspecialchars($_POST['pseudo']); // htmlspecialchars pour la sécurité
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);

    $check = $bdd->prepare('SELECT pseudo, email, password FROM utilisateur WHERE email = ?'); //verif qu'il est bien inscrit dans la table
        $check -> execute(array($email));
        $data = $check->fetch(); //on stock les données dans data et on cherches les données avec fetch
        $row = $check->rowCount(); //verif si il existe avec rowCount (=1 exsiste sinon exsiste pas)

    if($row == 0) { // si la personne n'est pas dans la base de données alors...

        if(strlen($pseudo) <= 255) {//strlen pour recup la valeur de la chaine de caractères (ici, si le pseudo fait moins de 255 caractères alors...)

            if(strlen($email) <= 255) {

                if(filter_var($email, FILTER_VALIDATE_EMAIL)) { // verif si l'email n'existe pas dans la base

                    if($password == $password_retype) {
                        
                        $password = hash('sha256', $password);
                        $ip = $_SERVER['REMOTE_ADDR']; // on enregistre l'adresse ip

                        $insert = $bdd->prepare('INSERT INTO utilisateur(pseudo, email, password, ip) VALUES(:pseudo, :email, :password, :ip)'); // prepare pour y inserer dans la base ":" preparation du tableau associatif
                        $insert -> execute(array( //tableau associatif
                            'pseudo' => $pseudo,
                            'email' => $email,
                            'password' => $password,
                            'ip' => $ip
                        ));
                        Header ('location:inscription.php?reg_err=success'); // redirection + message de succés 

                    }else {
                        Header ('location:inscription.php?reg_err=password');
                    }
                }else {
                    Header ('location:inscription.php?reg_err=email');
                }
            }else {
                Header ('location:inscription.php?reg_err=email_length');
            }
        }else {
            Header ('location:inscription.php?reg_err=pseudo_length');
        }
    }else {
        Header ('location:inscription.php?reg_err=already');
    }
}