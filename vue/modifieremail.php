<?php
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    if (isset($_POST['newemail'])) {
        $newemail = htmlspecialchars($_POST['newemail']);
        $newemail2 = htmlspecialchars($_POST['newemail2']);
        if (!empty($newemail)AND!empty($newemail2)) {
            if ($newemail == $newemail2) {
                if ((filter_var($newemail, FILTER_VALIDATE_EMAIL))) {
                    $data = array('id' => $id, 'newemail' => $newemail);
                }

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
                file_get_contents('http://localhost/ex_api/API/updateEmail.php?id='.$id.'', false, $context);
                header("location:index.php?page=modifier-email&message=1");
                //$reponse="Ton addresse e-mail a bien été mise à jour !";
            } else {
                header("location:index.php?page=modifier-email&message=2");
                //$reponse="Les adresses e-mail saisies ne sont pas les mêmes.";
            }
        } else {
            header("location:index.php?page=modifier-email&message=3");
            //$reponse = "Il faut remplir les deux champs.";
        }
    }

 ?>


<div id="Bloc-texte">
    <p>Modifier ton e-mail</p>
</div>

    
<form method="post" action="">
    <label>Ma nouvelle adresse e-mail:</label>
    <input type="email" name ="newemail"/> </br>
    <label>Confirmation de ma nouvelle adresse e-mail :</label>
    <input type ="email" name="newemail2"/></br>
    <input type="submit" value="Mettre à jour mon adresse e-mail"/>
</form>

<?php
}
if (isset($_GET['message'])) {
        $message = htmlspecialchars($_GET['message']);
        switch ($message) {
            
            case "1":
                echo 'Ton addresse e-mail a bien été mise à jour !'; 
                break;
            case "2":
                echo 'Les adresses e-mail saisies ne sont pas les mêmes.';
                break;
            case "3":
                echo 'Il faut remplir les deux champs.';
                break;
        }
}
?>