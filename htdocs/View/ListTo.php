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
            $reviews =  $testi->getReviewByTo($to);
           echo $to->getName().' '.$destination->getPrice()." "."Euros"." "."avec pour note"." ".$to->getGrade();
           foreach ($reviews as $review) {
               echo "<br>".$to->getName()." ".$review->getAuthor()." ". $review->getMessage()."<br>";
           }
        }
    } 
?>
<?php 
$destination = new DestinationManager($pdo);
$allDestinations = $destination->getListGroupByName();
$allreview= new ReviewManager($pdo);
$tourOp = new TourOperatorManager($pdo);
$allTourOp = $tourOp->getList();
if (isset($_POST['message'])){
    $newReview = new Review(['author'=>$_POST['author'], 'message'=>$_POST['message']]);
        
        
    
    } ?>

 <form method="post" action="ListTo.php">
    <label for="nom">Votre Nom:</label>
    <input type="text" name="author" required>
    <label for="message">Votre message:</label>
    <input type="text" name="message" required>
    <div class="labels">
        <label >* TO :</label>
    </div>
    <div class="rightTab">
        <select name="to">
            <option value="">Please choose a TO</option>
            <?php foreach ($allTourOp as $rowTourOp) { ?>
                <option value="<?=intval($rowTourOp->getId())?>"><?=$rowTourOp->getName()?></option>

            <?php } ?>
        </select>
    </div>
    <button>Soumettre</button>


    </form>
</div>
              
<?php

    include 'Footer.php';

?>