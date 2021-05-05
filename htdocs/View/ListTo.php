<?php
include '../Process/Autoload.php';
require_once("../Process/Connexion.php");
include 'Header.php';
?>

<div class="container">
<?php
 $test = new DestinationManager($pdo);
 $testi= new ReviewManager($pdo);
    if (isset($_GET['destination'])) {
       $arrayDestination = $test->getDestinationByLocation($_GET['destination']);
     
        echo "<h1>".$_GET['destination']."</h1>"; 
       foreach ($arrayDestination as $destination){
           $to =  $test->getDestibyTo($destination);
          
           echo $to->getName().' '.$destination->getPrice()." "."Euros"." "."avec pour note"." ".$to->getGrade();
        }
    }

?>
</div>

<?php

    include 'Footer.php';

?>