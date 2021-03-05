<?php
require 'bddconnect.php';
if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET['id']);
    $jsonData = file_get_contents("php://input");
    if(strlen($jsonData)>0){
        $data = json_decode($jsonData);
    }

    $newmotdepasse = $data->newmotdepasse;
               $bdd= dbbConnect();
               $insertpass=$bdd->prepare('UPDATE utilisateurs SET motdepasse=? WHERE id=?');
               $insertpass->execute(array($newmotdepasse,$id));
               
    }
         
 
