<?php
require('/var/www/html/share/slim4/vendor/autoload.php');

require_once("../model/UserDAO.php");
require_once("../model/PoiDAO.php");
if ( !isset ($_SESSION["gatekeeper"]))
{
    header ("Location: ../loginsys/login.html");
}
// Import classes from the Psr library (standardised HTTP requests and responses)
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Factory\AppFactory;

// Create our app.
$app = AppFactory::create();

// Add routing functionality to Slim. This is not included by default and
// must be turned on.
$app->addRoutingMiddleware();

// Error handling
$app->addErrorMiddleware(true, true, true);

// For the routes to work correctly, you must set your base path.
// This is the relative path of your webspace on the server, including the
// folder you're using but NOT public_html. Here we are assuming the Slim app
// is saved in the 'slimapp' folder within 'public_html' 
$app->setBasePath('/~assign253/index');

$conn = new PDO ("");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$poidao=new PoiDAO($conn, "pointsofinterest","poi_reviews");
$view = new \Slim\Views\PhpRenderer('.');

$app->get('/search/{region}', function (Request $req, Response $res, array $args) use($poidao,$view) { 

    

       
       
        
        // Send an SQL query to the database server
        // $statement = $conn->prepare("select * from wadsongs where artist=?");
        // Loop through the results
        $pois=$poidao->searchByRegion($args["region"]);

            /*foreach ($pois as $row) 
                {   

                    
                    //echo '<div class="result">';
                    $id=$row->getID();
                    $row->printDetails();
                   // echo "<a class='resultlink' href='recommend.php?poiid=$id'>Recommend this place</a> <br/>";
                   // echo "<a class='resultlink' href='../review/showreviews.php?poiid=$id'>See Reviews of this place</a>";

                   // echo "</div>";
                    
                }*/
                $res = $view->render($res, 'searchresults.phtml', ['results'=>$pois]);    
                return $res;
        
    

   
});
$app->post('/review', function (Request $req, Response $res, array $args) use($poidao,$view)  {
    $post = $req->getParsedBody();
    $revobj= new Review($post['poiid'],$post['revtxt'],0);
    $poidao->addReview($revobj);
    $res = $view->render($res, 'submitreview.phtml', ['results'=>$reviews]);    
    return $res;


});
$app->run();