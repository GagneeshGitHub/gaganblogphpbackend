<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");

// Setting database

    require_once 'commonPhp.php';
    $mydatabase = new MyDatabase();

    $id = $_POST['authorId'];

    $result_rows = $mydatabase->getAuthorRow($id);
    $mydatabase->closeTheConnection();
    
    print_r(json_encode($result_rows)); 
?>