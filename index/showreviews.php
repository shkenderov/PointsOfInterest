<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews!</title>
    <link rel="stylesheet" href="../nav/nav.css">
    <link rel="stylesheet" href="review.css">

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
                require_once("../model/PoiDAO.php");
                require_once("../model/UserDAO.php");

                session_start();
                if ( !isset ($_SESSION["gatekeeper"]))
                {
                    header ("Location: ../loginsys/login.html");
                }
                $conn = new PDO ("");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Hello, " . $_SESSION["gatekeeper"] ;

                ?>
                
                </a>
            </li>
            <?php
                   $userdao=new UserDAO($conn, "poi_users");

                    if($userdao->isAdminByName($_SESSION["gatekeeper"])==1){
                        ?>
                            <li>
                                <a class="nv" href="../adminpanel/adminpanel.php">Admin Panel</a>
                            </li>
                        <?php
                    }
                ?>
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
        <?php $id = htmlentities($_POST["poiid"]);
?>
<div id="wrapper">
    <h1>Reviews for 
        <?php 
        $poidao=new PoiDAO($conn, "pointsofinterest","poi_reviews");

        $poitemp=$poidao->findPoiById($id);
        echo $poitemp->getName();
        ?>
        </h1>
    <h3>Write a Review!</h3>
    <h4>All reviews have to be approved by an admin to be diplayed.</h4>

    <div id="submitreviewcontainer">
            <input type="hidden" id="parseid" name="poiid" value="<?php echo $id; ?> ">
            <textarea autocomplete="off" id="reviewtext" class="txtbox" name="loc"  placeholder="Review Text"></textarea>  
            <input id='ajaxbtnreview' class='btn' type='Submit' value="Submit">
            <div id='responsedivreview'></div> 
    </div>

<?php 

$i=1;
$reviews=$poidao->findReviewsByPoiId($id);
if($reviews==null){
    echo "<h3>No reviews for this Point of Interest.</h3><br/><a class='link' href='../index/index.php'>Return Home</a>";
}
else{
    foreach ($reviews as $row) 
        {   

            echo "<h3>Review " . $i . ":</h3>";
            echo "<p>";

            $row->printReview();
            echo "</p>";
            echo "<br/>";
            $i++;
            
        }
}

?>
</div>
<footer id="footer">
        <ul class="footer-links">
            <li ><a class="nv" href="../index/index.php">Search</a></li>
            <li><a class="nv" href="../addPoi/addpoiform.php">Add</a></li>
            <form method="post" action="../index/index.php">
                <input type="hidden" name="logout"  value="1" />
                <input id="footerbtn" type="submit"  value="Log out" />
            </form>
           
        </ul>
    </footer>

<script src="makereview.js"></script>
</body>
</html>