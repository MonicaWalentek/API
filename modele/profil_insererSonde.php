<?php
if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET['id']);

if(isset($_POST['newid'])){
    $newid= htmlspecialchars($_POST['newid']);
    $newplace=htmlspecialchars($_POST['newplace']);
    
    $donnees= array('id' => $id, 'newid' => $newid, 'newplace' => $newplace);
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type:application/json",
            'ignore_errors' => true,
            'timeout' => 10,
            'content' => json_encode($donnees),
        ),
    );
    $context = stream_context_create($options);
    file_get_contents('../API/insererSonde.php', false, $context);

    
    
    //header("location:../index.php?page=profil&message=1");
    //$reponse="Ta sonde a bien été ajoutée !";
    //}
//else{
  //  header("location:../index.php?page=profil&message=2");
    //$reponse="Une erreur est survenue.";
     }
}
//else{
//header("location:../index.php?page=profil&message=2");}
