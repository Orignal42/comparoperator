<?php
require_once("../Process/Connexion.php");
include '../Process/Autoload.php';
include 'Header.php';


 $destinationManager = new DestinationManager($pdo);
 $toursoperatorsManager = new TourOperatorManager($pdo);
 if (isset($_POST['location']) && isset($_POST['price']) &&  isset($_POST['name']) && isset($_POST['link'])) {
 
 $toursoperator= new TourOperator(['name'=>$_POST['name'],'link'=>$_POST['link']]);
 $destination= new Destination(['location'=> $_POST['location'] , 'price' => $_POST['price'],'id_tour_operator'=> $toursoperator->getId()]);
 var_dump( $toursoperator);
 var_dump($destination);
 $destinationManager->add($destination);
 $toursoperatorsManager->add($toursoperator);
}

?>




<div class="container-form">
      <form action="" method="post">
         <div class="formulaire">
          <div class="labels">
            <label>location</label>
                     
          </div>
          <div class="rightTab">
          <select name="location">
            <option value="">Please choose a location</option>
            <option value="corse">Corse</option>
            <option value="sardaigne">Sardaigne</option>
            <option value="ny">New York</option>
            <option value="paris">Paris</option>
            <option value="vancouver">Vancouver</option>
            <option value="london">London</option>
            <option value="maroco">Maroco</option>
            <option value="tokyo">Tokyo</option>
            <option value="venise">Venise</option>
            <option value="barcelona">Barcelona</option>
        </select>
          </div>
            
            Prix: <input type="text" name="price" maxlength="240" style="margin-bottom: 10px;"/><br>
            Tour Operator : <input type="text" name="name" maxlength="240" style="margin-bottom: 10px;"/><br>
            Link : <input type="text" name="link" maxlength="240" style="margin-bottom: 10px;"/><br>                      
            <input type="submit"  name="submit" style="margin-bottom: 10px">
         </div>
      </form>
     
</div>

<?php
include 'Footer.php';
?>



