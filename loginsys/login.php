<?php
    require_once("../model/UserDAO.php");

    session_start();

    $a = htmlentities($_POST["username"]);
    $b = htmlentities($_POST["password"]);
    $conn = new PDO ("");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $userdao=new UserDAO($conn, "poi_users");
    $returnedusername=$userdao->login($a,$b);
    if ($returnedusername == null) {
        echo "Wrong username or password"  ;
        echo '<a href="login.html">Try Again</a>';        
    }
    else{
        
                $_SESSION["gatekeeper"] = $returnedusername;
                
                header ("Location: ../index/index.php");

        }           
        
    
?>
