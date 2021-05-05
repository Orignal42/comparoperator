<?php

class ReviewManager {

  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

    public function add(Review $review)
    {
      

      $q = $this->db->prepare('INSERT INTO reviews(message, author, id_tour_operator) VALUES(:message, :author, :id_tour_operator)');
      
      $q->bindValue(':message', $review->getMessage());
      $q->bindValue(':author', $review->getAuthor());
      $q->bindValue(':id_tour_operator', $review->getId_Tour_Operator());
      $q->execute();
      $review->hydrate([
        'id' => $this->db->lastInsertId()
      ]);
    }






    public function getRevibyTo(Review $review)
  {

    $q = $this->db->prepare('SELECT * FROM tour_operators WHERE id=?');
      
    
    $q->execute([$review->getId_Tour_Operator()]);
    $rev = $q->fetch(PDO::FETCH_ASSOC);
    $test = new Review($rev);

    return $test;
  }

  public function getReviewByTo($review)
  {

    $reviewCollection = [];

    $q = $this->db->prepare('SELECT * FROM reviews WHERE message=?');
      
    
    $q->execute([$review]);
    $destinations = $q->fetchAll(PDO::FETCH_ASSOC);
    foreach ($review as $reviewArray) {
      array_push($reviewCollection, new Destination($reviewArray));
    }

    return $reviewCollection;
  }
}