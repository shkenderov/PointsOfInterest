<?php

class Review{
    private $id;
    private $poi_id;
    private $review;
    private $approved;

    function __construct($poi_idIn,$reviewIn,$approvedIn){
        $this->id=null;
        $this->poi_id=$poi_idIn;
        $this->review=$reviewIn;
        $this->approved=$approvedIn;
    }

    function getId(){
        return $this->id;
    }
     function getPoi_id(){
        return $this->poi_id;
    }
    function getReview(){
        return $this->review;
    }
     function getApproved(){
        return $this->approved;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setApproved($approvedIn) {
        $this->approved = $approvedIn;
    }
    function printReview()
    {
        echo  "<br /> " . $this->review ;
        echo "<br />";
    }
}

?>