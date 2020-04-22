<?php
require_once("../model/UserDAO.php");
session_start();
$logout=0;
$logout= htmlentities($_POST["logout"]);
if($logout==1){
    session_destroy();
    header("Location: ../loginsys/login.html");

}
if ( !isset ($_SESSION["gatekeeper"]))
{
    header ("Location: ../loginsys/login.html");
}
else{ 

?>
<!DOCTYPE html>
<html>
<head>
<title>Points Of Interest!</title>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                $conn = new PDO ("");//credentials deleted for security reasons
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

    <div id="wrapper">
        
        <h1>Search Points of Interest by Region?</h1>
        
        
            <div id="form_container"  >
            <!--method="get" action="searchbyloc.php"-->
        <input autocomplete="off" id="region" class="txtbox" name="loc" required placeholder="Region">        
        <input id="ajaxbtn" class="btn" type="submit" value="Search!" />
                </div>
        <h1>Or...</h1>
        <div id="addsection">
            <a id="addlink" href="../addPoi/addpoiform.php">
                Add new Point Of Interest
            </a>
        </div>
    </div>
   
    <div id="response">
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

<!--<script src="../nav/nav.js"></script>-->
<script type='text/javascript' src='ajax.js'></script>
</body>
</html>
<?php
}
?>