<div id="Bloc-texte">
    <p>Modifier ton mot de passe</p>
</div>

<?php
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
     if(isset($_POST['newmdp'])){
     $newmotdepasse = htmlspecialchars(password_hash($_POST['newmdp'], PASSWORD_DEFAULT));
     $newmdp= htmlspecialchars($_POST['newmdp']);
     $newmdp2=htmlspecialchars($_POST['newmdp2']);
        if(!empty($newmdp)AND !empty($newmdp2)){
            if($newmdp==$newmdp2){
            $data = array('id' => $id, 'newmotdepasse' => $newmotdepasse);    
            $option = array(
                    'http' => array(
                        'method' => 'POST',
                        'header' => "Content-Type: application/json",
                        'ignore_errors' => true,
                        'timeout' => 10,
                        'content' => json_encode($data),
                    ),
                );
            $context = stream_context_create($option);
            file_get_contents('http://localhost/ex_api/API/updatePassword.php?id='.$id.'', false, $context);
            header("location:index.php?page=modifier-mdp&message=1");
               //$reponse="Ton nouveau mot de passe a bien été mis à jour !";
            }
            else{
                header("location:index.php?page=modifier-mdp&message=2");
                //$reponse="Les mots de passes saisis ne sont pas les mêmes.";
            }
        }
        else {
            header("location:index.php?page=modifier-mdp&message=3");
            //$reponse = "Il faut remplir les deux champs.";
        }
     }
   
?>
<form method="post" action="">
    <label>Mon nouveau mot de passe :</label>
    <input type="password" name ="newmdp"/> </br>
    <label>Confirmation de mon nouveau mot de passe :</label>
    <input type ="password" name="newmdp2"/></br>
    <input type="submit" value="Mettre à jour mon mot de passe"/>
</form>

<?php 
}
if (isset($_GET['message'])) {
        $message = htmlspecialchars($_GET['message']);
        switch ($message) {
            
            case "1":
                echo 'Ton nouveau mot de passe a bien été mis à jour !'; 
                break;
            case "2":
                echo 'Les mots de passes saisis ne sont pas les mêmes.';
                break;
            case "3":
                echo 'Il faut remplir les deux champs.';
                break;
        }
}
?>