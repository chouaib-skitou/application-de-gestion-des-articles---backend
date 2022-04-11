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
    
    if($item->deleteArticle()){
        echo json_encode("Article deleted.");
    } else{
        echo json_encode("Not deleted");
    }
?>