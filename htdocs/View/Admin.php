<?php

    include '../Process/Autoload.php';

    require_once("../Process/Connexion.php");

    include 'Header.php';

    $destination = new DestinationManager($pdo);
    $allDestinations = $destination->getListGroupByName();

    $tourOp = new TourOperatorManager($pdo);
    $allTourOp = $tourOp->getList();


    if (isset($_POST['price'])){

        $newDestination = new Destination(['location'=>$_POST['location'], 'id_tour_operator'=>$_POST['to'], 'price'=>$_POST['price']]);
        $operator = new TourOperator(['id'=>$_POST['to']]);
        $destination->add($newDestination, $operator);
    
    }

?>

<!-- FORM 1 -->

<!-- FORM 2 -->

<!-- FORM 3 SELECT -->

<form method="post" action="Admin.php">
                    
    <div class="labels">
        <label>* Location :</label>
    </div>
    <div class="rightTab">
        <select name="location">
            <option value="">Please choose a location</option>

            <?php foreach ($allDestinations as $rowDestination) { ?>

                <option value="<?=$rowDestination->getLocation()?>"><?=$rowDestination->getLocation()?></option>

            <?php } ?>
            
        </select>
    </div>     

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

    

            <div class="labels">
                <label for="price">* Price :</label>
            </div>
            <div class="rightTab">
                <input type="text" name="price" required placeholder="600$">
            </div></br>      
         <input type="submit" id='submit' value='Créer'></br>
        </form>
            <form action="Admin.php" method="post">
            <input type="text" value="Location" name="location">
            <input type="text" value="Price"    name="price">
            <input type="hidden" value=""       name="<?php ($rowTourOp->getId()) ?>">
            <input type="submit" id='submit' value='Créer destination'>
            </form></br>
            <form action="Admin.php"  method="post">
            <input type="text" value="TO" name="" >
            <input type="text" value="link">
            <input type="submit" id='submit' value='Créer TO'>
            </form> 


<?php

    include 'Footer.php';

?>