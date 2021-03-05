<?php

session_start();
require 'vue/fonctionvue.php';

function ShowNav() {
    if (isset($_SESSION['id']) AND isset($_SESSION['pseudo'])) {
        echo'
        <nav>
            <ul>
                <li><a class="link_menu "href="index.php?page=index" style="text-decoration:none">Accueil</a></li>
                <li><a class="link_menu "href="index.php?page=profil" style="text-decoration:none">Profil</a></li>
                <li><a class="link_menu "href="index.php?page=deconnexion" style="text-decoration:none">Déconnexion</a></li>
            </ul>
        </nav>';
    } else {
        echo'
        <nav>
            <ul>
                <li><a class="link_menu "href="index.php?page=index" style="text-decoration:none">Accueil</a></li>
                <li><a class="link_menu "href="index.php?page=connexion" style="text-decoration:none">Connexion</a></li>
            </ul>
        </nav>';
    }
}

function ShowSection() {
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        switch ($page) {

            //Barre de navigation
            case "index":
                ShowIndex();
                break;
            case "connexion":
                ShowConnexion();
                break;
            case "deconnexion":
                ShowDeconnexion();
                break;
            case "inscription":
                ShowInscription();
                break;
            case "profil":
                ShowProfil();
                break;


            //Profil de l'utilisateur
            case "modifier-mdp":
                ShowModifierMdp();
                break;
            case "modifier-email":
                ShowModifierEmail();
                break;
        }
    } else {
        //Montre tout simplement la page d'accueil
        echo '
        <div id="Bloc-texte">
        <p>Bienvenue sur le site !</p>
        </div>';
    }
}
