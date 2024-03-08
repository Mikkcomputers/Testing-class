<?php
  include "../server/index.php";
  include "../core.php";
  require "../phpMailer/PHPMailer.php";
  require "../phpMailer/Exception.php";
  require "../phpMailer/SMTP.php";

//   use PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  $error = array();
  $username = "";
  $amount = "";

if(isset($_POST['btn_debit'])) {
  $error = array();
  $username = $_POST['username'];
  $amount = $_POST['amount'];
  $user = $_SESSION['admin'];

  if (empty($username)) {
      $error['fullname'] = "Pleased enter Username";
  }
  if (empty($amount)) {
      $error['amount'] = "Pleased enter Amount";
  }
  if (count($error) >0) {
      echo"<div class='alert alert-danger'>";
      foreach ($error as $value) {
          
          echo"<li>$value</li>";
      }
      echo"</div>";
  }
  if (count($error)===0) {

      
          //INSERT INTO USERS TABLE
  $sql2 = "SELECT SUM(amount) as total FROM `debit` WHERE `username` = '$username'";
  $res2 = $conn->query($sql2);
  // $data = $res2->fetch_assoc()['total'];
  // $credit_username = $data['username'];
  // $credit_amount = $data['amount'];
  $credit_amount = $res2->fetch_assoc()['total'] - $amount;
  
  $qry = "UPDATE `users` SET `amount` = ? WHERE `username` = ?";
  $stmt = $conn->prepare($qry);
  $stmt->bind_param("is", $credit_amount, $username);
  $res = $stmt->execute();


  // $sql = "INSERT INTO debit(`username`,`amount`, `user`)VALUES('$username', $amount, '$user')";
  $sql = "INSERT INTO debit(`username`,`amount`, `user`)VALUES(?,?,?)";
  // $result = $conn->query($sql);
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sis", $username, $amount, $user);
      $result = $stmt->execute();

      $query = "SELECT * FROM `users` WHERE `username` = '$username'";
      $res = $conn->query($query);
      $res->num_rows>0;
      $receiver = $res->fetch_assoc()['email']; 
      
      $admin = $_SESSION['admin'];
      $quer = "SELECT * FROM `admin` WHERE `username` = '$admin'";
      $res = $conn->query($quer);
      $res->num_rows>0;
      $sender = $res->fetch_assoc()['email']; 

  if ($result) {
  //     echo "
  //     <script>
  //     // alert('registration successful');
  //         swal.fire('Done','$username Withdraw $amount','success').then(()=>{window.location='../debit-history'});
  //     </script>
  // ";
  // }else{
  //     echo "
  //     <script>
  //         swal.fire('error','debit have an error','error');
  //     </script>
  // ";
  // }

  // --------------------
  $subject = "ADASHE WALLET";
  $message = "Welcome to Adashe Wallet "."<br> Thanks <b><u>".$username ."</u></b> for Withdraw ". $amount.   " ";
  // $message = "Welcome to Adashe Wallet please click verify below to verify your email \n <a href='verify_email.php?token=$token'>Verify Email</a>";
  $headers = "From: muhammaduisa1122@gmail.com" . "\r\n" .
  "CC: muhammaduisa1122@gmail.com";

//   //sender email
//   $sender = "";
//   //receipient email
//   $receiver = "";
       
  //Create instance of PHPMailer
  $mail = new PHPMailer();
  //Set mailer to use smtp
  $mail->isSMTP();
  //Define smtp host
  $mail->Host = "smtp.gmail.com";
  //Enable smtp authentication
  $mail->SMTPAuth = true;
  //Set smtp encryption type (ssl/tls)
  $mail->SMTPSecure = "ssl";
  //Port to connect smtp
  $mail->Port = "465";
  //Set gmail username
  $mail->Username = "email---------------";
  //Set gmail password
  $mail->Password = "password-----------------------";
  //Email subject
  $mail->Subject = $subject;
  //Set sender email
  $mail->setFrom($sender, "Debit");
  //Enable HTML
  $mail->isHTML(true);
  //Attachment
  // $mail->addAttachment('img/attachment.png');
  //Email body
  $mail->Body = $message;
  //Add recipient
  $mail->addAddress($receiver);
  //Finally send email
  if ( $mail->send() ) {
  // $_SESSION['sent'] = $subject2;
  
  echo "
      <script>
        swal.fire('Done','$username Withdraw $amount', 'success')
        function x(){
            window.location='../debit-history'
        }
        setTimeout(x,1000)
      </script>
  ";
  }else{
  echo "Withdraw Can not be Execute: ".$mail->ErrorInfo;
  }
  //Closing smtp connection
  $mail->smtpClose();  


// --------------------
}
else{
echo"fail.... ".$conn->error;
}
}}
//UPDATE WALLET BALANCE


// $sql = "UPDATE `users` SET amount = $new_balance  WHERE username = '$username' ";
//  $result = $conn->query($sql);




// EDIT
$update = false;
  
  
  $username = "";
  $amount = "";

  if(isset($_GET['edit'])){
      $update = true;
      $id = $_GET['edit'];

      $sql = "SELECT * FROM debit WHERE id=$id";
      $res = $conn->query($sql);
      $row = $res->fetch_assoc();

  if ($update==true) {
      $username = $row['username'];
      $amount = $row['amount'];
  }
  }

  //UPDATE

  if (isset($_POST['btn_update'])) {
      $id  = $_POST['hidden'];
      $username = $_POST['username'];
      $amount = $_POST['amount'];
      
      $sql = "UPDATE debit SET   username = '$username', amount = '$amount' WHERE id = $id";
      $result = mysqli_query($conn, $sql);
      if ($result) {
          header("Location: view_debit.php");
      }


  }
  

?>