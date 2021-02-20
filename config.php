<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=utilisateurs;charset=utf8', 'root', '');
    echo 'Vous êtes bien connécté à la base';
}catch(Exception $e) {
    die('ERREUR' . $e->getMessage());
}