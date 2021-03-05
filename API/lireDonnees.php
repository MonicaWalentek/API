<?php
//READ
require 'bddconnect.php';
if (isset($_GET['idsonde'])){
    $idsonde = $_GET['idsonde'];
    if (isset($_GET['datedebut'])){
        $datedebut = $_GET['datedebut'];
        $datefin = $_GET['datefin'];
        //verif si bien date
        
    $bdd=dbbConnect();
    $req = $bdd->prepare('SELECT temperature, date_heure, humidite FROM donnees JOIN sonde ON donnees.id_sonde=sonde.idsonde WHERE idsonde=? AND date_heure BETWEEN ? AND ? ORDER BY date_heure LIMIT 100');
    $req->execute(array($idsonde, $datedebut, $datefin));
    while($resultat = $req->fetch());
    $lecture = json_encode($resultat);
    echo $lecture;
    }
 else {  
    $bdd=dbbConnect();
    $req = $bdd->prepare('SELECT temperature, date_heure, humidite FROM donnees JOIN sonde ON donnees.id_sonde=sonde.idsonde WHERE idsonde=? ORDER BY date_heure DESC LIMIT 1');
    $req->execute(array($idsonde));
    while($resultat = $req->fetch());
    $lecture = json_encode($resultat);
    echo $lecture;
}
}
// Il faut créer sur la page profil un moyen à l'utilisateur de lire les données de la sonde en temps réel ou sur un certain laps de temps
// Différent de git
