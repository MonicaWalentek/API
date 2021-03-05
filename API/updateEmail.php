<?php
require 'bddconnect.php';
if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET['id']);
    
    $jsonData = file_get_contents("php://input");
    if(strlen($jsonData)>0){
        $data = json_decode($jsonData);
    }
    $id = $data->id;
    $newemail = $data->newemail;
    
    $bdd= dbbConnect();
    $insertemail=$bdd->prepare('UPDATE utilisateurs SET email=? WHERE id=?');
    $insertemail->execute(array($newemail, $id));
                
                }

?>