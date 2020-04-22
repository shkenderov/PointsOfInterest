<html>
<head>
<title>PHP Test</title>
<link rel="stylesheet" href="../nav/nav.css">
<link rel="stylesheet" href="register.css">
</head>
<body >
    <nav>
        <div class="logo">
            <h4>POINTS OF INTEREST!</h4>
        </div>
        <ul class="nav-links" >

        </ul>

    </nav>
    <div id="wrapper">
<?php
    require_once("../model/UserDAO.php");

$username = htmlentities($_POST["username"]);
$pswd=htmlentities($_POST["pswd"]);
$pswd2=htmlentities($_POST["pswd2"]);

echo "<p>your username is $username!</p>";
if ($pswd!=$pswd2) { 
    echo "Passwords don't match";
    echo "<a href='register.html'> Press here to try again </a>";
}
else{
    
        $conn = new PDO ("");
        $userdao=new UserDAO($conn, "poi_users");
        $userIn=new User($username,$pswd,0);
        $userdao->addUser($userIn);
        // Set up exception-based error handling
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo '<a href="login.html">Registration Successful! Click here to log in! </a>';        





}


?>
</div>
</body>
</html>