<?php
require 'bddconnect.php';
// Dans l'url qui sera appelé, on va récupérer le pseudo de l'utilisateur

if (isset($_GET['pseudo'])){

    $pseudo=$_GET['pseudo'];
    $bdd = dbbConnect();
    $profil = $bdd->prepare('SELECT id, pseudo, date_creation, email FROM utilisateurs WHERE pseudo = ?');
    $profil->execute(array($pseudo));
    while($resultat = $profil->fetch()){
        echo json_encode($resultat);
    }
}

if(isset($_GET['email'])){
    $email = $_GET['email'];
    $bdd = dbbConnect();
    $profil = $bdd->prepare('SELECT id, pseudo, date_creation, email FROM utilisateurs WHERE email = ?');
    $profil->execute(array($email));
    while($resultat = $profil->fetch()){
        echo json_encode($resultat);
    }
}

// Les données reçus doivent être mis sous forme json.
    