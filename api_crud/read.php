<?php
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Methods: PUT, GET, POST");
 header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    include_once 'config/database.php';
    include_once 'class/article.php';

    $database = new DB();
    $db = $database->getConnection();

    $items = new Article($db);

    $stmt = $items->getArticles();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $ArticleArr = array();
       
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "title" => $title,
                "description" => $description,
                "published" => $published
            );

            array_push($ArticleArr, $e);
        }
        echo json_encode($ArticleArr);
    }
?>

