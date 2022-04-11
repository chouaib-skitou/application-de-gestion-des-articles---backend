<?php
    class Article{

        // conn
        private $conn;

        // table
        private $dbTable = "article";

        // col
        public $id;
        public $title;
        public $description;
        public $published;
      
        // db conn
        public function __construct($db){
            $this->conn = $db;
        }

        // GET articles
        public function getArticles(){
            $sqlQuery = "SELECT id, title, description, published
               FROM " . $this->dbTable . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE Article
        public function createArticle(){
            $sqlQuery = "INSERT INTO
                        ". $this->dbTable ."
                    SET
                    title = :title, 
                    description = :description, 
                    published = :published";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->published=htmlspecialchars(strip_tags($this->published));
                   
            // bind data
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":published", $this->published);
           
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

       // GET Article
       public function getSingleArticle(){
        $sqlQuery = "SELECT
                    id, 
                    title, 
                    description, 
                    published
                  FROM
                    ". $this->dbTable ."
                WHERE 
                   id = ?";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->title = $dataRow['title'];
        $this->description = $dataRow['description'];
        $this->published = $dataRow['published'];
      
    }      
        

        // UPDATE Article
        public function updateArticle(){
            $sqlQuery = "UPDATE
                        ". $this->dbTable ."
                    SET
                    title = :title, 
                    description = :description, 
                    published = :published
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->published=htmlspecialchars(strip_tags($this->published));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":published", $this->published);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE article
        function deleteArticle(){
            $sqlQuery = "DELETE FROM " . $this->dbTable . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>
