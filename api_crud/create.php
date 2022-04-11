<?php
   
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Methods: PUT, GET, POST");
   header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  

    include_once 'config/database.php';
    include_once 'class/article.php';

    $database = new DB();
    $db = $database->getConnection();

    $item = new Article($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->title = $data->title;
    $item->description = $data->description;
    $item->published = $data->published;
      
    if($item->createArticle()){
        echo json_encode("Article created.");
    } else{
        echo json_encode("Failed to create article.");
    }
?>