<?php

class TourOperatorManager {

  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

    public function add(TourOperator $tourOperator)
    {
      

      $q = $this->db->prepare('INSERT INTO tour_operators(name, link) VALUES(:name,  :link,)');
           
      $q->bindValue(':name', $tourOperator->getName());
            $q->bindValue(':link',$tourOperator->getLink());
            $q->execute();
      
      $tourOperator->hydrate([
        'id' => $this->db->lastInsertId()
      ]);
    }





   
}


  