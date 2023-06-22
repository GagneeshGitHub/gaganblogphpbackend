<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: X-Requested-With");

    require_once 'commonPhp.php';
    $mydatabase = new MyDatabase();

    $username = $_POST['blogusername'];
    $password = $_POST['blogpassword'];
    $post_id = $_POST['postid'];

    $exist_user = $mydatabase->chkAuthentication($username,$password);

    if(!$exist_user){
        $mydatabase->closeTheConnection();
        return print_r(json_encode("Username not found"));
    }

    $mydatabase->deletePost($post_id);

    $mydatabase->closeTheConnection();
    return print_r(json_encode("Successfull"));

?>