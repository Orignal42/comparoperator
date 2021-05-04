<?php
class TourOperator{
    protected  $id;
    protected  $name;
    protected  $grade;
    protected  $link;
    protected  $is_premium;
    
   


    /* CONSTRUCT */

    public function __construct(array $donnees){
        $this->hydrate($donnees);
    }

    /* HYDRATE */

    public function hydrate($donnees){
        foreach ($donnees as $key =>$value) {
        
            $method = 'set'.ucfirst($key);
        
        if (method_exists($this, $method))
        {
          $this->$method($value);
        }
        }
    }

    public function getId(){
        return $this->id;
    }

    public function setId ($id){
        $this->id = $id;
    }


    public function getName (){
        return $this->name;
    }

    public function setName ($name){
        $this->name = $name;
    }
    public function getGrade (){
        return $this->grade;
    }
    public function setGrade ($grade){
        $this->grade = $grade;
    }

    public function getLink (){
        return $this->link;
    }

    public function setLink ($link){
        $this->link = $link;
    }
    
    public function isIsPremimum (){
        return $this->ispremium;
    }

    public function setIs_premimum ($is_premium){
        $this->ispremium = $is_premium;
    }
}