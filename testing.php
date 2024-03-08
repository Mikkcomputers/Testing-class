<?php


include "../../server";  
// database($conn);
// $conn->close();
// function database($conn){
  // global $conn;
$username = "CREATE TABLE IF NOT EXISTS `admin` (
    `id_admin` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `fullname` varchar(100) NOT NULL,
    `username` varchar(100) NOT NULL UNIQUE,
    `phone` varchar(100) NOT NULL UNIQUE,
    `email` varchar(100) NOT NULL UNIQUE,
    `password` varchar(200) NOT NULL,
    `roll` int(11) NOT NULL DEFAULT '0',
    `verify` int(11) NOT NULL DEFAULT '0',
    `token` int(11) NOT NULL,
    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";
  $user = "CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `fullname` varchar(100) NOT NULL,
    `username` varchar(100) NOT NULL UNIQUE,
    `phone` varchar(15) NOT NULL UNIQUE,
    `amount` int(11) NOT NULL,
    `id_admin` int(11),
    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY(id_admin) REFERENCES `admin`(id_admin) 
  )";
  $credit  = "CREATE TABLE IF NOT EXISTS `credit` (
    `id` int(11) NOT NULL,
    `username` varchar(100) NOT NULL,
    `amount` varchar(15) NOT NULL,
    `id_admin` int(11),
    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY(id_admin) REFERENCES `admin`(id_admin) 
  )";
  $debit = "CREATE TABLE IF NOT EXISTS `debit` (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `username` varchar(100) NOT NULL,
    `amount` varchar(15) NOT NULL,
    `id_admin` int(11),
    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY(id_admin) REFERENCES `admin`(id_admin) 
  )"; 
 
  
  $rules = "CREATE TABLE IF NOT EXISTS `rules` (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `list` varchar(200) NOT NULL,
    `id_admin` int(11),
    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY(id_admin) REFERENCES `admin`(id_admin) 
  )"; 
$res = $conn->query($username) && $conn->query($user) && $conn->query($credit) && $conn->query($debit) && $conn->query($rules);
// if($res){  
// echo "create table";
// }
// else{
//   echo "creating table has an error".$conn->error;
// } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- <script src="../../sweetalert2/sweetalert2/dist/sweetalert2.all.js"></script> -->
    <script src="../../sweetalert2/sweetalert2/dist/sweetalert2.all.js"></script>
</head>
<body>
    
</body>
</html>
<?php
// define("HOST","localhost");
// define("USER","root");
// define("PASS","");
// define("DB_NAME","adashe_esystem");
// $conn = new mysqli(HOST,USER,PASS,DB_NAME);
// function register(){
    // include "../../server";
    // global $conn;
    $errors = array();
    $fullname = "";
    $username = "";
    $email = "";
    $phone = "";
    $password = "";
    $cpassword = "";

    if(isset($_POST['btn_reg'])){
        //variables declarations
        $errors = array();
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $verify = false;
        $token = substr(time()*rand(),1,6);
        $roll = 1;

        // validations

        if(empty($fullname)){
            $errors['fullname'] = 'Full Name Required';
        } 

        if(empty($username)){
            $errors['username'] = 'Username Required';
        } 

        if(empty($email)){
            $errors['email'] = 'Email Address Required';
        }  
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Invalid Email Address';
        } 
        
        if(empty($phone)){
            $errors['phone'] = 'Phone Number Required';
        }  
        
        if(empty($password)){
            $errors['password'] = 'Password Required';
        } 
        
        if(empty($cpassword)){
            $errors['cpassword'] = 'Confirm Password Required';
        } 
        
        if($password!=$cpassword){
            $errors['mismatch'] = 'The two passwords mismatched';
        }
        // if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        //         $errors['validate'] = "Invalid Email";
        // }

        if(count($errors)===0){
            $password = password_hash($password, PASSWORD_DEFAULT);
            

    $sql = "INSERT INTO `admin` (`fullname`, `username`, `phone`, `Email`, `password`,`roll`) VALUES('$fullname', '$username', '$phone', '$email',  '$password', $roll, $verify, $token)";
    $result = $conn->query($sql);
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param('ssssss', );
    // $result = $stmt->execute();
    if($result === True){
        echo "
            <script>
            // alert('register successfully');
                swal.fire('Successful','register successfully','success')
                .then(res){
                    if(True){
                        window.location='../login'
                    }
                }
            </script>
        ";
        }
    else{
        echo "
            <script>
                swal.fire('error','register have some error','error');
            </script>
        ".$conn->error;
    }}}

// }

// include "../function/index.php";
// database($con);
// register($conn);


?>


?>