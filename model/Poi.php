<?php

//$a = $_POST["id"];
class Poi
{
    // Attributes
    private $id;
    private $name;
    private $type;
    private $country;
    private $region;
    private $lon;
    private $lat;
    private $description;
    private $recommended;
    private $username;
    // methods
    function __construct($nameIn,$typeIn,$countryIn,$regionIn,$lonIn,$latIn,$descriptionIn,$recommendedIn,$usernameIn)
    {
        $this->id=null;
        $this->name=$nameIn;
        $this->type=$typeIn;
        $this->country=$countryIn;
        $this->region=$regionIn;
        $this->lon=$lonIn;
        $this->lat=$latIn;
        $this->description=$descriptionIn;
        $this->recommended=$recommendedIn;
        $this->username=$usernameIn;
    }

     function getId(){
        return $this->id;
    }
     function getName(){
        return $this->name;
    }
    function getType(){
        return $this->type;
    }
     function getCountry(){
        return $this->country;
    }
     function getRegion(){
        return $this->region;
    }
     function getLon(){
        return $this->lon;
    }
     function getLat(){
        return $this->lat;
    }
    function getDescription(){
        return $this->description;
    }
     function getRecommended(){
        return $this->recommended;
    }
     function getUsername(){
        return $this->username;
    }
    function printDetails()
    {
        echo "Name: " . $this->name ."<br />Type: " . $this->type . "<br />Country: " . $this->country . " <br />Region: " . $this->region . " <br />Longittude: " . $this->lon . " <br />Lattitude: " . $this->lat . " <br />Description: " . $this->description . " <br />Recommended by: " . $this->recommended . " people.<br />Added by user: " . $this->username;
        echo "<br />";
    }
     function setId($id) {
        $this->id = $id;
    }

    function recommend(){
        $this->recommended=$this->recommended+1;
    }

};



?>
