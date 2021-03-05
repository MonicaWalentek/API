<?php

if (isset($_POST['formulaire'])) {
        $email = htmlspecialchars($_POST['email']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $pass_hache = htmlspecialchars(password_hash($_POST['motdepasse'], PASSWORD_DEFAULT));
        $motdepasse = htmlspecialchars($_POST['motdepasse']);
        $motdepasse2 = htmlspecialchars($_POST['motdepasse2']);
        $pseudolength = strlen($pseudo);

        if (!empty($email) AND (!empty($pseudo)) AND (!empty($motdepasse)) AND (!empty($motdepasse2))) {
            if ($pseudolength <= 15) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if ($motdepasse == $motdepasse2) {
                        $json='http://localhost/ex_api/API/lireUtilisateur.php?pseudo='.$pseudo.'';
                        $resultat1 = json_decode(file_get_contents($json));
                        $json='http://localhost/ex_api/API/lireUtilisateur.php?email='.$email.'';
                        $resultat2 = json_decode(file_get_contents($json));
                        //On appelle la bdd, on vérifie si il existe un pseudo ou un email dans la bdd
                    if ((strlen($resultat1->pseudo)>0) || (strlen($resultat2->email)>0)) {
                        
                            //$erreur = "Votre pseudo existe déjà ou votre e-mail a déjà été utilisé.";
                    header('location:index.php?page=inscription&erreur=1');}
                    else{
                        //on insère
                        $data = array('email'=>$email, 'pseudo'=>$pseudo, 'motdepasse'=>$pass_hache);
         
                        $option = array(
                            'http' => array(
                                'method' => 'POST',
                                'header' => "Content-Type: application/json",
                                'ignore_errors'=> true,
                                'timeout' => 10,
                                'content' => json_encode($data),
                            ),
                        );
                        $context = stream_context_create($option);
                        file_get_contents('http://localhost/ex_api/API/insererUtilisateur.php', false, $context);
                        
                        //On récupère ensuite l'id de l'utilisateur
                        
                        $json='http://localhost/ex_api/API/lireUtilisateur.php?pseudo='.$pseudo.'';
                        $resultat1 = json_decode(file_get_contents($json));
                        
                        $_SESSION['id'] = $resultat1->id;
                        $_SESSION['pseudo'] = $resultat1->pseudo;
                        header('location:index.php?page=inscription&erreur=2');
                        //$erreur = "Votre compte a bien été crée. Pas de mail avec vos identifiants pour le moment alors conservez bien vos identifiants !"
                    }
                } 
                else {
                        header('location:index.php?page=inscription&erreur=3');
                        //$erreur = "Vos mots de passe sont différents.";
                    }
            } 
            else {
                    header('location:index.php?page=inscription&erreur=4');
                    //$erreur = "Votre adresse e-mail n'est pas valide.";
            }
            } else {
                header('location:index.php?page=inscription&erreur=5');
                //$erreur = "Votre pseudo ne doit pas dépasser 15 caractères.";
            }
        } else {
            header('location:index.php?page=inscription&erreur=6');
            //$erreur = "Tous les champs doivent être complétés.";
        }
}
    
?>


        <div id="Bloc-texte">
        <p>Créer un compte</p>
        </div>
        <p>
        <form method="post" action="">
        <table>
        <tr>
          <td>
            <label for ="pseudo"> Pseudo (15 caractères max.) :</label>
          </td>
          <td>
            <input type="text" id ="pseudo" name="pseudo"/> 
        </tr>
        <tr>
          <td>
            <label for ="motdepasse">Mot de passe :</label>
          </td>
          <td>
            <input type="password" id="motdepasse" name="motdepasse"/>
          </td>
        </tr>
        <tr>
          <td>
            <label for ="motdepasse2">Confirmation du mot de passe :</label>
          </td>
          <td>
            <input type="password" id="motdepasse2" name="motdepasse2"/>
          </td>
        </tr>
        <tr>
          <td>
            <label for ="email">Adresse e-mail :</label>
          </td>
          <td>
            <input type="email" id="email" name="email" value="<?php
    if (isset($email)) {
        echo $email;
    } ?>
   "/>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" name="formulaire" value="Créer mon compte"/>
          </td>
        </tr>
        </table>
        </form>
<?php
if (isset($_GET['erreur'])) {
        $message = htmlspecialchars($_GET['erreur']);
        switch ($message) {
            
            case "1":
                echo 'Votre pseudo existe déjà ou votre e-mail a déjà été utilisé.'; 
                break;
            case "2":
                echo'Votre compte a bien été crée. Pas de mail avec vos identifiants pour le moment alors conservez bien vos identifiants !';
                break;
            case "3":
                echo'Vos mots de passe sont différents.';
                break;
            case "4":
                echo'Votre adresse e-mail n\'est pas valide.';
                break;
            case "5":
                echo'Votre pseudo ne doit pas dépasser 15 caractères.';
                break;
            case "6":
                echo'Tous les champs doivent être complétés.';
                break;
        }
}
?>