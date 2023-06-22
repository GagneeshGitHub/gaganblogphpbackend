<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");

    require_once 'commonPhp.php';

    $mydatabase = new MyDatabase();

    // $username = $_POST['blogUsername'];
    // $password = $_POST['blogPassword'];

    $username = $_POST['blogUsername'];
    $password = $_POST['blogPassword'];

    $exist_user = $mydatabase->chkAuthentication($username,$password);

    if($exist_user){
        $author_id = $mydatabase->getAuthorId();
        $authot_name = $mydatabase->getAuthorName();
        $user_id = $mydatabase->getUserId();
        $mydatabase->closeTheConnection();
        print_r(json_encode([true,$author_id,$authot_name]));
    } else {
        $mydatabase->closeTheConnection();
        print(json_encode([false]));
    }

?>