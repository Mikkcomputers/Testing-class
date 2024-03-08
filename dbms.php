<?php
    function create_dbms(){
        // include "../password/server/";
        define("HOST","localhost");
        define("USERNAME","root");
        define("PASSWORD","");
        define("DB_NAME","passwordsaving");
        $conn = new mysqli(HOST,USERNAME,PASSWORD,DB_NAME);
        // if (!$conn) {
        //     echo "Error connection to server".connect_error;
        // }
        
            $sql_dbms = "CREATE DATABASE `login3`";
            $sql1 = " DROP DATABASE `login`";
            // $sql2 = "DROP DATABASE `login2`";
            // $sql3 = "DROP DATABASE `login3`";
            // $sql4 = "DROP DATABASE `password`";
            // $sql5 = "DROP DATABASE `passwords`";
            // $sql3 = "DROP DATABASE `login3`";
            $
            // $res = $conn->query($sql_dbms);
            // if ($res) {
            //     echo "good and find"."<br>";
            // }
       
// include "connection.php";


            // include "../server/index.php";
            // $sql_reg = "CREATE TABLE register(
            //     `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            //     `fullname` varchar(100) NOT NULL,
            //     `username` varchar(100) NOT NULL,
            //     `phone` varchar(100) NOT NULL,
            //     `email` varchar(100) NOT NULL,
            //     `password` varchar(200) NOT NULL,
            //     `roll` int(11) NOT NULL DEFAULT '0',
            //     `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            //     )" ;
            // $users = "CREATE TABLE users(
            //     id int(11) PRIMARY KEY AUTO_INCREMENT,
            //     link varchar(200) NOT NULL,
            //     `password` varchar(200) NOT NULL,
            //     create_on timestamp
    
            // )";
            //  = "DROP ";
            $qry =$conn->query($sql1);
            if (!$qry === true) {
                echo "erro creating table".$conn->error;
            }
            else{
                echo "Good";
            }
        }
        create_dbms();
        // if (!$conn->query($sql_dbms)) {
        //     echo "Error during Creating dbms".$conn->error;
        // }
?>