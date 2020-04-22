<?php
    session_start();

    $logout=0;

    if ( !isset ($_SESSION["gatekeeper"]))
    {
        header ("Location: ../loginsys/login.html");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../nav/nav.css">
    <link rel="stylesheet" href="addpoiform.css">


    <title>Add Point of Interest</title>
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
                $conn = new PDO ("");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        <h1>Add new Point Of Interest!</h1>
        <form id="addform" method="POST" action="addpoi.php">
            <input  class="txtbox"  name="name" required placeholder="Name" >            
            <input  class="txtbox"  name="type" required placeholder="Type, ex. city">    
            <input  class="txtbox"  name="country" required placeholder="Country">        
            <input   class="txtbox" name="region" required placeholder="Region">        
            <input  class="txtbox" type="number"   name="lon"  placeholder="Longitude (optional)">        
            <input  class="txtbox" type="number"  name="lat"  placeholder="Lattitude (optional)"> 
            <textarea name="descr" required placeholder="Description"></textarea>   
            <input  class="btn" type="submit" value="Go!" />

        </form>
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

<script src="../nav/nav.js"></script>

</body>
</html>