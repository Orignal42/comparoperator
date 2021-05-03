<?php

class DestinationManager {

  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

    public function add(Destination $destination)
    {
      

      $q = $this->db->prepare('INSERT INTO destinations(location, price, id_tour_operator) VALUES(:location, :price, :id_tour_operator)');
      
      $q->bindValue(':location', $destination->getLocation());
      $q->bindValue(':price', $destination->getPrice());
      $q->bindValue(':id_tour_operator', $destination->getIdTourOperator());
      
      $q->execute();
      
      $destination->hydrate([
        'id' => $this->db->lastInsertId()
      ]);
    }


}