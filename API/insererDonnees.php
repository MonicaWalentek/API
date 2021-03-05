<?php
//CREATE
//Il faut utiliser une méthode post du coté de la sonde
// Ce qui suit est une méthode get mais pas sur que ça soit bien de tout passer par l'url
/*if (isset($_GET['idsonde']) && (isset($_GET['temperature'])) && (isset($_GET['humidite']))){
    $idsonde = $_GET['idsonde'];
    $temperature = $_GET['temperature'];
    $time = DateTime();
    $humidity = $_GET['humidite'];
*/
//Là, c'est une méthode post :
$jsonData = file_get_contents("php://input");
if(strlen($jsonData)>0){
    $data = json_decode($jsonData);
}
/*Il faudra avoir dans notre json un idsonde, temperature, humidite:
 * $idsonde = $data->idsonde;
 * $temperature = $data->temperature;
 * $humidite = $data->humidite;
 * $time = DateTime();

 */

require 'bddconnect.php';
$bdd=dbbConnect();
$req = $bdd->prepare('INSERT INTO donnees(id_sonde, temperature, date_heure, humidite)VALUES(:id_sonde, :temperature, :date_heure, :humidite)');
$req->execute(array('id_sonde'=>$idsonde,'temperature'=>$temperature, 'date_heure'=>$time, 'humidite'=>$humidity));

//}