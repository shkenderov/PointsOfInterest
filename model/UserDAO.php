<?php
    require_once("User.php");
    
    class UserDAO{
        private $table;
        private $conn;
        public function __construct($c, $t) {
            $this->conn = $c;
            $this->table = $t;
        }
        public function findUserById($id) {
            try{
                $stmt = $this->conn->prepare("SELECT * FROM ".  $this->table .  " WHERE ID=?");
                $stmt->execute([$id]);
                $row = $stmt->fetch();
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
            $userout= new User( $row["username"], $row["password"],$row["isAdmin"]);
            $userout->setId($row["ID"]);
            return $userout;
        }
        public function searchByUsername($username) {
            try{
                $stmt = $this->conn->prepare("SELECT * FROM ".  $this->table .  " WHERE username=?");
                $stmt->execute([$username]);
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
            $users = [];

            while($row = $stmt->fetch()) {
                $user= new User( $row["username"], $row["password"],$row["isAdmin"]);
                $user->setId($row["ID"]);
                $users[] = $user;
            }
            return $users;
        }
        public function addUser(User &$userobj) {
            try{
                $stmt = $this->conn->prepare("INSERT INTO ".  $this->table .  "(username,password,isadmin) VALUES (?,?,?)");
                $stmt->execute([$userobj->getUsername(), $userobj->getPassword(), $userobj->getIsAdmin()]);
                $userobj->setId($this->conn->lastInsertId());
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
        }
        public function updateUser(User &$userobj){
            try{
                $stmt = $this->conn->prepare("UPDATE " . $this->table .  " SET username=?, password=?,isadmin=? WHERE ID=?");
                $stmt->execute([$userobj->getUsername(), $userobj->getPassword(), $userobj->getIsAdmin(), $userobj->getId()]);
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
        }
        public function login($username,$password) {
            try{
                $stmt = $this->conn->prepare("SELECT * FROM ".  $this->table .  " WHERE username=? AND password=?");
                $stmt->execute([$username,$password]);
                $row=$stmt->fetch();
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
            return $row["username"];
        }
        
        public function isAdminByName($user){
            try{
                $stmt = $this->conn->prepare("SELECT * FROM ".  $this->table .  " WHERE username=?");
                $stmt->execute([$user]);
                $row=$stmt->fetch();
            }
        
            // Catch any exceptions (errors) thrown from the 'try' block
            catch(PDOException $e) 
            {
                echo "Error: $e";
                return null;
            }
            return $row["isadmin"];


        }
    }
?>