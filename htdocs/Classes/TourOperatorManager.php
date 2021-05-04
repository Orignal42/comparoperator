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

    public function getListTO() {
      $TO = [];
      
      $q = $this->db->prepare('SELECT * FROM tour_operators');
      $q->execute();
      
      while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
      {
        echo '<br>';
        array_push($TO, new TourOperator ($donnees));
      }
      
      return $TO;
    }

    public function createTourOperator($touroperator){
      $locationStatement = $this->db->prepare("INSERT INTO tour_operators (name, link) VALUE (:name, :link)");
      $locationStatement->bindValue("name", $touroperator->getName(), PDO::PARAM_STR);
      $locationStatement->bindValue("link", $touroperator->getLink(), PDO::PARAM_INT);
      $locationStatement->execute();



   
}

public function getList()
    {
        $tourop = [];

        $q = $this->db->prepare('SELECT tour_operators.* FROM tour_operators');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {

            array_push($tourop,new TourOperator($donnees));

        }

        return $tourop;
    }

}


  