<?php

if (isset($_POST['btn'])) {
    $pin = $_POST['pin'];

    $token = substr(time()*rand(9865476, 75345678886),1,11);
    // for ($pin=0; $pin < $token; $pin++) { 
    //     echo $token.$pin."<br>";
    //     // break;
    // }
    while ($token <= $pin) {
        echo $token++ ."<br>";
    }
}
?>

<form action="" method="post">
    <input type="text" name="pin">
    <button name="btn">submit</button>
</form>