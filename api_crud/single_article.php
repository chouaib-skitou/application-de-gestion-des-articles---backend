<?php
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Methods: PUT, GET, POST");
   header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    include_once 'config/database.php';
    include_once 'class/article.php';

    $database = new DB();
    $db = $database->getConnection();

    $item = new Article($db);
    

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleArticle();

    if($item != null) {
        $article_Arr = array(
            "id" =>  $item->id,
            "title" => $item->title,
            "description" => $item->description,
            "published" => $item->published
        );
      
        http_response_code(200);
        echo json_encode($article_Arr);
    }
      
    else {
        http_response_code(404);
        echo json_encode("Article record not found.");
    }
?>