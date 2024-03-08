<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="../../sweetalert2/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="../../sweetalert2/sweetalert2/dist/sweetalert2.min.js"></script>
</head>
<body>
    
</body>
</html>
<?php
include "../connection.php";
// include "./index.php";

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
        

$sql = "INSERT INTO `admin` (`fullname`, `username`, `phone`, `Email`, `password`,`roll`) VALUES('$fullname', '$username', '$phone', '$email',  '$password', $roll)";
$result = $conn->query($sql);
// $stmt = $conn->prepare($sql);
// $stmt->bind_param('ssssss', );
// $result = $stmt->execute();
if($result){
    echo "
        <script>
        // alert('register successfully');
            swal.fire('Successful','register successfully','success').then(()=>{window.location='../login'});
        </script>
    ";
    }
else{
    echo "
        <script>
        // alert('register have some error');

            swal.fire('error','register have some error','error');
        </script>
    ";
}}}


?>