<?php
            define("HOST","localhost");
            define("USERNAME","root");
            define("PASSWORD","");
            define("DB_NAME","password22");
            
            
            $conn = new mysqli(HOST,USERNAME,PASSWORD,DB_NAME);
            // if (!$conn) {
            //     echo "Error connection to server".connect_error;
            // }
            
                $sql_dbms = "CREATE DATABASE `Password`";
                $res = $conn->query($sql_dbms);
                if ($res) {
                    echo "good and find";
                }else{
                    echo "erorrrrrrrrrrrr" . $conn->error;
                }
?>