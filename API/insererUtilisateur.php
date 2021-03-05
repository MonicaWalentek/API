<?php
require 'bddconnect.php';

$jsonData = file_get_contents("php://input");
if(strlen($jsonData)>0){
    $data = json_decode($jsonData);
}

$email = $data->email;
$motdepasse = $data->motdepasse;
$pseudo= $data->pseudo;
 

$bdd = dbbConnect();
 
                        //On insère
                            $req = $bdd->prepare('INSERT INTO utilisateurs (pseudo, motdepasse, email, date_creation) VALUES (:pseudo,:motdepasse,:email, CURDATE())');
                            $req->execute(array(
                                ':pseudo' => $pseudo,
                                ':motdepasse' => $motdepasse,
                                ':email' => $email));


                            
                        
                    
?>