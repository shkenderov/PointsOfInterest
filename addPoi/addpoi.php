<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../nav/nav.css">
    <link rel="stylesheet" href="addpoiform.css">


</head>
<body onload="main()">
    <nav>
        <div class="logo">
            <h4>POINTS OF INTEREST!</h4>
        </div>
        <ul class="nav-links" >
            <li ><a class="nv" href="../index/index/php">Search</a></li>
            <li><a class="nv" href="../addPoi/addpoiform.php">Add</a></li>
            
            <li>
                <a>
                <?php
                $conn = new PDO ("");
                echo "Hello, " . $_SESSION["gatekeeper"] ;

                ?>
                
                </a>
            </li>

            <form method="post" action="../index/index.php">
                <input type="hidden" name="logout"  value="1" />
                <input id="navbtn" type="submit"  value="Log out" />
            </form>
        </ul>
        <div id="burger">
            <div ></div>
            <div></div>
            <div></div>
        </div>
    </nav>
    
    <div id="wrapper">

<?php 
require_once("../model/PoiDAO.php");
session_start();
if ( !isset ($_SESSION["gatekeeper"]))
{
    header ("Location: ../loginsys/login.html");
}
$conn = new PDO ("mysql:host=localhost;dbname=assign253;", "assign253", "heiquaeg");
$poidao=new PoiDAO($conn, "pointsofinterest","poi_reviews");
$name =htmlentities($_POST["name"]);
$type = htmlentities($_POST["type"]);
$country = htmlentities($_POST["country"]);
$region = htmlentities($_POST["region"]);

$lon = htmlentities($_POST["lon"]);
$lat = htmlentities($_POST["lat"]);
$descr = htmlentities($_POST["descr"]);

                	
            if(!is_numeric($lon)){
                $lon=null;
            }
            if(!is_numeric($lat)){
                $lat=null;
            }
            $poi=new Poi($name,$type,$country,$region,$lon,$lat,$descr,0,$_SESSION["gatekeeper"]);        	
            $poidao->addPoi($poi);

            echo "<h3>Point successfully added!</h3></br>";   
            echo "<a class='nv' href='../index/index.php'>Return to main page</a> <br/>";
     



    ?>
</div>
<footer id="footer">
        <ul class="footer-links">
            <li ><a class="nv" href="../index/index.php">Search</a></li>
            <li><a class="nv" href="../addPoi/addpoiform.php">Add</a></li>
            <form method="post" action="index.php">
                <input type="hidden" name="logout"  value="1" />
                <input id="footerbtn" type="submit"  value="Log out" />
            </form>
           
        </ul>
    </footer>

<script src="../nav/nav.js"></script>

</body>
</html>
