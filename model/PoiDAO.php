<?php
    require_once("Poi.php");
    require_once("Review.php");

    class PoiDAO{
        private $poi_table;
        private $conn;
        private $review_table;
        public function __construct($c, $t,$t2) {
            $this->conn = $c;
            $this->poi_table = $t;
            $this->review_table=$t2;
        }
        public function findPoiById($id) {
            try{
                $stmt = $this->conn->prepare("SELECT * FROM ".  $this->poi_table .  " WHERE ID=?");
                $stmt->execute([$id]);
            }
            
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
                $row = $stmt->fetch();
                $poiout= new Poi( $row["name"], $row["type"],$row["country"], $row["region"], $row["lon"],$row["lat"],$row["description"], $row["recommended"], $row["username"]);
                $poiout->setId($row["ID"]);
                return $poiout;
            }
        public function searchByRegion($region) {
            try{
                $stmt = $this->conn->prepare("SELECT * FROM ".  $this->poi_table .  " WHERE region=?");
                $stmt->execute([$region]);
            }
        
        // Catch any exceptions (errors) thrown from the 'try' block
        catch(PDOException $e) 
        {
            echo "Error: $e";
            return null;
        }
            $pois = [];

            while($row = $stmt->fetch()) {
                $poi = new Poi($row["name"], $row["type"],$row["country"], $row["region"], $row["lon"],$row["lat"],$row["description"], $row["recommended"], $row["username"]);
                $poi->setId($row["ID"]);
                $pois[] = $poi;
            }
            return $pois;
        }

        public function addPoi(Poi &$poiobj) {
           // print_r($poiobj);
           try{
                $stmt = $this->conn->prepare("INSERT INTO ".  $this->poi_table .  "(name, type,country,region,lon,lat,description,recommended,username) VALUES (?,?,?,?,?,?,?,?,?)");
                $stmt->execute([$poiobj->getName(), $poiobj->getType(), $poiobj->getCountry(), $poiobj->getRegion(), $poiobj->getLon(), $poiobj->getLat(), $poiobj->getDescription(), $poiobj->getRecommended(), $poiobj->getUsername()]);
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
                $poiobj->setId($this->conn->lastInsertId());
            return $poiobj;
        }
        function updatePoi(Poi &$poiobj){
            try{
                $stmt = $this->conn->prepare("UPDATE " . $this->poi_table .  " SET name=?, type=?,country=?,region=?,lon=?,lat=?,description=?,recommended=? WHERE ID=?");
                $stmt->execute([$poiobj->getName(), $poiobj->getType(), $poiobj->getCountry(), $poiobj->getRegion(), $poiobj->getLon(), $poiobj->getLat(), $poiobj->getDescription(), $poiobj->getRecommended(), $poiobj->getId()]);
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
        }




       
        //findbypoiId
        public function findReviewsByPoiId($id) {
            try{
                $stmt = $this->conn->prepare("SELECT * FROM ".  $this->review_table .  " WHERE poi_id=? AND approved=1");
                $stmt->execute([$id]);
                $reviews = [];

                while($row = $stmt->fetch()) {
                    $reviewout = new Review($row["poi_id"], $row["review"],$row["approved"]);
                    $reviewout->setId($row["ID"]);
                    $reviews[] = $reviewout;
                }
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
            return $reviews;
        }




        public function findReviewById($id) {
            try{
                $stmt = $this->conn->prepare("SELECT * FROM ".  $this->review_table .  " WHERE ID=?");
                $stmt->execute([$id]);
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
            $row = $stmt->fetch();
            $revout= new Review( $row["poi_id"], $row["review"],$row["approved"]);
            $revout->setId($row["ID"]);
            return $revout;
        }
        function updateReview(Review &$revobj){
            try{
                $stmt = $this->conn->prepare("UPDATE " . $this->review_table .  " SET poi_id=?, review=?,approved=? WHERE ID=?");
                $stmt->execute([$revobj->getPoi_id(), $revobj->getReview(), $revobj->getApproved(), $revobj->getId()]);
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
        }

        function addReview(Review &$revobj){
            try{
                $stmt = $this->conn->prepare("INSERT INTO ".  $this->review_table .  "(poi_id, review,approved) VALUES (?,?,?)");
                $stmt->execute([$revobj->getPoi_id(), $revobj->getReview(), $revobj->getApproved()]);
                $revobj->setId($this->conn->lastInsertId());
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
        }

        function findNotApprooved(){
            try{
                $stmt = $this->conn->prepare("SELECT * FROM ".  $this->review_table .  " WHERE approved=0");
                $stmt->execute();
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
            $reviews = [];

            while($row = $stmt->fetch()) {
                $reviewout = new Review($row["poi_id"], $row["review"],$row["approved"]);
                $reviewout->setId($row["id"]);
                $reviews[] = $reviewout;
            }
            return $reviews;
        }

        public function deleteReviewById($id){
            try{
                $stmt = $this->conn->prepare("DELETE FROM ".  $this->review_table .  " WHERE ID=?");
                $stmt->execute([$id]);
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
        }

        public function approveReviewBy($id){
            try{
                $stmt = $this->conn->prepare("UPDATE " . $this->review_table .  " SET approved=1 WHERE ID=?");
                $stmt->execute([$id]);
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
        }
    }
?>