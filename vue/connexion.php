<?php
    if (isset($_POST['pseudo'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $motdepasse = htmlspecialchars($_POST['motdepasse']);
        if(!empty($pseudo)AND !empty($motdepasse)){
            $json='http://localhost/ex_api/API/lireconnexion.php?pseudo='.$pseudo.'&motdepasse='.$motdepasse.'';
         $resultat = json_decode(file_get_contents($json));
         if ($resultat->connexion == "True"){
             session_start();
             $_SESSION['id'] = $resultat->id;
             $_SESSION['pseudo'] = $pseudo;
             header('location:/ex_api/');
        }
        elseif($resultat->connexion =="False") {
            $reponse="Il faut remplir les deux champs !";
        }
        else{
            echo 'oh !';
        }
        
        // Après, on reçoit si oui ou non la connexion et ok on fait un id, on start une session
        
    }
    }
?>


        <div id="Bloc-texte">
        <p>Connexion</p>
        </div>
 
        <form method="post" action="">
        <p> 
        Pseudo :
        <input type="text" name="pseudo"/> </br>
        Mot de passe :
        <input type="password" name="motdepasse"/></br>
        <input type="submit"   value="Se connecter"/></br>
        Vous n'avez pas de compte ? <a class="link_menu " href="index.php?page=inscription" style="text-decoration:none">Créer un compte</a>
        </p>
        </form>
        
    <?php

    //Message d'erreur :
    if (isset($erreur)) {
        echo $erreur;
    }
    
   if (isset($reponse)) {
        echo $reponse;
}
?>