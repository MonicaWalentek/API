<?php
require 'bddconnect.php';

$jsonData = file_get_contents("php://input");
if(strlen($jsonData)>0){
    $data = json_decode($jsonData);
}


// On récupère donc les données en json.
// On verifie si les json sont vide, et on décode $data.
$id = $data->id;
$newid = $data->newid;
$newplace= $data->newplace;
 
    $bdd= dbbConnect();
    $insertsonde=$bdd->prepare('INSERT INTO sonde(id, lieu, id_utilisateur) VALUES (:id, :lieu, :id_utilisateur)');
    $insertsonde->execute(array('id'=>$newid, 'lieu'=>$newplace, 'id_utilisateur'=>$id));
    