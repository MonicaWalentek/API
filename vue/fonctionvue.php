<?php
require "modele/Bdd.php";


// A modifier une fois l'api créé
function ShowIndex() {
    echo'
       <div id="Bloc-texte">
        <p>Bienvenue sur le site ! </br>
        En ce moment, il fait température °C à ville. </br>
        Le graphique du jour, le graphique de la semaine, le graphique du mois.</p>
            <p><a href="API/lireUtilisateur.php">Test du code api</a></p>
        </div>
        ';
 
}
    
function ShowConnexion() {
require 'connexion.php';
}

function ShowDeconnexion() {
    $_SESSION = array();
    session_destroy();
    echo'<div id="Bloc-texte">
        <p>Déconnexion</p>
        </div>
        <p> Vous avez été déconnecté(e) ! Vous allez être rediriger vers la page d\'accueil d\'ici 5 secondes ! </br></br>
        </p>
        ';
    header("Refresh: 5;URL=index.php");
}

function ShowInscription() {
    require 'inscription.php';
}

function ShowProfil() {
    require 'profil.php';
}

function ShowModifierMdp() {
    require 'modifiermdp.php';
}

function ShowModifierEmail() {
    require'modifieremail.php';
}
