<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: *");

    // Database
    require_once 'commonPhp.php';

    $mydatabase = new MyDatabase();

    // Url Variables
    $su_username = $_POST['username'];
    $su_password = $_POST['password'];
    $su_author = $_POST['author'];

    //Check for existance of the username
    $exist_uesername = $mydatabase->chkUsername($su_username);

    if($exist_uesername){
        $mydatabase->closeTheConnection();
        return print_r(json_encode(["Username Already Exists"]));
    } 

    //Add the username
    $mydatabase->addUser($su_username,$su_password,$su_author);
    $mydatabase->closeTheConnection();

    return print_r(json_encode(["Successfull"]));

?>