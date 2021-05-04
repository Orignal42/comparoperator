<?php

class DestinationManager {

  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

    public function add(Destination $destination)
    {
      

      $q = $this->db->prepare('INSERT INTO destinations (location, price, id_tour_operator) VALUES(:location, :price, :id_tour_operator)');
      
      $q->bindValue(':location', $destination->getLocation());
      $q->bindValue(':price', $destination->getPrice());
      $q->bindValue(':id_tour_operator', $destination->getId_Tour_Operator());
      $q->execute();
      
      $destination->hydrate([
        'id' => $this->db->lastInsertId()
      ]);
    }

    public function getList() {
      $desti = [];
      
      $q = $this->db->prepare('SELECT * FROM destinations');
      $q->execute();
      
      while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
      {
        echo '<br>';
        array_push($desti, new Destination ($donnees));
      }
      
      return $desti;
    }


    public function getDestibyTo(Destination $destination){

      $q = $this->db->prepare('SELECT * FROM tour_operators WHERE id=?');
        
     
    $q->execute([$destination->getId_tour_operator()]);
      $To = $q->fetch(PDO::FETCH_ASSOC);
      $test = new TourOperator($To);

      return $test;
    }

    public function getDestinationByLocation($location){
      $destinationCollection = [];
      $q = $this->db->prepare('SELECT * FROM destinations WHERE location=?');
        
      // $q->bindValue(':location', $destination->getLocation());
      $q->execute([$location]);
      $destinations = $q->fetchAll(PDO::FETCH_ASSOC);
      foreach ($destinations as $destinationArray) {
        array_push($destinationCollection, new Destination($destinationArray));
      }

      return $destinationCollection;
    }
  

    public function getlistOperatorbyDestinations($id){
      $arrayListdestination=[];
      $q = $this->_db->prepare('SELECT * FROM destinations WHERE tour_operator.id=? ');
      $q->execute([$id]);
      $listdestination = $q->fetchAll();
  
      foreach($listdestination as $destination){
        array_push($arrayListdestination, new Destination($destination));
      }
      return $arrayListdestination;
  
    }

    public function createDestination($destination){
      $locationStatement = $this->pdo->prepare("INSERT INTO destination (location, price, id_tour_operator) VALUE (:location, :price, :id_tour_operator)");
      $locationStatement->bindValue("location", $destination->getLocation(), PDO::PARAM_STR);
      $locationStatement->bindValue("price", $destination->getPrice(), PDO::PARAM_INT);
      $locationStatement->bindValue("id_tour_operator", $destination->getId_tour_operator(), PDO::PARAM_INT);
      $locationStatement->execute();

  }

  public function getListGroupByName(){
    $q = $this->db->prepare('SELECT location, images, description FROM destinations GROUP BY location, images, description');
    $destinations = [];
    $q->execute();
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      array_push($destinations, new Destination ($donnees));
    }
      return $destinations;
  }







  
}