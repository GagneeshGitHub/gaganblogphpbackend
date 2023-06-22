<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");

    //Database
    require_once 'commonPhp.php';
    $mydatabase = new MyDatabase();

    $username = $_POST['blogusername'];
    $password = $_POST['blogpassword'];
    $post_header = $_POST['heading'];
    $post_content = $_POST['content'];
    $author_id = $_POST['author_id'];

    //Verifyin the client
    $exist_user = $mydatabase->chkAuthentication($username,$password);

    if(!$exist_user){
        $mydatabase->closeTheConnection();
        return print_r(json_encode("User Not Found"));
    }

    $mydatabase->insertPost($post_header,$post_content,$author_id);
    $mydatabase->closeTheConnection();

    print_r(json_encode("Successfull"));

?>