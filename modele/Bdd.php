<?php

function dbbConnect()
	{
	try
		{
   		 $bdd = new PDO('mysql:host=localhost;dbname=projetsonde;charset=utf8;port=3307', 'root', 'root');
   		 return $bdd;
		}


	catch(Exception $e)
		{
    	die('Erreur : '.$e->getMessage());
		}

	}
        
function lireUtilisateur($pseudo) {
    $bdd = dbbConnect();

    $profil = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ?');
    $profil->execute(array($pseudo));
    $resultat = $profil->fetch();
    return $resultat;
}



?>
