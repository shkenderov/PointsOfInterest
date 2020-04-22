
<?php

require_once("../model/UserDAO.php");
require_once("../model/PoiDAO.php");
$conn = new PDO ("");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$actionstr=0;
$actionstr = htmlentities($_GET["actionstr"]);
$id_in = htmlentities($_GET["id"]);

session_start();
$logout=0;
$logout= $_POST["logout"];
if($logout==1){
    session_destroy();
    header("Location: ../loginsys/login.html");

}
if ( !isset ($_SESSION["gatekeeper"]))
{
    header ("Location: ../loginsys/login.html");
}
$userdao=new UserDAO($conn, "poi_users");
$poidao=new PoiDAO($conn, "pointsofinterest","poi_reviews");


    if($userdao->isAdminByName($_SESSION["gatekeeper"])==0){
        header ("Location: ../loginsys/login.html");
    }


if($actionstr=="del"){
    $poidao->deleteReviewById($id_in);
}
if($actionstr=="app"){
    
    $poidao->approveReviewBy($id_in);
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Points Of Interest!</title>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../nav/nav.css">
    <link rel="stylesheet" href="adminpanel.css">

</head>
<body onload="main()">
    <nav>
        <div class="logo">
            <h4>POINTS OF INTEREST!</h4>
        </div>
        <ul class="nav-links" >
            <li ><a class="nv" href="../index/index.php">Search</a></li>
            <li><a class="nv" href="../addPoi/addpoiform.php">Add</a></li>
            
            <li>
                <a>
                <?php
                echo "Hello, " . $_SESSION["gatekeeper"] ;

                ?>
                
                </a>
            </li>
            
   
                            <li>
                                <a class="nv" href="../adminpanel/adminpanel.php">Admin Panel</a>
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
            $i=1;
            $reviews=$poidao->findNotApprooved();
            if($reviews==null){
                echo "<h3> No pending reviews.</h3></br><a class='link'  href='../index/index.php'>Return Home</a>";
            }
            else{
                foreach ($reviews as $row) 
                    {   
                        $poiid=$row->getPoi_id();
                        $poitemp=$poidao->findPoiById($poiid);
                        echo "<div class='rescontainer'>";
                        echo "<h3>Review for " . $poitemp->getName() . ":</h3>";
                        echo "<p>";
                        $id=$row->getId();
                        $row->printReview();
                        echo "</p>";
                        echo "<br/>";
                        $i++;
                        echo "<a class='link' href='adminpanel.php?id=$id&actionstr=del'>Delete</a> <br/>";
                        
                        echo "<a class='link' href='adminpanel.php?id=$id&actionstr=app'>Approve</a> <br/>";

                        echo "</div>";
                    }
            }
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
