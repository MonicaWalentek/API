<?php
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];  

?>


<div id="Bloc-texte">
    <p>Ton Profil</p>
</div>

<?php
// Partie GET lire utilisateur
$pseudo = $_SESSION['pseudo'];
// On récupère les données de l'API qui sont en JSON et qu'on les retraduit en php
$json='http://localhost/ex_api/API/lireUtilisateur.php?pseudo='.$pseudo.'';
 $resultat = json_decode(file_get_contents($json));
 
 //Partie POST inserer sonde
 If (isset($_POST['newid'])){
     $newid= htmlspecialchars($_POST['newid']);
     $newplace = htmlspecialchars($_POST['newplace']);
     if(!empty($newid)AND !empty($newplace)){
         $data = array('id'=>$id, 'newid'=>$newid, 'newplace'=>$newplace);
         
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
         file_get_contents('http://localhost/ex_api/API/insererSonde.php', false, $context);
     }
     else {
         $reponse="Il faut remplir les deux champs.";
     }
 //On teste d'abord que les résultats sont valide et qu'il n'y pas de case vide
 // On met ces données dans un array
 // On transforme ces données en json
 }
?>
<div id="Profil">
    <p>  Pseudo :  <?php print "$resultat->pseudo"; ?> </br>
        Compte créé le : <?php print "$resultat->date_creation"; ?> </br>
        Adresse e-mail : <?php print "$resultat->email" ?> </br>
        <a class="link-menu" href="index.php?page=modifier-email" style="text-decoration:none">Modifier ton e-mail</a> </br>
        <a class="link-menu" href="index.php?page=modifier-mdp" style="text-decoration:none">Modifier ton mot de passe.</a> </br>
    </p>
</div>

<div id="NouvelleSonde">
    <p> Vous avez acheter une nouvelle sonde est vous souhaitez l'ajouter ? </br> </p>
        <form method="post" action="">
            <label>ID de l'appareil (vous trouverez le numéro à l'arrière de l'appareil *inserer une image*) :</label>
            <input type="text" name ="newid"/> </br>
            <label>Lieu placé dans mon logement :</label>
            <input type ="text" name="newplace"/></br>
             <input type="submit" value="Ajouter ma sonde"/>
        </form>
</div>
<?php 

if (isset($reponse)) {
        echo $reponse;
}
?>

<div id="Sonde">
    <!-- On fait appelle à l'API -->
</div>

<?php
}
else {
    header("location:index.php?page=connexion");
}  