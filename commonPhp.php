<?php

    class MyDatabase{

        private $db;
        private $user_id;
        private $author_id;
        private $author_name;

        //Constructor
        function __construct(){
            $this->db = mysqli_connect("bxdmk6ympg8ad5rgv3gt-mysql.services.clever-cloud.com","uqepqfgck4oyud9u","dS7t2TfQxJh2y1UoPVPr","bxdmk6ympg8ad5rgv3gt",3306);
            // $this->db = mysqli_connect("localhost","root","","gaganblogsite");


            if(!$this->db){
                print(json_encode('Database Not Found'));
            }
        }

        //Check if username exist or not
        function chkUsername($username){
            $mysql_query_object = mysqli_query($this->db,"SELECT * FROM reg_users WHERE username='$username'");
            $mysql_result = mysqli_fetch_row($mysql_query_object);
            
            if(!empty($mysql_result)){
                return true;
            } else {
                return false;
            }
        }

        //Check if username and password are correct or not
        function chkAuthentication($username,$password){
            $mysql_query_object = mysqli_query($this->db,"SELECT * FROM reg_users WHERE username='$username' AND password='$password'");
            $mysql_result = mysqli_fetch_row($mysql_query_object);
            if(!empty($mysql_result)){
                $this->setUserId($mysql_result);
                $this->setAuthorIdName();
                return true;
            } else {
                return false;
            }
        }


        //Adding the user
        function addUser($username,$password,$author){
            mysqli_query($this->db, "INSERT INTO reg_users (username,password) VALUES ('$username','$password')");
            $mysql_query_object = mysqli_query($this->db,"SELECT * FROM reg_users WHERE username='$username' AND password='$password'");
            $mysql_result = mysqli_fetch_row($mysql_query_object);
            $user_id = $mysql_result[0];
            mysqli_query($this->db,"INSERT INTO post_author (author_name,user_id) VALUES ('$author','$user_id')");
            return true;
        }


        //Get the author name
        function getAuthorRow($author_id){
            $mysql_query_obj = mysqli_query($this->db,"SELECT * FROM post_author WHERE author_id='$author_id'");
            $mysql_result = mysqli_fetch_row($mysql_query_obj);
            // $author_name = $mysql_result[1];
            return $mysql_result;
        }


        //Get my uploaded post
        function getMyPosts(){
            $author_id = $this->author_id;
            $mysql_query_obj = mysqli_query($this->db,"select * from post_headings where author_id='$author_id'");
            $mysql_result = mysqli_fetch_all($mysql_query_obj);
            return $mysql_result;
        }

        //Inserting the post
        function insertPost($heading,$content,$author_id){
            // echo 'Before executing the insert statement';
            mysqli_query($this->db,"insert into post_headings (post_name,post_content,author_id) values ('$heading','$content','$author_id')");
            // echo 'After executing the insert statement';
        }

        function getAllPosts(){
            $mysql_object = mysqli_query($this->db,"SELECT * FROM post_headings");
            $result_rows = mysqli_fetch_all($mysql_object);
            return $result_rows;
        }

        function getStringPost($string){
            $mysql_object = mysqli_query($this->db,"SELECT * FROM post_headings WHERE post_name LIKE '%$string%'");
            $result_rows = mysqli_fetch_all($mysql_object);
            return $result_rows;
        }

        function deletePost($post_id){
            mysqli_query($this->db,"DELETE FROM post_headings WHERE post_id='$post_id'");
        }


        // Get and set function -----

        //Get userid
        private function setUserId($result_row){
            $this->user_id = $result_row[0];
        }

        //Get authorid
        private function setAuthorIdName(){
            $mysqli_query_object = mysqli_query($this->db,"SELECT * FROM post_author WHERE user_id='$this->user_id'");
            $result_row = mysqli_fetch_row($mysqli_query_object);
            $this->author_id = $result_row[0];
            $this->author_name = $result_row[1];
        }

        // Get user id, author name and id
        function getUserId(){
            return $this->user_id;
        }

        function getAuthorId(){
            return $this->author_id;
        }

        function getAuthorName(){
            return $this->author_name;
        }

        function closeTheConnection(){
            mysqli_close($this->db);
        }

    }

?>