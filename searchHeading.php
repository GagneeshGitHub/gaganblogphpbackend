<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");

// Setting database
    require_once 'commonPhp.php';

    $mydatabase = new MyDatabase();

// Getting the search string
    $s_string = $_POST['searchString'];


    if($s_string==""){
        $result_rows = $mydatabase->getAllPosts();
    } else {
        $result_rows = $mydatabase->getStringPost($s_string);
    }

    $mydatabase->closeTheConnection();

    print_r(json_encode($result_rows)); 
?>