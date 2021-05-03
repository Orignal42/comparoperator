<?php

class TourOperatorManager {

  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

    public function add(TourOperator $tourOperator)
    {
      

      $q = $this->db->prepare('INSERT INTO touroperator(name, grade, link, is_premium) VALUES(:name, :grade, :link, :is_premium)');
      
      $q->bindValue(':', $tourOperator->getId());
      $q->bindValue(':name', $tourOperator->getName());
      $q->bindValue(':grade', $tourOperator->getGrade());
      $q->bindValue(':link',$tourOperator->getLink());
      $q->bindValue(':IsPremium',$tourOperator->isIsPremimum());
      $q->execute();
      
      $tourOperator->hydrate([
        'id' => $this->db->lastInsertId()
      ]);
    }


}


  