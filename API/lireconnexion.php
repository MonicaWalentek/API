<?php
require 'bddconnect.php';
//GET

if (isset($_GET['pseudo'])&& isset($_GET['motdepasse'])){
    
    $pseudo=$_GET['pseudo'];
    $motdepasse=$_GET['motdepasse'];
    
        $bdd = dbbConnect();
        $req = $bdd->prepare('SELECT id, motdepasse FROM utilisateurs WHERE pseudo = :pseudo');
        $req->execute(array(
            'pseudo' => $pseudo));
        $resultat = $req->fetch();
        $id = $resultat['id'];

        $isPasswordCorrect = password_verify($motdepasse, $resultat['motdepasse']);

        if (!$resultat) {
            //On modifie le code à partir de là
            //Il faut renvoyer du json soit avec connexion : mauvais identifiant, soit connexion : reussie
            $array =array('connexion'=>'False');
            $connexion = json_encode($array);
            echo $connexion;
        } 
        else {
            if ($isPasswordCorrect) {
                $array =array('id'=>$id,'connexion'=>'True');
                $connexion = json_encode($array);
                echo $connexion;
                        
                //session_start();
                //$_SESSION['id'] = $resultat['id'];
                //$_SESSION['pseudo'] = $pseudo;
                //header('location:../index.php?page=index');
            } else {
            $array =array('connexion'=>'False');
            $connexion = json_encode($array);
            echo $connexion;
            }
        }
}
    ?>
