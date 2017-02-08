<?php
$name     = $_POST['name'];
$email    = $_POST['email'];
$password = $_POST['pass1'];

include_once('config.php');
$result = mysqli_query($conn, "INSERT INTO `juskam`.`user`
            (`user_id`,
             `user_name`,
             `user_email`,
             `user_password`,
             `user_status`)
VALUES (NULL,
        '$name',
        '$email',
        '$password',
        '0');");
if ($result) {
    header('location: practice.php?registeration_successfull=<span style="color:white">You have successfully registered. You can now login.</span>');
} else {
    echo "failed";
}

?>
