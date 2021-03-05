
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ta météo chez toi !</title>
    <link rel="stylesheet" href="css/header.css"/>
  </head>
  <body onload="initElement();">
      <!-- Le initElement servira quand on aura du javascript à mettre pour le front -->

    <header>

<div id="Titre">
  <h1>Ta Météo Chez Toi !</h1>
</div>

<?php
require_once 'controller/controller.php';
ShowNav();
?>
    
    </header>
      
      
<section>
<?php ShowSection();?>
</section>

  </body>
</html>
