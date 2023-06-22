<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: X-Requested-With");

    require_once 'commonPhp.php';
    $mydatabase = new MyDatabase();

    $username = $_POST['blogusername'];
    $password = $_POST['blogpassword'];
    // $author_id = $_GET['authorid'];


    $exist_user = $mydatabase->chkAuthentication($username,$password);

    if(!$exist_user){
        $mydatabase->closeTheConnection();
        print(json_encode("You are not logged in"));
    } else {
        //getting all post data for that username and author
        $sql_result = $mydatabase->getMyPosts();
        $mydatabase->closeTheConnection();
        print_r(json_encode($sql_result));
    }

?>