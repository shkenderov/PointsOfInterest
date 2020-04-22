<?php

class User
{
    private $id;
    private $username;
    private $password;
    private $isAdmin;

    function __construct($nameIn,$passwordIn,$isadminIn){
        $this->id=null;
        $this->username=$nameIn;
        $this->password= $passwordIn;
        $this->isAdmin=$isadminIn;
    }
    function getId(){
        return $this->id;
    }
     function getUsername(){
        return $this->username;
    }
    function getPassword(){
        return $this->password;
    }
     function getIsAdmin(){
        return $this->isAdmin;
    }
    function setId($idIn) {
        $this->id = $idIn;
    }

}
?>