<html>
<head>
<title>Recommend</title>
<link rel="stylesheet" href="../nav/nav.css">
<link rel="stylesheet" href="index.css">

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
                session_start();
                require_once("../model/UserDAO.php");
                if ( !isset ($_SESSION["gatekeeper"]))
                {
                    header ("Location: ../loginsys/login.html");
                }
                $conn = new PDO ("");
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
            <form method="post" action="index.php">
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
 
<?php 
    require_once("../model/PoiDAO.php");

    $conn = new PDO ("mysql:host=localhost;dbname=assign253;", "assign253", "heiquaeg");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $poidao=new PoiDAO($conn, "pointsofinterest","poi_reviews");

    $id = htmlentities($_POST["poiid"]);
    $poi=$poidao->findPoiById($id);
    $poi->recommend();
    $poidao->updatePoi($poi);
    echo "<h1>Thank you for recommending " . $poi->getName() . "! <br/>In now has " . $poi->getRecommended() . " recommendations!</h1><br/>";
    echo "<a id='homelink' href='index.php'>Return home</a>";
    
?>


<script src="../nav/nav.js"></script>

</body>
</html>
